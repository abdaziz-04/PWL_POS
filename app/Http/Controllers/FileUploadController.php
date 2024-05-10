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

        $path = $request->berkas->store('uploads');
        echo "Berhasil upload, file berada di: $path";
        // echo $request->berkas->getClientOriginalName()."Lolos validasi";

        if ($request->hasFile("berkas")) {
            echo "path(): " . $request->berkas->path() . "<br>";
            echo "extension(): " . $request->berkas->extension() . "<br>";
            echo "getClientOriginalExtension(): " . $request->berkas->getClientOriginalExtension() . "<br>";
            echo "getMimeType(): " . $request->berkas->getMimeType() . "<br>";
            echo "getClientOriginalName(): " . $request->berkas->getClientOriginalName() . "<br>";
            echo "getSize(): " . $request->berkas->getSize();
        } else {
            echo "Tidak ada berkas yang diupload";
        }
    }
}
