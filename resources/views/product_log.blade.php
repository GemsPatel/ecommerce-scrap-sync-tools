<!DOCTYPE html>
<html dir="ltr" lang="en">
@section('title')
Product Logs
@endsection
@include('include.header_css')
<style>
    .mainlabelcontent {
        font-weight: bolder;
    }
    .SumoSelect {
        display: inline-block;
        position: relative;
        outline: none;
        width: 100%;
    }
    .SumoSelect .select-all {
        border-radius: 3px 3px 0 0;
        position: relative;
        border-bottom: 1px solid #ddd;
        background-color: #fff;
        padding: 8px 0 3px 35px;
        height: 15px;
        cursor: pointer;
    }
    .ssd {
        display: flex;
    }
    .file-up-resize {
        height: 35px;
    }
    .imgphoto {
        height: 80px;
        width: 80px;
    }
    .text-white{
        font-size: 13px;
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
                        <h4 class="page-title">Product Logs</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Logs</li>
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
                        <input type="hidden" id="ct_field" value="0" />
                        <input type="hidden" id="Hd_Sync_Product_Ids" name="Hd_Sync_Product_Ids" value="" />
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div style="padding-bottom: 10px;float: right;display:flex;">
                                            <a href="#" class="btn btn-primary btn-rounded " style="display:none;"
                                                id='resyn_btn' data-toggle="modal" data-target="#AddEliftruckfielddata">
                                                <i class="mdi mdi-sync"></i> Resync Selected
                                            </a>
                                            &nbsp;
                                            <a href="#" class="btn btn-primary btn-rounded " style="display:none;"
                                                id="AddNewAdmin" onclick="resyncall()">
                                                <i class="mdi mdi-sync"></i> Resync All
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="row" style="padding-bottom: 30px;">
                                                <div class="col-md-3">
                                                    <label>Filter by Status</label>
                                                    <select class="form-control" id="filter_by_status"
                                                        name="filter_by_status">
                                                        <option value="">All</option>
                                                        <option value="synced">Synced</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="failed">Failed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <table class="table table-striped table-bordered bootstrap-3"
                                                style="width:100% !important">
                                                <thead>
                                                    <tr>
                                                        <!--<th><input type="checkbox" id="sel_pro" name="sel_pro[]" onClick="selectDeselectAll()"></th>-->
                                                        <th>Name</th>
                                                        <th>SKU</th>
                                                        <th>UPC</th>
                                                        <th>Created&nbsp;At</th>
                                                        <th>Sync&nbsp;Date&nbsp;&&nbsp;Time</th>
                                                        <th>Sync&nbsp;Status</th>
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
		 var table = $('.bootstrap-3').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: "{{route('get_product_log')}}",
				type: 'GET',
				 "data": function ( d ) {
                            return $.extend( {}, d, {
                              "filter_by_status": $('#filter_by_status').val(),
					});
				},
			},
			"columns": [
			/*{ "data": "shopify_order_id"  ,"bSortable":false,  "render": function ( data, type, full, meta ) {
				return '<input type="checkbox" name="sel_pro[]" id="sel_pro_'+data+'" class="select_product" onClick="selectMultipleProductForSync('+data+')">';
			}},*/
			{"data": "name", "bSortable":true},
			{"data": "sku", "bSortable":true, "width":"15%"},
            {"data": "upc", "bSortable":true, "width":"10%"},
			{"data": "created_at", "bSortable":true, "width":"15%"},
			{"data": "last_product_sync_time", "bSortable":true, "width":"15%"},
			{ "data": "product_sync_status"  ,"bSortable":true,"width":"5%",  "render": function ( data, type, full, meta ) {
				if(full.product_sync_status=='synced'){
                    return '<span class="badge bg-success text-white" data-toggle="tooltip" data-placement="left" title="" data-original-title="Product Synced Successfully!">Synced</span>';
				}else if(full.product_sync_status=='failed'){
                    return '<span class="badge bg-danger text-white" data-toggle="tooltip" data-placement="left" title="'+full.response+'" data-original-title="'+full.response+'">Failed</span>';
                }else{
                    return '<span class="badge bg-info text-white">Pending</span>'; // '+full.product_sync_status+'
				}
			}},
			{ "data": "action"  ,"bSortable":true, "width":"5%", "render": function ( data, type, full, meta ) {
                if(full.product_sync_status=='failed'){
				    return "<a href='#' class='btn btn-danger btn-sm resync_product' data-id='"+full.id+"'><span class='mdi mdi-refresh'></i> Resync</span>";
                }else{
                    return "";
                }
			}}
			],
			"scrollX": true,
			"order": [[ 4, 'desc' ]]
		});
		$("#filter_by_status").change(function (e) {
			table.draw();
		});
	})(window, document, jQuery);

	// Resync Product
    $(document).on('click','.resync_product',function(){
        id = $(this).data('id');

        if(!id){
            swal('Failed!', 'Product id not found. Please try again', 'error');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: "{{url('/resyncProduct')}}",
            dataType:'json',
            data: { "_token": "{{ csrf_token() }}","id":id},
            beforeSend: function() {
                $('.loaderAjax').css('display', 'block');
            },
            success: function(response) {
                $('.loaderAjax').css('display', 'none');
                $('.bootstrap-3').DataTable().ajax.reload();
                if (response.status_code == 1) {
					swal('Success!', response.status_text, 'success');
                } else {
                    swal('Failed!', response.status_text, 'error');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.loaderAjax').css('display', 'none');
                if (jqXHR.status == 500) {
					swal('Failed!', 'Internal error: ' + jqXHR.responseText, 'error');
                } else {
					swal('Failed!', 'Unexpected error Please try again.', 'error');
                }
            }
        });
    });
</script>
</html>