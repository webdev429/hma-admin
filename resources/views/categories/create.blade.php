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
                                <label class="col-sm-2 col-form-label">{{ __('Specific Field') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('optional_field') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="equip_specifics[]"
                                            data-style="select-with-transition" multiple title="-" id="equip_info_select" data-size="7">
                                            @foreach ($equip_specifics as $specific)
                                              <option value="{{ $specific->id }}" {{ in_array($specific->id, old('specifics') ?? []) ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
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
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Specific Field') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('optional_field') ? ' has-danger' : '' }}">
                                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="truck_specifics[]" id="truck_info_select"
                                            data-style="select-with-transition" multiple title="-" data-size="7" disabled>
                                            @foreach ($truck_specifics as $specific)
                                              <option value="{{ $specific->id }}" {{ in_array($specific->id, old('specifics') ?? []) ? 'selected' : '' }}>{{ $specific->name }}{{ $specific->unit ? '('.$specific->unit.')' : '' }}</option>
                                            @endforeach
                                        </select>
                                        @include('alerts.feedback', ['field' => 'specifics'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Title Structure') }}</label>
                                <div class="col-sm-7">
                                    <div class="row" style="margin:0 auto;">
                                        <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title1" id="title1_select"
                                            data-style="select-with-transition" title="-" data-size="7" required>
                                            <option value="year" selected>Year</option>
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
                                        <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title2" id="title2_select"
                                            data-style="select-with-transition" title="-" data-size="7" required>
                                            <option value="year">Year</option>
                                            <option value="make" selected>Make</option>
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
                                        <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title3" id="title3_select"
                                            data-style="select-with-transition" title="-" data-size="7">
                                            <option value="title_none">None</option>
                                            <option value="year">Year</option>
                                            <option value="make">Make</option>
                                            <option value="model" selected>Model</option>
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
                                        <select class="selectpicker col-md-3 col-sm-12 pl-0 pr-0" name="title4" id="title4_select"
                                            data-style="select-with-transition" title="-" data-size="7">
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

@push('js')
<script>
    $('#equip_info').change(function() {
        var equip_info = $(this).val();
        if(equip_info == 1) {
            $('#equip_info_select').prop('disabled', false);
            $('#equip_info_select').selectpicker('refresh');
        } else {
            $('#equip_info_select').prop('disabled', true);
            $('#equip_info_select').selectpicker('refresh');
        }
    });
    $('#truck_mounted').change(function() {
        var equip_info = $(this).val();
        console.log(equip_info);
        if(equip_info == 1) {
            $('#truck_info_select').prop('disabled', false);
            $('#truck_info_select').selectpicker('refresh');
        } else {
            $('#truck_info_select').prop('disabled', true);
            $('#truck_info_select').selectpicker('refresh');
        }
    });
</script>
@endpush
