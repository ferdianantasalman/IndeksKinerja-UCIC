@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Tambah Pertanyaan</h5>
                <form action="/admin/jenjang_fungsional/options" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Kategori</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($categories as $id => $category)
                                <option value="{{ $id }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="question_id" class="form-label">Pertanyaan</label>
                        <select class="form-control" name="question_id" id="question_id">
                            @foreach ($questions as $id => $question)
                                <option value="{{ $id }}">{{ $question }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="option_text" class="form-label">Jawaban</label>
                        <input type="text" class="form-control" id="option_text" name="option_text"
                            value="{{ old('option_text') }}">
                    </div>
                    <div class="mb-3">
                        <label for="point" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="point" name="point"
                            value=" {{ old('point') }}">
                    </div>
                    {{-- <div class="row"> --}}
                    <a href="/admin/jenjang_fungsional/options" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
