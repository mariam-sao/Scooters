@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header py-3 d-flex">
            <h1 class="h3 mb-0 text-gray-800">{{ __('create scoter') }}</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin.scoters.index') }}" class="btn btn-primary">
                        <span class="text">{{ __('Go Back') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.scoters.update', $scoter->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="scoter_number">{{ __('Scoter Number') }}</label>
                        <input type="text" class="form-control" id="scoter_number" placeholder="{{ __('scoter number') }}" name="scoter_number" value="{{ old('scoter_number', $scoter->scoter_number) }}" />
                    </div>
                    <div class="form-group">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="number" class="form-control" id="price" placeholder="{{ __('price') }}" name="price" value="{{ old('price', $scoter->price) }}" />
                    </div>
                    <div class="form-group">
                        <label for="capacity">{{ __('Capacity') }}</label>
                        <input type="number" class="form-control" id="capacity" placeholder="{{ __('capacity') }}" name="capacity" value="{{ old('capacity', $scoter->capacity) }}" />
                    </div>
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach($categories as $id => $category)
                                <option {{ $id == $scoter->category->id ? 'selected' : null }} value="{{ $id }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="floor">{{ __('Floor') }}</label>
                        <input type="number" class="form-control" id="floor" placeholder="{{ __('floor') }}" name="floor" value="{{ old('floor', $scoter->floor) }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control" name="description" id="descriptioin" placeholder="description" cols="30" rows="10">{{ old('description', $scoter->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection