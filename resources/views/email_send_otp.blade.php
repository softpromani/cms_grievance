@extends('frontend.layout.main')
<style>

</style>
@section('content')
<!-- create API key -->
<!-- BEGIN: Content-->

        <section>
            <div class="card">
                <div class="card-header pb-0">
                  <h4 class="card-title">Notification</h4>
                </div>
                <div class="row">
                  <div class="col-md-5 order-md-0 order-1">
                    <div class="card-body">
                      <!-- form -->
                      <form id="EmailVerify"  onsubmit="return false">
                        @csrf
                        <div class="input-group email">
                          <input type="email" class="form-control " name="email" placeholder="Enter Email Address" aria-describedby="button-addon2" />
                          <button class="btn btn-outline-primary" id="submitBtn" type="submit">send OTP</button>
                      </div>
                      </form>
                      <form action="{{route('user-login.emailotpverify')}}" method="post">
                        @csrf
                      <div class="otp"></div>
                    </div>
                      </form>
                      {{-- otp form --}}
                     
                  </div>
                  <div class="col-md-7 order-md-1 order-0">
                    <div class="text-center">
                      <img
                        class="img-fluid text-center"
                        src="../../../app-assets/images/illustration/pricing-Illustration.svg"
                        alt="illustration"
                        width="310"
                      />
                    </div>
                  </div>
                </div>
            </div>
            
        </section>
   


  <!-- api key list -->
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