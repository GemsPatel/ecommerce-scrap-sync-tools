 <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('public/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('public/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <script src="{{asset('public/dist/js/app.min.js')}}"></script>
    <script src="{{asset('public/dist/js/app.init.js')}}"></script>
    <script src="{{asset('public/dist/js/app-style-switcher.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('public/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('public/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('public/dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->

	<script src="{{asset('public/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
	<script src="{{asset('public/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

	<script src="{{asset('public/assets/libs/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
	<script src="{{asset('public/assets/libs/toastr/build/toastr.min.js')}}"></script>
	<script src="{{ asset('public/js/jquery.sumoselect.js') }}"></script>


	<script src="{{ asset('public/js/bootstrap-toggle.min.js')}}"></script>
	<script src="{{asset('public/assets/libs/select2/dist/js/select2.min.js')}}"></script>
	<script src="{{asset('public/dist/js/pages/forms/select2/select2.init.js')}}"></script>

    <!--This page JavaScript -->
	<script>
		$(document.body).on('click', '.editPassword', function() {
			var id = $(this).data('id');
			$('.edit_password').html('');
			$('#p_password').val('');
			$('#c_password').val('');
			$('#ChangePasswordModal').modal('show');
			$(".PasswordButton").prop('disabled', false);
		});

		$("#edit_password").on("submit", function( event ) {
			event.preventDefault();


			$('.edit_password').html('');
			var p_password = $('#p_password').val();
			var c_password = $('#c_password').val();
			if(p_password.length < 8){
				$('.p_password').html('The password must be at least 8 characters.');
				return;
			}
			if(p_password!=c_password){
				$('.p_password').html('Password and confirm password should be same.');
				return;
			}

			$(".PasswordButton").prop('disabled', true);
			var data=$(this).serialize();
			$('.loaderAjax').css('display', 'block');
			$.ajax({
				url: "{{ URL('password-update') }}",
				type:'POST',
				data: data,
				success: function(data) {
					$(".PasswordButton").prop('disabled', false);
					$('#ChangePasswordModal').modal('hide');
					swal('Updated!', 'Password updated successfully.', 'success');

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
					$(".PasswordButton").prop('disabled', false);
					$('.loaderAjax').css('display', 'none');
				}
			});
		});

		$(document.body).on('click', '.editProfile', function() {
			var id = $(this).data('id');
			$('.edit_profile').html('');
			$('.loaderAjax').css('display', 'block');
			$.get("{{ URL('profile-edit') }}", {'id':id}, function(data, status){
				$('#profile_id').val(data.id);
				$('#edit_profile_name').val(data.name);
				$('#edit_profile_email').val(data.email);
				$(".EditProfileButton").prop('disabled', false);
				$('#EditProfileModal').modal('show');
				$('.loaderAjax').css('display', 'none');
			});
		});

		$("#edit_profile").on("submit", function( event ) {
			event.preventDefault();


			var edit_profile_name = $('#edit_profile_name').val();
			var edit_profile_email = $('#edit_profile_email').val();
			if(edit_profile_name==''){
				$('.edit_profile_name').html('The name field is required.');
				return;
			}
			if(edit_profile_email==''){
				$('.edit_profile_email').html('The email field is required.');
				return;
			}

			var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if (!filter.test(edit_profile_email)) {
				$('.edit_profile_email').html('Invalid Email Address.');
				return;
			}

			$(".EditProfileButton").prop('disabled', true);
			$('.edit_profile').html('');
			var data=$(this).serialize();
			$('.loaderAjax').css('display', 'block');
			$.ajax({
				url: "{{ URL('profile-update') }}",
				type:'POST',
				data: data,
				success: function(data) {
					$(".EditProfileButton").prop('disabled', false);
					$('#EditProfileModal').modal('hide');
					swal('Updated!', 'Profile updated successfully.', 'success');
					$('.loaderAjax').css('display', 'none');
					setTimeout(function(){ location.reload(); }, 2000);

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
					$(".EditProfileButton").prop('disabled', false);
					$('.loaderAjax').css('display', 'none');
				}
			});
		});
	</script>