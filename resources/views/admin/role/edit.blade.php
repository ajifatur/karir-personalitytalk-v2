@extends('template/admin/main')

@section('title', __('role.title.edit'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">{{ __('role.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('role.title.edit') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.role.update') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $role->id }}">
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('role.db_field.name') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $role->name }}">
						@if($errors->has('name'))
						<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('role.db_field.code') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="code" type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" value="{{ $role->code }}">
						@if($errors->has('code'))
						<small class="text-danger">{{ ucfirst($errors->first('code')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('role.db_field.has_access') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_access" value="1" id="has_access-1" {{ $role->has_access == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_access-1">
                            {{ __('form.yes') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_access" value="0" id="has_access-0" {{ $role->has_access == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_access-0">
                            {{ __('form.no') }}
                            </label>
                        </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('role.db_field.has_position') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_position" value="1" id="has_position-1" {{ $role->has_position == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_position-1">
                            {{ __('form.yes') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_position" value="0" id="has_position-0" {{ $role->has_position == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_position-0">
                            {{ __('form.no') }}
                            </label>
                        </div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-md-3"></div>
					<div class="col-lg-10 col-md-9">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
						<a href="{{ route('admin.role.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection