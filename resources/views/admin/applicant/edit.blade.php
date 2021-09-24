@extends('template/admin/main')

@section('title', __('applicant.title.edit'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.applicant.index') }}">{{ __('applicant.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('applicant.title.edit') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.applicant.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $applicant->id }}">

				<!-- Identity -->
				<div class="row">
					<div class="col-lg-2 col-md-3">
						<p><strong>Identitas Diri</strong></p>
					</div>
					<div class="col-lg-10 col-md-9">
						<div class="form-group">
							<label>{{ __('applicant.db_field.name') }}: <span class="text-danger">*</span></label>
							<input name="name" type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $applicant->user->name }}">
							@if($errors->has('name'))
							<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
							@endif
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.birthdate') }}: <span class="text-danger">*</span></label>
								<div class="input-group">
									<input name="birthdate" type="text" class="form-control form-control-sm {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" value="{{ generate_date_format($applicant->user->birthdate, 'd/m/y') }}" placeholder="dd/mm/yyyy" autocomplete="off">
									<div class="input-group-append">
										<span class="input-group-text {{ $errors->has('birthdate') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								@if($errors->has('birthdate'))
								<small class="text-danger">{{ ucfirst($errors->first('birthdate')) }}</small>
								@endif
							</div>
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.gender') }}: <span class="text-danger">*</span></label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gender" value="M" id="gender-M" {{ $applicant->user->gender == 'M' ? 'checked' : '' }}>
									<label class="form-check-label" for="gender-M">{{ gender('M') }}</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gender" value="F" id="gender-F" {{ $applicant->user->gender == 'F' ? 'checked' : '' }}>
									<label class="form-check-label" for="gender-F">{{ gender('F') }}</label>
								</div>
								@if($errors->has('gender'))
								<small class="text-danger">{{ ucfirst($errors->first('gender')) }}</small>
								@endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.email') }}: <span class="text-danger">*</span></label>
								<input name="email" type="email" class="form-control form-control-sm {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $applicant->user->email }}">
								@if($errors->has('email'))
								<small class="text-danger">{{ ucfirst($errors->first('email')) }}</small>
								@endif
							</div>
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.phone_number') }}: <span class="text-danger">*</span></label>
								<input name="phone_number" type="text" class="form-control form-control-sm {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" value="{{ $applicant->user->phone_number }}">
								@if($errors->has('phone_number'))
								<small class="text-danger">{{ ucfirst($errors->first('phone_number')) }}</small>
								@endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.identity_number') }}:</label>
								<input name="identity_number" type="text" class="form-control form-control-sm {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" value="{{ $applicant->identity_number }}">
								@if($errors->has('identity_number'))
								<small class="text-danger">{{ ucfirst($errors->first('identity_number')) }}</small>
								@endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.religion') }}: <span class="text-danger">*</span></label>
								<select name="religion" class="form-control form-control-sm {{ $errors->has('religion') ? 'is-invalid' : '' }}">
									<option value="" disabled selected>{{ __('form.choose-') }}</option>
									@foreach($religions as $religion)
										<option value="{{ $religion->id }}" {{ $religion->id == $applicant->religion->id ? 'selected' : '' }}>{{ $religion->name }}</option>
									@endforeach
								</select>
								@if($errors->has('religion'))
								<small class="text-danger">{{ ucfirst($errors->first('religion')) }}</small>
								@endif
							</div>
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.relationship') }}: <span class="text-danger">*</span></label>
								<select name="relationship" class="form-control form-control-sm {{ $errors->has('relationship') ? 'is-invalid' : '' }}">
									<option value="" disabled selected>{{ __('form.choose-') }}</option>
									@foreach($relationships as $relationship)
										<option value="{{ $relationship->id }}" {{ $relationship->id == $applicant->relationship->id ? 'selected' : '' }}>{{ $relationship->name }}</option>
									@endforeach
								</select>
								@if($errors->has('relationship'))
								<small class="text-danger">{{ ucfirst($errors->first('relationship')) }}</small>
								@endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.address') }}:</label>
								<textarea name="address" class="form-control form-control-sm {{ $errors->has('address') ? 'is-invalid' : '' }}" rows="3">{{ $applicant->user->address }}</textarea>
								@if($errors->has('address'))
								<small class="text-danger">{{ ucfirst($errors->first('address')) }}</small>
								@endif
							</div>
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.latest_education') }}:</label>
								<textarea name="latest_education" class="form-control form-control-sm {{ $errors->has('latest_education') ? 'is-invalid' : '' }}" rows="3">{{ $applicant->latest_education }}</textarea>
								@if($errors->has('latest_education'))
								<small class="text-danger">{{ ucfirst($errors->first('latest_education')) }}</small>
								@endif
							</div>
						</div>
					</div>
				</div>
				<hr>

				<!-- Work -->
				<div class="row">
					<div class="col-lg-2 col-md-3">
						<p><strong>Pekerjaan</strong></p>
					</div>
					<div class="col-lg-10 col-md-9">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('applicant.db_field.vacancy') }}: <span class="text-danger">*</span></label>
								<select name="vacancy" class="form-control form-control-sm {{ $errors->has('vacancy') ? 'is-invalid' : '' }}">
									<option value="" disabled selected>{{ __('form.choose-') }}</option>
									@foreach($applicant->company->vacancies()->where('end_date','=','0000-00-00')->orderBy('id')->get() as $vacancy)
										@if($vacancy->position)
											<option value="{{ $vacancy->id }}" {{ $vacancy->id == $applicant->vacancy_id ? 'selected' : '' }}>{{ $vacancy->position->name }}</option>
										@endif
									@endforeach
								</select>
								@if($errors->has('vacancy'))
								<small class="text-danger">{{ ucfirst($errors->first('vacancy')) }}</small>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label>{{ __('applicant.db_field.job_experiences') }}:</label>
							<textarea name="job_experiences" class="form-control form-control-sm {{ $errors->has('job_experiences') ? 'is-invalid' : '' }}" rows="3">{{ $applicant->job_experiences }}</textarea>
							@if($errors->has('job_experiences'))
							<small class="text-danger">{{ ucfirst($errors->first('job_experiences')) }}</small>
							@endif
						</div>
					</div>
				</div>
				<hr>

				<!-- Buttons -->
				<div class="float-right">
					<a href="{{ route('admin.applicant.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
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
		$('input[name=birthdate]').datepicker({
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