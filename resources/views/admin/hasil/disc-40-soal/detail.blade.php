@extends('template/admin/main')

@section('title', 'Data Hasil Tes')

@section('content')

@php
  $posisi_magang = '';
  if($user->role == 6){
    if($user->jenis_kelamin == 1) $posisi_magang = 'Social Media Manager';
    elseif($user->jenis_kelamin == 2) $posisi_magang = 'Content Writer';
    elseif($user->jenis_kelamin == 3) $posisi_magang = 'Event Manager';
    elseif($user->jenis_kelamin == 4) $posisi_magang = 'Creative & Design Manager';
    elseif($user->jenis_kelamin == 5) $posisi_magang = 'Video Editor';
  }
@endphp

<!-- Page Heading -->
<div class="page-heading shadow d-none">
  <h1 class="h3 text-gray-800">Data Hasil Tes</h1>
  <ol class="breadcrumb" id="breadcrumb">
    <li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
    <li class="breadcrumb-item"><a href="/admin/hasil">Hasil Tes</a></li>
    <li class="breadcrumb-item active" aria-current="page">DISC 40 Soal</li>
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
              @php
                $posisi_magang = '';
                if($user->role == 6){
                  if($user->jenis_kelamin == 1) $posisi_magang = 'Social Media Manager (Magang)';
                  elseif($user->jenis_kelamin == 2) $posisi_magang = 'Content Writer (Magang)';
                  elseif($user->jenis_kelamin == 3) $posisi_magang = 'Event Manager (Magang)';
                  elseif($user->jenis_kelamin == 4) $posisi_magang = 'Creative & Design Manager (Magang)';
                  elseif($user->jenis_kelamin == 5) $posisi_magang = 'Video Editor (Magang)';
                }
              @endphp
              <input type="hidden" name="mostChartImage" id="mostChartImage">
              <input type="hidden" name="leastChartImage" id="leastChartImage">
              <input type="hidden" name="nama" value="{{ $user->nama_user }} {{ $user->role == 6 ? '('.$user->email.')' : '' }}">
              <input type="hidden" name="usia" value="{{ $user->role != 6 ? generate_age($user->tanggal_lahir, $hasil->created_at).' tahun' : '-' }}">
              <input type="hidden" name="jenis_kelamin" value="{{ $user->role != 6 ? $user->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' : '-' }}">
              <input type="hidden" name="posisi" value="{{ $user->role != 6 ? !empty($user_desc) ? $user_desc->nama_posisi.' ('.$role->nama_role.')' : $role->nama_role : $posisi_magang }}">
              <input type="hidden" name="tes" value="{{ $hasil->nama_tes }}">
              <input type="hidden" name="path" value="{{ $hasil->path }}">
              <input type="hidden" name="id_paket" value="{{ $hasil->id_paket }}">
              <input type="hidden" name="disc_score_m" value="{{ json_encode($disc_score_m) }}">
              <input type="hidden" name="disc_score_l" value="{{ json_encode($disc_score_l) }}">
              <input type="hidden" name="most" value="<?php echo implode("-", $code_m) ?>">
              <input type="hidden" name="least" value="<?php echo implode("-", $code_l) ?>">
              <input type="hidden" name="kode_keterangan" value="{{ $kode_keterangan }}">
          </form>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="grafik-tab" data-toggle="tab" href="#grafik" role="tab" aria-controls="grafik" aria-selected="true">Grafik</a>
              </li>
              <li class="nav-item" role="presentation">
                  <a class="nav-link" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="deskripsi" aria-selected="false">Deskripsi</a>
              </li>
          </ul>
          <div class="tab-content py-4" id="myTabContent">
            <div class="tab-pane fade show active" id="grafik" role="tabpanel" aria-labelledby="grafik-tab">
              <div class="row align-items-center">
                  <div class="col-xl-auto">
                      <div class="row">
                          <div class="col-auto mx-auto">
                            <table class="table-bordered">
                              <thead bgcolor="#bebebe">
                                <tr>
                                  <th width="50" rowspan="2">#</th>
                                  <th width="100">MOST</th>
                                  <th width="100">LEAST</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($disc as $letter)
                                <tr>
                                  <td align="center" bgcolor="#bebebe"><strong>{{ $letter }}</strong></td>
                                  <td align="center" bgcolor="#eeeeee">{{ array_key_exists($letter, $disc_score_m) ? $disc_score_m[$letter]['score'] : 0 }}</td>
                                  <td align="center" bgcolor="#eeeeee">{{ array_key_exists($letter, $disc_score_l) ? $disc_score_l[$letter]['score'] : 0 }}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl mt-3 mt-xl-0 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                          <p class="text-center mb-0 font-weight-bold">Response to the Environment</p>
                          <p class="text-center mb-0 font-weight-bold">MOST</p>
                          <p class="text-center mb-0 font-weight-bold">Adapted: (<?php echo implode("-", $code_m) ?>)</p>
                          <canvas class="mt-3" id="mostChart" width="200" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                          <p class="text-center mb-0 font-weight-bold">Basic Style</p>
                          <p class="text-center mb-0 font-weight-bold">LEAST</p>
                          <p class="text-center mb-0 font-weight-bold">Natural: (<?php echo implode("-", $code_l) ?>)</p>
                          <canvas class="mt-3" id="leastChart" width="200" height="150"></canvas>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="tab-pane fade" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
              <div class="p-2 deskripsi">{!! html_entity_decode($hasil_keterangan) !!}</div>
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
  .deskripsi {border-style: groove; font-size: smaller;}
  .deskripsi p {margin-bottom: .5rem; text-align: justify;}
  @media(min-width: 768px){
    .deskripsi {columns: 2;}
  }
