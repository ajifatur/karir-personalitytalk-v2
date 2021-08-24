@extends('template/admin/main')

@section('title', __('office.title.index'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.office.index') }}">{{ __('office.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('office.title.index') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between align-items-center">
			<div>
				<a class="btn btn-sm btn-primary" href="{{ route('admin.office.create') }}">
					<i class="fas fa-plus fa-sm fa-fw text-gray-400"></i> {{ __('office.title.create') }}
				</a>
			</div>
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
							<th>{{ __('office.table_field.identity') }}</th>
							<th width="175">{{ __('office.table_field.company') }}</th>
							<th width="100">{{ __('office.table_field.updated_at') }}</th>
							<th width="60">{{ __('office.table_field.options') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($offices as $office)
						<tr>
							<td><input type="checkbox"></td>
							<td>
								<a href="{{ route('admin.office.detail', ['id' => $office->id]) }}">{{ $office->name }}</a>
								@if($office->address != '')
								<br><small class="text-muted"><i class="fa fa-map-marker-alt mr-2"></i>{{ $office->address }}</small>
								@endif
								@if($office->phone_number != '')
								<br><small class="text-muted"><i class="fa fa-phone mr-2"></i>{{ $office->phone_number }}</small>
								@endif
							</td>
							<td>
								<a href="#">{{ $office->company->name }}</a>
								<br>
								<small class="text-muted">{{ $office->company->user->name }}</small>
							</td>
							<td>
								<span class="d-none">{{ $office->updated_at }}</span>
								{{ date('d/m/Y', strtotime($office->updated_at)) }}
								<br>
								<small class="text-muted"><i class="fa fa-clock mr-2"></i>{{ date('H:i', strtotime($office->updated_at)) }}</small>
							</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('admin.office.edit', ['id' => $office->id]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('office.table_action.edit') }}"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $office->id }}" data-toggle="tooltip" data-placement="top" title="{{ __('office.table_action.delete') }}"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<form id="form-delete" class="d-none" method="post" action="{{ route('admin.office.delete') }}">
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
	});
</script>

@endsection