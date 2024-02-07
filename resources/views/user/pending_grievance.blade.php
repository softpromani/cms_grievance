@extends('frontend.layout.user_main')
@section('title','Active Grievance')
<style>

</style>
@section('content')
   <section>
         <!-- list and filter start -->
         <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">Manage Grievance</h4>
                {{-- <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div> --}}
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="table">
                    <thead class="table">
                        <tr>
                            <th>Id</th>
                            <th>Token Number</th>
                            <th>Subject</th>
                            <th>Status</th>
                        </tr>
                          @foreach ( $complane_data as $data)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td><a href="{{route('user.grievancedetail',Crypt::encrypt($data->id))}}">{{$data->grievance_code??''}}</a></td>
                                <td>{{$data->title??''}}</td>
                                <td>{{$data->status??''}}</td>
                          </tr>
                            @endforeach
                            
                       
                    </thead>
                    
                </table>
            </div>
           
        </div>
        <!-- list and filter end -->
   </section>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
