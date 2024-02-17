@extends('layout.main', ['breadcrumb_title' => 'View Grievance'])
@section('title', 'Grievance::view')
@section('content')

<div class=" row-12">
    <div class="card card-statistics">
        <div class="card-header">
            <h4 class="card-title">User Details</h4>
            
        </div>
        <div class="card-body statistics-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-info me-2">
                            <div class="avatar-content">
                                <i data-feather="user" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h5 class="fw-bolder mb-0">{{ $user->user_name }}</h5>
                            <p class="card-text font-small-3 mb-0">User Name</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-12 mb-2 mb-md-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-primary me-2">
                            <div class="avatar-content">
                                <i data-feather="at-sign" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h5 class="fw-bolder mb-0">{{ $user->email }}</h5>
                            <p class="card-text font-small-3 mb-0">Email</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-danger me-2">
                            <div class="avatar-content">
                                <i data-feather="smartphone" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h5 class="fw-bolder mb-0">{{ $user->mobile }}</h5>
                            <p class="card-text font-small-3 mb-0">Mobile</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mt-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-warning me-2">
                            <div class="avatar-content">
                                <i data-feather="key" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h5 class="fw-bolder mb-0">{{ $grievance->grievance_code }}</h5>
                            <p class="card-text font-small-3 mb-0">Grievance Token</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-12 mt-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-info me-2">
                            <div class="avatar-content">
                                <i data-feather="shield" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h5 class="fw-bolder mb-0">{{  $grievance->status  }}</h5>
                            <p class="card-text font-small-3 mb-0">Current Status</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mt-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-warning me-2">
                            <div class="avatar-content">
                                <i data-feather="calendar" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h5 class="fw-bolder mb-0">{{   $grievance->created_at->format('F j, Y h:i A') }}</h5>
                            <p class="card-text font-small-3 mb-0">Grievance Raise Date</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="basic-timeline">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $user->user_name }}</h4>
                </div>
                <div class="card-body" style="scrollbar-width: auto;height: 500px; overflow-y: scroll;">
                    <ul class="timeline">
                        @forelse ($tracking as $trk )
                        <li class="timeline-item">

                            @if ($trk->creatable_type == 'App\Models\GrievanceUser')
                            <span class="timeline-point timeline-point-danger">
                                <i data-feather="user"></i>
                            </span>
                            @elseif ($trk->creatable_type == 'App\Models\User')
                            <span class="timeline-point timeline-point-success">
                                <i data-feather="twitch"></i>
                            </span>
                            @endif
                           
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>{{ $trk->creatable->user_name }}</h6>
                                    <span class="timeline-event-time"> {{ $trk->created_at->format('F j, Y h:i A')}} , <b> {{  $trk->created_at->diffForHumans() }}</b></span>
                                </div>
                                <p>{{ $trk->message??'' }}</p>
                                @if ($trk->media)
                                
                                {{-- <a href="{{ asset('storage/'.$trk->media->file_path )}}" class="button" target="_blank"><i class="fa fa-download"></i>Download</a> --}}
                                <a class="btn btn-link p-0 grievance_file" style="display:inline" data-url="{{ isset($trk->media->file_path) ? asset('storage/'.$trk->media->file_path ) : '#' }}">
                                    <button type="button" class="btn btn-sm btn-primary">View</button>
                                </a>
                                @endif   
                            </div>
                        </li>
                        @empty
                        <p>No Message</p>
                    @endforelse
                    </ul>
                </div>
                <div>
                <form class="chat-app-form card-body" action="{{ route('admin.grievancequery') }}" enctype="multipart/form-data" method="post" style="display: {{ ($grievance->status == 'close') ? 'none' : '' }};">
                    @csrf
                <div class="row" style="position: sticky;">
                    <div class="col-7 me-1 mb-2 form-send-message">
                       <input type="text" class="form-control message @error('message') is-invalid @enderror " name="message" placeholder="Type your message "> 
                       @error('message')
                       <p class="error text-danger">{{ $message  }}</p>
                       @enderror
                       <input type="hidden" name="grievance_id" value="{{ $grievance->id }}">
                    </div>
                   
                    <div class="col-4">
                    <span class="input-group-text">
                        <label for="attach-doc" class="attachment-icon form-label mb-0">
                           <input type="file" id="attach-doc" name="file"> </label></span>
                    </div>  
                </div>     
                    <button type="submit" class="btn btn-primary send waves-effect waves-float waves-light" onclick="enterChat();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send d-lg-none"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        <span class="d-none d-lg-block">Send</span>
                    </button>
                
                </form>
            </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <object id="file_modal_object" type="application/pdf" width="100%" height="600px"></object>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondry" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.grievance_file', function() {
                var file_url = $(this).data('url');
                $('#file_modal_object').data('url', file_url);
                $('#fileModal').modal('show');
            });
            $('#fileModal').on('show.bs.modal', function() {
                var file_url = $('#file_modal_object').data('url');
                $('#file_modal_object').attr('data', file_url);
            });
            $('#fileModal').on('hidden.bs.modal', function() {
                location.reload(true); 

            });
        });
    </script>
   
@endsection