<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Validation\ValidatesRequests;

class UploadController extends Controller
{
    use ValidatesRequests;
    public function upload(){
        return view('upload');
    }
    
    public function proses_upload(Request $request){
        $this->validate($request, [
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'keterangan' => 'required',
        ]);
    
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        echo 'File Name: '.$file->getClientOriginalName().'<br>';

        // ekstensi file
        echo 'File Extension: '.$file->getClientOriginalExtension().'<br>';

        // real path
        echo 'File Real Path: '.$file->getRealPath().'<br>';

        // ukuran file
        echo 'File Size: '.$file->getSize().'<br>';

        // tipe mime
        echo 'File Mime Type: '.$file->getMimeType();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'storage/data_file'; // Menggunakan storage Laravel

        // upload file
        $file->move(public_path($tujuan_upload), $file->getClientOriginalName());

        return "File berhasil diupload ke: " . asset($tujuan_upload.'/'.$file->getClientOriginalName());
    }
}
