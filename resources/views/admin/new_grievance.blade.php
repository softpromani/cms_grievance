@extends('layout.main', ['breadcrumb_title' => 'New Grievance'])
@section('title', 'Grievance::new')
@section('content')
 {{-- @can('role_create') --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Manage New Grievance</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <table class="table table-nowrap container">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No.</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($grievances)
                                    @forelse ($grievances as $gvns)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $gvns->grivuser->user_name }}</td>
                                            <td>{{ $gvns->title }}</td>
                                            <td>{{ $gvns->subject->name }}</td>
                                            <td>{{ $gvns->created_at }}</td>
                                            <td>
                                                <a class="btn btn-link p-0 editUser " style="display:inline" data-url="{{ isset($gvns)?asset($gvns->id):'#' }}"  data-user-id="{{ isset($gvns) ? $gvns->id : '' }}" ><button type="button" class="btn btn-sm btn-primary">Take Action</button></a></td>        
                                            
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <p style="color: red;">No items found.</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                            @endif
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer">
                                @if ($grievances)
                                {!! $grievances->links('pagination::bootstrap-5') !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endcan --}}
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Take Action</h1>
                </div>
                <form id="FormId" action="#"  method="POST" enctype="multipart/form-data"  class="row gy-1 pt-75">
                    @csrf
                    <input type="text" id="userIdInput" name="grievance_id" value="" hidden>
                    <div class="col-md-6 mb-1">
                            <label for="message" class="form-label">Message</label>
                            <div class="input-group">
                                <textarea class="form-control" name="message" id="message" ></textarea>
                            </div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="file" class="form-label">File Upload</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="file" name="file">
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
<script>
$(document).ready(function() {
    $(document).on('click', '.editUser', function() {
        var baseUrl = "{{ url('admin/action') }}"; 
        var grievance_id = $(this).data('user-id');
        
        $('#FormId').attr('action', baseUrl.replace('/{grievance_id}', '/' + grievance_id));
        
        $('#editUser').modal('show');
        $('#userIdInput').val(grievance_id);
    });
});



</script>
@endsection