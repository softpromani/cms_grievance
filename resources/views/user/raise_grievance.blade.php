@extends('frontend.layout.user_main')
<style>

</style>
@section('content')
    <!-- Browser States Card -->
    <section>
        <div class="row">
            {{-- <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-browser-states">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">Browser States</h4>
                            <p class="card-text font-small-2">Counter August 2020</p>
                        </div>
                        <div class="dropdown chart-dropdown">
                            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Last 28 Days</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="browser-states">
                            <div class="d-flex">
                                <img src="../../../app-assets/images/icons/google-chrome.png" class="rounded me-1"
                                    height="30" alt="Google Chrome" />
                                <h6 class="align-self-center mb-0">Google Chrome</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="fw-bold text-body-heading me-1">54.4%</div>
                                <div id="browser-state-chart-primary"></div>
                            </div>
                        </div>
                        <div class="browser-states">
                            <div class="d-flex">
                                <img src="../../../app-assets/images/icons/mozila-firefox.png" class="rounded me-1"
                                    height="30" alt="Mozila Firefox" />
                                <h6 class="align-self-center mb-0">Mozila Firefox</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="fw-bold text-body-heading me-1">6.1%</div>
                                <div id="browser-state-chart-warning"></div>
                            </div>
                        </div>
                        <div class="browser-states">
                            <div class="d-flex">
                                <img src="../../../app-assets/images/icons/apple-safari.png" class="rounded me-1"
                                    height="30" alt="Apple Safari" />
                                <h6 class="align-self-center mb-0">Apple Safari</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="fw-bold text-body-heading me-1">14.6%</div>
                                <div id="browser-state-chart-secondary"></div>
                            </div>
                        </div>
                        <div class="browser-states">
                            <div class="d-flex">
                                <img src="../../../app-assets/images/icons/internet-explorer.png" class="rounded me-1"
                                    height="30" alt="Internet Explorer" />
                                <h6 class="align-self-center mb-0">Internet Explorer</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="fw-bold text-body-heading me-1">4.2%</div>
                                <div id="browser-state-chart-info"></div>
                            </div>
                        </div>
                        <div class="browser-states">
                            <div class="d-flex">
                                <img src="../../../app-assets/images/icons/opera.png" class="rounded me-1" height="30"
                                    alt="Opera Mini" />
                                <h6 class="align-self-center mb-0">Opera Mini</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="fw-bold text-body-heading me-1">8.4%</div>
                                <div id="browser-state-chart-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class=" col-lg-12 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Raise Grievance</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('user-login.raisegrievance') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basicSelect">Subject</label>
                                        <select class="form-select" id="basicSelect" name="subject">
                                            <option value="">-- Grievance Subject --</option>
                                            @foreach ($grievance_subject as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last-name-column">
                                            Title</label>
                                        <input type="text" id="last-name-column" class="form-control" placeholder="Title"
                                            name="title" value="{{ old('title') }}" />
                                        @error('title')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last-name-column">Choose File</label>
                                        <input type="file" id="" class="form-control" placeholder=""
                                            name="raise_file" value="{{ old('raise_file') }}" />
                                        {{-- @error('raise_file')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="form-floating mb-0">
                                        <textarea data-length="200" class="form-control char-textarea" name="message" id="textarea-counter" rows="3"
                                            placeholder="Message" style="height: 100px">{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="textarea-counter">Message</label>
                                    </div>
                                    <small class="textarea-counter-value float-end"><span class="char-count">0</span> /
                                        200
                                    </small>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1">Raise</button>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row">

        </div>
    </section>
    <!-- Basic Floating Label Form section end -->



    <!--/ Browser States Card -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
