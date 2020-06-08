@extends('layouts.app', [
  'class' => 'off-canvas-sidebar',
  'classPage' => 'login-page',
  'activePage' => 'deal_list',
  'title' => __('HMA Project Dashboard'),
  'pageBackground' => asset("material").'/img/login.jpg'
])

@section('content')
<style>
  .filter_area div a .collapse-header {
    background: #333333;
  }
</style>
<div class="container" style="height:auto;margin-top:-30px;">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card" style="margin:0;">
        <div class="card-header card-header-rose card-header-icon" style="">
          
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3 col-sm-12">
              <div class="card">
                <div class="card-header form-group">
                  <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search..." id="search_key">
                  </div>
                  <div id="filter_list">
                    <div class="filter_item" data-type="checkbox" data-id="deal_sales">sales<i class="material-icons" style="font-size:16px;">close</i></div>
                    <div class="filter_item" data-type="checkbox" data-id="deal_auctions">auctions<i class="material-icons" style="font-size:16px;">close</i></div>
                    @foreach ($types_modal as $type)
                    <div class="filter_item" data-type="checkbox_type" data-id="typecheck_{{ $type->id }}" style="display:none;">{{ $type->name }} <i class="material-icons" style="font-size:16px;">close</i></div>
                    @endforeach
                    @foreach ($categories as $category)
                    <div class="filter_item" data-type="checkbox_category" data-id="categorycheck_{{ $category->id }}" style="display:none;">{{ $category->name }} <i class="material-icons" style="font-size:16px;">close</i></div>
                    @endforeach
                    @foreach ($makes as $make)
                    <div class="filter_item" data-type="checkbox_make" data-id="makecheck_{{ $make->id }}" style="display:none;">{{ $make->name }} <i class="material-icons" style="font-size:16px;">close</i></div>
                    @endforeach
                    @foreach ($modelds as $modeld)
                    <div class="filter_item" data-type="checkbox_modeld" data-id="modeldcheck_{{ $modeld->id }}" style="display:none;">{{ $modeld->name }} <i class="material-icons" style="font-size:16px;">close</i></div>
                    @endforeach
                  </div>
                </div>
                <div class="card-body filter_area">
                  <!-- Deal Type -->
                  <div class="filter_dealtype">
                    <a href="#deal_type" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="deal_type">
                      <div class="collapse-header">
                        Deal Type
                      </div>
                    </a>
                    <div class="collapse show" id="deal_type">
                      <div class="collapse-body">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked="true" id="deal_sales" onchange="sendAjaxRequestbySale();"> For Sales
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked="true" id="deal_auctions" onchange="sendAjaxRequestbyAuction();"> For Auction
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Equipment Type Filter -->
                  <div class="filter_eqtype">
                    <a href="#eq_type" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_type">
                      <div class="collapse-header">
                        Equipment Type
                      </div>
                    </a>
                    <div class="collapse" id="eq_type">
                      <div class="collapse-body">
                        @foreach ($types_first as $type)
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input type-filter-check" type="checkbox" unchecked id="typecheck_{{ $type->id }}" value="{{ $type->id }}" data-text="{{ $type->name }}{{ $type->unit ? '('.$type->unit.')' : '' }}" onchange="sendAjaxRequestByType();"> {{ $type->name }}{{ $type->unit ? '('.$type->unit.')' : '' }}
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        @endforeach
                        @if ($types_modal != 'no_more')
                          <div class="text-center">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#typeModal"><i class="material-icons">add</i> Show All</button>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <!-- Equipment Category Filter -->
                  <div class="filter_eqcategory">
                    <a href="#eq_category" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_category">
                      <div class="collapse-header">
                        Equipment Category
                      </div>
                    </a>
                    <div class="collapse" id="eq_category">
                      <div class="collapse-body">
                      </div>
                    </div>
                  </div>
                  <!-- Make Filter -->
                  <div class="filter_eqmake">
                    <a href="#eq_make" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_make">
                      <div class="collapse-header">
                        Make
                      </div>
                    </a>
                    <div class="collapse" id="eq_make">
                      <div class="collapse-body">
                        
                      </div>
                    </div>
                  </div>
                  <!-- Model Filter -->
                  <div class="filter_eqmodeld">
                    <a href="#eq_modeld" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_modeld">
                      <div class="collapse-header">
                        Model
                      </div>
                    </a>
                    <div class="collapse" id="eq_modeld">
                      <div class="collapse-body">
                        
                      </div>
                    </div>
                  </div>
                  <!-- Year Filter -->
                  <div class="filter_eqyear">
                    <a href="#eq_year" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_year">
                      <div class="collapse-header">
                        Year
                      </div>
                    </a>
                    <div class="collapse" id="eq_year">
                      <div class="collapse-body">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="from_year" id="from_year" value="1900">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="end_year" id="end_year" value="{{ date('Y') }}">
                            </div>
                          </div>
                        </div>
                        <div id="sliderYear" class="slider slider-primary" onchange="onChangeEqYear();"></div>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-primary" onclick="sendAjaxRequestByEqYear();">
                            Search
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Address Filter -->
                  <div class="filter_eqlocation">
                    <a href="#eq_address" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_address">
                      <div class="collapse-header">
                        Location
                      </div>
                    </a>
                    <div class="collapse" id="eq_address">
                      <!-- Country -->
                      <div class="collapse-body">
                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="countries[]" id="select_country" onchange="sendAjaxRequestByCountry();"
                          data-style="select-with-transition" multiple title="Choose Country" data-size="7">
                          <option value="United States">United States</option>
                          <option value="Canada">Canada</option>
                          <option value="Mexico">Mexico</option>
                        </select>
                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="makes[]" id="select_state"
                          data-style="select-with-transition" multiple title="Choose State" data-size="7">                          
                        </select>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-primary" onclick="sendAjaxRequestByEqLocation();">
                            Search
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Buyer's Premium Filter -->
                  <div class="filter_buypremium">
                    <a href="#eq_premium" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_premium">
                      <div class="collapse-header">
                        Buyer's Premium
                      </div>
                    </a>
                    <div class="collapse" id="eq_premium">
                      <div class="collapse-body">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="from_premium" id="from_premium" value="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="end_premium" id="end_premium" value="100">
                            </div>
                          </div>
                        </div>
                        <div id="sliderPremium" class="slider slider-primary"></div>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-primary" onclick="sendAjaxRequestByPremium();">
                            Search
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Price Filter -->
                  <div class="filter_eqprice">
                    <a href="#eq_price" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_price">
                      <div class="collapse-header">
                        Price
                      </div>
                    </a>
                    <div class="collapse" id="eq_price">
                      <div class="collapse-body">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="start_price" id="eq_price_start" value="0">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="end_price" id="eq_price_end" value="100000">
                            </div>
                          </div>
                        </div>
                        <div id="sliderPrice" class="slider slider-primary slider-price"></div>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-primary" onclick="sendAjaxRequestByPrice();">
                            Search
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Auction Date Filter -->
                  <div class="filter_aucdate">
                    <a href="#eq_enddate" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_enddate">
                      <div class="collapse-header">
                        Auction End Date
                      </div>
                    </a>
                    <div class="collapse" id="eq_enddate">
                      <div class="collapse-body" style="border-bottom:1px solid lightgray;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
                        <input type="text"  name="auc_fromdate" id="auc_fromdate"
                          placeholder="{{ __('Select date from') }}" class="form-control datetimepicker" value="{{ old('auc_fromdate', now()->format('d-m-Y')) }}"/>
                        <input type="text"  name="auc_enddate" id="auc_enddate"
                          placeholder="{{ __('Select date until') }}" class="form-control datetimepicker" value="{{ old('auc_enddate', now()->format('d-m-Y')) }}"/>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-primary" onclick="sendAjaxRequestByAucDate();">
                            Search
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Truck Data -->
                  <div class="filter_truckmounted" style="display:none;">
                    <a href="#eq_truck" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_truck">
                      <div class="collapse-header">
                        Truck Data
                      </div>
                    </a>
                    <div class="collapse" id="eq_truck">
                      <div class="collapse-body">
                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="truckmakes[]" id="eq_truck_make"
                          data-style="select-with-transition" multiple title="Choose Truck Make" data-size="7">
                          @foreach ($truckmakes as $truckmake)
                            <option value="{{ $truckmake->id }}" {{ in_array($truckmake->id, old('truckmake') ?? []) ? 'selected' : '' }}>{{ $truckmake->name }}</option>
                          @endforeach
                        </select>
                        <input type="text" class="form-control" placeholder="Truck Model" id="eq_truck_model">
                        <input type="text" class="form-control" placeholder="Truck Year" id="eq_truck_year">
                        <input type="text" class="form-control" placeholder="Truck Engine" id="eq_truck_engine">
                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="eq_truck_trans[]" id="eq_truck_trans"
                          data-style="select-with-transition" multiple title="Choose Truck Transimission" data-size="7">
                            <option value=""></option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                        <select class="selectpicker col-sm-12 pl-0 pr-0" name="eq_truck_fuel[]" id="eq_truck_fuel"
                          data-style="select-with-transition" multiple title="Choose Truck Fuel Type" data-size="7">
                            <option value=""></option>
                            <option value="Diesel">Diesel</option>
                            <option value="Gas">Gas</option>
                        </select>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-primary" onclick="sendAjaxRequestByTruckData();">
                            Search
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Specific Data -->
                  <div class="filter_specific" style="display:none;">
                    <a href="#eq_specific" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="eq_specific">
                      <div class="collapse-header">
                        Specific Data
                      </div>
                    </a>
                    <div class="collapse" id="eq_specific">
                      <div class="collapse-body" style="border-bottom:1px solid lightgray;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9 col-sm-12" id="listArea" style="padding-top:20px;">
              <div class="row">
                @foreach ($deals as $deal)
                  <div class="col-md-4 col-sm-12">
                    <div class="card card-product">
                      <div class="card-header card-header-image product-image-header" style="background:url('{{ $deal->path() }}') no-repeat center center;" data-header-animation="false">
                        
                      </div>
                      <div class="card-body">
                        <!-- <div class="card-header-image product-image-header" style="background:url('{{ $deal->path() }}') no-repeat center center;">
                      </div> -->
                        <h4 class="card-title flex-horizental">
                          <a href="#pablo" style="float:left;"><strong>{{ $deal->title }}</strong></a>
                          <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#dealModal{{ $deal->id }}" style="float:right;">Details</button>
                        </h4>
                        <!-- <div class="card-description">
                          
                        </div> -->
                      </div>
                      <div class="card-footer">
                        <div class="price">
                          @if ($deal->deal_type == 0)
                            <h4 class="text-success flex-horizental"><i class="material-icons">monetization_on</i>  <strong> {{ $deal->price.$deal->price_currency }}</strong></h4>
                          @else
                            <h4 class="flex-horizental" style="color:#007bff;"><i class="material-icons">gavel</i>  <strong> {{ $deal->auc_enddate }}</strong></h4>
                          @endif
                        </div>
                        <div class="stats">
                          <p class="card-category"><i class="material-icons">place</i> <span style="font-size:11px;">{{ $deal->city ? $deal->city.', ' : '' }}{{ $deal->state ? $deal->state.', ' : '' }}{{ $deal->country ? $deal->country.', ' : '' }}</span> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                @endforeach
              </div>
              <div class="text-center">
                {{ $deals->links() }}
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<div id="filter_modalArea">
  @if ($types_modal != 'no_more')
    <div class="modal fade filter-modal" id="typeModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">Choose Equipment Type</div>
          <div class="modal-body">
            <div class="row" style="padding:20px;">
            @foreach ($types_modal as $type)
              <div class="form-check col-md-3 col-sm-12">
                <label class="form-check-label">
                  <input class="form-check-input type-filter-check" type="checkbox" unchecked id="typecheck_{{ $type->id }}" value="{{ $type->id }}"> {{ $type->name }}{{ $type->unit ? '('.$type->unit.')' : '' }}
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            @endforeach
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-round" onclick="sendAjaxRequestByType();" data-dismiss="modal">Search</button>
            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal" style="margin-left:10px;">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endif
  <!-- Modal for Categories -->
  <div class="modal fade filter-modal" id="categoryModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">Choose Equipment Category</div>
        <div class="modal-body">
          <div class="row" style="padding:20px;">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-round" onclick="ajaxSendRequestByCategory();" data-dismiss="modal">Search</button>
          <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal" style="margin-left:10px;">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal for Make -->
  <div class="modal fade filter-modal" id="makeModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">Choose Makes</div>
        <div class="modal-body">
          <div class="row" style="padding:20px;">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-round" onclick="ajaxSendRequestByMake();" data-dismiss="modal">Search</button>
          <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal" style="margin-left:10px;">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modalArea">
  @foreach ($deals as $deal)
  
    <!-- Classic Modal -->
    <div class="modal fade" id="dealModal{{ $deal->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div style="margin-bottom:10px;">
                  <img style="width:100%;" src="{{ $deal->path() }}" alt="{{ $deal->title }}">
                </div>
                <div style="min-height:80px;"></div>
              </div>
              <div class="col-md-12 col-sm-12">
                @if ($deal->deal_type == 0)
                  <span class="badge badge-pill badge-success">Sales</span>
                @else
                  <span class="badge badge-pill badge-info">Auction</span>
                @endif
                <div style="margin-top:10px;">
                  <div class="info_item">
                    <h4 style="color:#333333;">{{ $deal->title }}</h4>
                    <h6 style="color:#333333;margin-bottom:0;">{{ $deal->type->name }} / {{ $deal->category->name }}</h6>
                  </div>
                  <div class="info_item">
                    @if ($deal->deal_type == 0)
                      <h5 class="text-success" style="display:flex;margin-bottom:0;"><i class="material-icons">monetization_on</i> &nbsp;&nbsp;{{ $deal->price }}{{ $deal->price ? $deal->price_currency : '' }}</h5>
                    @else
                      <h5 class="text-warning" style="display:flex;margin-bottom:0;"><i class="material-icons">calendar_today</i> &nbsp;&nbsp;{{ $deal->auc_enddate }}</h5>
                    @endif
                    <p style="color:#333333;display:flex;margin:0;"><i class="material-icons">place</i>&nbsp;{{ $deal->city ? $deal->city.', ' : '' }}{{ $deal->state ? $deal->state.', ' : '' }}{{ $deal->country ? $deal->country.', ' : '' }}</p>
                  </div>            
                  <div class="info_item" style="border:none;">
                    <button class="btn btn-secondary" onclick="location.href='{{ $deal->url }}';"><i class="material-icons">laptop_mac</i>  Vendor's Website</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="card">
                <div class="card-header card-header-tabs card-header-rose">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#general{{ $deal->id }}" data-toggle="tab" style="color:#333333 !important;">
                            <i class="material-icons">list</i> Equipment Info
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        @if ($deal->category->truck_mounted)
                        <li class="nav-item">
                          <a class="nav-link" href="#truck{{ $deal->id }}" data-toggle="tab" style="color:#333333 !important;">
                            <i class="material-icons">local_shipping</i> Truck Info
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        @endif
                        <li class="nav-item">
                          <a class="nav-link" href="#specific{{ $deal->id }}" data-toggle="tab" style="color:#333333 !important;">
                            <i class="material-icons">feedback</i> Specific Info
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#advice{{ $deal->id }}" data-toggle="tab" style="color:#333333 !important;">
                            <i class="material-icons">contact_mail</i> Buying Help
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="general{{ $deal->id }}">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            @if ($deal->year)
                            <tr>
                              <td>Year</td>
                              <td>{{ $deal->year }}</td>
                            </tr>
                            @endif
                            @if ($deal->make)
                            <tr>
                              <td>Make</td>
                              <td>{{ $deal->make->name }}</td>
                            </tr>
                            @endif
                            @if ($deal->modeld)
                            <tr>
                              <td>Model</td>
                              <td>{{ $deal->modeld->name }}</td>
                            </tr>
                            @endif
                            @if ($deal->sn)
                            <tr>
                              <td>Serial Number</td>
                              <td>{{ $deal->sn }}</td>
                            </tr>
                            @endif
                            @if ($deal->description)
                            <tr>
                              <td>Description</td>
                              <td>{{ $deal->description }}</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="truck{{ $deal->id }}">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            @if ($deal->truck_year)
                            <tr>
                              <td>Truck Year</td>
                              <td>{{ $deal->truck_year }}</td>
                            </tr>
                            @endif
                            @if ($deal->truckmake_id)
                            <tr>
                              <td>Truck Make</td>
                              <td>{{ $deal->truckmake_id ? $deal->truckmake->name : '' }}</td>
                            </tr>
                            @endif
                            @if ($deal->truck_model)
                            <tr>
                              <td>Truck Model</td>
                              <td>{{ $deal->truck_model }}</td>
                            </tr>
                            @endif
                            @if ($deal->truck_condition)
                            <tr>
                              <td>Condition</td>
                              <td>{{ $deal->truck_condition . $deal->truck_condtion_unit }}</td>
                            </tr>
                            @endif
                            @if ($deal->truck_engine)
                            <tr>
                              <td>Engine</td>
                              <td>{{ $deal->truck_engine }}</td>
                            </tr>
                            @endif
                            @if ($deal->truck_trans)
                            <tr>
                              <td>Transmission</td>
                              <td>{{ $deal->truck_trans }}</td>
                            </tr>
                            @endif
                            @if ($deal->truck_suspension)
                            <tr>
                              <td>Fuel Type</td>
                              <td>{{ $deal->truck_suspension }}</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="specific{{ $deal->id }}">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
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
                                @if($show_flag)
                                <tr>
                                  <td>{{ $specific->name }}</td>
                                  <td>{{ $show_flag }}{{ $show_flag ? $valueUnit : ''}}</td>
                                </tr>
                                @endif
                              @else
                                @if ($show_flag)
                                <tr>
                                  <td>{{ $specific->name }}</td>
                                  <td>{{ $show_flag }}</td>
                                </tr>
                                @endif
                              @endif
                            @else
                              @php
                              $optionAry = explode('/', $specific->value);
                              @endphp
                              @if ($show_flag)
                              <tr>
                                <td>{{ $specific->name }}</td>
                                <td>{{ $show_flag }}</td>
                              </tr>
                              @endif
                            @endif
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="advice{{ $deal->id }}">
                      <form action="" method="post">
                        @csrf
                        @method('post')
                      <div class="row">
                        <div class="col-md-5 col-sm-12">
                          <div class="row">
                            <label class="col-sm-4 col-form-label">First Name</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                                </div>
                            </div>
                            <label class="col-sm-4 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lastname" id="lastname" required>
                                </div>
                            </div>
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" id="phone" required>
                                </div>
                            </div>
                            <label class="col-sm-4 col-form-label">Country</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <select class="selectpicker" name="country" id="country" data-style="select-with-transition">
                                    <option value="United States">United States</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Mexico">Mexico</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <div class="form-group">
                            <textarea cols="30" rows="13"
                                class="rounded" style="padding:10px;"
                                name="message" placeholder="Message"></textarea>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                      </div>
                      <hr style="width:100%;">
                      <div>
                        <button type="submit" class="btn btn-lg btn-primary" style="float:right;">Send</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
