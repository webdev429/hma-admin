@extends('layouts.app', ['activePage' => 'category-management', 'menuParent' => 'characteristics', 'titlePage' => __('Category
Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('category.store') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('post')

                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">category</i>
                            </div>
                            <h4 class="card-title">{{ __('Add Category') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('category.index') }}"
                                        class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" id="input-name" type="text" placeholder="{{ __('Name') }}"
                                            value="{{ old('name') }}" required="true" aria-required="true" />
                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Equipment Type') }}</label>
                                <div class="col-sm-7" >
                                    <div class="form-group">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="type_id" value="0" data-style="select-with-transition">
                                                <option value=""></option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Specific Field') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('optional_field') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="specifics[]"
                                            data-style="select-with-transition" multiple title="-" data-size="7">
                                            @foreach ($specifics as $specific)
                                              <option value="{{ $specific->id }}" {{ in_array($specific->id, old('specifics') ?? []) ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                        </select>
                                        @include('alerts.feedback', ['field' => 'specifics'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Truck Mounted') }}</label>
                                <div class="col-sm-2" >
                                    <div class="form-group">
                                        <select class="selectpicker" name="truck_mounted" value="0" data-style="select-with-transition">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-rose">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