</style>

@endsection

@section('js-extra')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script type="text/javascript">

function generateMostChart(){
    var url = mostChart.toBase64Image();
    document.getElementById("mostChartImage").value = url;
}

function generateLeastChart(){
    var url = leastChart.toBase64Image();
    document.getElementById("leastChartImage").value = url;
}

var ctx1 = document.getElementById('mostChart').getContext('2d');
var mostChart = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ['D', 'I', 'S', 'C'],
        datasets: [{
            label: 'Score',
            data: [{{ array_key_exists('D', $disc_score_m) ? $disc_score_m['D']['score'] : 0 }}, {{ array_key_exists('I', $disc_score_m) ? $disc_score_m['I']['score'] : 0 }}, {{ array_key_exists('S', $disc_score_m) ? $disc_score_m['S']['score'] : 0 }}, {{ array_key_exists('C', $disc_score_m) ? $disc_score_m['C']['score'] : 0 }}],
            fill: false,
            backgroundColor: '#FF6B8A',
            borderColor: '#FF6B8A',
            lineTension: 0
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100,
                    stepSize: 25
                }
            }]
        },
        bezierCurve : false,
        animation: {
            onComplete: generateMostChart
        }
    }
});

var ctx2 = document.getElementById('leastChart').getContext('2d');
var leastChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ['D', 'I', 'S', 'C'],
        datasets: [{
            label: 'Score',
            data: [{{ array_key_exists('D', $disc_score_l) ? $disc_score_l['D']['score'] : 0 }}, {{ array_key_exists('I', $disc_score_l) ? $disc_score_l['I']['score'] : 0 }}, {{ array_key_exists('S', $disc_score_l) ? $disc_score_l['S']['score'] : 0 }}, {{ array_key_exists('C', $disc_score_l) ? $disc_score_l['C']['score'] : 0 }}],
            fill: false,
            backgroundColor: '#fd7e14',
            borderColor: '#fd7e14',
            lineTension: 0
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100,
                    stepSize: 25
                }
            }]
        },
        bezierCurve : false,
        animation: {
            onComplete: generateLeastChart
        }
    }
});

$(document).on("click", ".btn-print", function(e){
  e.preventDefault();
  $("#form")[0].submit();
});

// $(document).on("click", ".btn-print", function(e){
//   e.preventDefault();
//   window.print();
// });
</script>

@endsection