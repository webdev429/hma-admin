@extends('layouts.app', ['activePage' => 'make-management', 'menuParent' => 'characteristics', 'titlePage' => __('Make Data Management')])

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
                <h4 class="card-title">{{ __('Make') }}</h4>
              </div>
              <div class="card-body">
                @can('create', App\Make::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('make.create') }}" class="btn btn-sm btn-rose">{{ __('Add') }}</a>
                    </div>
                  </div>
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('Name') }}
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
                      @can('manage-items', App\User::class)
                        <th class="text-right">
                          {{ __('Actions') }}
                        </th>
                      @endcan
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                        <tr>
                          <td>
                            {{ $item->name }}
                          </td>
                          <td>
                            {{ $item->created_at->format('Y-m-d') }}
                          </td>
                          <td>
                            {{ $item->updated_at->format('Y-m-d') }}
                          </td>
                          <td>
                            {{ $item->user->name }}
                          </td>
                          @can('manage-makes', App\User::class)
                            @if (auth()->user()->can('update', $item) || auth()->user()->can('delete', $item))
                              <td class="td-actions text-right">
                                <form action="{{ route('make.destroy', $item) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    
                                    @can('update', $item)
                                      <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('make.edit', $item) }}" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                      </a>
                                    @endcan
                                    @if ($item->deals->isEmpty() && auth()->user()->can('delete', $item))
                                      <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                          <i class="material-icons">close</i>
                                          <div class="ripple-container"></div>
                                      </button>
                                    @endif
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