@extends('template/admin/main')

@section('title', 'Tambah Agama')

@section('content')

  <!-- Page Heading -->
  <div class="page-heading shadow d-none">
    <h1 class="h3 text-gray-800">Tambah Agama</h1>
    <ol class="breadcrumb" id="breadcrumb">
      <li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
      <li class="breadcrumb-item"><a href="/admin/agama">Agama</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Agama</li>
    </ol>
  </div>

  <!-- Card -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <form method="post" action="/admin/agama/store">
        {{ csrf_field() }}
          <div class="form-group row">
            <label class="col-lg-2 col-md-3 col-form-label">Nama Agama: <span class="text-danger">*</span></label>
            <div class="col-lg-10 col-md-9">
              <input type="text" name="nama_agama" class="form-control {{ $errors->has('nama_agama') ? 'is-invalid' : '' }}" placeholder="Masukkan Nama Agama" value="{{ old('nama_agama') }}">
              @if($errors->has('nama_agama'))
              <div class="invalid-feedback">
                {{ ucfirst($errors->first('nama_agama')) }}
              </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-2 col-md-3"></div>
            <div class="col-lg-10 col-md-9">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="/admin/agama" class="btn btn-secondary">Kembali</a>
            </div>
          </div>
      </form>
    </div>
  </div>

@endsection