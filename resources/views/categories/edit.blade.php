@extends('layouts.app', ['activePage' => 'category-management', 'menuParent' => 'characteristics', 'titlePage' => __('Category
Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('category.update', $category) }}" autocomplete="off"
                    class="form-horizontal">
                    @csrf
                    @method('put')

                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">category</i>
                            </div>
                            <h4 class="card-title">{{ __('Edit Category') }}</h4>
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
                                            value="{{ old('name', $category->name) }}" required="true"
                                            aria-required="true" />
                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Equipment Type') }}</label>
                                <div class="col-sm-7" >
                                    <div class="form-group">
                                        <select class="selectpicker" name="type_id" data-style="select-with-transition">
                                            <option value=""></option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ $type->id == $category->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Equipment Information') }}</label>
                                <div class="col-sm-2" >
                                    <div class="form-group">
                                        <select class="selectpicker" name="equip_info" id="equip_info" data-style="select-with-transition">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Specific Fields') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="equip_specifics[]"
                                            data-style="select-with-transition" multiple title="-" data-size="7">
                                            @foreach ($equip_specifics as $specific)
                                                <option value="{{ $specific->id }}" {{ in_array($specific->id, old('specifics', $category->specifics->pluck('id')->toArray()) ?? []) ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                        </select>
                                        @include('alerts.feedback', ['field' => 'specifics'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Truck Information') }}</label>
                                <div class="col-sm-2" >
                                    <div class="form-group">
                                        <select class="selectpicker" name="truck_mounted" id="truck_mounted" value="0" data-style="select-with-transition">
                                            <option value="0" {{ $category->truck_mounted == 0 ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ $category->truck_mounted == 1 ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Specific Field') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('optional_field') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="truck_specifics[]"
                                            data-style="select-with-transition" multiple title="-" data-size="7">
                                            @foreach ($truck_specifics as $specific)
                                                <option value="{{ $specific->id }}" {{ in_array($specific->id, old('specifics', $category->specifics->pluck('id')->toArray()) ?? []) ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                        </select>
                                        @include('alerts.feedback', ['field' => 'truck_specifics'])
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
