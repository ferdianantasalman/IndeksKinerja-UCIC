@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Pertanyaan</h5>
                <a href="questions/create" class="btn btn-outline-primary mb-2">Tambah Data</a>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Pertanyaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $ct)
                            <tr>
                                <td>{{ $loop->index + 1 }}.</td>
                                <td>{{ $ct->category->name }}</td>
                                <td>{{ $ct->question_text }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('questions.edit', $ct->id) }}"
                                            class="btn btn-square btn-primary m-2"><i
                                                class="fa fa-pen"></i>{{ $ct->id }}</a>
                                        <form action="{{ route('questions.destroy', $ct->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                class="btn btn-square btn-primary m-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
