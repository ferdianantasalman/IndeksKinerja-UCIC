@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4">Detail</h5>
                <h6 class="mb-4">Total Nilai : {{ $results->total_points }}</h6>
                <a href="{{ route('results.index') }}" class="btn btn-outline-primary mb-2">Kembali</a>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results->questions as $question)
                            <tr>
                                <td>{{ $loop->index + 1 }}.</td>
                                <td>{{ $question->question_text }}</td>
                                <td>{{ $question->pivot->points }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
