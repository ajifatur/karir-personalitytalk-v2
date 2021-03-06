@extends('template/admin/main')

@section('title', 'Tambah Karyawan')

@section('content')

  <!-- Page Heading -->
  <div class="page-heading shadow d-none">
    <h1 class="h3 text-gray-800">Tambah Karyawan</h1>
    <ol class="breadcrumb" id="breadcrumb">
      <li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
      <li class="breadcrumb-item"><a href="/admin/karyawan">Karyawan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Karyawan</li>
    </ol>
  </div>

  <!-- Card -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <form method="post" action="/admin/karyawan/store" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Nama Lengkap: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <input name="nama_lengkap" type="text" class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') }}">
            @if($errors->has('nama_lengkap'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('nama_lengkap')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Email: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Masukkan Email" value="{{ old('email') }}">
            @if($errors->has('email'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('email')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Tanggal Lahir: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <input name="tanggal_lahir" type="text" class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
            @if($errors->has('tanggal_lahir'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('tanggal_lahir')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Jenis Kelamin: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }} custom-select">
                <option value="" disabled selected>--Pilih--</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @if($errors->has('jenis_kelamin'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('jenis_kelamin')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Nomor HP: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <input name="nomor_hp" type="text" class="form-control {{ $errors->has('nomor_hp') ? 'is-invalid' : '' }}" placeholder="Masukkan Nomor HP" value="{{ old('nomor_hp') }}">
            @if($errors->has('nomor_hp'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('nomor_hp')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Status: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }} custom-select">
                <option value="" disabled selected>--Pilih--</option>
                <option value="1" {{ old('status') === 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            @if($errors->has('status'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('status')) }}
            </div>
            @endif
          </div>
        </div>
        @if(Auth::user()->role == role_admin())
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Perusahaan: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <select name="hrd" class="form-control custom-select {{ $errors->has('hrd') ? 'is-invalid' : '' }}">
                <option value="" disabled selected>--Pilih--</option>
                @foreach($hrd as $data)
                <option value="{{ $data->id_hrd }}" {{ $data->id_hrd == old('hrd') ? 'selected' : '' }}>{{ $data->perusahaan }} ({{ $data->nama_lengkap }})</option>
                @endforeach
            </select>
            @if($errors->has('hrd'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('hrd')) }}
            </div>
            @endif
          </div>
        </div>
        @endif
        @if(Auth::user()->role == role_hrd())
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Kantor: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <select name="kantor" class="form-control {{ $errors->has('kantor') ? 'is-invalid' : '' }} custom-select">
                <option value="" disabled selected>--Pilih--</option>
                @foreach($kantor as $data)
                <option value="{{ $data->id_kantor }}" {{ old('kantor') == $data->id_kantor ? 'selected' : '' }}>{{ $data->nama_kantor }}</option>
                @endforeach
            </select>
            @if($errors->has('kantor'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('kantor')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Jabatan: <span class="text-danger">*</span></label>
          <div class="col-lg-10 col-md-9">
            <select name="jabatan" class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }} custom-select">
                <option value="" disabled selected>--Pilih--</option>
                @foreach($posisi as $data)
                <option value="{{ $data->id_posisi }}" {{ old('jabatan') == $data->id_posisi ? 'selected' : '' }}>{{ $data->nama_posisi }}</option>
                @endforeach
            </select>
            @if($errors->has('jabatan'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('jabatan')) }}
            </div>
            @endif
          </div>
        </div>
        @endif
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Awal Bekerja:</label>
          <div class="col-lg-10 col-md-9">
            <input name="awal_bekerja" type="text" class="form-control {{ $errors->has('awal_bekerja') ? 'is-invalid' : '' }}" placeholder="Masukkan Tanggal Awal Bekerja" value="{{ old('awal_bekerja') }}">
            @if($errors->has('awal_bekerja'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('awal_bekerja')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">NIK:</label>
          <div class="col-lg-10 col-md-9">
            <input name="nik" type="text" class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" placeholder="Masukkan NIK" value="{{ old('nik') }}">
            @if($errors->has('nik'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('nik')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Alamat:</label>
          <div class="col-lg-10 col-md-9">
            <textarea name="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" placeholder="Masukkan Alamat" rows="2">{{ old('alamat') }}</textarea>
            @if($errors->has('alamat'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('alamat')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Pendidikan Terakhir:</label>
          <div class="col-lg-10 col-md-9">
            <textarea name="pendidikan_terakhir" class="form-control {{ $errors->has('pendidikan_terakhir') ? 'is-invalid' : '' }}" placeholder="Masukkan Pendidikan Terakhir" rows="2">{{ old('pendidikan_terakhir') }}</textarea>
            @if($errors->has('pendidikan_terakhir'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('pendidikan_terakhir')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-2 col-md-3 col-form-label">Foto:</label>
          <div class="col-lg-10 col-md-9">
            <button type="button" class="btn btn-sm {{ $errors->has('file') ? 'btn-danger' : 'btn-success' }} btn-upload"><i class="fa fa-upload mr-2"></i> Upload Foto</button>
            <input name="file" id="file" type="file" accept="image/*" class="d-none">
            <input type="hidden" name="foto" value="">
            <br>
            <img class="preview-image img-thumbnail mt-4 d-none" width="300">
            @if($errors->has('file'))
            <div class="invalid-feedback">
              {{ ucfirst($errors->first('file')) }}
            </div>
            @endif
          </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-2 col-md-3"></div>
            <div class="col-lg-10 col-md-9">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/admin/karyawan" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
      </form>
    </div>
  </div>

@endsection

@section('css-extra')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />

@endsection

@section('js-extra')

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
      // Datepicker
    $("input[name=tanggal_lahir], input[name=awal_bekerja]").datepicker({
      format: "dd/mm/yyyy",
      autoclose: true,
      todayHighlights: true,
    });
    
    // Button toggle password
    $(document).on("click", ".btn-toggle-password", function(e){
      e.preventDefault();
      $(this).hasClass("show") ? $("input[name=password]").attr("type","text") : $("input[name=password]").attr("type","password");
      $(this).hasClass("show") ? $(this).find(".fa").removeClass("fa-eye").addClass("fa-eye-slash") : $(this).find(".fa").removeClass("fa-eye-slash").addClass("fa-eye");
      $(this).hasClass("show") ? $(this).removeClass("show").addClass("hide") : $(this).removeClass("hide").addClass("show");
    });

    // Button upload
    $(document).on("click", ".btn-upload", function(e){
      e.preventDefault();
      $("#file").trigger("click");
    });

    // Preview photo before upload
    $(document).on("change", "input[type=file]", function(){
      readURL(this);
    });
  });

  function readURL(input) {
    if(input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $(".preview-image").attr('src', e.target.result).removeClass("d-none");
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

@endsection