@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-1">
        <div class="card shadow mb-4 text-center">
        <a href="voteup" class="pvup {{$tanya->id}}"><img src="{{ asset('img/up-arrow.png') }}"></a>
        <span class="vcount">0</span>
        <a href="votedown" class="pvdown {{$tanya->id}}"><img src="{{ asset('img/down-arrow.png') }}"></a>
        </div>
    </div>
    <div class="col-lg-11">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" title="{{ $tanya->judul }}">{{ $tanya->judul }}</h4>
            </div>
            <div class="card-body">
                <p>
                    <h6>
                        Dibuat pada: {{ $tanya->created_at }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Diperbarui pada: {{ $tanya->updated_at }}
                    </h6>
                </p>
                <hr>
                <p>{!! $tanya->isi !!}</p>
            </div>
            <div class="tags card-body">
                Tag :&nbsp;&nbsp;&nbsp;&nbsp;
                @php $i=1 @endphp    
                @foreach ($tags as $value)
                <a href="#" class="color{{$i}}">{{$value}}</a>
                @php $i++ @endphp
                @endforeach
            </div>
            <div class="card-body">
                <p>
                    Ditanyakan oleh: 
                    @foreach ($user as $u)
                        @if ($u->id == $tanya->user_id)
                        <a href="#" title="{{ $u->name }}">
                                {{ $u->name }}
                        @endif
                    @endforeach
                    </a>
                </p>
            </div>
            <div class="card-footer small">
                @foreach ($komen_tanya as $kt)
                    @if ($kt->pertanyaan_id  == $tanya->id)
                        {!! $kt->isi !!} -
                        @foreach ($user as $u)
                            @if ($u->id == $kt->user_id)
                            <a href="#" title="{{ $u->name }}">
                                    {{ $u->name }}
                            @endif
                        @endforeach
                        </a>
                        <hr>
                    @endif
                @endforeach
                <form action="/komentarpertanyaan/{{ $tanya->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control my-editor" placeholder="tambahkan komentar ..." name="isi" id="isi" rows="3"></textarea>
            
                        @if($errors->has('isi'))
                            <div class="text-danger">
                                {{ $errors->first('isi')}}
                            </div>
                        @endif
                    </div>
                    <input type="hidden" class="form-control" value="{{ $tanya->id }}" id="pertanyaan_id" name="pertanyaan_id">
                    <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" id="user_id" name="user_id">
                    <button type="submit" style="width: auto" class="btn btn-primary btn-user btn-block">
                        Beri komentar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
    <h5 class="m-0 font-weight-bold text-primary mt-4 mb-2">Jawaban</h5>
    <div class="row">
        @foreach ($jawab as $obj)
            @if ($obj->pertanyaan_id == $tanya->id)
                <div class="col-lg-1">
                    <div class="card shadow mb-4 text-center">
                        <a href="voteup" class="pvup {{$obj->id}}"><img src="{{ asset('img/up-arrow.png') }}"></a>
                        <span class="vcount">0</span>
                        <a href="votedown" class="pvdown {{$obj->id}}"><img src="{{ asset('img/down-arrow.png') }}"></a>
                    </div>
                </div>
                <div class="col-lg-11">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            {!! $obj->isi !!}
                            @if(Auth::user()->id==$obj->user_id)
                            <button type="button" class="btn btn-sm btn-info open_modal" value="{{ $obj->id }}"><i class="fas fa-edit"></i></button>
                            <a href="/delete/jawaban/{{ $obj->id }}" class="btn btn-sm btn-danger" onClick="Alertx()"><i class="fas fa-trash"></i></a>
                            @endif                      
                        </div>
                        <div class="card-body">
                            <p>
                                Dijawab oleh: 
                                @foreach ($user as $u)
                                    @if ($u->id == $obj->user_id)
                                    <a href="#" title="{{ $u->name }}">
                                            {{ $u->name }}
                                    @endif
                                @endforeach
                                </a>
                            </p>
                        </div>
                        <div class="card-footer small">
                            @foreach ($komen_jawab as $kj)
                                @if ($kj->jawaban_id  == $obj->id)
                                    {!! $kj->isi !!} -
                                    @foreach ($user as $u)
                                        @if ($u->id == $kj->user_id)
                                        <a href="#" title="{{ $u->name }}">
                                                {{ $u->name }}
                                        @endif
                                    @endforeach
                                    </a>
                                    <hr>
                                @endif
                            @endforeach
                            <form action="/komentarjawaban/{{ $obj->id }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control my-editor" placeholder="tambahkan komentar ..." name="isi" id="isi" rows="3"></textarea>
                        
                                    @if($errors->has('isi'))
                                        <div class="text-danger">
                                            {{ $errors->first('isi')}}
                                        </div>
                                    @endif
                                </div>
                                <input type="hidden" class="form-control" value="{{ $obj->id }}" id="jawaban_id" name="jawaban_id">
                                <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" id="user_id" name="user_id">
                                <button type="submit" style="width: auto" class="btn btn-primary btn-user btn-block">
                                    Beri komentar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <h5 class="m-0 font-weight-bold text-primary mt-4 mb-1">Jawaban Anda</h5>
    <form action="/jawaban/{{ $tanya->id }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea class="form-control my-editor" placeholder="Tulis jawaban ..." name="isi" id="isi" rows="6"></textarea>

            @if($errors->has('isi'))
                <div class="text-danger">
                    {{ $errors->first('isi')}}
                </div>
            @endif
        </div>
        <input type="hidden" class="form-control" value="{{ $tanya->id }}" id="pertanyaan_id" name="pertanyaan_id">
        <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" id="user_id" name="user_id">
        <button type="submit" style="width: auto" class="btn btn-primary btn-user btn-block">
            Jawab
        </button>
    </form>
    <div>
        <a href="/pertanyaan" class="btn btn-info my-2"><< Kembali ke daftar pertanyaan</a>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Jawaban</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    tes
                </div> 
            </div>
        </div>        
    </div>
@endsection

@push('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/fm.tagator.jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
 
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
 
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
 
  tinymce.init(editor_config);
</script>

<script type="text/javascript">
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".vup").click(function(e){
  
        e.preventDefault();
   
        $.ajax({
           type:'POST',
           url:"",
           data:{name:name, password:password, email:email},
           success:function(data){
              alert(data.success);
           }
        });
  
	});
</script>
<script>
    $(document).on('click','.open_modal',function(){
        $('#myModal').modal('show');
    });
</script>
<script>
    function Alertx(){
        Swal.fire({
            title: 'Apakah Yakin Mau dihapus ?',
            text: 'Anda akan menghapus data ini !!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ya saya yakin',
            cancelButtonText: 'Tidak',
            closeOnConfirm: false,
            closeOnCancel:false
        },
        function (isConfirm){
            if(isConfirm){
            swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
        });
    }
</script>

<script type="text/javascript">
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".pvup").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        // pertanyaan_id atau jawaban_id
        var pj_id = $(this).attr('class').replace('pvup ', '');
        alert(pj_id);
        $.ajax({
           type:'POST',
           url:"",
           data:{name:name, password:password, email:email},
           success:function(data){
              alert(data.success);
           }
        });
	});

    $(".pvdown").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        // pertanyaan_id atau jawaban_id
        var pj_id = $(this).attr('class').replace('pvdown ', '');
        alert(pj_id);
        $.ajax({
            type:'POST',
            url:"",
            data:{name:name, password:password, email:email},
            success:function(data){
                alert(data.success);
            }
        });
    });
</script>
@endpush