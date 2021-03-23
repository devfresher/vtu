<?php
require_once '../includes/config.php';
require_once '../components/head.php';

require_once '../model/Plan.php';
require_once '../model/Product.php';

$product = new Product($db);
$plan = new Plan($db);

$productList = $product->getAllProducts();
$planList = $plan->getAllPlans();
?>
		<!--begin::Page Vendors Styles(used by this page)-->
		<!--end::Page Vendors Styles-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url(<?php echo BASE_URL.USER_ROOT?>assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		
		<?php include_once '../components/mobileHeader.php'; ?>

		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<?php include_once 'special/toolbar.php';?>

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						<?php include_once '../components/subToolBar.php'?>

						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
							<div class="container">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card card-custom">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0 ">
                                                <div class="card-toolbar">
                                                    <!--begin::Button-->
                                                    <button class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#newPlanForm">
                                                        <span class="svg-icon svg-icon-md">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        New Plan
                                                    </button>
                                                    <!--end::Button-->

                                                    <!-- Modal-->
                                                    <form class="form" method="POST" id="new-plan-form" action="<?php echo BASE_URL?>controller/plan.php">
                                                        <div class="modal fade" id="newPlanForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newPlanForm" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">New Plan</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div data-scroll="true" data-height="300">
                                                                            <input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>plan-management">

                                                                            <div class="form-group row">
                                                                                <div class="col-md">
                                                                                    <label class="col-form-label">Plan Name</label>
                                                                                    <input type="text" name="plan_name" class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md">
                                                                                    <label class="col-form-label">Migration Fee (<?php echo $appInfo->currency?>)</label>
                                                                                    <input type="number" name="migration_fee" class="form-control" />
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-md">
                                                                                    <label class="col-form-label">Plan Lock</label>
                                                                                    <select name="plan_lock" class="form-control selectpicker" data-size="2">
                                                                                        <option value="1">Lock</option>
                                                                                        <option value="0">Unlock</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md">
                                                                                    <label class="col-form-label">Plan Type</label>
                                                                                    <select name="plan_type" class="form-control selectpicker" data-size="2">
                                                                                        <option value="private">Private</option>
                                                                                        <option value="public">Public</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="create_plan" class="btn btn-primary font-weight-bold">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card-body">                                            
                                                <!--begin::Search Form-->
                                                <div class="mb-7">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-8 col-xl-7">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4 my-2 my-md-0">
                                                                    <div class="input-icon">
                                                                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                                                        <span>
                                                                            <i class="flaticon2-search-1 text-muted"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 my-2 my-md-0">
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                                        <select class="form-control" id="kt_datatable_search_status">
                                                                            <option value="">All</option>
                                                                            <option value="1">Pending</option>
                                                                            <option value="2">Declined</option>
                                                                            <option value="3">Approved</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 my-2 my-md-0">
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                                        <select class="form-control" id="kt_datatable_search_type">
                                                                            <option value="">All</option>
                                                                            <option value="1">Fund Wallet</option>
                                                                            <option value="2">Receive Share</option>
                                                                            <option value="3">Share Out</option>
                                                                            <option value="4">Purchase</option>
                                                                            <option value="5">Withdrawal</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-xl-3 mt-5 mt-lg-0">
                                                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                                        </div>
                                                        <div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
                                                            <!--begin::Dropdown-->
                                                            <div class="dropdown dropdown-inline mr-2">
                                                                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="svg-icon svg-icon-md">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                                            <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>Export</button>
                                                                <!--begin::Dropdown Menu-->
                                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                    <!--begin::Navigation-->
                                                                    <ul class="navi flex-column navi-hover py-2">
                                                                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
                                                                                <span class="navi-icon">
                                                                                    <i class="la la-print"></i>
                                                                                </span>
                                                                                <span class="navi-text">Print</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
                                                                                <span class="navi-icon">
                                                                                    <i class="la la-file-pdf-o"></i>
                                                                                </span>
                                                                                <span class="navi-text">PDF</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <!--end::Navigation-->
                                                                </div>
                                                                <!--end::Dropdown Menu-->
                                                            </div>
                                                            <!--end::Dropdown-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Search Form-->

                                                <!--begin: Datatable-->
                                                <table class="datatable datatable-bordered datatable-head-custom" id="plan_list_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th title="Field #1" class="custom-th">S/N</th>
                                                            <th title="Field #2" class="custom-th">Plan Name</th>
                                                            <th title="Field #3" class="custom-th">Migration Fee</th>
                                                            <th title="Field #4" class="custom-th">planType</th>
                                                            <th title="Field #5" class="custom-th">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if($planList !== false){
                                                            $i = 1;
                                                            foreach ($planList as $plan) { ?>
                                                                <div class="modal fade" id="editPlanForm<?php echo $plan['id']?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editPlanForm<?php echo $plan['id']?>" aria-hidden="true">
                                                                    <form class="form" method="POST" id="edit-plan-form<?php echo $plan['id']?>" action="<?php echo BASE_URL?>controller/plan.php">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div data-scroll="true" data-height="300">
                                                                                        <input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>plan-management">
                                                                                        <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>">

                                                                                        <div class="form-group row">
                                                                                            <div class="col-md">
                                                                                                <label class="col-form-label">Plan Name</label>
                                                                                                <input type="text" name="plan_name" class="form-control" value="<?php echo $plan['plan_name']?>" disabled/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-md">
                                                                                                <label class="col-form-label">Migration Fee (<?php echo $appInfo->currency?>)</label>
                                                                                                <input type="number" name="migration_fee" class="form-control" value="<?php echo $plan['migration_fee']?>" />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <div class="col-md">
                                                                                                <label class="col-form-label">Plan Lock</label>
                                                                                                <select name="plan_lock" class="form-control selectpicker" data-size="2">
                                                                                                    <option value="1" <?php echo ($plan['plan_lock'] == 1)? 'selected':''?>>Lock</option>
                                                                                                    <option value="0" <?php echo ($plan['plan_lock'] == 0)? 'selected':''?>>Unlock</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md">
                                                                                                <label class="col-form-label">Plan Type</label>
                                                                                                <select name="plan_type" class="form-control selectpicker" data-size="2">
                                                                                                    <option value="private" <?php echo ($plan['plan_type'] == 'private')? 'selected':''?>>Private</option>
                                                                                                    <option value="public" <?php echo ($plan['plan_type'] == 'public')? 'selected':''?>>Public</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="update_plan" class="btn btn-primary font-weight-bold">Save Changes</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <tr>
                                                                    <td><?php echo $i?></td>
                                                                    <td><?php echo $plan['plan_name']?></td>
                                                                    <td><?php echo $appInfo->currency_code.number_format($plan['migration_fee'], 2)?></td>
                                                                    <td><?php echo $plan['plan_type']?></td>
                                                                    <td>
                                                                        <span style="overflow: visible;position: relative;">
                                                                            <a href="javascript:;" data-toggle="modal" data-target="#editPlanForm<?php echo $plan['id']?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Modify Plan Settings">
                                                                                <span class="svg-icon svg-icon-md">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                                                                                        </g>
                                                                                    </svg>
                                                                                </span>
                                                                            </a>

                                                                            <a href="<?php echo BASE_URL.ADMIN_ROOT.'plan?id='.$plan['id']?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit Price">
                                                                                <span class="svg-icon svg-icon-md">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                                                        </g>
                                                                                    </svg>
                                                                                </span>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete Plan">
                                                                                <span class="svg-icon svg-icon-md">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                                                        </g>
                                                                                    </svg>
                                                                                </span>
                                                                            </a>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            <?php $i++; } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <!--end: Datatable-->   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					
					<?php include_once '../components/footer.php';?>

				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->

		<?php include_once '../components/quickUser.php';?>

		<?php include_once '../components/scrollTop.php';?>
		<?php include_once '../components/js.php';?>

		<!--begin::Page Vendors(used by this page)-->
        <script src="<?php echo BASE_URL?>assets/js/pages/crud/ktdatatable/advanced/plan.js"></script>
        <script src="<?php echo BASE_URL?>assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
		<?php include_once '../components/message.php'?>
		<!--end::Page Vendors-->
	</body>
	<!--end::Body-->
</html>