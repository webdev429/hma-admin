@extends('layouts.app', ['activePage' => 'deal_list', 'menuParent' => 'deal', 'titlePage' => __('Edit Deal')])

@section('content')
<style>
    .specific_item div .dropdown.bootstrap-select {
        width: 100% !important;
    }
    .truck_unit div .dropdown.bootstrap-select {
        width: 100% !important;
    }
    .price_unit div .dropdown.bootstrap-select {
        width: 100% !important;
    }

</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="editDealForm" method="post" enctype="multipart/form-data" action="{{ route('deal.update', $deal) }}" class="form-horizontal" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="card">
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
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Deal Type -->
                                    <label class="col-sm-4 col-form-label">Deal Type</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="deal_type" id="deal_type" onchange="onChangeDealType()" data-style="select-with-transition" required="true">
                                                <option value="0" {{ $deal->deal_type == 0 ? 'selected' : '' }}>Sale </option>
                                                <option value="1" {{ $deal->deal_type == 1 ? 'selected' : '' }}>Auction</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Equipment Type -->
                                    <label class="col-md-4 col-form-label">Equipment Type</label>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <select class="selectpicker" onchange="onChangeEqupmentType();" name="type_id" id="type_id" data-style="select-with-transition" required="true">
                                                <option value="0"></option>
                                                @foreach($types as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == old('type_id', $deal->type_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Equipment Category -->
                                    <label class="col-md-4 col-form-label">Equipment Category</label>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <select class="selectpicker" onchange="onChangeEquipmentCategory();" name="category_id" id="category_id" data-style="select-with-transition" required="true">
                                                <option value="0"></option>
                                                @foreach($equipment_category as $item)
                                                    <option class="category_{{ $item->id }}" value="{{ $item->id }}" {{ $item->id == old('category_id', $deal->category_id) ? 'selected' : '' }} style="display:none;">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Make -->
                                    <label class="col-sm-4 col-form-label">Make</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" onchange="onChangeMake();" data-style="select-with-transition" name="make_id" id="make_id" required="true">
                                                <option value=""></option>
                                                @foreach($makes as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == old('make_id', $deal->make_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Model -->
                                    <label class="col-sm-4 col-form-label">Model</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" onchange="onChangeModel();" data-style="select-with-transition" name="modeld_id" id="modeld_id" required="true">
                                                <option value=""></option>
                                                @foreach($modelds as $item)
                                                    <option class="modeld_{{ $item->id }}" value="{{ $item->id }}" {{ $item->id == old('modeld_id', $deal->modeld_id) ? 'selected' : '' }} style="display:none;">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Year -->
                                    <label class="col-sm-4 col-form-label">Year</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" onchange="onChangeYear();" class="form-control" name="year" id="year" number="true" range="[1800, 2100]" value="{{ $deal->year }}" required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Country -->
                                    <label class="col-sm-4 col-form-label">Country</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="country" onchange="onChangeCountry();" id="country" data-style="select-with-transition">
                                                <option value="United States" {{ $deal->country == 'United States' ? 'selected' : '' }}>United States</option>
                                                <option value="Canada" {{ $deal->country == 'Canada' ? 'selected' : '' }}>Canada</option>
                                                <option value="Mexico" {{ $deal->country == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- State -->
                                    <label class="col-sm-4 col-form-label">State</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="state" id="state" data-style="select-with-transition">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- City -->
                                    <label class="col-sm-4 col-form-label">City</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="city" value="{{ $deal->city }}">
                                        </div>
                                    </div>
                                    <!-- Company Name -->
                                    <label class="col-sm-4 col-form-label company_item" style="display:{{ $deal->deal_type == 0 ? 'block' : 'none' }};">Company Name</label>
                                    <div class="col-sm-8 company_item" style="display:{{ $deal->deal_type == 0 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="company" id="company" value="{{ $deal->company }}">
                                        </div>
                                    </div>
                                    <!-- Auctioneer -->
                                    <label class="col-sm-4 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">Auctioneer</label>
                                    <div class="col-sm-8 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <select class="selectpicker" name="auctioneer_id" id="auctioneer_id" data-style="select-with-transition">
                                                <option value=""></option>
                                                @foreach ($auctioneers as $auctioneer)
                                                    <option value="{{ $auctioneer->id }}" {{ $auctioneer->id == old('auctioneer_id', $deal->auctioneer_id) ? 'selected' : '' }}>{{ $auctioneer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Price -->
                                    <label class="col-sm-4 col-form-label price-item" style="display:{{ $deal->deal_type == 0 ? 'block' : 'none' }};">Price</label>
                                    <div class="col-sm-5 price-item" style="display:{{ $deal->deal_type == 0 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{ $deal->price }}" name="price" id="price" number="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 price-item price_unit" style="display:{{ $deal->deal_type == 0 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <select class="selectpicker" name="price_currency" data-style="select-with-transition">
                                                <option value="USD" {{ $deal->price_currency == "USD" ? 'selected' : '' }}>USD</option>
                                                <option value="CAD" {{ $deal->price_currency == "CAD" ? 'selected' : '' }}>CAD</option>
                                                <option value="MXN" {{ $deal->price_currency == "MXN" ? 'selected' : '' }}>MXN</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Buyer's Premium -->
                                    <label class="col-sm-4 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">Buyer's Premium</label>
                                    <div class="col-sm-8 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="premium" id="premium" number="true" range="[0, 100]" value="{{ $deal->premium }}">
                                        </div>
                                    </div>
                                    <!-- AuctionEndDate  -->
                                    <label class="col-sm-4 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">Auction Date</label>
                                    <div class="col-sm-8 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">
                                        <div class="form-group{{ $errors->has('auc_enddate') ? ' has-danger' : '' }}">
                                            <input type="text"  name="auc_enddate" id="auc_enddate"
                                            placeholder="{{ __('Select date') }}" class="form-control datetimepicker" value="{{ $deal->auc_enddate ? $deal->auc_enddate : now()->format('d-m-Y') }}"/>
                                            @include('alerts.feedback', ['field' => 'auc_enddate'])
                                        </div>
                                    </div>
                                    <!-- Serial Number -->
                                    <label class="col-sm-4 col-form-label">SN</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="sn" id="sn" value="{{ $deal->sn }}">
                                        </div>
                                    </div>
                                    <!-- Url -->
                                    <label class="col-sm-4 col-form-label">URL</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="url" id="url" value="{{ $deal->url }}">
                                        </div>
                                    </div>
                                    <!-- LOT# -->
                                    <label class="col-sm-4 col-form-label auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">Lot #</label>
                                    <div class="col-sm-8 auction-field" style="display:{{ $deal->deal_type == 1 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="auc_lot" id="lot" value="{{ $deal->lot }}">
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <hr>
                            <h4 class="specific_title"><strong>Equipment Specific Information</strong></h4>
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
                                            <label class='col-md-2 col-sm-4 col-form-label {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}"> {{ $specific->name }}</label>
                                            <div class='col-md-2 col-sm-5 {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">
                                                <div class='form-group'>
                                                    <input type='text' class='form-control' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' number="{{ $specific->data_type == 2 ? 'true' : 'false' }}" value="{{ $show_flag }}">
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-2 {{ $specific->column_name }} specific_item" style="padding-left:0;display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}"">
                                                <div class='form-group'>
                                                    <select class='selectpicker' name='{{ $specific->column_name }}_unit' id='{{ $specific->column_name }}_unit' data-style='select-with-transition'>
                                                        @foreach ($unitAry as $unit)
                                                        <option value='{{ $unit }}' {{ $valueUnit == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-1"></div>
                                        @else
                                            <label class='col-md-2 col-sm-4 col-form-label {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}"> {{ $specific->name }}</label>
                                            <div class='col-md-4 col-sm-8 col-sm-9 {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">
                                                <div class='form-group'>
                                                    <input type='text' class='form-control' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' value="{{ $show_flag }}">
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @php
                                        $optionAry = explode('/', $specific->value);
                                        @endphp
                                        <label class='col-md-1 col-sm-3 col-form-label {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">{{ $specific->name }}</label>
                                        <div class='col-md-2 col-sm-9 {{ $specific->column_name }} specific_item' style="display:{{ $deal->category->specifics->where('id', $specific->id)->first() ? 'block;' : 'none;' }}">
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
                            <h4 class="truck-mounted-title" style="display:{{ $deal->category->truck_mounted == 1 ? 'block;' : 'none;' }}"><strong>Truck Information</strong></h4>
                            <div class="row truck-mounted-fields">
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Truck Make -->
                                    <label class="col-sm-4 col-form-label">Truck Make</label>
                                    <div class="col-sm-8">
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
                                    <label class="col-sm-4 col-form-label">Truck Model</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_model" value="{{ $deal->truck_model }}">
                                        </div>
                                    </div>
                                    <!-- Truck Year -->
                                    <label class="col-sm-4 col-form-label">Truck Year</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_year" number="true" range="[1800, 2100]" value="{{ $deal->truck_year }}">
                                        </div>
                                    </div>
                                    <!-- Truck Condition(km/mi) -->
                                    <label class="col-sm-4 col-form-label">Truck Condition</label>
                                    <div class="col-sm-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_condition" number="true" value="{{ $deal->truck_condition }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 truck_unit">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_condition_unit" data-style="select-with-transition">
                                                <option value="Km" {{ $deal->truck_condition_unit == 'Km' ? 'selected' : '' }}>Km</option>
                                                <option value="mile" {{ $deal->truck_condition_unit == 'mile' ? 'selected' : '' }}>mile</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Truck Engine -->
                                    <label class="col-sm-4 col-form-label">Truck Engine</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_engine" value="{{ $deal->truck_engine }}">
                                        </div>
                                    </div>
                                    <!-- Truck Trans -->
                                    <label class="col-sm-4 col-form-label">Truck Transmission</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_trans" data-style="select-with-transition">
                                                <option value="Manual" {{ $deal->truck_trans == 'Manual' ? 'selected' : '' }}>Manual</option>
                                                <option value="Automatic" {{ $deal->truck_trans == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Truck Suspension -->
                                    <label class="col-sm-4 col-form-label">Truck Fuel Type</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_suspension" data-style="select-with-transition">
                                                <option value="Diesel" {{ $deal->truck_suspension == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                                <option value="Gas" {{ $deal->truck_suspension == 'Gas' ? 'selected' : '' }}>Gas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4><strong>Ad Information</strong></h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Title -->
                                    <label class="col-md-4 col-form-label">Title</label>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control disabled" name="title" id="title" value="{{ $deal->title }}">
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <label class="col-md-4 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <textarea cols="30" rows="10"
                                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                name="description" id="input-description" type="text">
                                                {{ $deal->description }}
                                            </textarea>
                                            @include('alerts.feedback', ['field' => 'description'])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="text-align:center;">
                                    <h4 class="title"><strong>Primary Picture</strong></h4>
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
                                            @if ($deal->picture)
                                                <input type="file" name="photo" id = "input-picture" />
                                            @else
                                                <input type="file" name="photo" id = "input-picture" required="true" />
                                            @endif
                                            </span>
                                            <a href="#pablo" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> {{ __('Remove') }}</a>
                                        </div>
                                        @include('alerts.feedback', ['field' => 'photo'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-rose">Save</button>
                        </div>
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
    .specific_item {
        display: none;
    }
    .specific_title {
        display: none;
    }
</style>
@endsection

@push('js')
<script>
    var makeStr = '';
    var modelStr = '';
    var yearStr = '';
    var titleStr = '';

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
        $(".specific_title").fadeIn();
        $('.dropdown.bootstrap-select').css('width', '100% !important');
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
        makeStr = $('#make_id').text();
        titleStr = yearStr.toString() + " " + makeStr.trim() + " " + modelStr.trim();
        $("#title").val(titleStr);

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

    function onChangeModel() {
        modelStr = $('#modeld_id').text();
        titleStr = yearStr.toString() + " " + makeStr.trim() + " " + modelStr.trim();
        $("#title").val(titleStr);
    }

    function onChangeYear() {
        yearStr = $('#year').val();
        titleStr = yearStr.toString() + " " + makeStr.trim() + " " + modelStr.trim();
        $("#title").val(titleStr);
    }

    function onChangeDealType() {
        var deal_type = $('#deal_type').val();
        
        if (deal_type == 0) {
            $('.auction-field').fadeOut();
            $('.price-item').fadeIn();
            $('.company_item').fadeIn();
        } else {
            $('.auction-field').fadeIn();
            $('.price-item').fadeOut();
            $('.company_item').fadeOut();
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

    function onChangeCountry() {
        var country = $('#country').val();
        $.ajax({
            type: "POST",
            url: "ajax_get_state_list",
            data: {
                country: country,
                _token: '<?php echo csrf_token() ?>'       
            },
            success: function(data) {
                $('#state option').remove();
                $('#state').append("<option value=''></option>");
                for(var item in data) {
                    var state = data[item];
                    $('#state').append("<option value='"+state+"'>"+state+"</option>");
                }
                $('#state').selectpicker('destroy').selectpicker();
            }
        });
    }

    $(document).ready(function () {
        setFormValidation('#editDealForm');
        var condition = <?php echo $deal->category->truck_mounted; ?>;
        if (condition != 1) {
            $('.truck-mounted-fields').css('display', 'none');
        }
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
        $.ajax({
            type: "POST",
            url: "ajax_get_state_list",
            data: {
                country: "<?php echo $deal->country;?>",
                _token: '<?php echo csrf_token() ?>'       
            },
            success: function(data) {
                $('#state option').remove();
                $('#state').append("<option value=''></option>");
                var selectedStr = "";
                for(var item in data) {
                    var state = data[item];
                    if (state == "<?php echo $deal->state;?>") {
                        selectedStr = "selected";
                    } else {
                        selectedStr = "";
                    }
                    $('#state').append("<option value='"+state+"'"+selectedStr+">"+state+"</option>");
                }
                $('#state').selectpicker('destroy').selectpicker();
            }
        });
        // var deal_type = "<?php echo $deal->deal_type;?>";
        // console.log(deal_type);
        // if (deal_type == '0') {
        //     $('.auction-field').fadeOut();
        //     $('.price-item').fadeIn();
        //     $('.company_item').fadeIn();
        // } else {
        //     $('.auction-field').fadeIn();
        //     $('.price-item').fadeOut();
        //     $('.company_item').fadeOut();
        // }
    });

</script>
@endpush
