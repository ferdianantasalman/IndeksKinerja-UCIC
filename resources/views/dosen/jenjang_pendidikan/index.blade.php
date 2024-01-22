@extends('dosen.layouts.main')

@section('content-dosen')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Jenjang Pendidikan</h5>
                <a href="jenjangpendidikan/create" class="btn btn-outline-primary mb-2">Nilai</a>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenjang</th>
                            <th>Point</th>
                            <th>Tahun</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenjang_pendidikan as $jf)
                            <tr>
                                <td>{{ $loop->index + 1 }}.</td>
                                <td>{{ $jf->jenjang }}</td>
                                <td>{{ $jf->point }}</td>
                                <td>{{ $jf->tahun }}</td>
                                <td>{{ $jf->semester }}</td>
                                <td>
                                    <div class="m-n2">
                                        <a href="{{ route('jenjangfungsional.edit', $jf->id) }}"
                                            class="btn btn-square btn-primary m-2"><i
                                                class="fa fa-pen"></i>{{ $jf->id }}</a>
                                        {{-- <form action="{{ route('bobotnilai.destroy', $jf->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                class="btn btn-square btn-primary m-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form> --}}
                                        <a href="{{ route('jenjangfungsional.destroy', $jf->id) }}"
                                            data-confirm-delete="true" class="btn btn-square btn-primary m-2"><i
                                                class="fa fa-trash"></i></a>
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
