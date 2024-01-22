@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Bobot Nilai</h5>
                <a href="bobotnilai/create" class="btn btn-outline-primary mb-2">Tambah Data</a>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Pertanyaan</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bobot_nilai as $bn)
                            <tr>
                                <td>{{ $loop->index + 1 }}.</td>
                                <td>{{ $bn->category }}</td>
                                <td>{{ $bn->name }}</td>
                                <td>{{ $bn->point }}</td>
                                <td>
                                    <div class="m-n2">
                                        <a href="{{ route('bobotnilai.edit', $bn->id) }}"
                                            class="btn btn-square btn-primary m-2"><i
                                                class="fa fa-pen"></i>{{ $bn->id }}</a>
                                        <form action="{{ route('bobotnilai.destroy', $bn->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                class="btn btn-square btn-primary m-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- <a href="{{ route('bobotnilai.destroy', $bn->id) }}" data-confirm-delete="true"
                                            class="btn btn-square btn-primary m-2"><i class="fa fa-trash"></i></a> --}}
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
