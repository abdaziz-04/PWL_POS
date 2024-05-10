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

        $extFile  = $request->berkas->getClientOriginalExtension();
        $namaFile = 'web-' .time(). "." .$extFile;
        $path = $request->berkas->storeAs('public', $namaFile); //  Method getClientOriginalName() akan menyimpan file dengan nama file original
        $pathBaru = asset('storage/'.$namaFile);

        echo "Berhasil upload, file berada di: $path";
        echo "<br>";
        echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
        // echo $request->berkas->getClientOriginalName()."Lolos validasi";
    }
}
