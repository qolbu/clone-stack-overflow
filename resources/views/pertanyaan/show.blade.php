@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">{{ $tanya->judul }}</h6>
        </div>
        <div class="card-body">
            <p>{!! $tanya->isi !!}</p>
        </div>
        <div class="tags col-sm-6 mb-4 small">
            Tag :
            @php $i=1 @endphp    
            @foreach ($tags as $value)
                <a href="#" class="color{{$i}}">{{$value}}</a>
                @php $i++ @endphp
            @endforeach
        </div>
    </div>
    <a href="/pertanyaan" class="btn btn-primary"><< Kembali ke daftar pertanyaan</a>
@endsection