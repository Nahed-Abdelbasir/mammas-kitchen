@extends('layouts.app')

@section('title' , 'Edit Item')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">

        @include('layouts.partial.msg') 

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('item.update' , $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Category</label>
                                <select class="form-control" name="category">
                                    @foreach($categories as $key=>$category)
                                        <option value="{{ $category->id }}" 
                                        @if($category->id == $item->category_id)
                                            selected
                                         @endif >
                                        {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Description</label>
                                <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Price</label>
                                <input type="number" class="form-control" name="price" value="{{ $item->price }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label class="bmd-label-floating">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="{{ route('item.index') }}">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')

@endpush