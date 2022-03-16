<!DOCTYPE html>
<html dir="ltr" lang="en">
@section('title')
Settings
@endsection
@include('include.header_css')
<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		@include('include.header')
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-5 align-self-center">
						<h4 class="page-title">Settings</h4>
					</div>
					<div class="col-7 align-self-center">
						<div class="d-flex align-items-center justify-content-end">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="#">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Settings</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Container fluid  -->
			<!-- ============================================================== -->
			<div class="container-fluid">
				<!-- ============================================================== -->
				<!-- Sales chart -->
				<!-- ============================================================== -->
				<div class="card-group">
					<div class="card">
						<!--<div class="card-body">-->
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab"
											href="#home5" role="tab" aria-controls="home5" aria-expanded="true"><span
												class="hidden-sm-up"><i class="mdi mdi-lock"></i></span> <span
												class="hidden-xs-down">API Settings</span></a> </li>
									{{-- <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab"
											href="#profile5" role="tab" aria-controls="profile"><span
												class="hidden-sm-up"><i class="mdi mdi-email"></i></span> <span
												class="hidden-xs-down">Email Notifications</span></a></li> --}}
								</ul>
								<div class="tab-content tabcontent-border p-20" id="myTabContent">
									<!-- ============================================================== -->
									<!-- API Setting tab -->
									<!-- ============================================================== -->
									<div role="tabpanel" class="tab-pane fade show active" id="home5"
										aria-labelledby="home-tab">
										<p>
										<div class="card-body">
											@php
												$domain = "";
												$access_token = "";
												$is_connected = 0;
												if($shopify_account_details){
													$domain = base64_decode($shopify_account_details->domain);
													$access_token = base64_decode($shopify_account_details->access_token);
													$is_connected = 1;
												}
											@endphp
											<div class="card-title">
												<img src="{{asset('public/images/shopify.png')}}" style="width:75px;"
													class="float-right mt-10 img-fluid">
											</div>
											<h4 class="card-title">Shopify Account - <span
													class="badge badge-pill badge-info ml-auto m-r-15"
													data-toggle="tooltip" data-placement="top" title=""
													data-original-title="Please fill the below field details for Shopify account connection.">?</span>
												@if($is_connected==1)
												<span class="badge badge-pill badge-success"><i class="fa fa-check"></i>
													Connected</span>
												@else
												<span class="badge badge-pill badge-danger"><i class="fa fa-times"></i>
													Not Connected</span>
												@endif
											</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Shopify Domain <span
																class="text-danger">*</span></label>
														<input type="text" class="form-control bp_text"
															name="shopify_domain" id="shopify_domain"
															value="{{ $domain }}" required @if($is_connected==1)
															disabled @endif>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Shopify Access Token <span
																class="text-danger">*</span></label>
														<input type="password" class="form-control bp_text"
															name="shopify_access_token" id="shopify_access_token"
															value="{{ $access_token }}" required @if($is_connected==1)
															disabled @endif>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														@if($is_connected==1)
														<button type="submit" class="btn btn-danger"
															id="shopify_disconnect_btn"> <i class="fa fa-times"></i>
															Disconnect</button>
														@else
														<button type="submit" class="btn btn-success"
															id="shopify_save_btn"> <i class="fa fa-check"></i>
															Connect</button>
														@endif
													</div>
												</div>
											</div>
											<hr>
										</div>
										<div class="card-body">
											@php
											$bp_app_ref = "";
											$bp_account_name = "";
											$bp_account_token = "";
											$is_connected = 0;
											if($bp_account_details){
											$bp_app_ref = base64_decode($bp_account_details->app_id);
											$bp_account_name = $bp_account_details->account_name;
											$bp_account_token = base64_decode($bp_account_details->app_secret);
											$is_connected = 1;
											}
											@endphp
											<div class="card-title">
												<img src="{{asset('public/images/bp.png')}}" style="width:103px;"
													class="float-right mt-10 img-fluid">
											</div>
											<h4 class="card-title">Brightpearl Account - <span
													class="badge badge-pill badge-info ml-auto m-r-15"
													data-toggle="tooltip" data-placement="top" title=""
													data-original-title="Please fill the below field details for Brightpearl account connection.">?</span>
												@if($is_connected==1)
												<span class="badge badge-pill badge-success"><i class="fa fa-check"></i>
													Connected</span>
												@else
												<span class="badge badge-pill badge-danger"><i class="fa fa-times"></i>
													Not Connected</span>
												@endif
											</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Brightpearl App Ref <span
																class="text-danger">*</span></label>
														<input type="text" class="form-control bp_text"
															name="bp_app_ref" id="bp_app_ref"
															value="<?php echo $bp_app_ref;?>" required
															@if($is_connected==1) disabled @endif>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Brightpearl Account Name <span
																class="text-danger">*</span></label>
														<input type="text" class="form-control bp_text"
															name="bp_account_name" id="bp_account_name"
															value="<?php echo $bp_account_name;?>" required
															@if($is_connected==1) disabled @endif>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Brightpearl Account Token <span
																class="text-danger">*</span></label>
														<input type="password" class="form-control bp_text"
															name="bp_account_token" id="bp_account_token"
															value="<?php echo $bp_account_token;?>" required
															@if($is_connected==1) disabled @endif>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														@if($is_connected==1)
														<button type="submit" class="btn btn-danger"
															id="bp_disconnect_btn"> <i class="fa fa-times"></i>
															Disconnect</button>
														@else
														<button type="submit" class="btn btn-success" id="bp_save_btn">
															<i class="fa fa-check"></i> Connect</button>
														@endif
													</div>
												</div>
											</div>
											<hr>
										</div>
										</p>
									</div>
									<!-- ============================================================== -->
									<!-- End API Setting tab -->
									<!-- ============================================================== -->
								</div>
							</div>
							<!--</div>-->
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- Sales chart -->
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			@include('include.footer')
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	@include('include.footer_js')
</body>
<script>
	$(document).ready(function () {

		$("#shopify_save_btn").click(function (ep) {
			ep.preventDefault();
			var shopify_domain = $('#shopify_domain').val();
			var shopify_access_token = $('#shopify_access_token').val();
			if(shopify_domain=='' || shopify_access_token==''){
				swal('Failed!', 'Please fill all the mandatory fields', 'error');
				return;
			}
			$('.loaderAjax').css('display', 'block');
			$.ajax({
				type: 'post',
				url: "{{route('connectShopifyAccount')}}",
				data: { 'shopify_domain': shopify_domain, 'shopify_access_token': shopify_access_token, '_token' : "{{ csrf_token() }}"},
				success: function (res) {
					console.log(res.status_code);
					$('.loaderAjax').css('display', 'none');
					if(res.status_code == 0){
						swal('Failed!', res.status_text, 'error');
					}else{
						swal('Success!', res.status_text, 'success');
						setTimeout(function(){ location.reload(); }, 2000);
					}
				}
			});
		});

		$("#shopify_disconnect_btn").click(function (ep) {
				swal({
					title: "Are you sure?",
					text: "You want to disconnect this account!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Disconnect it!",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				})
				.then((willDelete) => {
					if (willDelete.value)
					{
						$('.loaderAjax').css('display', 'block');
						$.get("{{ URL('disconnectShopifyAccount') }}").then(function(response){
							swal('Success!', 'Account Disconnected Successfully.', 'success');
							$('.loaderAjax').css('display', 'none');
							location.reload();
						});
					}
				});
		});

		$("#bp_save_btn").click(function (ep) {
			ep.preventDefault();
			var bp_app_ref = $('#bp_app_ref').val();
			var bp_account_token = $('#bp_account_token').val();
			var bp_account_name = $('#bp_account_name').val();
			if(bp_app_ref=='' || bp_account_token=='' || bp_account_name==''){
				swal('Failed!', 'Please fill all the mandatory fields', 'error');
				return;
			}
			$('.loaderAjax').css('display', 'block');
			$.ajax({
				type: 'post',
				url: "{{route('connectBrightpearlAccount')}}",
				data: { 'bp_app_ref': bp_app_ref,'bp_account_token': bp_account_token,'bp_account_name': bp_account_name, '_token' : "{{ csrf_token() }}"},
				success: function (res) {
					$('.loaderAjax').css('display', 'none');
					if(res.status_code == 0){
						swal('Failed!', res.status_text, 'error');
					}else{
						swal('Success!', res.status_text, 'success');
						setTimeout(function(){ location.reload(); }, 2000);
					}
				}
			});
		});

		$("#bp_disconnect_btn").click(function (ep) {
				swal({
					title: "Are you sure?",
					text: "You want to disconnect this account!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Disconnect it!",
					cancelButtonText: "Cancel",
					closeOnConfirm: false,
					closeOnCancel: false
				})
				.then((willDelete) => {
					if (willDelete.value)
					{
						$('.loaderAjax').css('display', 'block');
						$.get("{{ URL('disconnectBrightpearlAccount') }}").then(function(response){
							swal('Success!', 'Account Disconnected Successfully.', 'success');
							$('.loaderAjax').css('display', 'none');
							location.reload();
						});
					}
				});
		});

	});
</script>
</html>