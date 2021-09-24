@extends('template/admin/main')

@section('title', __('applicant.title.index'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.applicant.index') }}">{{ __('applicant.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('applicant.title.index') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-md-flex justify-content-between align-items-center">
			<div class="text-center">
				<a class="btn btn-sm btn-primary" href="{{ route('admin.applicant.create') }}">
					<i class="fas fa-plus fa-sm fa-fw text-gray-400"></i> {{ __('applicant.title.create') }}
				</a>
			</div>
			@if(Auth::user()->role->id == role('admin'))
			<div class="mt-2 mt-md-0">
                <select id="company" class="form-control form-control-sm">
                    <option value="0">{{ __('applicant.table_action.all') }}</option>
					@foreach($companies as $company)
					<option value="{{ $company->id }}" {{ isset($_GET['company']) && $company->id == $_GET['company'] ? 'selected' : ''  }}>{{ $company->name }}</option>
					@endforeach
				</select>
            </div>
			@endif
		</div>
		<div class="card-body">
			@if(Session::get('message') != null)
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ Session::get('message') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="dataTable">
					<thead>
						<tr>
							<th width="20"><input type="checkbox"></th>
							<th>{{ __('applicant.table_field.identity') }}</th>
							<th width="100">{{ __('applicant.table_field.username') }}</th>
							<th width="150">{{ __('applicant.table_field.position') }}</th>
							<th width="175">{{ __('applicant.table_field.company') }}</th>
							<th width="100">{{ __('applicant.table_field.last_visit') }}</th>
							<th width="60">{{ __('applicant.table_field.options') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($applicants as $applicant)
						<tr>
							<td><input type="checkbox"></td>
							<td>
								<a href="{{ route('admin.applicant.detail', ['id' => $applicant->id]) }}">{{ $applicant->user->name }}</a>
								@if($applicant->user->address != '')
								<br><small class="text-muted"><i class="fa fa-map-marker-alt mr-2"></i>{{ $applicant->user->address }}</small>
								@endif
								@if($applicant->user->phone_number != '')
								<br><small class="text-muted"><i class="fa fa-phone mr-2"></i>{{ $applicant->user->phone_number }}</small>
								@endif
							</td>
                            <td>{{ $applicant->user ? $applicant->user->username : '' }}</td>
							<td>
								{{ $applicant->position ? $applicant->position->name : '-' }}
								<br>
								<small class="text-muted">{{ $applicant->office ? $applicant->office->name : '' }}</small>
							</td>
							<td>
                                @if($applicant->company)
                                    <a href="{{ route('admin.company.detail', ['id' => $applicant->company->id]) }}">{{ $applicant->company->name }}</a>
                                    <br>
                                    <small class="text-muted">{{ $applicant->company->user->name }}</small>
                                @endif
							</td>
							<td>
								<span class="d-none">{{ $applicant->user->last_visit }}</span>
								{{ date('d/m/Y', strtotime($applicant->user->last_visit)) }}
								<br>
								<small class="text-muted"><i class="fa fa-clock mr-2"></i>{{ date('H:i', strtotime($applicant->user->last_visit)) }}</small>
							</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('admin.applicant.edit', ['id' => $applicant->id]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('applicant.table_action.edit') }}"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $applicant->id }}" data-toggle="tooltip" data-placement="top" title="{{ __('applicant.table_action.delete') }}"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<form id="form-delete" class="d-none" method="post" action="{{ route('admin.applicant.delete') }}">
					{{ csrf_field() }}
					<input type="hidden" name="id">
				</form>
			</div>
		</div>
	</div>
  
@endsection

@section('js-extra')

<script type="text/javascript">
	$(document).ready(function() {
		// DataTable
		generate_datatable("#dataTable");

		// Button Not Allowed
		$(document).on("click", ".not-allowed", function(e){
			e.preventDefault();
		});

		// Select company
		$(document).on("change", "select#company", function() {
			var company = $(this).val();
			if(company > 0)
				window.location.href = "{{ route('admin.applicant.index') }}" + "?company=" + company;
			else
				window.location.href = "{{ route('admin.applicant.index') }}";
		});
	});
</script>

@endsection