@extends('layouts.app', ['activePage' => 'deal_add', 'menuParent' => 'deal', 'titlePage' => __('Add Deal')])

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
                <form id="TypeValidation" class="form-horizontal" action="" method="">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Deal Registration</h4>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- Title -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Title</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="title" require="true">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Deal Type -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Deal Type</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="selectpicker" name="deal_type" id="deal_type" onchange="onChangeDealType()" data-style="select-with-transition">
                                                    <option value="0">Sale </option>
                                                    <option value="1">Auction</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Equipment Type -->
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Equipment Type</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <select class="selectpicker" onchange="onChangeEquipmentType();" name="equipment_type" id="equipment_type" data-style="select-with-transition">
                                                    <option value="0"></option>
                                                    @foreach($data['equipment_category'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                            <textarea cols="30" rows="7"
                                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                name="description" id="input-description" type="text"
                                                placeholder="{{ __('Description') }}" required="true"
                                                aria-required="true">{{ old('description') }}</textarea>
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
                                                <input type="text" class="form-control" name="year" require="true">
                                            </div>
                                        </div>
                                        <!-- Make -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Make</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition">
                                                    @foreach($data['makes'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Model -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Model</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition">
                                                    @foreach($data['modelds'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- City -->
                                        <label class="col-md-1 col-sm-3 col-form-label">City</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" require="true">
                                            </div>
                                        </div>
                                        <!-- State -->
                                        <label class="col-md-1 col-sm-3 col-form-label">State</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="state" require="true">
                                            </div>
                                        </div>
                                        <!-- Country -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Country</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition">
                                                    <option value="United States">United States</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Mexico">Mexico</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- AuctionEndDate  -->
                                        <label class="col-md-1 col-sm-3 col-form-label auction-field">EndDate</label>
                                        <div class="col-md-3 col-sm-9 auction-field">
                                            <div class="form-group">
                                                <input type="text" class="form-control datepicker" value="05/08/2020">
                                            </div>
                                        </div>
                                        <!-- LOT -->
                                        <label class="col-md-1 col-sm-3 col-form-label auction-field">LOT</label>
                                        <div class="col-md-3 col-sm-9 auction-field">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lot" id="lot">
                                            </div>
                                        </div>
                                        <!-- Auctioneer -->
                                        <label class="col-md-1 col-sm-3 col-form-label auction-field">Auctioneer</label>
                                        <div class="col-md-3 col-sm-9 auction-field">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="auctioneer" id="auctioneer">
                                            </div>
                                        </div>
                                        <!-- Price -->
                                        <label class="col-md-1 col-sm-3 col-form-label">Price</label>
                                        <div class="col-md-3 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="price" id="price">
                                            </div>
                                        </div>
                                        <!-- Url -->
                                        <label class="col-md-1 col-sm-3 col-form-label">URL</label>
                                        <div class="col-md-7 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="url" id="url">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12"></div>
                                        <!-- Truck Mounted -->
                                        <label class="col-md-2 col-sm-3 col-form-label" style="display:inline;">Truck Mounted?</label>
                                        <div class="col-md-2 col-sm-9" style="display:inline;">
                                            <div class="form-group">
                                                <div class="col-sm-10 checkbox-radios">
                                                    <div class="togglebutton">
                                                        <label>
                                                            <input type="checkbox" name="truck_mounted" id="truck_mounted" onchange="onChangeTruckMounted();" value="1" unchecked {{ old('truck_mounted') == 1 ? ' checked' : '' }}>
                                                            <span class="toggle"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12" style="text-align:center;">
                                    <h4 class="title">Primary Picture</h4>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('material') }}/img/image_placeholder.jpg" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="..." />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="truck-mounted-title">Truck Mounted Data</h4>
                            <div class="truck-mounted-fields">
                                <div class="row">
                                    <!-- Truck Year -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Year</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_year" require="true">
                                        </div>
                                    </div>
                                    <!-- Truck Make -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Make</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_make" require="true">
                                        </div>
                                    </div>
                                    <!-- Truck Model -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Model</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_model" require="true">
                                        </div>
                                    </div>
                                    <!-- Truck Engine -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Engine</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_engine" require="true">
                                        </div>
                                    </div>
                                    <!-- Truck Trans -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Trans</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_trans" require="true">
                                        </div>
                                    </div>
                                    <!-- Truck Suspension -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Suspension</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_suspension" require="true">
                                        </div>
                                    </div>
                                    <!-- Truck Condition(km/mi) -->
                                    <label class="col-md-1 col-sm-3 col-form-label">Truck Condition(Km/mile)</label>
                                    <div class="col-md-2 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="truck_condition" require="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4>Specific Properties</h4>
                            <div class="row" id="specific_field">
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
    .truck-mounted-fields {
        display: none;
    }
</style>
@endsection

@push('js')
<script>
    function onChangeEquipmentType() {
        var eType = $('#equipment_type').val();
        
        $.ajax({
            type: 'POST',
            url: 'ajax_get_specific_properties',
            data: {
                equipment_category_id: eType,
                _token: '<?php echo csrf_token() ?>'
            },
            success: function(data) {
                $('#specific_field').html(data);
            }
        });
    }

    function onChangeDealType() {
        var deal_type = $('#deal_type').val();
        
        if (deal_type == 0) {
            $('.auction-field').fadeOut();
        } else {
            $('.auction-field').fadeIn();
        }
    }

    function onChangeTruckMounted() {
        var show_flag = $('#truck_mounted').is(':checked');
        if (show_flag === true) {
            $('.truck-mounted-title').fadeIn();
            $('.truck-mounted-fields').fadeIn();
        } else {
            $('.truck-mounted-title').fadeOut();
            $('.truck-mounted-fields').fadeOut();
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
        setFormValidation('#RegisterValidation');
        setFormValidation('#TypeValidation');
        setFormValidation('#LoginValidation');
        setFormValidation('#RangeValidation');
        md.initFormExtendedDatetimepickers();
    });

</script>
@endpush
