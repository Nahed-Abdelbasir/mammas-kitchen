@extends('layouts.app')

@section('title' , 'Edit Slider')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">

        @include('layouts.partial.msg') 

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit Slider</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('slider.update' , $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title" value="{{ $slider->sub_title }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="{{ route('slider.index') }}">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')

@endpush