@extends('template/admin/main')

@section('title', __('vacancy.title.create'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.vacancy.index') }}">{{ __('vacancy.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('vacancy.title.create') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.vacancy.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-lg-2 col-md-3">
						<p><strong>Lowongan Pekerjaan</strong></p>
					</div>
					<div class="col-lg-10 col-md-9">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('vacancy.db_field.position') }}: <span class="text-danger">*</span></label>
								<select name="position" class="form-control form-control-sm {{ $errors->has('position') ? 'is-invalid' : '' }}">
									<option value="" disabled selected>{{ __('form.choose-') }}</option>
									@foreach($companies as $company)
										<optgroup label="{{ $company->name }} ({{ $company->user->name }})">
											@foreach($company->positions()->orderBy('name')->get() as $position)
												<option value="{{ $position->id }}" {{ $position->id == old('position') ? 'selected' : '' }}>{{ $position->name }}</option>
											@endforeach
										</optgroup>
									@endforeach
								</select>
								@if($errors->has('position'))
								<small class="text-danger">{{ ucfirst($errors->first('position')) }}</small>
								@endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>{{ __('vacancy.db_field.start_date') }}: <span class="text-danger">*</span></label>
								<div class="input-group">
									<input name="start_date" type="text" class="form-control form-control-sm {{ $errors->has('start_date') ? 'is-invalid' : '' }}" value="{{ old('start_date') }}" placeholder="dd/mm/yyyy">
									<div class="input-group-append">
										<span class="input-group-text {{ $errors->has('start_date') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								@if($errors->has('start_date'))
								<small class="text-danger">{{ ucfirst($errors->first('start_date')) }}</small>
								@endif
							</div>
							<div class="form-group col-md-6">
								<label>{{ __('vacancy.db_field.end_date') }}: <span class="text-danger">*</span></label>
								<div class="input-group">
									<input name="end_date" type="text" class="form-control form-control-sm {{ $errors->has('end_date') ? 'is-invalid' : '' }}" value="{{ old('end_date') }}" placeholder="dd/mm/yyyy">
									<div class="input-group-append">
										<span class="input-group-text {{ $errors->has('end_date') ? 'border-outline-danger' : 'border-outline-primary' }}"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								@if($errors->has('end_date'))
								<small class="text-danger">{{ ucfirst($errors->first('end_date')) }}</small>
								@endif
							</div>
						</div>
					</div>
				</div>
				<hr>

				<!-- Buttons -->
				<div class="float-right">
					<a href="{{ route('admin.vacancy.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
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
		$('input[name=start_date], input[name=end_date]').datepicker({
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