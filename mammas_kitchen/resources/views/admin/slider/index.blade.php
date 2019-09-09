@extends('layouts.app')

@section('title' , 'Slider')

@push('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>

@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
        <a class="btn btn-info" href="{{ route('slider.create') }}">Add New</a>

         @include('layouts.partial.msg')

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">All Sliders</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                  <thead class=" text-primary">
                    <th>
                      ID
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Sub Title
                    </th>
                    <th>
                      Image
                    </th>
                    <th>
                      Created At
                    </th>
                    <th>
                      Updated At
                    </th>
                    <th>
                      Action
                    </th>
                  </thead>
                  <tbody>

                    @foreach($sliders as $key=>$slider)

                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->sub_title }}</td>
                            <td class="text-center">
                              <img class="img-responsive img-thumbnail" src="{{ asset('uploads/sliders/'.$slider->image) }}" alt="" width="100" height="100"/>
                            </td>
                            <td>{{ $slider->created_at }}</td>
                            <td>{{ $slider->updated_at }}</td>
                            <td>
                              <a class="btn btn-info btn-sm" href="{{ route('slider.edit' , $slider->id) }}">
                                <i class="material-icons">mode_edit</i>
                              </a>
                              <button class="btn btn-danger btn-sm" type="button" 
                              onclick="if(confirm('Are you sure? You want to delete this')){
                                  event.preventDefault();
                                  document.getElementById('delete-form-{{ $slider->id }}').submit();

                                }else{
                                  event.preventDefault();
                                }"><i class="material-icons">delete</i></button>
                              <form id="delete-form-{{ $slider->id }}" action="{{ route('slider.destroy' , $slider->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                              </form>
                            </td>
                          </tr>

                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>



@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

@endpush




