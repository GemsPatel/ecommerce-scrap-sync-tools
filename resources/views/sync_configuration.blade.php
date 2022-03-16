<!DOCTYPE html>
<html dir="ltr" lang="en">
@section('title')
Sync Configuration
@endsection
@include('include.header_css')
<style>
	.frmSearch {
		border: 1px solid #a8d4b1;
		background-color: #c6f7d0;
		margin: 2px 0px;
		padding: 40px;
		border-radius: 4px;
	}
	#country-list {
		float: left;
		list-style: none;
		margin-top: -3px;
		padding: 0;
		width: 305px;
		position: absolute;
	}
	#country-list li {
		padding: 4px;
		background: #f0f0f0;
		border-bottom: #bbb9b9 1px solid;
		font-size: 12px;
	}
	#country-list li:hover {
		background: #ece3d2;
		cursor: pointer;
	}
	#search-box {
		padding: 4px;
		border: #a8d4b1 1px solid;
		border-radius: 4px;
	}
	.empty_inp {
		border: 1px solid red !important;
	}
	.select2 {
		width: 100% !important;
	}
	.custom-control-label,
	.control-label {
		font-weight: normal
	}
	.toggle.btn {
		min-width: 60px;
		min-height: 30px;
		border-radius: 20px;
		margin-left: 14px;
	}
	.checkbox-inline .toggle {
		margin-left: 10px !important;
		margin-right: 5px;
	}
	.show_hide {
		display: none;
	}
	.select2-selection--multiple {
		overflow: hidden !important;
		height: auto !important;
	}
	.card-title {
		font-size: 16px !important;
	}
