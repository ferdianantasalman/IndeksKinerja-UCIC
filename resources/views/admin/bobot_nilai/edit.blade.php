@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Edit Bobot Nilai</h5>
                {{-- <a href="">{{ $id }}</a> --}}
                <form action="{{ route('bobotnilai.update', $bobotNilai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category"
                            value="{{ $bobotNilai->category }}" ">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $bobotNilai->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="point" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="point" name="point"
                                value="{{ $bobotNilai->point }}">
                        </div>
                        {{-- <div class="row"> --}}
                        <a href="/admin/bobotnilai" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        {{-- </div> --}}
                    </form>
                </div>
            </div>
        </div>
@endsection
