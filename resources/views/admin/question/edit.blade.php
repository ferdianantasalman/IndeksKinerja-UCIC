@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Edit Pertanyaan</h5>
                <form action="{{ route('questions.update', $questions->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Kategori</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($categories as $id => $category)
                                <option {{ $id == $questions->category->id ? 'selected' : null }}
                                    value="{{ $id }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="question_text" name="question_text"
                            value="{{ old('question_text', $questions->question_text) }}">
                    </div>
                    {{-- <div class="row"> --}}
                    <a href="/admin/questions" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
