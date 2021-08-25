@extends('template/admin/main')

@section('title', __('position.title.create'))

@section('content')

	<!-- Breadcrumb -->
	<div class="d-none">
		<ol class="breadcrumb" id="breadcrumb">
			<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.position.index') }}">{{ __('position.name') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ __('position.title.create') }}</li>
		</ol>
	</div>

	<!-- Content -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="{{ route('admin.position.update') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $position->id }}">
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('position.db_field.name') }}: <span class="text-danger">*</span></label>
					<div class="col-lg-10 col-md-9">
						<input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $position->name }}">
						@if($errors->has('name'))
						<small class="text-danger">{{ ucfirst($errors->first('name')) }}</small>
						@endif
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-3 col-form-label">{{ __('position.db_field.role') }}: <span class="text-danger">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <select name="role" class="form-control custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}">
                            <option value="" disabled selected>{{ __('form.choose-') }}</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $position->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role'))
						<small class="text-danger">{{ ucfirst($errors->first('role')) }}</small>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-3 col-form-label">{{ __('position.db_field.company') }}: <span class="text-danger">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <select name="company" class="form-control custom-select {{ $errors->has('company') ? 'is-invalid' : '' }}">
                            <option value="" disabled selected>{{ __('form.choose-') }}</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ $company->id == $position->company_id ? 'selected' : '' }}>{{ $company->name }} ({{ $company->user->name }})</option>
                            @endforeach
                        </select>
                        @if($errors->has('company'))
						<small class="text-danger">{{ ucfirst($errors->first('company')) }}</small>
                        @endif
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-lg-2 col-md-3 col-form-label">{{ __('position.form.test') }}:</label>
					<div class="col-lg-10 col-md-9">
						<div class="row">
							@foreach($tests as $key=>$test)
							<div class="col-md-6 col-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="tests[]" value="{{ $test->id }}" id="defaultCheck-{{ $key }}" {{ in_array($test->id, $position->tests->pluck('id')->toArray()) ? 'checked' : '' }}>
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
                    <label class="col-lg-2 col-md-3 col-form-label">{{ __('position.form.skill') }}:</label>
                    <div class="col-lg-10 col-md-9">
                        <div class="row">
                            @if(count($position->skills)>0)
                                @foreach($position->skills as $key=>$skill)
                                <div class="col-12 mb-2 input-skill" data-id="{{ ($key+1) }}">
                                    <div class="input-group">
                                        <input name="skills[]" type="text" class="form-control" value="{{ $skill->name }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success btn-add-skill" type="button" data-id="{{ ($key+1) }}" title="{{ __('form.add') }}"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-outline-danger btn-delete-skill" type="button" data-id="{{ ($key+1) }}" title="{{ __('form.delete') }}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="col-12 mb-2 input-skill" data-id="1">
                                    <div class="input-group">
                                        <input name="skills[]" type="text" class="form-control" value="">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success btn-add-skill" type="button" data-id="1" title="{{ __('form.add') }}"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-outline-danger btn-delete-skill" type="button" data-id="1" title="{{ __('form.delete') }}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
				<div class="form-group row">
					<div class="col-lg-2 col-md-3"></div>
					<div class="col-lg-10 col-md-9">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('form.submit') }}</button>
						<a href="{{ route('admin.position.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>{{ __('form.back') }}</a>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection

@section('js-extra')

<script type="text/javascript">
    // Button Add Skill
    $(document).on("click", ".btn-add-skill", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var input = $(".input-skill");
        var html = '';
        html += '<div class="col-12 mb-2 input-skill" data-id="' + (input.length+1) + '">';
        html += '<div class="input-group">';
        html += '<input name="skills[]" type="text" class="form-control">';
        html += '<div class="input-group-append">';
        html += '<button class="btn btn-outline-success btn-add-skill" type="button" data-id="' + (input.length+1) + '" title="{{ __('form.add') }}"><i class="fa fa-plus"></i></button>';
        html += '<button class="btn btn-outline-danger btn-delete-skill" type="button" data-id="' + (input.length+1) + '" title="{{ __('form.delete') }}"><i class="fa fa-trash"></i></button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $(".input-skill[data-id=" + input.length + "]").after(html);
    });

    // Button Delete Skill
    $(document).on("click", ".btn-delete-skill", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var input = $(".input-skill");
        if(input.length <= 1){
            $(".input-skill[data-id=" + id + "]").find("input[type=text]").val("");
        }
        else{
            $(".input-skill[data-id=" + id + "]").remove();
            var inputAfter = $(".input-skill");
            inputAfter.each(function(key,elem){
                $(elem).attr("data-id", (key+1));
                $(elem).find(".btn-add-skill").attr("data-id", (key+1));
                $(elem).find(".btn-delete-skill").attr("data-id", (key+1));
            });
        }
    });
</script>

@endsection