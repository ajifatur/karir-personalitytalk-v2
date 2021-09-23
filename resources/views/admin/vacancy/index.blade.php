@extends('template/admin/main')

@section('title', __('vacancy.title.index'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.vacancy.index') }}">{{ __('vacancy.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('vacancy.title.index') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between align-items-center">
			<div class="text-center">
				<a class="btn btn-sm btn-primary" href="{{ route('admin.vacancy.create') }}">
					<i class="fas fa-plus fa-sm fa-fw text-gray-400"></i> {{ __('vacancy.title.create') }}
				</a>
			</div>
			@if(Auth::user()->role->id == role('admin'))
			<div class="mt-2 mt-md-0">
                <select id="company" class="form-control form-control-sm">
                    <option value="0">{{ __('vacancy.table_action.all') }}</option>
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
							<th>{{ __('vacancy.table_field.vacancy') }}</th>
							<th width="100">{{ __('vacancy.table_field.start_date') }}</th>
							<th width="100">{{ __('vacancy.table_field.end_date') }}</th>
							<th width="175">{{ __('vacancy.table_field.company') }}</th>
							<th width="100">{{ __('vacancy.table_field.updated_at') }}</th>
							<th width="60">{{ __('vacancy.table_field.options') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($vacancies as $vacancy)
						<tr>
							<td><input type="checkbox"></td>
							<td>
								<a href="{{ route('admin.vacancy.detail', ['id' => $vacancy->id]) }}">{{ $vacancy->position ? $vacancy->position->name : '' }}</a>
							</td>
							<td>
								<span class="d-none">{{ $vacancy->start_date }}</span>
								{{ generate_date_format($vacancy->start_date, 'd/m/y') }}
							</td>
							<td>
								<span class="d-none">{{ $vacancy->end_date }}</span>
								{{ generate_date_format($vacancy->end_date, 'd/m/y') }}
							</td>
							<td>
                                @if($vacancy->company && $vacancy->company->user)
                                    <a href="#">{{ $vacancy->company->name }}</a>
                                    <br>
                                    <small class="text-muted">{{ $vacancy->company->user->name }}</small>
                                @endif
							</td>
							<td>
								<span class="d-none">{{ $vacancy->updated_at }}</span>
								{{ date('d/m/Y', strtotime($vacancy->updated_at)) }}
								<br>
								<small class="text-muted"><i class="fa fa-clock mr-2"></i>{{ date('H:i', strtotime($vacancy->updated_at)) }}</small>
							</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('admin.vacancy.edit', ['id' => $vacancy->id]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('vacancy.table_action.edit') }}"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $vacancy->id }}" data-toggle="tooltip" data-placement="top" title="{{ __('vacancy.table_action.delete') }}"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<form id="form-delete" class="d-none" method="post" action="{{ route('admin.vacancy.delete') }}">
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
				window.location.href = "{{ route('admin.vacancy.index') }}" + "?company=" + company;
			else
				window.location.href = "{{ route('admin.vacancy.index') }}";
		});
	});
</script>

@endsection