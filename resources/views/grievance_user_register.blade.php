@extends('frontend.layout.main')
@section('title', 'User Registration')
<style>

</style>
@section('content')
    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Grievance User Register</h4>
                    </div>


                    <div class="card-body">
                        <form class="form" action="{{ route('user-login.postusergrievance') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">Select User Type<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        {{-- <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname-column" /> --}}
                                        <select name="user_type" class="form-control" id="user_type">
                                            <option value="">user type</option>
                                            @foreach ($user_type as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_type')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label unicode" for="first-name-column">Adsmn./Reg./Roll<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="text" id="unicode" class="form-control" placeholder=""
                                            name="unicode" />
                                        @error('unicode')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">First Name<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="text" id="first-name-column" class="form-control"
                                            placeholder="First Name" name="fname" />
                                        @error('fname')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last-name-column">Last Name<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="text" id="last-name-column" class="form-control"
                                            placeholder="Last Name" name="lname" />
                                            @error('lname')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last-name-column">Gender<sup
                                                style="color:red;font-size:15px">*</sup></label><br />
                                        <input type="radio" id="last-name-column" value="male" name="gender" />Male
                                        <input type="radio" value="female" name="gender" /> Female
                                        <input type="radio" value="other" name="gender" /> Other
                                        @error('gender')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <div class="mb-1">
                                            <label class="form-label" for="email-id-column">Email<sup
                                                    style="color:red;font-size:15px">*</sup></label>
                                            <input type="email" id="email-id-column" class="form-control" name="email"
                                                placeholder="Email" />
                                                @error('email')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="country-floating">Mobile<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="text" id="country-floating" class="form-control" name="mobile"
                                            placeholder="Mobile" />
                                            @error('mobile')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="country-floating">Password<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="password" id="country-floating" class="form-control" name="password"
                                            placeholder="password" />
                                            @error('password')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="company-column">Confirm Password<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="password" id="company-column" class="form-control"
                                            name="confirm_password" placeholder="Confirm Password" />
                                            @error('confirm_password')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-column">Course<sup
                                                style="color:red;font-size:15px">*</sup></label>
                                        <input type="text" id="email-id-column" class="form-control" name="course"
                                            placeholder="Course" />
                                            @error('course')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-column">Year/Semester</label>
                                        <input type="text" id="email-id-column" class="form-control"
                                            name="year_semester" placeholder="Year/Semester" />
                                            @error('year_semester')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-column">Course Complete Date</label>
                                        <input type="date" id="email-id-column" class="form-control"
                                            name="course_complete_date" placeholder="Course Complete Date" />
                                            @error('course_complete_date')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Floating Label Form section end -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // alert("gjhhj");
        $('#user_type').on('change', function() {
            // Get the current value of the input field
            var inputValue = $(this).val();
            if (inputValue == 3) {
                $('.unicode').text('Addmission No.');
            } else if (inputValue == 5 || inputValue == 6) {
                $('.unicode').text('Employee No.');

            } else if (inputValue == 4) {
                $('.unicode').text('Registration No.');

            }
            // Display the value in the output paragraph
            // $('.unicode').text('You typed: ' + inputValue);
        });
    });
</script>
