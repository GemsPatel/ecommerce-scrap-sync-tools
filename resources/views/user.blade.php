<!DOCTYPE html>
<html dir="ltr" lang="en">


@section('title')
Manage Users
@endsection
@include('include.header_css')

<body>


<input type="hidden" name="org_id" id="org_id">


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
                        <h4 class="page-title">Manage Users</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
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
                <!-- Content -->
                <!-- ============================================================== -->
                <div class="card-group">
                    <div class="card">
                        
						
						@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
						@endif
						
						
                            <div class="row">
								<div class="col-12">
									
							
									<div class="card-content collapse show">
										<div class="card-body">
										<div style="padding-bottom: 10px;float: right;">
										
										<a href="#" class="btn btn-success" data-toggle="modal" id="AddNewUser" data-target="#AddNewUserModal">
											<i class="fa fa-user-plus"></i> Add New User
										</a>
										</div>
										
											<div class="table-responsive">
												<table class="table table-striped table-bordered bootstrap-3" style="width:100% !important">
													<thead>
														<tr>
															<th>#</th>
															<th>Name</th>
															<th>Email</th>
															<th>Permission Access</th>
															<th>Status</th>
															<th>Created At</th>
															
															<th>Action</th>
														</tr>
													</thead>
													
												</table>
											</div>
										</div>
									</div>
									
								</div>
								<!-- Basic Tables end -->
							</div>
							
	
	
	
                      
                    </div>
                    <!-- Column -->
                    
                   
                   
                </div>
                <!-- ============================================================== -->
                <!-- Content -->
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
		
<!-- Modal -->
<div class="modal animated pulse text-left" id="AddNewUserModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#16181d">
				<h3 class="modal-title" style="color:#dbdbdb">Add New User</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:#dbdbdb">&times;</span>
				</button>
			</div>
			<form role="form" id="add_user">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				<div class="modal-body">
					<label>Name <span class="text-danger">*</span> : </label>
					<div class="form-group position-relative has-icon-left">
						<input type="text" class="form-control" id="name" name="name" placeholder="Name">
						<div class="form-control-position">
							<i class="la la-user font-medium-5 line-height-1 text-muted icon-align"></i>
						</div>
						<small class="text-danger animated name fadeInUp add_user"></small>
					</div>
					
					<label>Email <span class="text-danger">*</span> : </label>
					<div class="form-group position-relative has-icon-left">
						<input type="text" class="form-control" id="email" name="email"  placeholder="Email">
						<div class="form-control-position">
							<i class="la la-envelope font-medium-5 line-height-1 text-muted icon-align"></i>
						</div>
						<small class="text-danger animated email fadeInUp add_user"></small>
					</div>
					
					<label>Permission Access <span class="text-danger">*</span> : </label>
					<div class="form-group position-relative has-icon-left">
						<input type="radio" value="0" id="user_rad" name="accesstype" checked> User
						<input type="radio" value="1"  id="admin_rad" name="accesstype" > Admin
						
					</div>
					
				
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-danger" data-dismiss="modal" value="Close">
					<input type="submit" class="btn btn-success AddButton" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal animated pulse text-left" id="EditUserModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#16181d">
				<h3 class="modal-title" style="color:#dbdbdb">Edit User</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:#dbdbdb">&times;</span>
				</button>
			</div>
			<form role="form" id="edit_user">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="user_id" id="user_id">
				<div class="modal-body">
					<label>Name <span class="text-danger">*</span> : </label>
					<div class="form-group position-relative has-icon-left">
						<input type="text" class="form-control" id="edit_name" name="name" placeholder="Name">
						<div class="form-control-position">
							<i class="la la-user font-medium-5 line-height-1 text-muted icon-align"></i>
						</div>
						<small class="text-danger animated edit_name fadeInUp edit_user"></small>
					</div>
					
					<label>Email <span class="text-danger">*</span> : </label>
					<div class="form-group position-relative has-icon-left">
						<input type="text" class="form-control" id="edit_email" name="email"  placeholder="Email">
						<div class="form-control-position">
							<i class="la la-envelope font-medium-5 line-height-1 text-muted icon-align"></i>
						</div>
						<small class="text-danger animated edit_email fadeInUp edit_user"></small>
					</div>
					
					
					<label>Permission Access <span class="text-danger">*</span> : </label>
					<div class="form-group position-relative has-icon-left">
						<input type="radio" value="0" id="e_user_rad" name="accesstype" checked> User
						<input type="radio" value="1"  id="e_admin_rad" name="accesstype" > Admin
						
					</div>
					
					
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-danger" data-dismiss="modal" value="Close">
					<input type="submit" class="btn btn-success EditButton" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>
		
		
		
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
 
    <!-- ============================================================== -->
  
    @include('include.footer_js')
   
