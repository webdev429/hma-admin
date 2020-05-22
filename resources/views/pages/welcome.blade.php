@extends('layouts.app', [
  'class' => 'off-canvas-sidebar',
  'classPage' => 'login-page',
  'activePage' => 'deal_list',
  'title' => __('HMA Project Dashboard'),
  'pageBackground' => asset("material").'/img/login.jpg'
])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card" style="margin:0;">
        <div class="card-header card-header-rose card-header-icon">
          <div class="card-icon">
            <i class="material-icons">local_shipping</i>
          </div>
          <h4 class="card-title">{{ __('Heavy Equipment Deal List') }}</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Collapsible Accordion</h4>
              </div>
              <div class="card-body">
                <div id="accordion" role="tablist">
                  <div class="card-collapse">
                    <div class="card-header" role="tab" id="headingOne">
                      <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed">
                          Collapsible Group Item #1
                          <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                      </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                      <div class="card-body">
                        1
                      </div>
                    </div>
                  </div>
                  <div class="card-collapse">
                    <div class="card-header" role="tab" id="headingTwo">
                      <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Collapsible Group Item #2
                          <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        2
                      </div>
                    </div>
                  </div>
                  <div class="card-collapse">
                    <div class="card-header" role="tab" id="headingThree">
                      <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Collapsible Group Item #3
                          <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body">
                        3
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="col-md-9 col-sm-12 row">
              @foreach ($deals as $deal)
                <div class="col-md-6 col-sm-12">
                  <div class="card card-product">
                    <div class="card-header card-header-image product-image-header" style="background:url('{{ $deal->path() }}') no-repeat center center;" data-header-animation="true">
                      
                    </div>
                    <div class="card-body">
                      <div class="card-actions text-center">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                          <i class="material-icons">build</i> Fix Header!
                        </button>
                        <button type="button" class="btn btn-primary btn-link" rel="tooltip" data-placement="bottom"  data-toggle="modal" data-target="#dealModal{{ $deal->id }}" title="Detail View">
                          <i class="material-icons">art_track</i>
                        </button>
                        <a href="{{ $deal->url }}" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="To URL">
                          <i class="material-icons">link</i>
                        </a>
                        <!-- <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove">
                          <i class="material-icons">close</i>
                        </button> -->
                      </div>
                      <h4 class="card-title">
                        <a href="#pablo">{{ $deal->title }}</a>
                      </h4>
                      <!-- <div class="card-description">
                        
                      </div> -->
                    </div>
                    <div class="card-footer">
                      <div class="price">
                        <h4>{{ $deal->deal_type == 0 ? $deal->price.$deal->price_currency : $deal->auc_enddate }}</h4>
                      </div>
                      <div class="stats">
                        <p class="card-category"><i class="material-icons">place</i> {{ $deal->city ? $deal->city.', ' : '' }}{{ $deal->state ? $deal->state.', ' : '' }}{{ $deal->country ? $deal->country.', ' : '' }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                
              @endforeach
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
@foreach ($deals as $deal)

  <!-- Classic Modal -->
  <div class="modal fade" id="dealModal{{ $deal->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-5">
              <div style="margin-bottom:10px;">
                <img style="width:100%;" src="{{ $deal->path() }}" alt="{{ $deal->title }}">
              </div>
            </div>
            <div class="col-md-7">
              @if ($deal->deal_type == 0)
                <span class="badge badge-pill badge-success">Sales</span>
              @else
                <span class="badge badge-pill badge-info">Auction</span>
              @endif
              <h3 style="color:#333333;">{{ $deal->title }}</h3>
              <h6 style="color:#333333;">{{ $deal->type->name }} {{ $deal->category->name }}</h6>
              @if ($deal->deal_type == 0)
                <h5 class="text-warning" style="display:flex;"><i class="material-icons">monetization_on</i> &nbsp;&nbsp;{{ $deal->price }}{{ $deal->price ? $deal->price_currency : '' }}</h5>
              @else
                <h5 class="text-warning" style="display:flex;"><i class="material-icons">calendar_today</i> &nbsp;&nbsp;{{ $deal->auc_enddate }}</h5>
              @endif
              <h5 style="color:#333333;font-weight:bold;">Contact Information</h6>
              <p style="color:#333333;display:flex;"><i class="material-icons">place</i>&nbsp;{{ $deal->city ? $deal->city.', ' : '' }}{{ $deal->state ? $deal->state.', ' : '' }}{{ $deal->country ? $deal->country.', ' : '' }}</p>
              <p style="color:#333333;display:flex;"><i class="material-icons">phone</i>&nbsp;{{ $deal->user->phone_number }}</p>
              <p style="color:#333333;display:flex;"><i class="material-icons">person_pin</i>&nbsp;{{ $deal->user->name }}</p>
            </div>
          </div>
          <div class="row">
          <div class="card">
            <div class="card-header card-header-tabs card-header-rose">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#general{{ $deal->id }}" data-toggle="tab">
                        <i class="material-icons">network_check</i> General
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#truck{{ $deal->id }}" data-toggle="tab">
                        <i class="material-icons">local_shipping</i> Truck Mounted
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#specific{{ $deal->id }}" data-toggle="tab">
                        <i class="material-icons">feedback</i> Specific Info
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
                        <tr>
                          <td>Year</td>
                          <td>{{ $deal->year }}</td>
                        </tr>
                        <tr>
                          <td>Make</td>
                          <td>{{ $deal->make->name }}</td>
                        </tr>
                        <tr>
                          <td>Model</td>
                          <td>{{ $deal->modeld->name }}</td>
                        </tr>
                        <tr>
                          <td>Serial Number</td>
                          <td>{{ $deal->sn }}</td>
                        </tr>
                        <tr>
                          <td>Description</td>
                          <td>{{ $deal->description }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane" id="truck{{ $deal->id }}">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Truck Year</td>
                          <td>{{ $deal->truck_year }}</td>
                        </tr>
                        <tr>
                          <td>Truck Make</td>
                          <td>{{ $deal->truckmake_id ? $deal->truckmake->name : '' }}</td>
                        </tr>
                        <tr>
                          <td>Truck Model</td>
                          <td>{{ $deal->truck_model }}</td>
                        </tr>
                        <tr>
                          <td>Condition</td>
                          <td>{{ $deal->truck_condition . $deal->truck_condtion_unit }}</td>
                        </tr>
                        <tr>
                          <td>Engine</td>
                          <td>{{ $deal->truck_engine }}</td>
                        </tr>
                        <tr>
                          <td>Transmission</td>
                          <td>{{ $deal->truck_trans }}</td>
                        </tr>
                        <tr>
                          <td>Fuel Type</td>
                          <td>{{ $deal->truck_suspension }}</td>
                        </tr>
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
                                <tr>
                                  <td>{{ $specific->name }}</td>
                                  <td>{{ $show_flag }}{{ $show_flag ? $valueUnit : ''}}</td>
                                </tr>
                            @else
                              <tr>
                                <td>{{ $specific->name }}</td>
                                <td>{{ $show_flag }}</td>
                              </tr>
                            @endif
                        @else
                            @php
                            $optionAry = explode('/', $specific->value);
                            @endphp
                            <tr>
                              <td>{{ $specific->name }}</td>
                              <td>{{ $show_flag }}</td>
                            </tr>
                        @endif
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endforeach
<style>
  td {
    padding: 5px 8px !important;
  }
  .modal.show {
    position: absolute !important;
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
</style>
@endsection
