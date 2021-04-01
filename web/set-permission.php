<?php
require_once '../includes/config.php';
require_once '../components/head.php';

require_once '../model/Role.php';
require_once '../model/Module.php';

if (isset($_GET['roleID'])) {
    $roleId = $_GET['roleID'];

    $role = new Role($db);
    $module = new Module($db);

    $roleDetail = $role->getRole($roleId);
}else {
    http_response_code(404);
    include '../error/404.php'; // provide your own HTML for the error page
    die();
}

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
                                                <div class="card-title">
                                                    <h3 class="card-label"><?php echo $roleDetail->role_name?>'s Permission
                                                    <span class="d-block text-muted pt-2 font-size-sm">Role permission settings</span></h3>
                                                </div>
                                                <div class="card-toolbar">
                                                    <!--begin::Button-->
                                                    <button class="btn btn-success font-weight-bolder submit_permissions">
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
                                                        Save Changes
                                                    </button>
                                                    <!--end::Button-->
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
                                                            <th title="Field #2" class="custom-th">Permission</th>
                                                            <th title="Field #3" class="custom-th">View Page</th>
                                                            <th title="Field #4" class="custom-th">Create</th>
                                                            <th title="Field #5" class="custom-th">Update</th>
                                                            <th title="Field #6" class="custom-th">Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $moduleList = $module->getAdminModules();
                                                            $permissions = $utility->db->getAllRecords("role_permission", "*", "AND role_id = '$roleId'");
                                                            if($moduleList !== false) {
                                                                $i = 0;
                                                                foreach ($moduleList as $index => $moduleDetail) { ?>
                                                                    <tr class="module-item" data-module-id="<?php echo $moduleDetail['id']?>">
                                                                        <td><?php echo $moduleDetail['module_name']?></td>
                                                                        <td>
                                                                            <input type="checkbox" name="view" <?php echo ($permissions[$i]['view'] == 1)? 'checked':''?>/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="checkbox" name="create" <?php echo ($permissions[$i]['create_new'] == 1)? 'checked':''?>/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="checkbox" name="update" <?php echo ($permissions[$i]['edit'] == 1)? 'checked':''?>/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="checkbox" name="delete" <?php echo ($permissions[$i]['del'] == 1)? 'checked':''?>/>
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

        <script>
            $('.submit_permissions').on('click', function () {
                var button = $(this);
                Swal.fire({
                    icon: 'question',
                    text: 'Are you sure you want to save?',
                    showCancelButton: true,
                    confirmButtonText: "Yes, sure",
                    cancelButtonText: "Cancel!",
                }).then(function(result) {
                    if (result.value) {
                        
                        var data = '{"set_permission" : 1, "data" : [';
                        
                        var i = 1;
                        $('.module-item').each(function () {
                            var moduleId = $(this).attr('data-module-id');
                            var view = $(this).find("input[name=view]");
                            var create = $(this).find("input[name=create]");
                            var update = $(this).find("input[name=update]");
                            var del = $(this).find("input[name=delete]");

                            view = (view.prop("checked"))? 1:0;
                            create = (create.prop("checked"))? 1:0;
                            update = (update.prop("checked"))? 1:0;
                            del = (del.prop("checked"))? 1:0;

                            var roleId = '<?php echo $_GET['roleID']?>';


                            if(i  == $('.module-item').length){
                                var permissionItem = '{"module_id":'+ '"'+moduleId+'", "role_id":'+ '"'+roleId+'", "view":'+ '"'+view+'", "create":'+ '"'+create+'", "update":'+ '"'+update+'", "delete":'+ '"'+del+'"}';
                            } else {
                                var permissionItem = '{"module_id":'+ '"'+moduleId+'", "role_id":'+ '"'+roleId+'", "view":'+ '"'+view+'", "create":'+ '"'+create+'", "update":'+ '"'+update+'", "delete":'+ '"'+del+'"},';
                            }

                            data += permissionItem;

                            i++;
                        })

                        data += "]}";

                        updateData = JSON.parse(data);

                        $.ajax({
                            url: "<?php echo BASE_URL.'controller/role.php'?>",
                            type: "post",
                            data: updateData,
                            beforeSend: function(){
                                button.html("Saving <i class='fas fa-spinner fa-pulse'></i>");
                                button.prop('disabled', true);
                            },
                            success: function(result) {
                                button.removeAttr('disabled');
                                button.html('Save Changes');
                                console.log(result);
                                // window.location = '<?php echo BASE_URL.ADMIN_ROOT.'set-permission?roleID='.$roleId?>';
                            }
                        })
                    }
                });
            })
        </script>
		<!--end::Page Vendors-->
	</body>
	<!--end::Body-->
</html>