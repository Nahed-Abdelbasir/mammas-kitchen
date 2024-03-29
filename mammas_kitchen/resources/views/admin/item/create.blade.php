@extends('layouts.app')

@section('title' , 'Add Item')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">

        @include('layouts.partial.msg')
        
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Add New Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Category</label>
                                <select class="form-control" name="category">
                                    @foreach($categories as $key=>$category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Price</label>
                                <input type="number" class="form-control" name="price">
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