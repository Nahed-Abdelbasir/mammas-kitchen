@extends('layouts.app')

@section('title' , 'Reservation')

@push('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>

@endpush

@section('content')

<div class="content">
        <div class="container-fluid">

         @include('layouts.partial.msg')

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Reservations</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                  <thead class=" text-primary">
                    <th>
                      ID
                    </th>
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Phone
                    </th>
                    <th>
                      Date And Time
                    </th>
                    <th>
                      Message
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Created At
                    </th>
                    <th>
                      Action
                    </th>
                  </thead>
                  <tbody>

                    @foreach($reservation as $key=>$reserve)

                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reserve->name }}</td>
                            <td>{{ $reserve->email }}</td>
                            <td>{{ $reserve->phone }}</td>
                            <td>{{ $reserve->date_and_time }}</td>
                            <td>{{ $reserve->message }}</td>
                            <td> 
                                @if( $reserve->status == true )

                                    <span class="label label-info">confirmed</span>

                                @else

                                    <span class="label label-info">not confirmed yet</span>

                                @endif

                            </td>
                            <td>{{ $reserve->created_at }}</td>
                            <td>
                              
                              @if($reserve->status == false)

                                  <button class="btn btn-info btn-sm" type="button" 
                                  onclick="if(confirm('Are you verify this request by phone ? ')){
                                      event.preventDefault();
                                      document.getElementById('status-form-{{ $reserve->id }}').submit();

                                    }else{
                                      event.preventDefault();
                                    }"><i class="material-icons">done</i></button>
                                  <form id="status-form-{{ $reserve->id }}" action="{{ route('reservation.status' , $reserve->id) }}" method="POST">
                                    @csrf
                                  </form>

                              @endif

                              <button class="btn btn-danger btn-sm" type="button" 
                              onclick="if(confirm('Are you sure? You want to delete this')){
                                  event.preventDefault();
                                  document.getElementById('delete-form-{{ $reserve->id }}').submit();

                                }else{
                                  event.preventDefault();
                                }"><i class="material-icons">delete</i></button>
                              <form id="delete-form-{{ $reserve->id }}" action="{{ route('reservation.destroy' , $reserve->id) }}" method="POST">
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