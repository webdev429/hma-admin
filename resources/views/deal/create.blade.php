@extends('layouts.app', ['activePage' => 'deal_add', 'menuParent' => 'deal', 'titlePage' => __('Add Deal')])

@section('content')
<style>
    .specific_item div .dropdown.bootstrap-select {
        width: 100% !important;
    }
    .truck_unit div .dropdown.bootstrap-select {
        width: 100% !important;
    }
    .price_unit .form-group .dropdown.bootstrap-select {
        width: 100% !important;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="creatDealForm" enctype="multipart/form-data" action="{{ route('deal.store') }}" method="post" class="form-horizontal" autocomplete="off">
                    @csrf
                    @method('post')
                    <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Deal Registration</h4>
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
                                                <option value="0">Sale </option>
                                                <option value="1">Auction</option>
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
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                @foreach ($makes as $make)
                                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
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
                                                    <option class="modeld_{{ $item->id }}" value="{{ $item->id }}" style="display:none;">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Year -->
                                    <label class="col-sm-4 col-form-label">Year</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" onchange="onChangeYear();" class="form-control" name="year" id="year" number="true" range="[1800, 2100]" required="true">
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
                                                <option value="United States">United States</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Mexico">Mexico</option>
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
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                    </div>
                                    <!-- Company Name -->
                                    <label class="col-sm-4 col-form-label company_item">Company Name</label>
                                    <div class="col-sm-8 company_item">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="company" id="company">
                                        </div>
                                    </div>
                                    <!-- Auctioneer -->
                                    <label class="col-sm-4 col-form-label auction-field">Auctioneer</label>
                                    <div class="col-sm-8 auction-field">
                                        <div class="form-group">
                                            <select class="selectpicker" name="auctioneer_id" id="auctioneer_id" data-style="select-with-transition">
                                                <option value=""></option>
                                                @foreach ($auctioneers as $auctioneer)
                                                    <option value="{{ $auctioneer->id }}">{{ $auctioneer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Price -->
                                    <label class="col-sm-4 col-form-label price-item">Price</label>
                                    <div class="col-sm-5 price-item">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="price" id="price" number="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 price-item price-unit">
                                        <div class="form-group">
                                            <select class="selectpicker" name="price_currency" data-style="select-with-transition">
                                                <option value="USD">USD</option>
                                                <option value="CAD">CAD</option>
                                                <option value="MXN">MXN</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Buyer's Premium -->
                                    <label class="col-sm-4 col-form-label auction-field">Buyer's Premium</label>
                                    <div class="col-sm-8 auction-field">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="premium" id="premium" number="true" range="[0, 100]">
                                        </div>
                                    </div>
                                    <!-- AuctionEndDate  -->
                                    <label class="col-sm-4 col-form-label auction-field">Auction Date</label>
                                    <div class="col-sm-8 auction-field">
                                        <div class="form-group{{ $errors->has('auc_enddate') ? ' has-danger' : '' }}">
                                            <input type="text"  name="auc_enddate" id="auc_enddate"
                                            placeholder="{{ __('Select date') }}" class="form-control datetimepicker" value="{{ old('auc_enddate', now()->format('d-m-Y')) }}"/>
                                            @include('alerts.feedback', ['field' => 'auc_enddate'])
                                        </div>
                                    </div>
                                    <!-- Serial Number -->
                                    <label class="col-sm-4 col-form-label">SN</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="sn" id="sn">
                                        </div>
                                    </div>
                                    <!-- Url -->
                                    <label class="col-sm-4 col-form-label">URL</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="url" id="url">
                                        </div>
                                    </div>
                                    <!-- LOT# -->
                                    <label class="col-sm-4 col-form-label auction-field">Lot #</label>
                                    <div class="col-sm-8 auction-field">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="auc_lot" id="lot">
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <hr>
                            <h4 class="specific_title"><strong>Equipment Specific Information</strong></h4>
                            <div class="row" id="specific_field">
                                @foreach ($specifics as $specific)
                                    @if ($specific->type == 1)
                                        @if ($specific->unit != '')
                                        @php
                                            $unitAry = explode('/', $specific->unit);
                                        @endphp
                                        <label class='col-md-2 col-sm-4 col-form-label {{ $specific->column_name }} specific_item'> {{ $specific->name }}</label>
                                        <div class='col-md-2 col-sm-5 {{ $specific->column_name }} specific_item'>
                                            <div class='form-group'>
                                                <input type='text' class='form-control' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' number="{{ $specific->data_type == 2 ? 'true' : 'false' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-2 {{ $specific->column_name }} specific_item" style="padding-left:0;">
                                            <div class='form-group'>
                                                <select class='selectpicker' name='{{ $specific->column_name }}_unit' id='{{ $specific->column_name }}_unit' data-style='select-with-transition'>
                                                    @foreach ($unitAry as $unit)
                                                    <option value='{{ $unit }}'>{{ $unit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-1 specific_item"></div>
                                        @else
                                        <label class='col-md-2 col-sm-4 col-form-label {{ $specific->column_name }} specific_item'> {{ $specific->name }}</label>
                                        <div class='col-md-4 col-sm-8 col-sm-9 {{ $specific->column_name }} specific_item'>
                                            <div class='form-group'>
                                                <input type='text' class='form-control' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}'>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        @php
                                        $optionAry = explode('/', $specific->value);
                                        @endphp
                                        <label class='col-md-1 col-sm-3 col-form-label {{ $specific->column_name }} specific_item'>{{ $specific->name }}</label>
                                        <div class='col-md-2 col-sm-9 {{ $specific->column_name }} specific_item'>
                                            <div class='form-group'>
                                            <select class='selectpicker' name='{{ $specific->column_name }}' id='{{ $specific->column_name }}' data-style='select-with-transition'>
                                                @foreach ($optionAry as $option)
                                                <option value='{{ $option }}'>{{ $option }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <h4 class="truck-mounted-title"><strong>Truck Information</strong></h4>
                            <div class="row truck-mounted-fields">
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Truck Make -->
                                    <label class="col-sm-4 col-form-label">Truck Make</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truckmake_id" data-style="select-with-transition">
                                                <option value=""></option>
                                                @foreach ($truckmakes as $truckmake)
                                                <option value="{{ $truckmake->id }}">{{ $truckmake->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Truck Model -->
                                    <label class="col-sm-4 col-form-label">Truck Model</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_model">
                                        </div>
                                    </div>
                                    <!-- Truck Year -->
                                    <label class="col-sm-4 col-form-label">Truck Year</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_year" number="true" range="[1800, 2100]">
                                        </div>
                                    </div>
                                    <!-- Truck Condition(km/mi) -->
                                    <label class="col-sm-4 col-form-label">Truck Condition</label>
                                    <div class="col-sm-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_condition" number="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 truck_unit">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_condition_unit" data-style="select-with-transition">
                                                <option value="Km">Km</option>
                                                <option value="mile">mile</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 row">
                                    <!-- Truck Engine -->
                                    <label class="col-sm-4 col-form-label">Truck Engine</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_engine">
                                        </div>
                                    </div>
                                    <!-- Truck Trans -->
                                    <label class="col-sm-4 col-form-label">Truck Transmission</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_trans" data-style="select-with-transition">
                                                <option value="Manual">Manual</option>
                                                <option value="Automatic">Automatic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Truck Suspension -->
                                    <label class="col-sm-4 col-form-label">Truck Fuel Type</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="selectpicker" name="truck_suspension" data-style="select-with-transition">
                                                <option value="Diesel">Diesel</option>
                                                <option value="Gas">Gas</option>
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
                                            <input type="text" class="form-control disabled" name="title" id="title">
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <label class="col-md-4 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <textarea cols="30" rows="10"
                                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                name="description" id="input-description" type="text">
                                                {{ old('description') }}
                                            </textarea>
                                            @include('alerts.feedback', ['field' => 'description'])
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="text-align:center;">
                                    <h4 class="title"><strong>Primary Picture</strong></h4>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('material') }}/img/image_placeholder.jpg" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-file">
                                            <span class="fileinput-new">{{ __('Select image') }}</span>
                                            <span class="fileinput-exists">{{ __('Change') }}</span>
                                            <input type="file" name="photo" id = "input-picture" required="true" />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> {{ __('Remove') }}</a>
                                        </div>
                                        @include('alerts.feedback', ['field' => 'photo'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-rose">Add Deal</button>
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
        titleStr = yearStr.toString() + " " + makeStr.trim() + " " + modelStr.toString();
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
        titleStr = yearStr.toString() + " " + makeStr.trim() + " " + modelStr.toString();
        $("#title").val(titleStr);
    }

    function onChangeYear() {
        yearStr = $('#year').val();
        titleStr = yearStr.toString() + " " + makeStr.trim() + " " + modelStr.toString();
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
        setFormValidation('#creatDealForm');
        $('.truck-mounted-fields').css('display', 'none');
        
        var today = new Date();
        
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
            format: 'DD-MM-YYYY',
            minDate: today
        });
        $.ajax({
            type: "POST",
            url: "ajax_get_state_list",
            data: {
                country: 'United States',
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
    });

</script>
@endpush
