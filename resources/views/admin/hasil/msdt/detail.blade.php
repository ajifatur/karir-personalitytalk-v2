@extends('template/admin/main')

@section('title', 'Data Hasil Tes')

@section('content')

<!-- Page Heading -->
<div class="page-heading shadow d-none">
  <h1 class="h3 text-gray-800">Data Hasil Tes</h1>
  <ol class="breadcrumb" id="breadcrumb">
    <li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
    <li class="breadcrumb-item"><a href="/admin/hasil">Hasil Tes</a></li>
    <li class="breadcrumb-item active" aria-current="page">MSDT</li>
  </ol>
</div>

<div class="row mb-4">
  <div class="col-xl-3 mb-3">
      <div class="card shadow">
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6 col-xl-12">
                      <p><b>Nama:</b><br>{{ $user->nama_user }} {{ $user->role == 6 ? '('.$user->email.')' : '' }}</p>
                  </div>
                  @if($user->role != 6)
                  <div class="col-md-6 col-xl-12">
                      <p><b>Usia:</b><br>{{ $user->role != 6 ? generate_age($user->tanggal_lahir, $hasil->created_at).' tahun' : '-' }}</p>
                  </div>
                  <div class="col-md-6 col-xl-12">
                      <p><b>Jenis Kelamin:</b><br>{{ $user->role != 6 ? $user->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' : '-' }}</p>
                  </div>
                  @endif
                  <div class="col-md-6 col-xl-12">
                      <p><b>Posisi:</b><br>{{ $user->role != 6 ? !empty($user_desc) ? $user_desc->nama_posisi : $role->nama_role : $posisi_magang }}</p>
                  </div>
                  <div class="col-md-6 col-xl-12">
                      <p><b>Role:</b><br>{{ $role->nama_role }}</p>
                  </div>
                  <div class="col-md-6 col-xl-12">
                      <p><b>Tes:</b><br>{{ $hasil->nama_tes }}</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-9">
    <!-- Card -->
    <div class="card shadow">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <div></div>
        <div>
            <a class="btn btn-sm btn-primary btn-print" href="#">
              <i class="fas fa-print fa-sm fa-fw text-gray-400"></i> Cetak
            </a>
        </div>
      </div>
        <div class="card-body">
          <form id="form" class="d-none" method="post" action="/admin/hasil/print" target="_blank">
              {{ csrf_field() }}
              <input type="hidden" name="id_hasil" value="{{ $hasil->id_hasil }}">
              <input type="hidden" name="nama" value="{{ $user->nama_user }}">
              <input type="hidden" name="usia" value="{{ generate_age($user->tanggal_lahir, $hasil->created_at).' tahun' }}">
              <input type="hidden" name="jenis_kelamin" value="{{ $user->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}">
              <input type="hidden" name="posisi" value="{{ !empty($user_desc) ? $user_desc->nama_posisi.' ('.$role->nama_role.')' : $role->nama_role }}">
              <input type="hidden" name="tes" value="{{ $hasil->nama_tes }}">
              <input type="hidden" name="path" value="{{ $hasil->path }}">
          </form>
          <div class="row mt-3">
            <div class="col">
              <div class="row">
                <div class="col">
                  <p class="h4 text-center font-weight-bold mb-5">Tipe: {{ $hasil->hasil['tipe'] }}</p>
                  @foreach($keterangan->keterangan as $ket)
                      @if($ket['tipe'] == strtolower($hasil->hasil['tipe']))
                          {!! html_entity_decode($ket['keterangan']) !!}
                      @endif
                  @endforeach
            </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  
@endsection

@section('css-extra')

<style type="text/css">
  table tr th, table tr td {padding: .25rem .5rem; text-align: center;}
  .table-identity {min-width: 1000px};
  .h6.mt-4 {text-align: justify!important;}
</style>

@endsection

@section('js-extra')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).on("click", ".btn-print", function(e){
  e.preventDefault();
  $("#form")[0].submit();
});
</script>

@endsection