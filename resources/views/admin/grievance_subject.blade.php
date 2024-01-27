@extends('layout.main')
@section('title', 'subject')
@section('content')
 @can('role_create')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ isset($edit)?'Update Subject':'Add Subject' }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{ isset($edit)?route('admin.subject.update',$edit->id):route('admin.subject.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($edit)
                        @method('put')
                        @endisset
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Subject Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" value="{{ isset($edit)?$edit->name:'' }}" name="name" placeholder="Subject Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="image" name="icon_image">
                                    @if(isset($edit))
                                    <img src="{{isset($edit)? asset($edit->icon_image):'' }}" alt="icon_image" height="100" width="150">
                                @endif
                                </div>
                            </div>
                            <div class="col-md-6">
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
@endcan
@can('role_read')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Manage Subject</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <table class="table table-nowrap container">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No.</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Subject Image</th>
                            <th scope="col">Visible</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($subjects as $sub)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $sub->name }}</td>
                                <td><img src="{{ asset($sub->icon_image)??'' }}" alt="img" style="height: 100px; width:150px;"></td>
                               
                                <td><div class="form-check form-switch">
                                    <input class="form-check-input is_active" data-id="{{$sub->id}}" type="checkbox" role="switch" name="is_visible" id="flexSwitchCheckChecked" {{ $sub->is_visible ? 'checked' : '' }}>
                                  </div></td>

                                <td>{{ $sub->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.subject.edit',$sub->id) }}" title="Edit"><i class="fa fa-edit me-1" style="color:blue; font-size:15px;"></i></a>
                                        <form action="{{route('admin.subject.destroy',$sub->id) }}" method="post">
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

@section('script')
 <script>
    $(document).ready(function() {
        $(document).on('change', '.is_active', function() {
            
            var statusId = $(this).data('id');
            var isActive = $(this).is(':checked');
            var newurl = "{{ url('admin/changeStatus') }}/" + statusId;
           
            $.ajax({
                // url: '/admin/is_active/' + statusId,
                url: newurl,
                type: 'get',
                success: function(response) {
                    location.reload();
                },
            });
        });
    });
</script>  
@endsection
@endsection