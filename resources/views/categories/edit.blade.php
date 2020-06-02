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
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Title Structure') }}</label>
                                <div class="col-sm-7">
                                    <div class="row" style="margin:0 auto;">
                                        @php
                                            $title_structure = explode(',', $category->title_structure);
                                            if (sizeof($title_structure) == 2) {
                                                $title_structure[2] = 'none';
                                                $title_structure[3] = 'none';
                                            } else if (sizeof($title_structure) == 3) {
                                                $title_structure[3] = 'none';
                                            }                                        
                                        @endphp
                                        <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title1" id="title1_select"
                                            data-style="select-with-transition" title="-" data-size="7" required>
                                            <option value="year" {{ $title_structure[0] == 'year' ? 'selected' : '' }}>Year</option>
                                            <option value="make" {{ $title_structure[0] == 'make' ? 'selected' : '' }}>Make</option>
                                            <option value="model" {{ $title_structure[0] == 'model' ? 'selected' : '' }}>Model</option>
                                            <option value="truckyear" {{ $title_structure[0] == 'truckyear' ? 'selected' : '' }}>Truck Year</option>
                                            <option value="truckmake" {{ $title_structure[0] == 'truckmake' ? 'selected' : '' }}>Truck Make</option>
                                            <option value="truckmodel" {{ $title_structure[0] == 'truckmodel' ? 'selected' : '' }}>Truck Model</option>
                                            @foreach ($equip_specifics as $specific)
                                                <option value="{{ $specific->id }}" {{ $title_structure[0] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                            @foreach ($truck_specifics as $specific)
                                                <option value="{{ $specific->id }}" {{ $title_structure[0] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                        </select>
                                        <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title2" id="title2_select"
                                            data-style="select-with-transition" title="-" data-size="7" required>
                                            <option value="">None</option>
                                            <option value="year" {{ $title_structure[1] == 'year' ? 'selected' : '' }}>Year</option>
                                            <option value="make" {{ $title_structure[1] == 'make' ? 'selected' : '' }}>Make</option>
                                            <option value="model" {{ $title_structure[1] == 'model' ? 'selected' : '' }}>Model</option>
                                            <option value="truckyear" {{ $title_structure[1] == 'truckyear' ? 'selected' : '' }}>Truck Year</option>
                                            <option value="truckmake" {{ $title_structure[1] == 'truckmake' ? 'selected' : '' }}>Truck Make</option>
                                            <option value="truckmodel" {{ $title_structure[1] == 'truckmodel' ? 'selected' : '' }}>Truck Model</option>
                                            @foreach ($equip_specifics as $specific)
                                                <option value="{{ $specific->id }}" {{ $title_structure[1] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                            @foreach ($truck_specifics as $specific)
                                                <option value="{{ $specific->id }}" {{ $title_structure[1] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                        </select>
                                        @if ($title_structure[2] == 'none')
                                            <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title3" id="title3_select"
                                                data-style="select-with-transition" title="-" data-size="7" required>
                                                <option value="" selected>None</option>
                                                <option value="year">Year</option>
                                                <option value="make">Make</option>
                                                <option value="model">Model</option>
                                                <option value="truckyear">Truck Year</option>
                                                <option value="truckmake">Truck Make</option>
                                                <option value="truckmodel">Truck Model</option>
                                                @foreach ($equip_specifics as $specific)
                                                    <option value="{{ $specific->id }}">{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                                @foreach ($truck_specifics as $specific)
                                                    <option value="{{ $specific->id }}">{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title3" id="title3_select"
                                                data-style="select-with-transition" title="-" data-size="7" required>
                                                <option value="">None</option>
                                                <option value="year" {{ $title_structure[2] == 'year' ? 'selected' : '' }}>Year</option>
                                                <option value="make" {{ $title_structure[2] == 'make' ? 'selected' : '' }}>Make</option>
                                                <option value="model" {{ $title_structure[2] == 'model' ? 'selected' : '' }}>Model</option>
                                                <option value="truckyear" {{ $title_structure[2] == 'truckyear' ? 'selected' : '' }}>Truck Year</option>
                                                <option value="truckmake" {{ $title_structure[2] == 'truckmake' ? 'selected' : '' }}>Truck Make</option>
                                                <option value="truckmodel" {{ $title_structure[2] == 'truckmodel' ? 'selected' : '' }}>Truck Model</option>
                                                @foreach ($equip_specifics as $specific)
                                                    <option value="{{ $specific->id }}" {{ $title_structure[2] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                                @foreach ($truck_specifics as $specific)
                                                    <option value="{{ $specific->id }}" {{ $title_structure[2] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($title_structure[3] == 'none')
                                            <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title4" id="title3_select"
                                                data-style="select-with-transition" title="-" data-size="7" required>
                                                <option value="title_none" selected>None</option>
                                                <option value="year">Year</option>
                                                <option value="make">Make</option>
                                                <option value="model">Model</option>
                                                <option value="truckyear">Truck Year</option>
                                                <option value="truckmake">Truck Make</option>
                                                <option value="truckmodel">Truck Model</option>
                                                @foreach ($equip_specifics as $specific)
                                                    <option value="{{ $specific->id }}">{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                                @foreach ($truck_specifics as $specific)
                                                    <option value="{{ $specific->id }}">{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title4" id="title3_select"
                                                data-style="select-with-transition" title="-" data-size="7" required>
                                                <option value="title_none">None</option>
                                                <option value="year" {{ $title_structure[3] == 'year' ? 'selected' : '' }}>Year</option>
                                                <option value="make" {{ $title_structure[3] == 'make' ? 'selected' : '' }}>Make</option>
                                                <option value="model" {{ $title_structure[3] == 'model' ? 'selected' : '' }}>Model</option>
                                                <option value="truckyear" {{ $title_structure[3] == 'truckyear' ? 'selected' : '' }}>Truck Year</option>
                                                <option value="truckmake" {{ $title_structure[3] == 'truckmake' ? 'selected' : '' }}>Truck Make</option>
                                                <option value="truckmodel" {{ $title_structure[3] == 'truckmodel' ? 'selected' : '' }}>Truck Model</option>
                                                @foreach ($equip_specifics as $specific)
                                                    <option value="{{ $specific->id }}" {{ $title_structure[3] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                                @foreach ($truck_specifics as $specific)
                                                    <option value="{{ $specific->id }}" {{ $title_structure[3] == $specific->id ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                                @endforeach
                                            </select>
                                        @endif
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
