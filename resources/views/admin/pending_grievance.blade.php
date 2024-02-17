@extends('layout.main', ['breadcrumb_title' => 'Active Grievance'])
@section('title', 'Grievance::Active')
@section('content')
@can('grievance_solution_read')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Active Grievance</h4>
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
                                        {{-- <th scope="col">Chat</th> --}}
                                        @can('grievance_solution_edit')
                                        <th scope="col">Action</th>
                                        @endcan
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengrievances as $gvns)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $gvns->applicant->user_name }}</td>
                                            <td>{{ $gvns->title }}</td>
                                            <td>{{ $gvns->subject->name }}</td>
                                            @can('grievance_solution_edit')
                                            <td>
                                            {{-- <button type="button" class="open-modal-button" data-toggle="modal" data-target="#grievanceModal" data-grievance-id="{{ $gvns->id }}"style="border: none; background: none; padding: 0; margin: 0; font-size:15px; color:blue;" title="View"> <i class="fa fa-eye" aria-hidden="true"></i></button> --}}
                                            <a href="{{ route('admin.viewgrievance',encrypt($gvns->id)) }}" style="border: none; background: none; padding: 0; margin: 0; font-size:15px; color:blue;" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                            @endcan
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <p style="color: red;">No items found.</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer">
                                @if ($pengrievances)
                                {!! $pengrievances->links('pagination::bootstrap-5') !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
 
@endsection


@section('script')
<!-- <script>
    $(document).ready(function() {
        $('.open-modal-button').click(function() {
            var grievanceId = $(this).data('grievance-id');
            $('#grievanceModal').modal('show');

        });
    });
</script> -->
@endsection