@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pertanyaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 20%">Judul</th>
                            <th style="width: 40%">Isi</th>
                            <th>Tag</th>
                            <th style="width: 276px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pertanyaan as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->judul }}</td>
                                <td>{!! $value->isi !!}</td>
                                <td>{{ $value->tag }}</td>
                                <td>
                                    <a href="/pertanyaan/{{ $value->id }}" class="btn btn-sm btn-info">Tampilkan</a>
                                    <a href="/pertanyaan/{{ $value->id }}/edit" class="btn btn-sm btn-secondary">Sunting</a>
                                    <form action="/pertanyaan/{{ $value->id }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onClick="AlertMsg();"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="/pertanyaan/create" class="btn btn-primary mb-4">
        Buat pertanyaan baru
    </a>
        
@endsection

@push('scripts')

<script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
  $(function () {
    $("#dataTable").DataTable();
  });
</script>
<script>
function AlertMsg() {
    Swal.fire({
        title: 'Berhasil!',
        text: 'Pertanyaan Berhasil di Delete',
        icon: 'success',
        confirmButtonText: 'Ok'
    })
}
</script>
 
@endpush