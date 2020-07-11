@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Pertanyaan Baru</h6>
        </div>
        <div class="card-body">
            <form action="/pertanyaan" method="POST">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" placeholder="Judul pertanyaan ..." name="judul" id="judul">

                    @if($errors->has('judul'))
                        <div class="text-danger">
                            {{ $errors->first('judul')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control my-editor" placeholder="Isi pertanyaan ..." name="isi" id="isi" rows="6"></textarea>

                    @if($errors->has('isi'))
                        <div class="text-danger">
                            {{ $errors->first('isi')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="tag">Tag (Diakhiri dengan Koma)</label>
                    <input type="text" class="form-control" placeholder="Tambahkan tag ..." name="tag" id="tag">

                    @if($errors->has('tag'))
                        <div class="text-danger">
                            {{ $errors->first('tag')}}
                        </div>
                    @endif
                </div>
                <button type="submit" style="width: auto" class="btn btn-primary btn-user btn-block">
                    Buat pertanyaan
                </button>
                <a href="/pertanyaan" style="width: 7%" class="btn btn-danger btn-user btn-block">
                    Batal
                </a>
            </form>
        </div>
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

    
<script>
    $(function () {
        var $input_tagator1 = $('#tag');
        
        if ($input_tagator1.data('tagator') === undefined) {
            $input_tagator1.tagator({
                autocomplete: ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth'],
                useDimmer: true
            });
        } else {
            $input_tagator1.tagator('destroy');
        }
       
        
    });
</script>

@endpush