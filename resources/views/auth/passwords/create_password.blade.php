<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BigConnect</title>
    <!-- External CSS -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/fonts/font-awesome/css/font-awesome.min.css')}}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/images/fev.png')}}">
 
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
            	<div class="col-lg-5 col-md-12 col-sm-12 px-0">
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
                </div>
                <div class="col-lg-7 col-sm-12">
                    <div class="login-inner-form">
                        <div class="details">
                            <h3>Create <span>your password</span></h3>
							
							 @if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif
							@if (session('error_msg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_msg') }}
						</div>
						@endif
							
                            <form method="POST" action="{{ route('save-new-password') }}">
							  @csrf
							  <input type="hidden" id="HdToken" name="HdToken" value= "<?php echo \Request::segment(2); ?>"/>
							  
                                <div class="form-group">
                                   <input id="email" type="email" class="input-text @error('email') is-invalid @enderror" name="email"  required  placeholder="Email Address" value="<?php echo $arr_users[0]->email; ?>" readonly autofocus>

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
                                   <input id="confirm_password" type="password" class="input-text @error('confirm_password') is-invalid @enderror" name="confirm_password" required placeholder="Confirm Password">
									@error('confirm_password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								
									@enderror
                                </div>
								
								
                                <div class="form-group">
                                    <button type="submit" class="btn-md btn-theme btn-block">CREATE PASSWORD</button>
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