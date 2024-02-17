@extends('layout.main', ['breadcrumb_title' => 'Grievance Subject'])
@section('title', 'Grievance::Subject')
@section('content')
 @can('subject_create')
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
                                <label for="name" class="form-label">Subject Name<sup style="color:red;font-size:15px">*</sup></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" value="{{ isset($edit)?$edit->name:'' }}" name="name" placeholder="Subject Name" required>
                                </div>
                                @error('name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="image" name="icon_image">
                                    @if(isset($edit))
                                    <img src="{{isset($edit->media->file_path) ? asset('storage/'.$edit->media->file_path ) : '#' }}" alt="icon_image" height="100" width="150">
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
@can('subject_read')
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
                            @canany(['subject_edit', 'subject_delete'])
                            <th scope="col">Action</th>
                            @endcanany
                            
                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($subjects as $sub)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $sub->name }}</td>
                                <td><img src="{{ isset($sub->media->file_path) ? asset('storage/'.$sub->media->file_path ) : '#' }}" alt="img" style="height: 100px; width:150px;"></td>
                               
                                <td><div class="form-check form-switch">
                                    <input class="form-check-input is_active" data-id="{{$sub->id}}" type="checkbox" role="switch" name="is_visible" id="flexSwitchCheckChecked" {{ $sub->is_visible ? 'checked' : '' }}>
                                  </div></td>
                                <td>
                                    <div class="d-flex">
                                        @can('subject_edit')
                                        <a href="{{ route('admin.subject.edit',encrypt($sub->id)) }}" title="Edit"><i class="fa fa-edit me-1" style="color:blue; font-size:15px;"></i></a> 
                                        @endcan
                                        @can('subject_delete')
                                        <form action="{{route('admin.subject.destroy',$sub->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: none; padding: 0; margin: 0;">
                                                <i class="fa fa-trash-o" style="color: red; font-size: 15px;"></i>
                                            </button>
                                        </form>
                                        @endcan
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
                // success: function(response) {
                //     location.reload();
                // },
            });
        });
    });
</script>  
@endsection
@endsection