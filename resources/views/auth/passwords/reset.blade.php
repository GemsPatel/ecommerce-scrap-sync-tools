<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <!-- External CSS -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/fonts/font-awesome/css/font-awesome.min.css')}}">

    <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="96x96" href="{{asset('public/images/favicon-96x96.png')}}">
 
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/login.css')}}">

</head>

<style>
.invalid-feedback{
	display: block;
    float: left;
    padding-bottom: 10px;
}
</style>

<body>

<!-- Loader -->
<div class="loader"><div class="loader_div"></div></div>  

<!-- Login page -->
<div class="login_wrapper">
    <div class="container">
        <div class="col-md-12 pad-0">
            <div class="row login-box-12">
            	<!--<div class="col-lg-5 col-md-12 col-sm-12 px-0">
                	<div class="login_right">
	                    <a href="#" class="logo_text">
	                        <img src="{{asset('public/images/logo.png')}}"/>
	                    </a>
	                    <p>Connect apps and automate your eCommerce business</p>
	                    <a href="#" target="_blank" class="btn-outline">Read More</a>
	                    <ul class="social-list clearfix">
	                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
	                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
	                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
	                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
	                    </ul>
	                </div>
                </div>-->
                <div class="col-lg-12 col-sm-12">
                    <div class="login-inner-form">
                        <div class="details">
						
							<a href="#" >
								<img src="{{asset('public/images/181030_site_logo.png')}}" style="width: 200px;"/>
								<br/>
								<br/>
							</a>
						
                            <h3>Reset <span>your password</span></h3>
							
							 @if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif
							
                            <form method="POST" action="{{ route('password.update') }}">
							  @csrf
							  <input type="hidden" name="token" value="{{ $token }}">
							  
                                <div class="form-group">
                                   <input id="email" type="email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required  placeholder="Email Address" autofocus>

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									
									
                                </div>
								
								 <div class="form-group">
                                    <input id="password" type="password" class="input-text @error('password') is-invalid @enderror" name="password" required  placeholder="New Password" autofocus>

									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								 </div>
								
								 <div class="form-group">
								 
                                   <input id="password-confirm" type="password" class="input-text" name="password_confirmation" required placeholder="Confirm Password">
									
									
                                </div>
								
								
                                <div class="form-group">
                                    <button type="submit" class="btn-md btn-theme btn-block">RESET PASSWORD</button>
                                </div>
								
                            </form>
                            <p>Already a member?<a href="{{ route('login') }}"> Login here</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- /. Login page -->

<!-- External JS libraries -->
<script src="{{asset('public/assets/js/jquery-2.2.0.min.js')}}"></script>
<script src="{{asset('public/assets/js/popper.min.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
<!-- Custom JS Script -->


<script type="text/javascript">
    $(window).load(function() {
        // Animate loader off screen
        $(".loader").fadeOut("slow");;
    });
</script>

</body>

</html>