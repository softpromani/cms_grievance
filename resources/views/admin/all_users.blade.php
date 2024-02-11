@extends('layout.main', ['breadcrumb_title' => 'Users'])
@section('title', 'Grievance::user')
@section('content')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ isset($edit)?'Update User':'Add User' }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{ isset($edit)?route('admin.user.update',$edit->id):route('admin.user.store') }}" method="POST">
                        @csrf
                        @isset($edit)
                        @method('put')
                        @endisset
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="name" class="form-label">User Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ isset($edit)?$edit->name:'' }}" id="name" name="name" placeholder=" Name">
                                </div>
                            </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder=" ......" @isset($edit) disabled @endisset>
                                    </div>
                                </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="role" class="form-label">Select Role </label>
                                <select class="form-select" aria-label="Default select example" name="role">
                                    
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($Roles as $role)
                                        <option value="{{ $role->name }}" @if(isset($edit)?$role->name:'') selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="uemail" class="form-label">User Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ isset($edit)?$edit->email:'' }}" id="uemail" name="email" placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <button class="btn btn-primary" type="submit">{{ isset($edit)?'Update':'Submit' }}</button>
                            </div>
                            <!--end col-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@can('role_read')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All User</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <table class="table table-nowrap container">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subjects</th>
                            <th scope="col">Assign Subject</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->roles[0]->name??'' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->subjects)
                                    {{ $user->subjects->pluck('name') }}
                                    @else
                                    <p>N/A</p>
                                    @endif
                                  
                                </td>                      
                                <td>
                                    <a class="btn btn-link p-0 editUser " style="display:inline" data-url="{{ isset($user)?asset($user->id):'#' }}"  data-user-id="{{ isset($user) ? $user->id : '' }}" ><button type="button" class="btn btn-sm btn-primary">Add</button></a>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.user.edit',$user->id) }}" title="Edit"><i class="fa fa-edit me-1" style="color:blue; font-size:15px;"></i></a>
                                        <form action="{{ route('admin.user.destroy',$user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: none; padding: 0; margin: 0;">
                                                <i class="fa fa-trash-o" style="color: red; font-size: 15px;"></i>
                                            </button>
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
@endcan
    

<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Assign Subject</h1>
                </div>
                <form action="{{ route('admin.assign.store') }}"  method="POST"  class="row gy-1 pt-75">
                    @csrf
                    <input type="text" id="userIdInput" name="user_id" value="" hidden>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="select2-multiple"><strong>Select Subject</strong></label>
                        <select class=" form-select" id="multiselect" name="subject_id[]" multiple>
                            <option readonly disabled>Select Multiple Subject</option>
                            @foreach ($subjets as $sb )
                            <option value="{{ $sb->id}}">{{ $sb->name }}</option>
                            @endforeach
                           
                        </select>
                        <div id="defaultFormControlHelp" class="form-text">
                            If You Need to Select Multiple Subject...
                           </div>
                    </div>
                    
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
<script>
	$(document).ready(function() {
		$(document).on('click', '.editUser', function() {
        
			var url = $(this).data('url'); 
            var userId = $(this).data('user-id');
            // alert(userId);
            $('#editUser').modal('show');
            $('#userIdInput').val(userId);
		});
	});
</script>

@endsection