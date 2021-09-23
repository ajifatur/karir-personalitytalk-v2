@extends('template/admin/main')

@section('title', __('employee.title.edit'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">{{ __('employee.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('employee.title.edit') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.employee.update') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $employee->id }}">
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.name') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $employee->user->name }}">
						@if($errors->has('name'))
						<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.birthdate') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<div class="input-group">
							<input name="birthdate" type="text" class="form-control {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" value="{{ generate_date_format($employee->user->birthdate, 'd/m/y') }}" placeholder="dd/mm/yyyy" autocomplete="off">
							<div class="input-group-append">
								<span class="input-group-text {{ $errors->has('birthdate') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						@if($errors->has('birthdate'))
						<small class="text-danger">{{ ucfirst($errors->first('birthdate')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.gender') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="M" id="gender-M" {{ $employee->user->gender == 'M' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender-M">{{ gender('M') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="F" id="gender-F" {{ $employee->user->gender == 'F' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender-F">{{ gender('F') }}</label>
                        </div>
						@if($errors->has('gender'))
						<small class="text-danger">{{ ucfirst($errors->first('gender')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.email') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $employee->user->email }}">
						@if($errors->has('email'))
						<small class="text-danger">{{ ucfirst($errors->first('email')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.phone_number') }}:</label>
					<div class="col-lg-10 col-md-9">
						<input name="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" value="{{ $employee->user->phone_number }}">
						@if($errors->has('phone_number'))
						<small class="text-danger">{{ ucfirst($errors->first('phone_number')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.address') }}:</label>
					<div class="col-lg-10 col-md-9">
						<textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" rows="3">{{ $employee->user->address }}</textarea>
						@if($errors->has('address'))
						<small class="text-danger">{{ ucfirst($errors->first('address')) }}</small>
						@endif
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.position') }}: <span class="text-danger">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <select name="position" class="form-control custom-select {{ $errors->has('position') ? 'is-invalid' : '' }}">
                            <option value="" disabled selected>{{ __('form.choose-') }}</option>
                            @foreach($employee->company->positions()->orderBy('name')->get() as $position)
                                <option value="{{ $position->id }}" {{ $position->id == $employee->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('position'))
						<small class="text-danger">{{ ucfirst($errors->first('position')) }}</small>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.office') }}: <span class="text-danger">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <select name="office" class="form-control custom-select {{ $errors->has('office') ? 'is-invalid' : '' }}">
                            <option value="" disabled selected>{{ __('form.choose-') }}</option>
                            @foreach($employee->company->offices()->orderBy('name')->get() as $office)
                                <option value="{{ $office->id }}" {{ $office->id == $employee->office_id ? 'selected' : '' }}>{{ $office->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('office'))
						<small class="text-danger">{{ ucfirst($errors->first('office')) }}</small>
                        @endif
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.identity_number') }}:</label>
					<div class="col-lg-10 col-md-9">
						<input name="identity_number" type="text" class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" value="{{ $employee->identity_number }}">
						@if($errors->has('identity_number'))
						<small class="text-danger">{{ ucfirst($errors->first('identity_number')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.latest_education') }}:</label>
					<div class="col-lg-10 col-md-9">
						<textarea name="latest_education" class="form-control {{ $errors->has('latest_education') ? 'is-invalid' : '' }}" rows="3">{{ $employee->latest_education }}</textarea>
						@if($errors->has('latest_education'))
						<small class="text-danger">{{ ucfirst($errors->first('latest_education')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.start_date') }}:</label>
					<div class="col-lg-10 col-md-9">
						<div class="input-group">
							<input name="start_date" type="text" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" value="{{ generate_date_format($employee->start_date, 'd/m/y') }}" placeholder="dd/mm/yyyy" autocomplete="off">
							<div class="input-group-append">
								<span class="input-group-text {{ $errors->has('start_date') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						@if($errors->has('start_date'))
						<small class="text-danger">{{ ucfirst($errors->first('start_date')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('employee.db_field.end_date') }}:</label>
					<div class="col-lg-10 col-md-9">
						<div class="input-group">
							<input name="end_date" type="text" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" value="{{ generate_date_format($employee->end_date, 'd/m/y') }}" placeholder="dd/mm/yyyy" autocomplete="off">
							<div class="input-group-append">
								<span class="input-group-text {{ $errors->has('end_date') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="small text-muted mt-1">{{ __('employee.form.end_date') }}</div>
						@if($errors->has('end_date'))
						<small class="text-danger">{{ ucfirst($errors->first('end_date')) }}</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-md-3"></div>
					<div class="col-lg-10 col-md-9">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
						<a href="{{ route('admin.employee.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
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
		$('input[name=birthdate], input[name=start_date], input[name=end_date]').datepicker({
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