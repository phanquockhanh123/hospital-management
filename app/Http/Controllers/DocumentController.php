<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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
            $documents = Document::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $documents = Document::orderByDesc('created_at')->paginate(config('const.perPage'));
        }


        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admin.documents.create', compact('doctors', 'patients'));
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
            'title' => 'required|string|max:255',
            'document_file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:5120',
            'patient_id' => 'required|integer|exists:patients,id,deleted_at,NULL',
            'doctor_id' => 'required|integer|exists:doctors,id,deleted_at,NULL',
            'note' => 'nullable|string|max:255',
            'document_type' => 'required|in:' . implode(',', array_keys(Document::$documentTypes)),
        ]);
        // Lưu file
        if ($request->hasFile('document_file')) {
            $document_file = $request->file('document_file');

            $filename = time() . '_' . $document_file->getClientOriginalName();

            $path = $document_file->move('documentFile', $filename);

            $validatedData['document_file'] = $path;
            $validatedData['filename'] = $filename;
        }
        Document::create($validatedData);
        
        return redirect()->route('documents.index')
            ->with('success', 'Tài liệu bệnh nhân đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {

        return view('admin.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admin.documents.edit', compact('document', 'doctors', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'document_file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:5120',
            'patient_id' => 'required|integer|exists:patients,id,deleted_at,NULL',
            'doctor_id' => 'required|integer|exists:doctors,id,deleted_at,NULL',
            'note' => 'nullable|string|max:255',
            'document_type' => 'required|in:' . implode(',', array_keys(Document::$documentTypes)),
        ]);

        // Handle the avatar file upload
        if ($request->document_file) {
            $filePath = "./documentFile/" . $document->filename;
            // Delete the old profile file, if there is one
            if ($document->document_file) {
                Storage::delete($document->document_file);
                File::delete($filePath);
            }

            $document_file = $request->file('document_file');

            $filename = time() . '_' . $document_file->getClientOriginalName();
            // Store the new profile file
            $profilePath = $request->file('document_file')->move('documentFile', $filename);
            $validatedData['document_file'] = $profilePath;
            $validatedData['filename'] = $filename;
        }
        $document->update($validatedData);

        return redirect()->route('documents.index')
            ->with('success', 'Thông tin tài liệu bệnh nhân đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Tài liệu bệnh nhân đã được xoá thành công.');
    }
}
