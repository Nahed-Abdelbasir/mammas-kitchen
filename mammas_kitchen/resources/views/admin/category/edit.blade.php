@extends('layouts.app')

@section('title' , 'Edit Category')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">

        @include('layouts.partial.msg') 

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update' , $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="{{ route('category.index') }}">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')

@endpush