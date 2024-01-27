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
                                    <h4 class="card-title">Multiple Column</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name</label>
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="last-name-column">Last Name</label>
                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="city-column">City</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="City" name="city-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="country-floating">Country</label>
                                                    <input type="text" id="country-floating" class="form-control" name="country-floating" placeholder="Country" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="company-column">Company</label>
                                                    <input type="text" id="company-column" class="form-control" name="company-column" placeholder="Company" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Email</label>
                                                    <input type="email" id="email-id-column" class="form-control" name="email-id-column" placeholder="Email" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="reset" class="btn btn-primary me-1">Submit</button>
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
        $("#submitBtn").click(function() {
            var formData = $("#EmailVerify").serialize();
            var Url = "{{ route('user-login.emailverify') }}";
            $.ajax({
                url: Url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success, e.g., show a success message
                    console.log(response);
                    $('.otp').html(response.data);
                    $('.email').hide();
                    // $('.email').prop('disabled', true);
                },
                error: function(error) {
                    // Handle errors, e.g., display validation errors
                    console.log(error.responseJSON);
                }
            });
        });
    });
</script>