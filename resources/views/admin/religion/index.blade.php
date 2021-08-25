@extends('template/admin/main')

@section('title', __('religion.title.index'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.religion.index') }}">{{ __('religion.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('religion.title.index') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between align-items-center">
			<div>
				<a class="btn btn-sm btn-primary" href="{{ route('admin.religion.create') }}">
					<i class="fas fa-plus fa-sm fa-fw text-gray-400"></i> {{ __('religion.title.create') }}
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
							<th>{{ __('religion.table_field.name') }}</th>
							<th width="100">{{ __('religion.table_field.updated_at') }}</th>
							<th width="60">{{ __('religion.table_field.options') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($religions as $religion)
						<tr>
							<td><input type="checkbox"></td>
							<td>
								<a href="{{ route('admin.religion.detail', ['id' => $religion->id]) }}">{{ $religion->name }}</a>
							</td>
							<td>
								<span class="d-none">{{ $religion->updated_at }}</span>
								{{ date('d/m/Y', strtotime($religion->updated_at)) }}
								<br>
								<small class="text-muted"><i class="fa fa-clock mr-2"></i>{{ date('H:i', strtotime($religion->updated_at)) }}</small>
							</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('admin.religion.edit', ['id' => $religion->id]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('religion.table_action.edit') }}"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $religion->id }}" data-toggle="tooltip" data-placement="top" title="{{ __('religion.table_action.delete') }}"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<form id="form-delete" class="d-none" method="post" action="{{ route('admin.religion.delete') }}">
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