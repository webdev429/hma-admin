@extends('layouts.app', ['activePage' => 'specific-management', 'menuParent' => 'characteristics', 'titlePage' =>
__('Specific Data Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('specific.store') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('post')

                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">category</i>
                            </div>
                            <h4 class="card-title">{{ __('Add Specific Data') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('specific.index') }}"
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
                                <label class="col-sm-2 col-form-label">{{ __('Unit') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('unit') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}"
                                            name="unit" id="input-unit" type="text" placeholder="{{ __('Unit') }}"
                                            value="{{ old('unit') }}" />
                                        @include('alerts.feedback', ['field' => 'unit'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Column Name') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('column_name') ? ' has-danger' : '' }}">
                                        <input
                                            class="form-control{{ $errors->has('column_name') ? ' is-invalid' : '' }}"
                                            name="column_name" id="input-unit" type="text"
                                            placeholder="{{ __('Column Name') }}" value="{{ old('column_name') }}"
                                            required="true" aria-required="true" />
                                        @include('alerts.feedback', ['field' => 'column_name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Type') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="type"
                                            data-style="select-with-transition" title="" data-size="100">
                                            <option value="">-</option>
                                            <option value="1">Text</option>
                                            <option value="2">Select Box</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'type'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Data Type') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="data_type"
                                            data-style="select-with-transition" title="" data-size="100">
                                            <option value=""></option>
                                            <option value="1">String</option>
                                            <option value="2">Numeric</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'data_type'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Value') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('value') ? ' has-danger' : '' }}">
                                        <input
                                            class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                            name="value" id="input-unit" type="text"
                                            placeholder="{{ __('Value') }}" value="{{ old('value') }}" />
                                        @include('alerts.feedback', ['field' => 'value'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Character Limit') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('limit') ? ' has-danger' : '' }}">
                                        <input
                                            class="form-control{{ $errors->has('limit') ? ' is-invalid' : '' }}"
                                            name="limit" id="limit" type="text" number="true"
                                            placeholder="{{ __('Character Limit') }}" value="{{ old('limit') }}" />
                                        @include('alerts.feedback', ['field' => 'limit'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Field Type') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="truck_data"
                                            data-style="select-with-transition" title="" data-size="100">
                                            <option value="0">Equipment Information Field</option>
                                            <option value="1">Truck Information Field</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'required'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-7">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" name="require" type="checkbox" value="1"> Required
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                        </label>
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

