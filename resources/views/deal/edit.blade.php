@extends('layouts.app', ['activePage' => 'deal_list', 'menuParent' => 'deal', 'titlePage' => __('Edit Deal')])

@section('content')
<style>
    .dropdown.bootstrap-select {
        width: 100% !important;
    }

</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('deal.update', $deal) }}" class="form-horizontal" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Edit Deal</h4>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('deal.index') }}" class="btn btn-sm btn-rose">{{ __('To the List') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- Title -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Title</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ old('title', $deal->title) }}" name="title" require="true">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Deal Type -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Deal Type</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="selectpicker" name="deal_type" id="deal_type" onchange="onChangeDealType()" data-style="select-with-transition" require="true">
                                                    <option value="0" {{ $deal->deal_type == 0 ? 'selected' : '' }}>Sale </option>
                                                    <option value="1" {{ $deal->deal_type == 1 ? 'selected' : '' }}>Auction</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Equipment Type -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Equipment Type</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="selectpicker" onchange="onChangeEqupmentType();" name="type_id" id="type_id" data-style="select-with-transition" require="true">
                                                    <option value="0"></option>
                                                    @foreach($types as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == old('type_id', $deal->type_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Equipment Category -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Equipment Category</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="selectpicker" onchange="onChangeEquipmentCategory();" name="category_id" id="category_id" data-style="select-with-transition" require="true">
                                                    <option value="0"></option>
                                                    @foreach($equipment_category as $item)
                                                        <option class="category_{{ $item->id }}" value="{{ $item->id }}" {{ $item->id == old('category_id', $deal->category_id) ? 'selected' : '' }} style="display:none;">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 row">
                                    <label class="col-md-4 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <textarea cols="30" rows="10"
                                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                name="description" id="input-description" type="text"
                                                placeholder="{{ __('Description') }}" required="true"
                                                aria-required="true">{{ old('description', $deal->description) }}</textarea>
                                            @include('alerts.feedback', ['field' => 'description'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-12" style="margin-top:30px;">
                                    <h4>General Properties</h4>
                                    <div class="row">
                                        <!-- Year -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Year</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="year" value="{{ $deal->year }}">
                                            </div>
                                        </div>
                                        <!-- Make -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Make</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" onchange="onChangeMake();" data-style="select-with-transition" name="make_id" id="make_id">
                                                    <option value=""></option>
                                                    @foreach($makes as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == old('make_id', $deal->make_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Model -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Model</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition" name="modeld_id" id="modeld_id">
                                                    <option value=""></option>
                                                    @foreach($modelds as $item)
                                                        <option class="modeld_{{ $item->id }}" value="{{ $item->id }}" {{ $item->id == old('modeld_id', $deal->modeld_id) ? 'selected' : '' }} style="display:none;">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- City -->
                                        <label class="col-md-1 col-sm-3 col-form-label">City</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" value="{{ $deal->city }}">
                                            </div>
                                        </div>
                                        <!-- State -->
                                        <label class="col-md-1 col-sm-3 col-form-label">State</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="state" value="{{ $deal->state }}">
                                            </div>
                                        </div>
                                        <!-- Country -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Country</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" name="country" data-style="select-with-transition">
                                                    <option value="United States" {{ $deal->country == 'United States' ? 'selected' : '' }}>United States</option>
                                                    <option value="Canada" {{ $deal->country == 'Canada' ? 'selected' : '' }}>Canada</option>
                                                    <option value="Mexico" {{ $deal->country == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- AuctionEndDate  -->
                                        <label class="col-md-1 col-sm-3 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block;' : 'none;' }}">EndDate</label>
                                        <div class="col-md-3 col-sm-9 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block;' : 'none;' }}">
                                            <div class="form-group{{ $errors->has('auc_enddate') ? ' has-danger' : '' }}">
                                                <input type="text"  name="auc_enddate" id="auc_enddate"
                                                placeholder="{{ __('Select date') }}" class="form-control datetimepicker" value="{{ old('auc_enddate', $deal->auc_enddate) }}"/>
                                                @include('alerts.feedback', ['field' => 'auc_enddate'])
                                            </div>
                                        </div>
                                        <!-- LOT -->
                                        <label class="col-md-1 col-sm-3 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block;' : 'none;' }}">LOT</label>
                                        <div class="col-md-3 col-sm-9 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block;' : 'none;' }}">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="auc_lot" id="lot" value="{{ $deal->auc_lot }}">
                                            </div>
                                        </div>
                                        <!-- Auctioneer -->
                                        <label class="col-md-1 col-sm-3 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block;' : 'none;' }}">Auctioneer</label>
                                        <div class="col-md-3 col-sm-9 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block;' : 'none;' }}">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="auc_auctioneer" id="auctioneer" value="{{ $deal->auc_auctioneer }}">
                                            </div>
                                        </div>
                                        <!-- Price -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Price</label>
                                        <div class="col-md-3 col-sm-7">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="price" id="price" value="{{ $deal->price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-2" style="padding:0;">
                                            <div class="form-group">
                                                <select class="selectpicker" name="price_currency" data-style="select-with-transition">
                                                    <option value="USD" {{ $deal->price_currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                    <option value="CAD" {{ $deal->price_currency == 'CAD' ? 'selected' : '' }}>CAD</option>
                                                    <option value="MXN" {{ $deal->price_currency == 'MXN' ? 'selected' : '' }}>MXN</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Url -->
                                        <label class="col-md-1 col-sm-3 col-form-label">URL</label>
                                        <div class="col-md-6 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="url" id="url" value="{{ $deal->url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12" style="text-align:center;">
                                    <h4 class="title">Primary Picture</h4>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            @if ($deal->picture)
                                            <img src="{{ $deal->path() }}" alt="...">
                                            @else
                                            <img src="{{ asset('material') }}/img/image_placeholder.jpg" alt="...">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-file">
                                            <span class="fileinput-new">{{ __('Select image') }}</span>
                                            <span class="fileinput-exists">{{ __('Change') }}</span>
                                            <input type="file" name="photo" id = "input-picture" />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> {{ __('Remove') }}</a>
                                        </div>
                                        @include('alerts.feedback', ['field' => 'photo'])
                                    </div>
                                </div>
                            </div>
                            <h4 class="truck-mounted-title" style="display:{{ $deal->category->truck_mounted == 1 ? 'block;' : 'none;' }}">Truck Mounted Data</h4>
                            <div class="truck-mounted-fields" style="display:{{ $deal->category->truck_mounted == 1 ? 'block;' : 'none;' }}">
                                <div class="row">
                                    <!-- Truck Year -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Year</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_year" value="{{ $deal->truck_year }}">
                                        </div>
                                    </div>
                                    <!-- Truck Make -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Make</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truckmake_id" data-style="select-with-transition">
                                                <option value=""></option>
                                                @foreach ($truckmakes as $truckmake)
                                                <option value="{{ $truckmake->id }}" {{ $deal->truckmake_id == $truckmake->id ? 'selected' : '' }}>{{ $truckmake->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Truck Model -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Model</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_model" value="{{ $deal->truck_model }}">
                                        </div>
                                    </div>
                                    <!-- Truck Engine -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Engine</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_engine" value="{{ $deal->truck_engine }}">
                                        </div>
                                    </div>
                                    <!-- Truck Trans -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Trans</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_trans" value="{{ $deal->truck_trans }}">
                                        </div>
                                    </div>
                                    <!-- Truck Suspension -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Suspension</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_suspension" value="{{ $deal->truck_suspension }}">
                                        </div>
                                    </div>
                                    <!-- Truck Condition(km/mi) -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Condition</label>
                                    <div class="col-md-2 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_condition" value="{{ $deal->truck_condition }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-3">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_condition_unit" data-style="select-with-transition">
                                                <option value="Km" {{ $deal->truck_condition_unit == 'Km' ? 'selected' : '' }}>Km</option>
                                                <option value="mile" {{ $deal->truck_condition_unit == 'mile' ? 'selected' : '' }}>mile</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4>Specific Properties</h4>
                            <div class="row" id="specific_field">
                                @foreach ($specifics as $specific)
                                    @php
                                        $show_flag = eval('return $deal->'. $specific->column_name . ';');
                                    @endphp
                                    @if ($specific->type == 1)
                                        @if ($specific->unit != '')
                                        @php
                                            $unitAry = explode('/', $specific->unit);
                                            $valueUnit = eval('return $deal->'.$specific->column_name.'_unit;');
                                        @endphp
                                        <label class='col-md-1 col-sm-2 col-form-label {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}"> {{ $specific->name }}</label>
                                        <div class='col-md-2 col-sm-8 {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">
                                            <div class='form-group'>
                                                <input type='text' class='form-control' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' value="{{ $show_flag }}">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-2 {{ $specific->column_name }} specific_item" style="padding:0;display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">
                                            <div class='form-group'>
                                                <select class='selectpicker' name='{{ $specific->column_name }}_unit' id='{{ $specific->column_name }}_unit' data-style='select-with-transition'>
                                                    @foreach ($unitAry as $unit)
                                                    <option value='{{ $unit }}' {{ $valueUnit == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @else
                                        <label class='col-md-1 col-sm-3 col-form-label {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}"> {{ $specific->name }}</label>
                                        <div class='col-md-2 col-sm-9 {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">
                                            <div class='form-group'>
                                                <input type='text' class='form-control' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' value="{{ $show_flag }}">
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        @php
                                        $optionAry = explode('/', $specific->value);
                                        @endphp
                                        <label class='col-md-1 col-sm-3 col-form-label {{ $specific->column_name }} specific_item' style="display:{{ $show_flag != NULL ? 'block;' : 'none;' }}">{{ $specific->name }}</label>
                                        <div class='col-md-2 col-sm-9 {{ $specific->column_name }} specific_item' style="display:{{ $show_flag != NULL ? 'block;' : 'none;' }}">
                                            <div class='form-group'>
                                            <select class='selectpicker' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' data-style='select-with-transition'>
                                                @foreach ($optionAry as $option)
                                                <option value='{{ $option }}' {{ $show_flag == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-rose">Save</button>
                        </div>
                        <input type="hidden" id="category_selected" value="" />
                        <input type="hidden" id="make_selected" value="" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .auction-field {
        display: none;
    }
    .truck-mounted-title {
        display: none;
    }
    .truck-mounted-fields {
        display: none;
    }
    .specific_item {
        display: none;
    }
</style>
@endsection

@push('js')
<script>
    function onChangeEqupmentType() {
        var eType = $('#type_id').val();
        $(".specific_item").fadeOut();
        $.ajax({
            type: "POST",
            url: "ajax_get_equipment_category",
            data: {
                equipment_type_id: eType,
                _token: '<?php echo csrf_token() ?>'       
            },
            success: function(data) {
                $('#category_id option').remove();
                $('#category_id').append("<option value=''></option>");
                for(var item in data) {
                    var category_itemId = data[item].id;
                    $('#category_id').append("<option value='"+data[item].id+"'>"+data[item].name+"</option>");
                }
                $('#category_id').selectpicker('destroy').selectpicker();
            }
        });
        $('#category_selected').val(eType);
    }
    
    function onChangeEquipmentCategory() {
        var eCategory = $('#category_id').val();
        $(".specific_item").fadeOut();
        $.ajax({
            type: 'POST',
            url: 'ajax_get_specific_properties',
            data: {
                equipment_category_id: eCategory,
                _token: '<?php echo csrf_token() ?>'
            },
            success: function(data) {
                console.log(data);
                if (data[0].truck_mounted == 1) {
                    $('.truck-mounted-title').fadeIn();
                    $('.truck-mounted-fields').fadeIn();
                } else {
                    $('.truck-mounted-title').fadeOut();
                    $('.truck-mounted-fields').fadeOut();
                }
                for (var item in data) {
                    var class_str = '.' + data[item].column_name;
                    $(".specific_item"+class_str).fadeIn();
                }
            }
        });
    }

    function onChangeMake() {
        var mId = $('#make_id').val();
        $.ajax({
            type: "POST",
            url: "ajax_get_modeld",
            data: {
                make_id: mId,
                _token: '<?php echo csrf_token() ?>'       
            },
            success: function(data) {
                $('#modeld_id option').remove();
                $('#modeld_id').append("<option value=''></option>");
                for(var item in data) {
                    var modeld_itemId = data[item].id;
                    $('#modeld_id').append("<option value='"+data[item].id+"'>"+data[item].name+"</option>");
                }
                $('#modeld_id').selectpicker('destroy').selectpicker();
            }
        });
        $('#make_selected').val(mId);
    }

    function onChangeDealType() {
        var deal_type = $('#deal_type').val();
        
        if (deal_type == 0) {
            $('.auction-field').fadeOut();
        } else {
            $('.auction-field').fadeIn();
        }
    }

    function setFormValidation(id) {
        $(id).validate({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
            },
            errorPlacement: function (error, element) {
                $(element).closest('.form-group').append(error);
            },
        });
    }

    $(document).ready(function () {
        
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
            format: 'DD-MM-YYYY'
        });
    });

</script>
@endpush
