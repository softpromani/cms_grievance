@extends('layout.main')
@section('title', 'new')
@section('content')
 {{-- @can('role_create') --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Manage Roles</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <table class="table table-nowrap container">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No.</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Subject</th>
                                        {{-- <th scope="col">Message</th> --}}
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grievances as $gvns)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $gvns->grivuser->user_name }}</td>
                                            <td>{{ $gvns->title }}</td>
                                            <td>{{ $gvns->subject->name }}</td>
                                            {{-- <td>{{ $gvns->message }}</td> --}}
                                            <td>{{ $gvns->created_at }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Accept Button -->
                                                    <form action="{{ route('admin.takeaction',$gvns->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="type" value="action_taken">
                                                        <input type="hidden" name="id" value="{{$gvns->id}}">
                                                        <button type="submit" class="btn btn-success">Take Action</button>
                                                    </form>
                                                </div>
                                            </td>
                                            
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endcan --}}

    
@endsection


@section('script')
@endsection