@extends('layout.main', ['breadcrumb_title' => 'Close Grievance'])
@section('title', 'Grievance::Close')
@section('content')
@can('grievance_solution_read')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Close Grievance</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <table class="table table-nowrap container">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No.</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Suatus</th>
                                        @can('grievance_solution_edit')
                                        <th scope="col">Message</th>
                                        @endcan
                                        
                                        <th scope="col">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                    @forelse($closegrievance as $close)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $close->applicant->user_name }}</td>
                                            <td>{{ $close->title }}</td>
                                            <td>{{ $close->subject->name }}</td>
                                            <td>{{ $close->status }}</td>
                                            @can('grievance_solution_edit')
                                            <td>
                                                <a href="{{ route('admin.viewgrievance',encrypt($close->id)) }}" style="border: none; background: none; padding: 0; margin: 0; font-size:15px; color:blue;" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                            @endcan
                                            <td>{{ $close->created_at }}</td>
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
                                {!! $closegrievance->links('pagination::bootstrap-5') !!}
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
@endsection