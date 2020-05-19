@extends('layouts.app', ['activePage' => 'deal_list', 'menuParent' => 'deal', 'titlePage' => __('Deal Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">filter_none</i>
                </div>
                <h4 class="card-title">{{ __('Deal List') }}</h4>
              </div>
              <div class="card-body">
                @can('create', App\Deal::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('deal.create') }}" class="btn btn-sm btn-rose">{{ __('Add Deal') }}</a>
                    </div>
                  </div>
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    <style>
                      th {
                        min-width: 100px;
                      }
                    </style>
                      <th>
                        {{ __('Picture') }}
                      </th>
                      <th>
                          {{ __('Title') }}
                      </th>
                      <th>
                          {{ __('Description') }}
                      </th>
                      <th>
                        {{ __('Deal Type') }}
                      </th>
                      <th>
                        {{ __('Equipment Type') }}
                      </th>
                      <th>
                        {{ __('Equipment Category') }}
                      </th>
                      <th>
                          {{ __('Year') }}
                      </th>
                      <th>
                          {{ __('Make') }}
                      </th>
                      <th>
                          {{ __('Model') }}
                      </th>
                      <th>
                          {{ __('Address') }}
                      </th>
                      <th>
                          {{ __('End Date') }}
                      </th>
                      <th>
                          {{ __('LOT') }}
                      </th>
                      <th>
                          {{ __('Auctioneer') }}
                      </th>
                      <th>
                          {{ __('Price') }}
                      </th>
                      <th>
                          {{ __('Url') }}
                      </th>
                      <th>
                          {{ __('Specific Properties') }}
                      </th>
                      <th>
                          {{ __('Truck Mounted') }}
                      </th>
                      <th>
                        {{ __('Created Date') }}
                      </th>
                      <th>
                        {{ __('Updated Date') }}
                      </th>
                      <th>
                        {{ __('Creator') }}
                      </th>
                      @can('manage-deals', App\User::class)
                        <th class="text-right">
                          {{ __('Actions') }}
                        </th>
                      @endcan
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                        <tr>
                          <td>
                            <img src="{{ $item->path() }}" alt="" style="max-width: 200px;">
                          </td>
                          <td>
                            {{ $item->title }}
                          </td>
                          <td>
                            {{ $item->description }}
                          </td>
                          <td>
                            {{ $item->deal_type == 0 ? 'Sale' : 'Aution' }}
                          </td>
                          <td>
                            {{ $item->type_id != NULL ? $item->type->name : '' }}
                          </td>
                          <td>
                            {{ $item->category_id != NULL ? $item->category->name : '' }}
                          </td>
                          <td>
                            {{ $item->year }}
                          </td>
                          <td>
                            {{ $item->make_id != NULL ? $item->make->name : '' }}
                          </td>
                          <td>
                            {{ $item->modeld_id != NULL ? $item->modeld->name : '' }}
                          </td>
                          <td>
                            {{ $item->city }} &nbsp; {{ $item->state }} &nbsp; {{ $item->country }}
                          </td>
                          <td>
                            {{ $item->auc_enddate }}
                          </td>
                          <td>
                            {{ $item->auc_lot }}
                          </td>
                          <td>
                            {{ $item->auc_auctioneer }}
                          </td>
                          <td>
                            {{ $item->price }}
                          </td>
                          <td>
                            {{ $item->url }}
                          </td>
                          <td>
                            @foreach ($specifics as $spec)
                              @php
                                $spec_value = eval('return $item->'.$spec->column_name.';');
                                $spec_unit = '';
                                $spec_unit = eval('if(isset($item->'.$spec->column_name.'_unit)) return $item->'.$spec->column_name.'_unit;');
                              @endphp
                              @if ($item->category->specifics->where('id', $spec->id)->first())
                              <br>{{ $spec->name }}:&nbsp; {{ $spec_value.$spec_unit }}
                              @endif
                            @endforeach
                          </td>
                          <td>
                            @if ($item->category->truck_mounted == 1)
                              <br>Truck Year: {{ $item->truck_year }} &nbsp;&nbsp; Truck Make: {{ $item->truckmake_id != NULL ? $item->truckmake->name : '' }}
                              <br>Truck Model: {{ $item->truck_model }} &nbsp;&nbsp; Truck Engine: {{ $item->truck_engine }}
                              <br>Truck Trans: {{ $item->truck_trans }} &nbsp;&nbsp; Truck Suspension: {{ $item->truck_suspension }}
                              <br>Truck Condition: {{ $item->truck_condition.$item->truck_condition_unit }}
                            @endif
                          </td>
                          <td>
                            {{ $item->created_at->format('Y-m-d') }}
                          </td>
                          <td>
                            {{ $item->updated_at->format('Y-m-d') }}
                          </td>
                          <td>
                            {{ 'Admin' }}
                          </td>
                          @can('manage-deals', App\Deal::class)
                            @if (auth()->user()->can('update', $item) || auth()->user()->can('delete', $item))
                              <td class="td-actions text-right">
                                <form action="{{ route('deal.destroy', $item) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    
                                    @can('update', $item)
                                      <a rel="tooltip" class="btn btn-success btn-round" href="{{ route('deal.edit', $item) }}" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                      </a>
                                    @endcan
                                    @can('delete', $item)
                                      <button type="button" class="btn btn-danger btn-round" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                          <i class="material-icons">close</i>
                                          <div class="ripple-container"></div>
                                      </button>
                                    @endcan
                                </form>
                              </td>
                            @endif
                          @endcan
                        </tr>
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
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search items",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });
  </script>
@endpush