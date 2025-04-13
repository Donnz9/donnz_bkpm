<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use Intervention\Image\ImageManager;
use Illuminate\Support\Str;


class UploadController extends Controller
{

    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        echo 'File Name: ' . $file->getClientOriginalName() . '<br>';

        // ekstensi file
        echo 'File Extension: ' . $file->getClientOriginalExtension() . '<br>';

        // real path
        echo 'File Real Path: ' . $file->getRealPath() . '<br>';

        // ukuran file
        echo 'File Size: ' . $file->getSize() . '<br>';

        // tipe mime
        echo 'File Mime Type: ' . $file->getMimeType();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = public_path('data_file');

        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }

    public function resize_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // penyimpanan
        $originalPath = public_path('data_file');
        $resizePath = public_path('img/logo');

        // mastikan folder ada
        if (!File::isDirectory($originalPath)) {
            File::makeDirectory($originalPath, 0777, true);
        }

        if (!File::isDirectory($resizePath)) {
            File::makeDirectory($resizePath, 0777, true);
        }

        // ammbil file dari request
        $file = $request->file('file');

        // nyimpan file asli ke data_file
        $originalFileName = $file->getClientOriginalName();
        $file->move($originalPath, $originalFileName);

        // Ambil ulang file dari data_file untuk proses resize
        $originalFilePath = $originalPath . '/' . $originalFileName;

        // Buat nama file hasil resize
        $resizeFileName = 'logo_' . uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Proses resize
        $canvas = Image::canvas(200, 200);
        $resizeImage = Image::make($originalFilePath)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $canvas->insert($resizeImage, 'center');

        // Simpan hasil resize ke img/logo
        $canvas->save($resizePath . '/' . $resizeFileName);

        return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
    }

    public function dropzone_image()
    {
        return view('dropzone_image');
    }

    public function dropzone_image_store(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['message' => 'Tidak ada file yang terupload!'], 400);
        }

        $uploadedFiles = $request->file('file');
        $savedFiles = [];

        foreach ($uploadedFiles as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('img/dropzone'), $imageName);
            $savedFiles[] = $imageName;
        }

        return response()->json(['success' => $savedFiles]);
    }

    public function dropzone_pdf()
    {
        return view('dropzone_pdf');
    }

    public function dropzone_pdf_store(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['message' => 'Tidak ada file yang terupload!'], 400);
        }
    
        $uploadedFiles = $request->file('file');
        $savedFiles = [];
    
        foreach ($uploadedFiles as $pdf) {
            $pdfName = 'pdf_' . time() . '_' . uniqid() . '.' . $pdf->extension();
            $pdf->move(public_path('pdf/dropzone'), $pdfName);
            $savedFiles[] = $pdfName;
        }
    
        return response()->json(['success' => $savedFiles]);
    }
}
