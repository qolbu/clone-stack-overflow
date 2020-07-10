@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">{{ $tanya->judul }}</h6>
        </div>
        <div class="card-body">
            <p>{!! $tanya->isi !!}</p>
        </div>
        <div class="col-sm-2 mb-4 small">
            Tag : 
            <div class="card bg-secondary text-white shadow p-1">
                {{ $tanya->tag }}
            </div>
        </div>
    </div>
    <a href="/pertanyaan" class="btn btn-primary"><< Kembali ke daftar pertanyaan</a>
@endsection