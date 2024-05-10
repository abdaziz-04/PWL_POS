<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZy]pPEjISvSWaRU90FeRpok6YctnY#Dr5pNlyT2bRjh83MhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>File Upload</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">File Upload</h2>
            <form action="{{ url('/file-upload-tugas') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="namaFile" class="form-label">Nama Gambar</label>
                <input type="text" id="namaFile" class="form-control" placeholder="Masukkan nama file" name="namaFile">
              </div>
              <div class="mb-3">
                <label for="berkas" class="form-label">Gambar Profile</label>
                <input type="file" id="berkas" class="form-control" name="berkas">
                @error('berkas')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary btn-block">Upload</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
