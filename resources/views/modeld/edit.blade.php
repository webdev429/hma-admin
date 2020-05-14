@extends('layouts.app', ['activePage' => 'modeld-management', 'menuParent' => 'characteristics', 'titlePage' => __('Model
Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('modeld.update', $modeld) }}" autocomplete="off"
                    class="form-horizontal">
                    @csrf
                    @method('put')

                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">category</i>
                            </div>
                            <h4 class="card-title">{{ __('Edit Model') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('modeld.index') }}"
                                        class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" id="input-name" type="text" placeholder="{{ __('Name') }}"
                                            value="{{ old('name', $modeld->name) }}" required="true"
                                            aria-required="true" />
                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <textarea cols="30" rows="10"
                                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                            name="description" id="input-description" type="text"
                                            placeholder="{{ __('Description') }}" required="true"
                                            aria-required="true">{{ old('description', $modeld->description) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'description'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-sm-3 col-form-label">Make</label>
                                <div class="col-md-3 col-sm-9">
                                    <div class="form-group">
                                        <select class="selectpicker" name="make_id" data-style="select-with-transition">
                                            @foreach($makes as $make)
                                            <option value="{{ $make->id }}" {{ $make->id == old('make_id', $make->make_id) ? 'selected' : '' }}>{{ $make->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="col-md-2 col-sm-3 col-form-label">Category</label>
                                <div class="col-md-3 col-sm-9">
                                    <div class="form-group">
                                        <select class="selectpicker" name="category_id" data-style="select-with-transition">
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $category->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
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
