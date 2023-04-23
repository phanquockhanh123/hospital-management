<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Mail\MailJoinMeeting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\ClientException;
use App\Http\Requests\Web\Zoom\CreateZoomCredentialsRequest;

class ZoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function generateJWTKey()
    {
        $zoom_api_key = 'fWBNUamhRDy47DJSFL5Cyg';
        $zoom_api_secret = 's3zQJ54wnMasL2brfjiAGUJ4KTVi1ti6GAtU';

        $token = [
            "iss" => $zoom_api_key,
            "exp" => time() + 3600
        ];
        return JWT::encode($token, $zoom_api_secret, 'HS256');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $meetings = Meeting::where('meeting_name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $meetings = Meeting::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        return view('zoom.index', compact('meetings'));
    }

    public function create()
    {
        return view('zoom.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'meeting_name' => 'required',
            'meeting_password' => 'required'
        ]);

        try {
            $client = new Client(['base_uri' => 'https://api.zoom.us']);
            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " . $this->generateJWTKey(),
                ],
                'json' => [
                    "topic" => $request->meeting_name,
                    'password' => $request->meeting_password,
                    "type" => 2,
                    "duration" => "30",
                ],
                'seetings' => [
                    'host_video' => true,
                    'audio' => 'both',
                    'join_before_host' => false,
                ]
            ]);

            $data = json_decode($response->getBody());
            $meeting = new Meeting();
            $meeting->meeting_name = $request->meeting_name;
            $meeting->meeting_password = $request->meeting_password;
            $meeting->meeting_id = $data->id;
            $meeting->user_id = Auth::id();
            $meeting->start_url = $data->start_url;
            $meeting->join_url = $data->join_url;
            $meeting->save();
        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody();
            $response_properties = json_decode($response);
            if ($response_properties->code == 124) {
                Session::flash('error', 'Please Check Your Zoom Credentials And Try Again');
                return back();
            }
        }

        return redirect()->route('meetings.index');
    }

    public function start_meeting($meeting)
    {
        $meeting = Meeting::where('meeting_id', $meeting)->orderByDesc('created_at')->first();
        $role = 1;
        if (!$meeting->is_active) {
            $meeting->update([
                'is_active' => true
            ]);
        }
        // dd($meeting);
        $users = User::where('role', '!=', 0)->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new MailJoinMeeting($user, $meeting));
        }
        
        return Redirect::to($meeting->start_url);
        // return view('zoom.start', compact('meeting', 'role'));
    }

    public function join_meeting($meeting)
    {
        $meeting = Meeting::where('meeting_id', $meeting)->first();
        $role = 0;
        return view('zoom.start', compact('meeting', 'role'));
    }

    public function leave_meeting(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $meeting = Meeting::where('meeting_id', $meeting_id)->first();

        $meeting->update([
            'finished' => true
        ]);

        return redirect()->route('meetings.index');
    }

    public function destroy($meeting_id)
    {
        $meeting = Meeting::where('meeting_id', $meeting_id)->first();

        try {
            $client = new Client(['base_uri' => 'https://api.zoom.us']);
            $client->request('DELETE', '/v2/meetings/' . $meeting_id, [
                "headers" => [
                    "Authorization" => "Bearer " . $this->generateJWTKey(),
                ],

                'seetings' => [
                    'meetingId' => $meeting_id,

                ]
            ]);
        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody();
            $response_properties = json_decode($response);
            if ($response_properties->code == 3002) {
                Session::flash('error', 'Sorry, you cannot delete this meeting since it\'s in progress.');
                return back();
            }
        }

        $meeting->delete();
        return back();
    }
}
