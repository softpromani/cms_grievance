@extends('frontend.layout.main')
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <form class="form" action="{{route('user-login.postusergrievance')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Select User Type<sup style="color:red;font-size:15px">*</sup></label>
                                                    {{-- <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname-column" /> --}}
                                                    <select name="user_type" class="form-control" id="user_type">
                                                        <option value="">user type</option>
                                                        @foreach ($user_type as $type )
                                                            <option value="{{$type->name}}">{{$type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-1">
                                                    <label class="form-label unicode" for="first-name-column">Adsmn./Reg./Roll<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="text" id="unicode" class="form-control" placeholder="" name="unicode" />
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="last-name-column">Last Name<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="last-name-column">Gender<sup style="color:red;font-size:15px">*</sup></label><br/>
                                                    <input type="radio" id="last-name-column" value="male" name="gender" />Male
                                                    <input type="radio"   value="female" name="gender" /> Female
                                                    <input type="radio"   value="other" name="gender" /> Other
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="email-id-column">Email<sup style="color:red;font-size:15px">*</sup></label>
                                                        <input type="email" id="email-id-column" class="form-control" name="email" placeholder="Email" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="country-floating">Mobile<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="text" id="country-floating" class="form-control" name="mobile" placeholder="Mobile" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="country-floating">Password<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="password" id="country-floating" class="form-control" name="password" placeholder="password" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="company-column">Confirm Password<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="password" id="company-column" class="form-control" name="confirm_password" placeholder="Confirm Password" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Course<sup style="color:red;font-size:15px">*</sup></label>
                                                    <input type="text" id="email-id-column" class="form-control" name="course" placeholder="Course" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Year/Semester</label>
                                                    <input type="text" id="email-id-column" class="form-control" name="year_semester" placeholder="Year/Semester" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Course Complete Date</label>
                                                    <input type="date" id="email-id-column" class="form-control" name="course_complete_date" placeholder="Course Complete Date" />
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
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
      // alert("gjhhj");
      $('#user_type').on('change', function() {
                // Get the current value of the input field
                var inputValue = $(this).val();
                if(inputValue=="student"){
                    $('.unicode').text('Addmission No.');
                }
                else if(inputValue=="teacher" || inputValue=="non-teacher" ){
                    $('.unicode').text('Employee No.');

                }
                else if(inputValue=="parent"){
                    $('.unicode').text('Registration No.');

                }
                // Display the value in the output paragraph
                // $('.unicode').text('You typed: ' + inputValue);
            });
    });
</script>