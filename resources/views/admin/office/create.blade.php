@extends('template/admin/main')

@section('title', __('office.title.create'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.office.index') }}">{{ __('office.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('office.title.create') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.office.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('office.db_field.name') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
						@if($errors->has('name'))
						<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
						@endif
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-3 col-form-label">{{ __('office.db_field.company') }}: <span class="text-danger">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <select name="company" class="form-control custom-select {{ $errors->has('company') ? 'is-invalid' : '' }}">
                            <option value="" disabled selected>{{ __('form.choose-') }}</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ $company->id == old('company') ? 'selected' : '' }}>{{ $company->name }} ({{ $company->user->name }})</option>
                            @endforeach
                        </select>
                        @if($errors->has('company'))
						<small class="text-danger">{{ ucfirst($errors->first('company')) }}</small>
                        @endif
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('office.db_field.address') }}:</label>
					<div class="col-lg-10 col-md-9">
						<textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" rows="3">{{ old('address') }}</textarea>
						@if($errors->has('address'))
						<small class="text-danger">{{ ucfirst($errors->first('address')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('office.db_field.phone_number') }}:</label>
					<div class="col-lg-10 col-md-9">
						<input name="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" value="{{ old('phone_number') }}">
						@if($errors->has('phone_number'))
						<small class="text-danger">{{ ucfirst($errors->first('phone_number')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('office.db_field.founded_on') }}:</label>
					<div class="col-lg-10 col-md-9">
						<div class="input-group">
							<input name="founded_on" type="text" class="form-control {{ $errors->has('founded_on') ? 'is-invalid' : '' }}" value="{{ old('founded_on') }}">
							<div class="input-group-append">
								<span class="input-group-text {{ $errors->has('founded_on') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						@if($errors->has('founded_on'))
						<small class="text-danger">{{ ucfirst($errors->first('founded_on')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-md-3"></div>
					<div class="col-lg-10 col-md-9">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
						<a href="{{ route('admin.office.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection

@section('js-extra')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// Datepicker
		$('input[name=founded_on]').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			todayHighlight: true
		});
	});
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />

@endsection