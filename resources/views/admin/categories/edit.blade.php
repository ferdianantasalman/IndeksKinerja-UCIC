@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Edit Kategori</h5>
                {{-- <a href="">{{ $id }}</a> --}}
                <form action="{{ route('categories.update', $categories->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $categories->name }}" placeholder="{{ $categories->name }}">
                    </div>
                    {{-- <div class="row"> --}}
                    <a href="/admin/categories" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