<style>
  #filter_modalArea .modal .modal-dialog .modal-content .modal-header {
    color: #333333;
  }
  #filter_list {
    margin-top: 10px;
  }
  .filter_item {
    display: flex;
    background: #999999;
    border-radius: 8px;
    color: white;
    align-items: center;
    justify-content: space-between;
    float:left;
    padding: 3px 7px;
    cursor: pointer;
    text-transform: uppercase;
    margin-right: 5px;
    margin-bottom: 5px;
  }
  .filter_item:hover {
    font-weight: bolder;
  }
  .info_item {
    padding: 5px 10px;
    border-right: 1px solid #333333;
    float:left;
    min-height: 65px;
  }
  .flex-horizental {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  td {
    padding: 5px 8px !important;
  }
  .modal.show {
    /* position: absolute !important; */
  }
  .product-image-header {
    max-height: 250px !important;
    min-height: 250px !important;
    background-repeat: no-repeat;
    -webkit-background-size: cover !important;
    -moz-background-size: cover !important;
    -o-background-size: cover !important;
    background-size: cover !important;
    box-shadow: 0 5px 15px -8px rgba(0, 0, 0, 0.24), 0 8px 10px -5px rgba(0, 0, 0, 0.2) !important;
  }
  .collapse-header {
    width: 100%;
    border-bottom: 1px solid lightgray;
    padding: 3px 8px;
    background: #e91e63;
    color: white;
  }
  .collapse-body {
    width: 100%;
    padding: 8px 12px;
    border-right: 1px solid lightgray;
    border-left: 1px solid lightgray;
  }
  .collapse-body div.dropdown.bootstrap-select {
    width: 100% !important;
  }
  .loader,
  .loader:after {
    border-radius: 50%;
    width: 10em;
    height: 10em;
  }
  .loader {
    margin: auto;
    font-size: 10px;
    position: relative;
    text-indent: -9999em;
    border-top: 1.1em solid rgba(0, 0, 0, 0.2);
    border-right: 1.1em solid rgba(0, 0, 0, 0.2);
    border-bottom: 1.1em solid rgba(0, 0, 0, 0.2);
    border-left: 1.1em solid #333333;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load8 1.1s infinite linear;
    animation: load8 1.1s infinite linear;
  }
  @-webkit-keyframes load8 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @keyframes load8 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
</style>
@endsection

@push('js')
  <script>
    (function (factory) {

      if ( typeof define === 'function' && define.amd ) {

          // AMD. Register as an anonymous module.
          define([], factory);

      } else if ( typeof exports === 'object' ) {

          // Node/CommonJS
          module.exports = factory();

      } else {

          // Browser globals
          window.wNumb = factory();
      }

      }(function(){

      'use strict';

      var FormatOptions = [
      'decimals',
      'thousand',
      'mark',
      'prefix',
      'suffix',
      'encoder',
      'decoder',
      'negativeBefore',
      'negative',
      'edit',
      'undo'
      ];

      // General

      // Reverse a string
      function strReverse ( a ) {
      return a.split('').reverse().join('');
      }

      // Check if a string starts with a specified prefix.
      function strStartsWith ( input, match ) {
      return input.substring(0, match.length) === match;
      }

      // Check is a string ends in a specified suffix.
      function strEndsWith ( input, match ) {
      return input.slice(-1 * match.length) === match;
      }

      // Throw an error if formatting options are incompatible.
      function throwEqualError( F, a, b ) {
      if ( (F[a] || F[b]) && (F[a] === F[b]) ) {
        throw new Error(a);
      }
      }

      // Check if a number is finite and not NaN
      function isValidNumber ( input ) {
      return typeof input === 'number' && isFinite( input );
      }

      // Provide rounding-accurate toFixed method.
      // Borrowed: http://stackoverflow.com/a/21323330/775265
      function toFixed ( value, exp ) {
      value = value.toString().split('e');
      value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));
      value = value.toString().split('e');
      return (+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp))).toFixed(exp);
      }


      // Formatting

      // Accept a number as input, output formatted string.
      function formatTo ( decimals, thousand, mark, prefix, suffix, encoder, decoder, negativeBefore, negative, edit, undo, input ) {

      var originalInput = input, inputIsNegative, inputPieces, inputBase, inputDecimals = '', output = '';

      // Apply user encoder to the input.
      // Expected outcome: number.
      if ( encoder ) {
        input = encoder(input);
      }

      // Stop if no valid number was provided, the number is infinite or NaN.
      if ( !isValidNumber(input) ) {
        return false;
      }

      // Rounding away decimals might cause a value of -0
      // when using very small ranges. Remove those cases.
      if ( decimals !== false && parseFloat(input.toFixed(decimals)) === 0 ) {
        input = 0;
      }

      // Formatting is done on absolute numbers,
      // decorated by an optional negative symbol.
      if ( input < 0 ) {
        inputIsNegative = true;
        input = Math.abs(input);
      }

      // Reduce the number of decimals to the specified option.
      if ( decimals !== false ) {
        input = toFixed( input, decimals );
      }

      // Transform the number into a string, so it can be split.
      input = input.toString();

      // Break the number on the decimal separator.
      if ( input.indexOf('.') !== -1 ) {
        inputPieces = input.split('.');

        inputBase = inputPieces[0];

        if ( mark ) {
          inputDecimals = mark + inputPieces[1];
        }

      } else {

      // If it isn't split, the entire number will do.
        inputBase = input;
      }

      // Group numbers in sets of three.
      if ( thousand ) {
        inputBase = strReverse(inputBase).match(/.{1,3}/g);
        inputBase = strReverse(inputBase.join( strReverse( thousand ) ));
      }

      // If the number is negative, prefix with negation symbol.
      if ( inputIsNegative && negativeBefore ) {
        output += negativeBefore;
      }

      // Prefix the number
      if ( prefix ) {
        output += prefix;
      }

      // Normal negative option comes after the prefix. Defaults to '-'.
      if ( inputIsNegative && negative ) {
        output += negative;
      }

      // Append the actual number.
      output += inputBase;
      output += inputDecimals;

      // Apply the suffix.
      if ( suffix ) {
        output += suffix;
      }

      // Run the output through a user-specified post-formatter.
      if ( edit ) {
        output = edit ( output, originalInput );
      }

      // All done.
      return output;
      }

      // Accept a sting as input, output decoded number.
      function formatFrom ( decimals, thousand, mark, prefix, suffix, encoder, decoder, negativeBefore, negative, edit, undo, input ) {

      var originalInput = input, inputIsNegative, output = '';

      // User defined pre-decoder. Result must be a non empty string.
      if ( undo ) {
        input = undo(input);
      }

      // Test the input. Can't be empty.
      if ( !input || typeof input !== 'string' ) {
        return false;
      }

      // If the string starts with the negativeBefore value: remove it.
      // Remember is was there, the number is negative.
      if ( negativeBefore && strStartsWith(input, negativeBefore) ) {
        input = input.replace(negativeBefore, '');
        inputIsNegative = true;
      }

      // Repeat the same procedure for the prefix.
      if ( prefix && strStartsWith(input, prefix) ) {
        input = input.replace(prefix, '');
      }

      // And again for negative.
      if ( negative && strStartsWith(input, negative) ) {
        input = input.replace(negative, '');
        inputIsNegative = true;
      }

      // Remove the suffix.
      // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/slice
      if ( suffix && strEndsWith(input, suffix) ) {
        input = input.slice(0, -1 * suffix.length);
      }

      // Remove the thousand grouping.
      if ( thousand ) {
        input = input.split(thousand).join('');
      }

      // Set the decimal separator back to period.
      if ( mark ) {
        input = input.replace(mark, '.');
      }

      // Prepend the negative symbol.
      if ( inputIsNegative ) {
        output += '-';
      }

      // Add the number
      output += input;

      // Trim all non-numeric characters (allow '.' and '-');
      output = output.replace(/[^0-9\.\-.]/g, '');

      // The value contains no parse-able number.
      if ( output === '' ) {
        return false;
      }

      // Covert to number.
      output = Number(output);

      // Run the user-specified post-decoder.
      if ( decoder ) {
        output = decoder(output);
      }

      // Check is the output is valid, otherwise: return false.
      if ( !isValidNumber(output) ) {
        return false;
      }

      return output;
      }


      // Framework

      // Validate formatting options
      function validate ( inputOptions ) {

      var i, optionName, optionValue,
        filteredOptions = {};

      if ( inputOptions['suffix'] === undefined ) {
        inputOptions['suffix'] = inputOptions['postfix'];
      }

      for ( i = 0; i < FormatOptions.length; i+=1 ) {

        optionName = FormatOptions[i];
        optionValue = inputOptions[optionName];

        if ( optionValue === undefined ) {

          // Only default if negativeBefore isn't set.
          if ( optionName === 'negative' && !filteredOptions.negativeBefore ) {
            filteredOptions[optionName] = '-';
          // Don't set a default for mark when 'thousand' is set.
          } else if ( optionName === 'mark' && filteredOptions.thousand !== '.' ) {
            filteredOptions[optionName] = '.';
          } else {
            filteredOptions[optionName] = false;
          }

        // Floating points in JS are stable up to 7 decimals.
        } else if ( optionName === 'decimals' ) {
          if ( optionValue >= 0 && optionValue < 8 ) {
            filteredOptions[optionName] = optionValue;
          } else {
            throw new Error(optionName);
          }

        // These options, when provided, must be functions.
        } else if ( optionName === 'encoder' || optionName === 'decoder' || optionName === 'edit' || optionName === 'undo' ) {
          if ( typeof optionValue === 'function' ) {
            filteredOptions[optionName] = optionValue;
          } else {
            throw new Error(optionName);
          }

        // Other options are strings.
        } else {

          if ( typeof optionValue === 'string' ) {
            filteredOptions[optionName] = optionValue;
          } else {
            throw new Error(optionName);
          }
        }
      }

      // Some values can't be extracted from a
      // string if certain combinations are present.
      throwEqualError(filteredOptions, 'mark', 'thousand');
      throwEqualError(filteredOptions, 'prefix', 'negative');
      throwEqualError(filteredOptions, 'prefix', 'negativeBefore');

      return filteredOptions;
      }

      // Pass all options as function arguments
      function passAll ( options, method, input ) {
      var i, args = [];

      // Add all options in order of FormatOptions
      for ( i = 0; i < FormatOptions.length; i+=1 ) {
        args.push(options[FormatOptions[i]]);
      }

      // Append the input, then call the method, presenting all
      // options as arguments.
      args.push(input);
      return method.apply('', args);
      }

      function wNumb ( options ) {

        if ( !(this instanceof wNumb) ) {
          return new wNumb ( options );
        }

        if ( typeof options !== "object" ) {
          return;
        }

        options = validate(options);

        // Call 'formatTo' with proper arguments.
        this.to = function ( input ) {
          return passAll(options, formatTo, input);
        };

        // Call 'formatFrom' with proper arguments.
        this.from = function ( input ) {
          return passAll(options, formatFrom, input);
        };
      }

      return wNumb;

    }));
    
    
    function isEmpty(obj) {
      for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
      }
      return true;
    }

    $('.filter_item').click(function() {
      console.log($(this).attr('data-id'));
      switch ($(this).attr('data-type')) {
        case 'checkbox':
          $(this).fadeOut();    
          $('#'+$(this).attr('data-id')).prop('checked', false);
          if ($(this).attr('data-id') == 'deal_sales') {
            sendAjaxRequestbySale();
          } else if ($(this).attr('data-id') == 'deal_auctions') {
            sendAjaxRequestbyAuction();
          }
          break;
        case 'checkbox_type':
          $('#'+$(this).attr('data-id')).prop('checked', false);
          sendAjaxRequestByType();
          $(this).remove();
          break;
        case 'checkbox_category':
          $('#'+$(this).attr('data-id')).prop('checked', false);
          ajaxSendRequestByCategory();
          $(this).remove();
          break;
        case 'checkbox_make':
          $('#'+$(this).attr('data-id')).prop('checked', false);
          sendAjaxRequestByMake();
          $(this).remove();
          break;
        case 'checkbox_modeld':
          $('#'+$(this).attr('data-id')).prop('checked', false);
          sendAjaxRequestByModel();
          $(this).remove();
          break;
        default:
          break;
      }
    });

    var search_key = '';
    var deal_type = 0;
    var eq_type = new Array();
    var eq_category = new Array();
    var eq_make = new Array();
    var eq_model = new Array();
    var from_year = '';
    var end_year = '';
    var country = new Array();
    var state = new Array();
    var start_premium = '';
    var end_premium = '';
    var start_price = '';
    var end_price = '';
    var auc_from_date = '';
    var auc_end_date = '';
    var truck_make = new Array();
    var truck_model = '';
    var truck_year = '';
    var truck_engine = '';
    var truck_trans = new Array();
    var truck_fuel = new Array();
    var page = 0;

    var specific_fields = new Array();

    $("#search_key").change(function() {
      search_key = $(this).val();
      sendAjaxRequest();
    });

    function sendAjaxRequest() {
      $("#listArea").empty();
      var loadingSpinner = "<div class='loader'>Loading...</div>";
      $("#listArea").append(loadingSpinner);

      $.ajax({
        type: "POST",
        url: "ajax_get_deals_with_filter",
        data: {
          search_key: search_key,
          deal_type: deal_type,
          eq_type: eq_type,
          eq_category: eq_category,
          eq_make: eq_make,
          eq_model: eq_model,
          from_year: from_year,
          end_year: end_year,
          country: country,
          state: state,
          start_premium: start_premium,
          end_premium: end_premium,
          start_price: start_price,
          end_price: end_price,
          auc_from_date: auc_from_date,
          auc_end_date: auc_end_date,
          truck_make: truck_make,
          truck_model: truck_model,
          truck_year: truck_year,
          truck_engine: truck_engine,
          truck_trans: truck_trans,
          truck_fuel: truck_fuel,
          page: page,
          _token: '<?php echo csrf_token();?>'
        },
        success: function(res) {
          var data = res.data.data;
          var pagination = res.pagination;
          if (res.data == 'fail') {
            var noHtml = "<h4 style='margin:auto;'>";
            noHtml += "There is no result which you are searching...";
            noHtml += "</h4>";
            $('#listArea').html(noHtml);
          } else {
            var listHtml = "";
            var modalHtml = "";
            for (var i in data) {
              listHtml += "<div class='col-md-4 col-sm-12'><div class='card card-product'>";
              listHtml += `<div class='card-header card-header-image product-image-header' style='background:url("/storage/${data[i].picture}") no-repeat center center;' data-header-animation='false'>`;
              listHtml += "</div>";
              listHtml += "<div class='card-body'>";
              listHtml += "<div class='card-actions text-center'>";
              listHtml += "<button type='button' class='btn btn-danger btn-link fix-broken-card'>";
              listHtml += "<i class='material-icons'>build</i> Fix Header!";
              listHtml += "</button>";
              listHtml += "<button type='button' class='btn btn-primary btn-link' rel='tooltip' data-placement='bottom' data-toggle='modal' data-target='#dealModal"+data[i].id+"' title='Detail View'><i class='material-icons'>art_track</i></button>";
              listHtml += "<a href='"+data[i].url+"' class='btn btn-success btn-link' rel='tooltip' data-placement='bottom' title='To URL' target='_blank'><i class='material-icons'>link</i></a>";
              listHtml += "</div>";
              listHtml += "<h4 class='card-title flex-horizental'><a href='#pablo' style='float:left;'><strong>"+data[i].title+"</strong></a>";
              listHtml += "<button class='btn btn-sm btn-secondary' data-toggle='modal' data-target='#dealModal"+data[i].id+"' style='float:right;'>Details</button></h4>";
              listHtml += "</div>";
              listHtml += "<div class='card-footer'>";
              listHtml += "<div calss='price'>";
              if (data[i].deal_type == 0) {
                if (data[i].price)
                  listHtml += "<h4 class='text-success flex-horizental'><i class='material-icons'>monetization_on</i><strong>" + data[i].price + data[i].price_currency + "</strong></h4>";
              } else {
                if (data[i].auc_enddate)
                  listHtml += "<h4 class='flex-horizental' style='color:#007bff;'><i class='material-icons'>gavel</i><strong>" + data[i].auc_enddate + "</strong></h4>";
              }
              listHtml += "</div>";
              var adStr = "";
              if (data[i].city)
                adStr += data[i].city;
              if (data[i].state) {
                if(adStr == "")
                  adStr += data[i].state;
                else
                  adStr += ", " + data[i].state;
              }
              if (data[i].country)
                adStr += ", " + data[i].country;
              listHtml += "<div class='stats'><p class='card-category'><i class='material-icons'>place</i><span style='font-size:11px;'>"+adStr+"</span></p></div>";
              listHtml += "</div>";
              listHtml += "</div></div>";

              // Modal
              modalHtml += "<div class='modal fade' id='dealModal"+data[i].id+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
              
              modalHtml += "<div class='modal-dialog'><div class='modal-content'>";
              // Modal Body
                modalHtml += "<div class='modal-body'>";
                // Row for general information
                  modalHtml += "<div class='row'>";

                    modalHtml += `<div class='col-md-12 col-sm-12'><img style='width:100%;' src="/storage/${data[i].picture}" alt='${data[i].title}'></div>
                    <div class="col-sm-12" style="min-height:80px;"></div>`;
                    modalHtml += "<div class='col-md-12 col-sm-12'>";
                    if (data[i].deal_type == 0) {
                      modalHtml += "<span class='badge badge-pill badge-success'>Sales</span>";
                    } else {
                      modalHtml += "<span class='badge badge-pill badge-info'>Auction</span>";
                    }
                    modalHtml += "<div style='margin-top:10px;'><div class='info_item'>";
                    modalHtml += "<h4 style='color:#333333;'>"+data[i].title+"</h4>";
                    modalHtml += "<h6 style='color:#333333;'>"+data[i].type_name+" / "+data[i].category_name+"</h6></div>";
                    modalHtml += "<div class='info_item'>";
                    if (data[i].deal_type == 0) {
                      modalHtml += "<h5 class='text-success' style='display:flex;margin-bottom:0;'><i class='material-icons'>monetization_on</i>&nbsp;&nbsp;"+data[i].price+ data[i].price_currency+"</h5>";
                    } else {
                      modalHtml += "<h5 class='text-warning' style='display:flex;margin-bottom:0;'><i class='material-icons'>calendar_today</i>&nbsp;&nbsp;"+data[i].auc_enddate+"</h5>";
                    }                    
                    modalHtml += "<p style='color:#333333;display:flex;'><i class='material-icons'>place</i>&nbsp;"+adStr+"</p></div>";
                    modalHtml += `<div class="info_item" style="border:none;">
                                    <button class="btn btn-secondary" onclick="location.href='${data[i].url}';"><i class="material-icons">laptop_mac</i>  Vendor's Website</button>
                                  </div>`;

                  modalHtml += "</div></div></div>";
                  // Row for detail info
                  modalHtml += "<div class='row'>";
                    modalHtml += "<div class='card'>";
                    // Card Header
                    modalHtml += "<div class='card-header card-header-tabs card-header-rose'>";
                    modalHtml += "<div class='nav-tabs-navigation'><div class='nav-tabs-wrapper'><ul class='nav nav-tabs' data-tabs='tabs'>";
                    modalHtml += "<li class='nav-item'><a class='nav-link active' href='#general"+data[i].id+"' data-toggle='tab' style='color:#333333 !important;'><i class='material-icons'>list</i>Equipment Info<div class='ripple-container'></div></a></li>";
                    if (data[i].truck_mount) {
                      modalHtml += "<li class='nav-item'><a class='nav-link' href='#truck"+data[i].id+"' data-toggle='tab' style='color:#333333 !important;'><i class='material-icons'>local_shipping</i>Truck Info</a><div class='ripple-container'></div></li>";
                    }
                    modalHtml += "<li class='nav-item'><a class='nav-link' href='#specific"+data[i].id+"' data-toggle='tab' style='color:#333333 !important;'><i class='material-icons'>feedback</i>Specific Info</a><div class='ripple-container'></div></li>";
                    modalHtml += `
                      <li class="nav-item">
                        <a class="nav-link" href="#advice${data[i].id}" data-toggle="tab" style="color:#333333 !important;">
                          <i class="material-icons">contact_mail</i> Buying Help
                          <div class="ripple-container"></div>
                        </a>
                      </li>
                    `;
                    modalHtml += "</ul></div></div>";
                    modalHtml += "</div>";
                    // Card Body
                    modalHtml += "<div class='card-body'><div class='tab-content'>";
                    // General Tab
                    modalHtml += "<div class='tab-pane active' id='general"+data[i].id+"'><div class='table-responsive'><table class='table'><tbody>";
                    if (data[i].year)
                      modalHtml += "<tr><td>Year</td><td>"+data[i].year+"</td></tr>";
                    if (data[i].make_id)
                      modalHtml += "<tr><td>Make</td><td>"+data[i].make_name+"</td></tr>";
                    if (data[i].modeld_id)
                      modalHtml += "<tr><td>Model</td><td>"+data[i].modeld_name+"</td></tr>";
                    if (data[i].sn)
                      modalHtml += "<tr><td>Serial Number</td><td>"+data[i].sn+"</td></tr>";
                    if (data[i].description)
                      modalHtml += "<tr><td>Description</td><td>"+data[i].description+"</td></tr>";
                    modalHtml += "</tbody></table></div></div>";
                    // Truck Tab
                    modalHtml += "<div class='tab-pane' id='truck"+data[i].id+"'><div class='table-responsive'><table class='table'><tbody>";
                    if (data[i].truck_year)
                      modalHtml += "<tr><td>Truck Year</td><td>"+data[i].truck_year+"</td></tr>";
                    if (data[i].truckmake_id)
                      modalHtml += "<tr><td>Truck Make</td><td>" + data[i].truckmake_name +"</td></tr>";
                    if (data[i].truck_model)
                      modalHtml += "<tr><td>Truck Model</td><td>"+data[i].truck_model+"</td></tr>";
                    if (data[i].truck_condition)
                      modalHtml += "<tr><td>Condition</td><td>"+data[i].truck_condition+"</td></tr>";
                    if (data[i].truck_engine)
                      modalHtml += "<tr><td>Engine</td><td>"+data[i].truck_engine+"</td></tr>";
                    if (data[i].truck_trans)
                      modalHtml += "<tr><td>Transimission</td><td>"+data[i].truck_trans+"</td></tr>";
                    if (data[i].truck_suspension)
                      modalHtml += "<tr><td>Fuel Type</td><td>"+data[i].truck_suspension+"</td></tr>";
                    modalHtml += "</tbody></table></div></div>";
                    // Specific Tab
                    modalHtml += "<div class='tab-pane' id='specific"+data[i].id+"'><div class='table-responsive'><table class='table'><tbody>";
                    
                    for (var s in specific_fields) {
                      var vField = eval('data[i].' + specific_fields[s].column_name);
                      var fvField = vField;
                      if (specific_fields[s].unit)
                        fvField = fvField + ' ' + eval('data[i].' + specific_fields[s].column_name + '_unit');
                      if (vField) {
                        modalHtml += `<tr>
                                        <td>${specific_fields[s].name}</td>
                                        <td>${fvField}</td>
                                      </tr>`;
                      }
                    }
                    
                    modalHtml += ``;

                    modalHtml += "</tbody></table></div></div>";

                    modalHtml += `
                      <div class="tab-pane" id="advice${data[i].id}">
                        <form action="" method="post">
                          @csrf
                          @method('post')
                        <div class="row">
                          <div class="col-md-5 col-sm-12">
                            <div class="row">
                              <label class="col-sm-4 col-form-label">First Name</label>
                              <div class="col-sm-8">
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="firstname" id="firstname" required>
                                  </div>
                              </div>
                              <label class="col-sm-4 col-form-label">Last Name</label>
                              <div class="col-sm-8">
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="lastname" id="lastname" required>
                                  </div>
                              </div>
                              <label class="col-sm-4 col-form-label">Email</label>
                              <div class="col-sm-8">
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="email" id="email" required>
                                  </div>
                              </div>
                              <label class="col-sm-4 col-form-label">Phone Number</label>
                              <div class="col-sm-8">
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="phone" id="phone" required>
                                  </div>
                              </div>
                              <label class="col-sm-4 col-form-label">Country</label>
                              <div class="col-sm-8">
                                  <div class="form-group">
                                    <select class="selectpicker" name="country" id="country" data-style="select-with-transition">
                                      <option value="United States">United States</option>
                                      <option value="Canada">Canada</option>
                                      <option value="Mexico">Mexico</option>
                                    </select>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                              <textarea cols="30" rows="13"
                                  class="rounded" style="padding:10px;"
                                  name="message" placeholder="Message"></textarea>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                        </div>
                        <hr style="width:100%;">
                        <div>
                          <button type="submit" class="btn btn-lg btn-primary" style="float:right;">Send</button>
                        </div>
                        </form>
                      </div>
                    `;

                    modalHtml += "</div></div>";

                  modalHtml += "</div></div>";
                  // End of Row for Detail
                  modalHtml += "<div class='modal-footer'>";
                  modalHtml += "<button type='button' class='btn btn-secondary btn-round' data-dismiss='modal'>Close</button>";
                  modalHtml += "</div>";
                modalHtml += "</div>";
                // Modal Body End
              modalHtml += "</div></div>";
              
              modalHtml += "</div>";
            }
            listHtml = `<div class="row">` + listHtml + `</div>`;
            $('#listArea').empty().html(listHtml);
            $('#listArea').append(`<div id="pagination"></div>`);
            $('#pagination').html(pagination);
            $('#modalArea').empty().html(modalHtml);
          }
        }
      });
    }

    function sendAjaxRequestByPage(paramPage) {
      page = paramPage;
      sendAjaxRequest();
    }

    function sendAjaxRequestbySale() {
      if ($('#deal_sales').prop('checked') === true) {
        $('.filter_eqprice').fadeIn();
        if ($('#deal_auctions').prop('checked') === true) {
          deal_type = 2;
        } else {
          deal_type = 0;
        }
        $('#filter_list').find(`[data-id='deal_sales']`).show();
      } else {
        $('.filter_eqprice').fadeOut();
        $('#eq_price_start').val('0');
        $('#eq_price_end').val('100000');
        if ($('#deal_auctions').prop('checked') === true) {
          deal_type = 1;
        } else {
          deal_type = 3;
        }
        $('#filter_list').find(`[data-id='deal_sales']`).hide();
      }
      sendAjaxRequest();
    }

    function sendAjaxRequestbyAuction() {
      if ($('#deal_auctions').prop('checked') === true) {
        $('.filter_aucdate').fadeIn();
        $('.filter_buypremium').fadeIn();
        if ($('#deal_sales').prop('checked') === true) {
          deal_type = 2;
        } else {
          deal_type = 1;
        }
        $('#filter_list').find(`[data-id='deal_auctions']`).show();
      } else {
        if ($('#deal_sales').prop('checked') === true) {
          deal_type = 0;
        } else {
          deal_type = 3;
        }
        $('.filter_aucdate').fadeOut();
        $('#auc_fromdate').val('');
        $('#auc_enddate').val('');
        $('.filter_buypremium').fadeOut();
        $('#from_premium').val('0');
        $('#end_premium').val('100');
        $('#filter_list').find(`[data-id='deal_auctions']`).hide();
      }
      sendAjaxRequest();
    }

    function sendAjaxRequestByType() {
      eq_type = [];
      $('#filter_list').find(`[data-type='checkbox_type']`).hide();
      $(".type-filter-check").each(function() {
        if ($(this).prop('checked') === true) {
          eq_type.push($(this).attr('value'));
          $('#filter_list').find(`[data-id='typecheck_${$(this).attr('value')}']`).show();
        } 
      });
      $.ajax({
        type: "POST",
        url: "ajax_get_categories_by_types",
        data: {
          types: eq_type,
          _token: '<?php echo csrf_token(); ?>'
        },
        success: function(res) {
          var data = res.data_list;
          var modal_data = res.data_modal;
          $('#eq_category .collapse-body').empty();
          for (var item in data) {
            var strItem = `<div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input category-filter-check" type="checkbox" unchecked id="categorycheck_${data[item].id}" value="${data[item].id}" onchange="ajaxSendRequestByCategory();"> ${data[item].name}
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>`;
            $('#eq_category .collapse-body').append(strItem);
          }
          if (modal_data.length != 0){
            var btnStr = `<div class="text-center">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#categoryModal"><i class="material-icons">add</i> Show All</button>
                          </div>`;
            $('#eq_category .collapse-body').append(btnStr);
            $('#categoryModal .modal-dialog .modal-content .modal-body .row').empty();
            for (var i in modal_data) {
              var strItem = `<div class="form-check col-md-3 col-sm-12">
                              <label class="form-check-label">
                                <input class="form-check-input category-filter-check" type="checkbox" unchecked id="categorycheck_${modal_data[i].id}" value="${ modal_data[i].id }"> ${modal_data[i].name}
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>`;
            }
            $('#categoryModal .modal-dialog .modal-content .modal-body .row').append(strItem);
          }
        }
      });
      sendAjaxRequest();
    }

    function ajaxSendRequestByCategory() {
      eq_category = [];
      $('#filter_list').find(`[data-type='checkbox_category']`).hide();
      $(".category-filter-check").each(function() {
        if ($(this).prop('checked') === true) {
          eq_category.push($(this).attr('value'));
          $('#filter_list').find(`[data-id='categorycheck_${$(this).attr('value')}']`).show();
        } 
      });
      $.ajax({
          type: "POST",
          url: "ajax_get_specifics_by_categories",
          data: {
              categories: eq_category,
              _token: '<?php echo csrf_token(); ?>'       
          },
          success: function(res) {
            var data = res.data_specific;
            var make_data = res.data_make;
            var make_modal_data = res.data_make_modal;
            var modeld_data = res.data_modeld;
            var modeld_modal_data = res.data_modeld_modal;
            if (data == 'fail') {
              $('#eq_specific .collapse-body').empty(); 
              $('.filter_specific').fadeOut();
            } else {
              $('#eq_specific .collapse-body').empty(); 
              $('.filter_specific').fadeIn();
              data.forEach(item => {
                var appendHtml = "";
                if (item.type == 1) {
                  appendHtml += "<input type='text' class='form-control' id='"+item.column_name+"' placeholder='"+item.name+"' />";
                } else if (item.type == 2) {
                  appendHtml += "<select class='selectpicker pl-0 pr-0' id='"+item.column_name+"' data-style='select-with-transition' multiple title='"+item.name+"' data-size='7' onchange='ajaxSendRequest();'>";
                  var res = item.value.split('/');
                  res.forEach(i => {
                    appendHtml += "<option value='"+i+"'>"+i+"</option>";
                  });
                  appendHtml += "</select>";
                }
                $('#eq_specific .collapse-body').append(appendHtml);
              });
              $('#eq_specific .selectpicker').selectpicker('destroy').selectpicker();
            }
          
            if (make_data != 'fail') {
              $('#eq_make .collapse-body').empty();
              for (var item in make_data) {
                var strItem = `<div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input make-filter-check" type="checkbox" unchecked id="makecheck_${make_data[item].id}" value="${make_data[item].id}" onchange="ajaxSendRequestByMake();"> ${make_data[item].name}
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>`;
                $('#eq_make .collapse-body').append(strItem);
              }
              if (make_modal_data != 'no_more'){
                var btnStr = `<div class="text-center">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#makeModal"><i class="material-icons">add</i> Show All</button>
                              </div>`;
                $('#eq_make .collapse-body').append(btnStr);
                $('#makeModal .modal-dialog .modal-content .modal-body .row').empty();
                for (var i in make_modal_data) {
                  var strItem = `<div class="form-check col-md-3 col-sm-12">
                                  <label class="form-check-label">
                                    <input class="form-check-input make-filter-check" type="checkbox" unchecked id="makecheck_${make_modal_data[i].id}" value="${ make_modal_data[i].id }"> ${make_modal_data[i].name}
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>`;
                }
                $('#makeModal .modal-dialog .modal-content .modal-body .row').append(strItem);
              }
            }

            if (modeld_data != 'fail') {
              $('#eq_modeld .collapse-body').empty();
              for (var item in modeld_data) {
                var strItem = `<div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input modeld-filter-check" type="checkbox" unchecked id="modeldcheck_${modeld_data[item].id}" value="${modeld_data[item].id}" onchange="ajaxSendRequestByMake();"> ${modeld_data[item].name}
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>`;
                $('#eq_modeld .collapse-body').append(strItem);
              }
              if (modeld_modal_data != 'no_more'){
                var btnStr = `<div class="text-center">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modeldModal"><i class="material-icons">add</i> Show All</button>
                              </div>`;
                $('#eq_modeld .collapse-body').append(btnStr);
                $('#modeldModal .modal-dialog .modal-content .modal-body .row').empty();
                for (var i in modeld_modal_data) {
                  var strItem = `<div class="form-check col-md-3 col-sm-12">
                                  <label class="form-check-label">
                                    <input class="form-check-input modeld-filter-check" type="checkbox" unchecked id="modeldcheck_${modeld_modal_data[i].id}" value="${ modeld_modal_data[i].id }"> ${modeld_modal_data[i].name}
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>`;
                }
                $('#makeModal .modal-dialog .modal-content .modal-body .row').append(strItem);
              }
            }
          }          
      });
      $.ajax({
        type: "POST",
        url: "ajax_get_if_truck",
        data: {
          categories: eq_category,
          _token: '<?php echo csrf_token(); ?>'
        },
        success: function(data) {
          if (data == 'fail') {
            $('.filter_truckmounted').fadeOut();
          } else if (data == 'success') {
            $('.filter_truckmounted').fadeIn();
          }
        }
      });
      sendAjaxRequest();
    }

    function sendAjaxRequestByMake() {
      eq_make = [];
      $('#filter_list').find(`[data-type='checkbox_make']`).hide();
      $(".make-filter-check").each(function() {
        if ($(this).prop('checked') === true) {
          eq_make.push($(this).attr('value'));
          $('#filter_list').find(`[data-id='makecheck_${$(this).attr('value')}']`).show();
        } 
      });
      $.ajax({
        type: "POST",
        url: "ajax_get_modelds_by_makes",
        data: {
          makes: eq_make,
          _token: '<?php echo csrf_token(); ?>'
        },
        success: function(data) {
          $('#select_modeld option').remove();
          $('#select_modeld').append("<option value=''></option>");
          for(var item in data) {
              var category_itemId = data[item].id;
              $('#select_modeld').append("<option value='"+data[item].id+"'>"+data[item].name+"</option>");
          }
          $('#select_modeld').selectpicker('destroy').selectpicker();
        }
      });
      sendAjaxRequest();
    }

    function sendAjaxRequestByModel() {
      eq_model = [];
      $('#filter_list').find(`[data-type='checkbox_modeld']`).hide();
      $(".modeld-filter-check").each(function() {
        if ($(this).prop('checked') === true) {
          eq_model.push($(this).attr('value'));
          $('#filter_list').find(`[data-id='modeldcheck_${$(this).attr('value')}']`).show();
        } 
      });
      sendAjaxRequest();
    }

    function sendAjaxRequestByCountry() {
      country = $('#select_country').val();
      $.ajax({
        type: "POST",
        url: "ajax_get_cities_by_countries",
        data: {
          countries: country,
          _token: '<?php echo csrf_token() ?>'
        },
        success: function(data) {
          $('#select_state option').remove();
          $('#select_state').append("<option value=''></option>");
          for(var item in data) {
              var category_itemId = data[item].id;
              $('#select_state').append("<option value='"+data[item]+"'>"+data[item]+"</option>");
          }
          $('#select_state').selectpicker('destroy').selectpicker();
        }
      });
      sendAjaxRequest();
    }

    function sendAjaxRequestByTruckData() {
      truck_make = $('#eq_truck_make').val();
      truck_model = $('#eq_truck_model').val();
      truck_year = $('#eq_truck_year').val();
      truck_engine = $('#eq_truck_engine').val();
      truck_trans = $('#eq_truck_trans').val();
      truck_fuel = $('#eq_truck_fuel').val();
      sendAjaxRequest();
    }

    function sendAjaxRequestByAucDate() {
      sendAjaxRequest();
    }

    function sendAjaxRequestByEqYear() {
      from_year = $('#from_year').val();
      end_year = $('#end_year').val();
      sendAjaxRequest();
    }

    function sendAjaxRequestByEqLocation() {
      country = $('#select_country').val();
      state = $('#select_state').val();
      sendAjaxRequest();
    }

    function sendAjaxRequestByPremium() {
      start_premium = $('#from_premium').val();
      end_premium = $('#end_premium').val();
      sendAjaxRequest();
    }

    function sendAjaxRequestByPrice() {
      start_price = $('#eq_price_start').val();
      end_price = $('#eq_price_end').val();
      sendAjaxRequest();
    }

    function initSliderFilter() {
      var slider_year = document.getElementById('sliderYear');
      var jsDate = new Date();
      var thisYear = jsDate.getFullYear();

      noUiSlider.create(slider_year, {
        start: [1900, thisYear],
        connect: true,
        step: 1,
        range: {
          min: 1900,
          max: thisYear
        },
        format: {
          from: Number,
          to: function(value) {
            return parseInt(value);
          }
        }
      });

      var fromYear = document.getElementById('from_year');
      var toYear = document.getElementById('end_year');

      slider_year.noUiSlider.on('update', function(values, handle) {
        if (handle) {
          toYear.value = values[handle];
        } else {
          fromYear.value = values[handle];
        }
      });

      fromYear.onchange = function() {
        slider_year.noUiSlider.set([fromYear.value, toYear.value]);
      };

      toYear.onchange = function() {
        slider_year.noUiSlider.set([fromYear.value, toYear.value]);
      };

      var slider_premium = document.getElementById('sliderPremium');

      noUiSlider.create(slider_premium, {
        start: [0, 100],
        connect: true,
        range: {
          min: 0,
          max: 100
        },
        step: 1,
        format: wNumb({
          decimal: 0
        })
      });

      var fromPremium = document.getElementById('from_premium');
      var toPremium = document.getElementById('end_premium');

      slider_premium.noUiSlider.on('update', function(values, handle) {
        if (handle) {
          toPremium.value = values[handle];
        } else {
          fromPremium.value = values[handle];
        }
      });

      fromPremium.onchange = function() {
        slider_premium.noUiSlider.set([fromPremium.value, toPremium.value]);
      };

      toPremium.onchange = function() {
        slider_premium.noUiSlider.set([fromPremium.value, toPremium.value]);
      };
    }

    function initSliderPrice() {
      var slider_price = document.getElementById('sliderPrice');

      noUiSlider.create(slider_price, {
        start: [0, 100000],
        connect: true,
        step: 100,
        range: {
          min: 0,
          max: 100000
        },
        format: {
          from: Number,
          to: function(value) {
            return parseInt(value);
          }
        }
      });

      var fromPrice = document.getElementById('eq_price_start');
      var toPrice = document.getElementById('eq_price_end');

      slider_price.noUiSlider.on('update', function(values, handle) {
        if (handle) {
          toPrice.value = values[handle];
        } else {
          fromPrice.value = values[handle];
        }
      });

      fromPrice.onchange = function() {
        slider_price.noUiSlider.set([fromPrice.value, toPrice.value]);
      };

      toPrice.onchange = function() {
        slider_price.noUiSlider.set([fromPrice.value, toPrice.value]);
      };
    }

    $(document).ready(function() {
      // $('.filter_specific').fadeOut();
      // $('.filter_truckmounted').fadeOut();
      
      var today = new Date();
        
      $('#auc_fromdate').datetimepicker({
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
        
      $('#auc_enddate').datetimepicker({
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
      // initialise Datetimepicker and Sliders
      // md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        initSliderFilter();
      }
      if ($('.slider-price').lengh != 0) {
        initSliderPrice();
      }

      $.ajax({
        type: 'POST',
        url: 'ajax_get_specific_fields',
        data: {
          _token: '<?php echo csrf_token();?>'
        },
        success: function(res) {
          specific_fields = res;
        }
      });
    });
  </script>
@endpush