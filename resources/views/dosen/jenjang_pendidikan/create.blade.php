@extends('dosen.layouts.main')

@section('content-dosen')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Tambah Bobot Nilai</h5>
                <form action="/rektorat/bobotnilai" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="point" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="point" name="point">
                    </div>
                    {{-- <div class="row"> --}}
                    <a href="/rektorat/bobotnilai" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
