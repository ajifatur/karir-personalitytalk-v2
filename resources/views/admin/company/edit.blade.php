@extends('template/admin/main')

@section('title', __('company.title.edit'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">{{ __('company.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('company.title.edit') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.company.update') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $company->id }}">
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('company.db_field.name') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $company->name }}">
						@if($errors->has('name'))
						<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('company.db_field.code') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="code" type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" value="{{ $company->code }}">
						<div class="small text-muted mt-1">{{ __('company.form.code') }}</div>
						@if($errors->has('code'))
						<small class="text-danger">{{ ucfirst($errors->first('code')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('company.db_field.address') }}:</label>
					<div class="col-lg-10 col-md-9">
						<textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" rows="3">{{ $company->address }}</textarea>
						@if($errors->has('address'))
						<small class="text-danger">{{ ucfirst($errors->first('address')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('company.db_field.phone_number') }}:</label>
					<div class="col-lg-10 col-md-9">
						<input name="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" value="{{ $company->phone_number }}">
						@if($errors->has('phone_number'))
						<small class="text-danger">{{ ucfirst($errors->first('phone_number')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('company.db_field.founded_on') }}:</label>
					<div class="col-lg-10 col-md-9">
						<div class="input-group">
							<input name="founded_on" type="text" class="form-control {{ $errors->has('founded_on') ? 'is-invalid' : '' }}" value="{{ generate_date_format($company->founded_on, 'd/m/y') }}" placeholder="dd/mm/yyyy">
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
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('company.form.test') }}:</label>
					<div class="col-lg-10 col-md-9">
						<div class="row">
							@foreach($tests as $key=>$test)
							<div class="col-md-6 col-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="tests[]" value="{{ $test->id }}" id="defaultCheck-{{ $key }}" {{ in_array($test->id, $company->tests->pluck('id')->toArray()) ? 'checked' : '' }}>
									<label class="form-check-label" for="defaultCheck-{{ $key }}">
									{{ $test->name }}
									</label>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-md-3"></div>
					<div class="col-lg-10 col-md-9">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
						<a href="{{ route('admin.company.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
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