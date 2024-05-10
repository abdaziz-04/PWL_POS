<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload() {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request) {
        // dump($request->berkas);
        $request->validate([
            'berkas'=>'required|file|image|max:5000',]);

        // $path = $request->berkas->store('uploads'); // Method store akan menyimpan file dengan nama acak

        $namaFile = $request->berkas->getClientOriginalName();
        $path = $request->berkas->storeAs('uploads', $namaFile); //  Method getClientOriginalName() akan menyimpan file dengan nama file original
        echo "Berhasil upload, file berada di: $path";
        // echo $request->berkas->getClientOriginalName()."Lolos validasi";
    }
}
