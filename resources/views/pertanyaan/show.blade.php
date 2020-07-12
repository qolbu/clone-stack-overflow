@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-1">
        <div class="card shadow mb-4 text-center">
        <a href="voteup" class="pvup"><img src="{{ asset('img/up-arrow.png') }}"></a>
        <span class="vcount">0</span>
        <a href="votedown" class="pvdown"><img src="{{ asset('img/down-arrow.png') }}"></a>
        </div>
    </div>
    <div class="col-lg-11">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">{{ $tanya->judul }}</h4>
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
            <div class="tags col-sm-12 mb-4 small">
                Tag :&nbsp;&nbsp;&nbsp;&nbsp;
                @php $i=1 @endphp    
                @foreach ($tags as $value)
                    <a href="#" class="color{{$i}}">{{$value}}</a>
                    @php $i++ @endphp
                @endforeach
            </div>
        </div>
    </div>
</div>
    <h5 class="m-0 font-weight-bold text-primary mt-4 mb-1">Jawaban</h5>
    <div class="row">
        <div class="col-lg-1">
        <div class="card shadow mb-4 text-center">
        <a href="voteup" class="pvup"><img src="{{ asset('img/up-arrow.png') }}"></a>
        <span class="vcount">0</span>
        <a href="votedown" class="pvdown"><img src="{{ asset('img/down-arrow.png') }}"></a>
        </div>
        </div>
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @foreach ($jawab as $obj)
                        @if ($obj->pertanyaan_id == $tanya->id)
                            {!! $obj->isi !!}
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <h5 class="m-0 font-weight-bold text-primary mt-4 mb-1">Jawaban Anda</h5>
    <form action="/pertanyaan/{{ $tanya->id }}" method="POST">
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
@endsection

@push('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/fm.tagator.jquery.js') }}"></script>
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


@endpush