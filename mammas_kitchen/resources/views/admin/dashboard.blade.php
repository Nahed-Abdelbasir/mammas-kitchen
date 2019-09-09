@extends('layouts.app')

@section('title' , 'Dashboard')

@push('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>

@endpush

@section('content')

    <div class="content">
            <div class="container-fluid">

              <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                      <div class="card-icon">
                        <i class="material-icons">content_copy</i>
                      </div>
                      <p class="card-category">Ctegory / Item</p>
                      <h3 class="card-title">{{ $categoryCount }} / {{ $itemCount }}
                      </h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">
                        <i class="material-icons text-danger">info</i>
                        <a href="#pablo">Total Categories And Items</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                      <div class="card-icon">
                        <i class="material-icons">slideshow</i>
                      </div>
                      <p class="card-category">Slider Count</p>
                      <h3 class="card-title">{{ $sliderCount }}</h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">
                        <i class="material-icons">date_range</i> 
                        <a href="{{ route('slider.index') }}">
                          Get More Details
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                      <div class="card-icon">
                        <i class="material-icons">info_outline</i>
                      </div>
                      <p class="card-category">Reservation</p>
                      <h3 class="card-title">{{ $reservations->count() }}</h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">
                        <i class="material-icons">local_offer</i> Not Confirmed Reservations
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                      <div class="card-icon">
                        <i class="fa fa-twitter"></i>
                      </div>
                      <p class="card-category">Contacts</p>
                      <h3 class="card-title">{{ $contactCount }}</h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

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
                            Phone
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Action
                          </th>
                        </thead>
                        <tbody>

                          @foreach($reservations as $key=>$reserve)

                                <tr>
                                  <td>{{ $key + 1 }}</td>
                                  <td>{{ $reserve->name }}</td>
                                  <td>{{ $reserve->phone }}</td>
                                  <td> 
                                      @if( $reserve->status == true )

                                          <span class="label label-info">confirmed</span>

                                      @else

                                          <span class="label label-info">not confirmed yet</span>

                                      @endif

                                  </td>
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