@extends('dosen.layouts.main')

@section('content-dosen')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Hasil Fungsional</h5>
                <a href="/dosen/test_fungsional" class="btn btn-outline-primary mb-2">Mulai Survey</a>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Nilai</th>
                            <th>Pertanyaan</th>
                            {{-- <th>Jawaban</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td>{{ $loop->index + 1 }}.</td>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->total_points }}</td>
                                <td>
                                    @foreach ($result->questions as $question)
                                        <span>{{ $question->question_text }}, </span>
                                    @endforeach
                                </td>
                                {{-- <td>{{ $result->options }}</td> --}}
                                {{-- <td>
                                    @foreach ($result->questions as $key => $question)
                                        <span class="badge badge-info">{{ $question->question_text }}</span>
                                    @endforeach
                                </td> --}}
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('dosen.result.show', $result->id) }}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- <a href="{{ route('results.edit', $result->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a> --}}
                                        <form onclick="return confirm('yakin ingin menghapus ? ')" class="d-inline"
                                            action="{{ route('dosen.result.destroy', $result->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"
                                                style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
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
