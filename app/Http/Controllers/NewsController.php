<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        if ($search) {
            $news = News::where('title', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->orderByDesc('priority_level')->paginate(config('const.perPage'));
        } else {
            $news = News::orderByDesc('created_at')->orderByDesc('priority_level')->paginate(config('const.perPage'));
        }


        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'nullable',
            'content' => 'nullable',
            'submitted_date' => 'required',
            'source_news' => 'nullable',
            'author' => 'nullable',
            'key_words' => 'nullable',
            'priority_level' => 'required'
        ]);
        $validatedData['status'] = News::STATUS_SUBMITTED;
        // Lưu ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . $image->getClientOriginalName();

            $path = $image->move('imgNews', $filename);

            $validatedData['image'] = $path;
            $validatedData['filename'] = $filename;
        }
        News::create($validatedData);

        return redirect()->route('news.index')
            ->with('success', 'Bài viết đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  News $new
     * @return \Illuminate\Http\Response
     */
    public function show(News $new)
    {

        return view('admin.news.show', compact('new'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News $new
     * @return \Illuminate\Http\Response
     */
    public function edit(News $new)
    {
        return view('admin.news.edit', compact('new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  News $new
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $new)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'nullable',
            'content' => 'nullable',
            'source_news' => 'nullable',
            'author' => 'nullable',
            'priority_level' => 'nullable',
            'key_words' => 'nullable',
        ]);
        $validatedData['submitted_date'] = now();
        // Handle the avatar file upload
        if ($request->image) {
            $imagePath = "./imgNews/" . $new->filename;
            // Delete the old image file, if there is one
            if ($new->image) {
                Storage::delete($new->image);
                File::delete($imagePath);
            }

            $image = $request->file('image');

            $filename = time() . '_' . $image->getClientOriginalName();
            // Store the new image file
            $imagePath = $request->file('image')->move('imgNews', $filename);
            $validatedData['image'] = $imagePath;
            $validatedData['filename'] = $filename;
        }
        $validatedData['status'] = News::STATUS_SUBMITTED;
        $new->update($validatedData);

        return redirect()->route('news.index')
            ->with('success', 'Thông tin bài viết đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $new
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $new)
    {
        $new->delete();

        return redirect()->route('news.index')
            ->with('success', 'Bài viết đã được xoá thành công.');
    }
}
