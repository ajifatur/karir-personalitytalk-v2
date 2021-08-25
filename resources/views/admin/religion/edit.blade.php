@extends('template/admin/main')

@section('title', __('religion.title.edit'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.religion.index') }}">{{ __('religion.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('religion.title.edit') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.religion.update') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $religion->id }}">
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('religion.db_field.name') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $religion->name }}">
						@if($errors->has('name'))
						<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-md-3"></div>
					<div class="col-lg-10 col-md-9">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
						<a href="{{ route('admin.religion.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection