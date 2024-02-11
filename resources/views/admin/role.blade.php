@extends('layout.main', ['breadcrumb_title' => 'Role'])
@section('title', 'Grievance::Role')
@section('content')
 @can('role_create')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Create Role</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{ route('admin.role_store') }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="role" class="form-label">Role Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@can('role_read')
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
                            <th scope="col">Role Name</th>
                            <th scope="col">Created at</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $data)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->created_at }}</td>
                                {{-- <td>
                                    <div class="d-flex">
                                        <a href="#" title="Edit"><i class="fa fa-edit me-1" style="color:blue; font-size:15px;"></i></a>
                                        <a href="#" onclick="deleteconfirm(this)" data-id="delete-form-{{$data->id}}"><i class="fa fa-trash-o" style="color:red; font-size:15px;"></i></a>
                                                <form id="delete-form-{{ $data->id }}" action="#"
                                                    method="post" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                    </div>
                                   
                                </td> --}}
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endcan
    
@endsection


@section('script')
@endsection