</style>
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
						<h4 class="page-title">Sync Configuration</h4>
					</div>
					<div class="col-7 align-self-center">
						<div class="d-flex align-items-center justify-content-end">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="#">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Sync Configuration</li>
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

				@if(session()->has('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<i class="fa fa-check-circle"></i> <small>{{ session()->get('success') }}</small>
				</div>
				@endif
				@if(session()->has('error'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<i class="fa fa-warning"></i> <small>{{ session()->get('error') }}</small>
				</div>
				@endif
				<!-- ============================================================== -->
				<!-- Sales chart -->
				<!-- ============================================================== -->
				<div class="card-group">
					<div class="card">
						<!--<div class="card-body">-->
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item"> <a class="nav-link active" id="product-tab" data-toggle="tab"
											href="#orders" role="tab" aria-controls="orders" aria-expanded="true"><span
												class="hidden-sm-up"><i class="mdi mdi-cart-outline"></i></span> <span
												class="hidden-xs-down">Product</span></a> </li>
								</ul>
								<div class="tab-content tabcontent-border p-20" id="myTabContent">
									<!-- ============================================================== -->
									<!-- Product Setting tab -->
									<!-- ============================================================== -->
									<div role="tabpanel" class="tab-pane fade show active" id="orders"
										aria-labelledby="product-tab">
										<p>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<form class="needs-validation form-horizontal save_order_form"
														novalidate action="{{route('save-product-setting')}}"
														method="POST">
														<input type="hidden" id="hidden_organization_id"
															value="{{Auth::user()->org_id}}" />
														@csrf
														{{-- Form Actions --}}
														@if($bp_account->status===1)
														<div class="card-body">
															<div class="action-form">
																<div class="form-group m-b-0 text-left">
																	<button type="submit"
																		class="btn btn-success bp_order_save_button"> <i
																			class="fa fa-check"></i>
																		Save</button>
																	<button type="reset"
																		class="btn btn-dark">Cancel</button>
																	<button type="button" data-toggle="tooltip" data-placement="top"
																		title="This process will reset all existing records and restart initial sync process again."
																		class="btn btn-info restart_product_sync"
																		style="float:right;"> <i
																		class="mdi mdi-reload"></i> Restart Product Sync
																	</button>
																</div>
															</div>
														</div>
														<hr>
														@endif
														<div class="card-body">

															<div class="tab-content tabcontent-border">
																{{-- Products --}}
																<div class="tab-pane p-20 active" id="products" role="tabpanel">

																	{{-- Enable product sync --}}
																	<div class="card-body">
																		<div class="row">
																			<div class="col-md-5">
																				<div class="custom-control custom-checkbox"
																					style="margin-bottom: 20px;">
																					<input type="checkbox"
																						class="custom-control-input allow_product_sync"
																						name="allow_product_sync" id="allow_product_sync"
																						{{$product->allow_product_sync=="1"?'checked':''}}
																					value="1"
																					data-fulfillment="{{$product->allow_product_sync}}"
																					>
																					<label class="custom-control-label"
																						for="allow_product_sync" style="font-size: 15px;">
																						Enable Product Sync <span
																							class="badge badge-pill badge-info ml-auto m-r-15"
																							data-toggle="tooltip" data-placement="top"
																							title="Enable or Disable Product sync through this switch">?</span>
																					</label>
																					<small id="error_allow_product_sync"></small>
																				</div>
																			</div>
																		</div>
																	</div>
																	<hr>

																	{{-- Unique key map --}}
																	<div class="card-body">
																		<h4 class="card-title">Map Unique key of Shopify Products to Brightpearl
																			Products
																			<span class="badge badge-pill badge-info ml-auto m-r-15" data-toggle="tooltip"
																				data-placement="top"
																				title="Please select a unique key of Product that you maintain in both the systems to match it between the platforms.">?</span>
																		</h4>
																		<div class="form-group row">
																			<label for="matchedby" class="col-sm-3 control-label col-form-label">Match
																				By</label>
																			<div class="col-sm-4">
																				<div class="form-group">
																					<label for="bp_product_unique_map"
																						class="control-label col-form-label">Brightpearl Product Fields
																						<span class="text-danger">*</span>
																					</label>
																					<select class="form-control select2 bp_product_unique_map"
																						name="bp_product_unique_map" id="bp_product_unique_map" required>
																						{!! $bp_fields_sku !!}
																					</select>
																					<input type="hidden" class="bp_product_unique_map_hidden"
																						value="{{ isset($product->bp_product_unique_map) ? $product->bp_product_unique_map : '' }}" />
																				</div>
																			</div>
																			<div class="col-sm-4">
																				<div class="form-group">
																					<label for="sf_product_unique_map"
																						class=" control-label col-form-label">Shopify POS Product Fields
																						<span class="text-danger">*</span>
																					</label>
																					<select class="form-control select2 sf_product_unique_map"
																						name="sf_product_unique_map" id="sf_product_unique_map" required>
																						{!! $sf_fields_sku !!}
																					</select>
																					<input type="hidden" class="sf_product_unique_map_hidden"
																						value="{{ isset($product->sf_product_unique_map) ? $product->sf_product_unique_map : '' }}" />
																				</div>
																			</div>
																		</div>
																	</div>
																	<hr>

																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
										</p>
									</div>
									<!-- ============================================================== -->
									<!-- End Product Setting tab -->
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
	$('.allow_product_sync').change(function() {
		if ($(this).prop('checked')) {
			$('.allow_product_sync').attr('value', 1);
			$('.dv_order_conf').css('display','block');
		} else {
			$('.allow_product_sync').attr('value', 0);
			$('.dv_order_conf').css('display','none');
		}
	});

	function scrolltoTop(element){
		var targetOffset = element.offset().top - $(".topbar").outerHeight(true);
			$('html, body').animate({
			scrollTop: targetOffset
			}, 'slow');
	}

	$(".bp_order_save_button").click(function(e) {
		var vald =  validateMyForm_order();
		if(vald==false){
			e.preventDefault();
		}
	});

	function validateMyForm_order() {
		var flag = false;
		if ($('#start_order_id_for_sync_order').val() == "") {
			flag = true;
			//toastr.error('Please Add Start Order ID','',options);
			toastr.error('Please Add Start Order ID');
			$('#error_start_order_id_for_sync_order').empty().text('Please fill the value').css('color', 'red');
		}else if ($('#default_brightpearl_channel').val() == "") {
			flag = true;
			toastr.error('Please select brightpearl channel name');
			$('#error_channel').empty().text('Please fill the value').css('color', 'red');
		} else if($('#default_brightpearl_tax_id').val()==""){
			flag = true;
			toastr.error('Please select brightpearl default Tax');
			$('#error_default_brightpearl_tax_id').empty().text('Please fill the value').css('color', 'red');
		} else if ($('#brightpearl_warehouse_id').val() == "") {
			flag = true;
			toastr.error('Please select brightpearl default warehouse name');
			$('#error_warehouse').empty().text('Please fill the value').css('color', 'red');
		} else if ($('#default_brightpearl_order_status').val() == "") {
			flag = true;
			toastr.error('Please select brightpearl order status');
			$('#error_default_brightpearl_order_status').empty().text('Please fill the value').css('color', 'red');
		} else if ($('#default_bp_cancelled_order_status').val() == "") {
			flag = true;
			toastr.error('Please select brightpearl default cancelled order status');
			$('#error_cancelled_order').empty().text('Please fill the value').css('color', 'red');
		} else if ($('#default_bp_order_edit_status').val() == "") {
			flag = true;
			toastr.error('Please select brightpearl default order edit status');
			$('#error_order_edit_status').empty().text('Please fill the value').css('color', 'red');
		}/* else if ($('#default_bp_product_brand_id').val() == "") {
			flag = true;
			toastr.error('Please select brightpearl default product brand','',options);
			$('#error_product_brand').empty().text('Please fill the value').css('color', 'red');
		}*/
		if (!flag) {
			return true;
		} else {
			return false;
		}
	}

	$(".restart_product_sync").click(function(e) {
		if (confirm('Are you sure you want to restart product sync?')) {
			$.ajax({
				type: 'POST',
				url: "{{url('/restartProductSync')}}",
				dataType:'json',
				data: {
					'_token': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function() {
					showOverlay();
				},
				success: function(response) {
				hideOverlay();
					if (response.status_code === 1) {
						toastr.success(response.status_text);
					} else {
						toastr.error(response.status_text);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					hideOverlay();
					if (jqXHR.status == 500) {
					toastr.error('Internal error: ' + jqXHR.responseText);
					} else {
					toastr.error('Unexpected error Please try again.');
					}
				}
			});
		} /*else {
			toastr.warning('Product sync restart process is cancelled.');
		}*/
	});
/***************************************************** ENd ORder Settings ****************************/
</script>
</html>