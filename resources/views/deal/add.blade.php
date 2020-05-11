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
                                <label class="col-md-1 col-sm-3 col-form-label">Deal Type</label>
                                <div class="col-md-4 col-sm-9">
                                    <div class="form-group">
                                        <select class="selectpicker" data-style="select-with-transition">
                                            <option value="0">Sale </option>
                                            <option value="1">Auction</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="col-md-2 col-sm-3 col-form-label">Equipment Category</label>
                                <div class="col-md-5 col-sm-9">
                                    <div class="form-group">
                                        <select class="selectpicker" data-style="select-with-transition">
                                            @foreach($data['equipment_category'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <div class="row">
                                        <label class="col-md-2 col-sm-3 col-form-label">Make</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition">
                                                    @foreach($data['makes'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">Model</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition">
                                                    @foreach($data['modelds'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">Year</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="year" require="true">
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">EndDate</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control datepicker" value="05/08/2020">
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">LOT</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lot" id="lot">
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">Auctioneer</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition">
                                                    <option value="0">Sale </option>
                                                    <option value="1">Auction</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">Country</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    require="true">
                                                    <option value="0">Sale </option>
                                                    <option value="1">Auction</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">State</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    require="true">
                                                    <option value="0">Sale </option>
                                                    <option value="1">Auction</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-sm-3 col-form-label">City</label>
                                        <div class="col-md-4 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" require="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 col-sm-2 col-form-label">URL</label>
                                        <div class="col-md-10 col-sm-10">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="url" url="true"
                                                    required="true" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <h4 class="title">Regular Image</h4>
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
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-rose float-right">Add Deal</button>
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