</body>


<script>
	(function(window, document, $) {
		'use strict';
		
		$('.bootstrap-3').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: "{{route('user-list')}}",
				type: 'GET',
			},
			"columns": [ 
			{"data": "id", render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{"data": "name", "bSortable":true},  
			{"data": "email", "bSortable":true},
			{"data": "access_type", "bSortable":true},
			{"data": "status", "bSortable":true},
			{"data": "created_at", "bSortable":true},
			{"data": "action", "bSortable":false}
			],
			"order": [[ 5, 'desc' ]]
		});
		
		$('#AddNewUserModal').on('show.bs.modal', function() {
			$('.add_user').html('');
			$('#name').val('');
			$('#email').val('');
			$('#password').val('');
			$('#confirm_password').val('');
			$('#no_lazada_account').val(1);
		});
		
		$("#add_user").on("submit", function( event ) {
			event.preventDefault();
			
			$(".AddButton").prop('disabled', true);
			$('.add_user').html('');
			var data=$(this).serialize();
			$('.loaderAjax').css('display', 'block');
			$.ajax({
				url: "{{ URL('user-add') }}",
				type:'POST',
				data: data,
				success: function(data) {
					$(".AddButton").prop('disabled', false);
					$('#AddNewUserModal').modal('hide');
					swal('Added!', 'New user added successfully.', 'success');
					$('.bootstrap-3').DataTable().ajax.reload();
					$('.loaderAjax').css('display', 'none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					$.each( XMLHttpRequest.responseJSON, function( key, value ) {
						if(key == 'errors')
						{
							$.each(value, function( key1, value1 ) {
								$("."+key1).html(value1);
							});
						}
					});
					$(".AddButton").prop('disabled', false);
					$('.loaderAjax').css('display', 'none');
				}       
			});
		});
		
		$(document.body).on('click', '.deleteUser', function() {
			var id = $(this).data('id'); 
			
			
			swal({
				title: "Are you sure?",
				text: "You want to delete this user account!",
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Yes, delete it!",   
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			})
			.then((willDelete) => {
				//console.log(willDelete);
				//alert(willDelete.value);
				if (willDelete.value) 
				{
					
					$('.loaderAjax').css('display', 'block');
					$.get("{{ URL('user-delete') }}",{'id':id}).then(function(response){
						swal('Deleted!', 'User account deleted successfully.', 'success');
						$('.loaderAjax').css('display', 'none');
						$('.bootstrap-3').DataTable().ajax.reload();
					});
					
				} 
			});
				
			
	
			
			
		});
		
		$(document.body).on('click', '.editUser', function() {
			var id = $(this).data('id');
			$('.edit_user').html('');
			$('.loaderAjax').css('display', 'block');
			$.get("{{ URL('user-edit') }}", {'id':id}, function(data, status){
				$('#user_id').val(data.id);
				$('#edit_name').val(data.name);
				$('#edit_email').val(data.email);
				if(data.access_type==1){
					$("#e_admin_rad").prop("checked", true);
				}else{
					$("#e_user_rad").prop("checked", true);
				}
			
				//$('#edit_no_lazada_account').val(data.no_of_lazada_account);
				$(".EditButton").prop('disabled', false);
				$('#EditUserModal').modal('show');
				$('.loaderAjax').css('display', 'none');
			});
		});
		
		$("#edit_user").on("submit", function( event ) {
			event.preventDefault();
			
			$(".EditButton").prop('disabled', true);
			$('.edit_user').html('');
			var data=$(this).serialize();
			$('.loaderAjax').css('display', 'block');
			$.ajax({
				url: "{{ URL('user-update') }}",
				type:'POST',
				data: data,
				success: function(data) {
					$(".EditButton").prop('disabled', false);
					$('#EditUserModal').modal('hide');
					swal('Updated!', 'User account updated successfully.', 'success');
					$('.bootstrap-3').DataTable().ajax.reload();
					$('.loaderAjax').css('display', 'none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					$.each( XMLHttpRequest.responseJSON, function( key, value ) {
						if(key == 'errors')
						{
							$.each(value, function( key1, value1 ) {
								$(".edit_"+key1).html(value1);
							});
						}
					});
					$(".EditButton").prop('disabled', false);
					$('.loaderAjax').css('display', 'none');
				}       
			});
		});
		
	
		
	})(window, document, jQuery);
</script>

</html>