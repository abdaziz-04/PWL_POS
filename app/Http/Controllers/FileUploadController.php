<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload() {
        return view('file-upload');
    }
    public function fileUpload2() {
        return view('uploadFile.file-upload-tugas');
    }

    public function prosesFileUpload2(Request $request) {
        $request->validate([
            'namaFile' => 'required|min:3',
            'berkas' => 'required|file|image|max:5000',
        ]);
            $namaFile = $request->namaFile . '.' . $request->berkas->getClientOriginalExtension();

            $path = $request->berkas->move('gambar', $namaFile);
            $path = str_replace("\\", "//", $path);

            $pathBaru = asset('gambar/'.$namaFile);

            return view('uploadFile.show-image', ['imagePath' => $pathBaru]);
    }


    public function prosesFileUpload(Request $request) {
        // dump($request->berkas);
        $request->validate([
            'berkas'=>'required|file|image|max:5000',]);

        $extFile  = $request->berkas->getClientOriginalExtension();
        $namaFile = 'web-' .time(). "." .$extFile;

        $path = $request->berkas->move('gambar', $namaFile); //  Method getClientOriginalName() akan menyimpan file dengan nama file original
        $path =str_replace("\\","//", $path);
        echo "Variabel path berisi: $path <br>";

        $pathBaru = asset('gambar/'.$namaFile);

        echo "Berhasil upload, data disimpan pada: $path";
        echo "<br>";
        echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
        // echo $request->berkas->getClientOriginalName()."Lolos validasi";
    }
}
