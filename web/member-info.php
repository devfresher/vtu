<?php
require_once '../includes/config.php';
require_once '../components/head.php';

require_once '../model/User.php';
require_once '../model/Wallet.php';
require_once '../model/Role.php';
require_once '../model/Plan.php';
require_once '../model/Transaction.php';

$user = new User($db);
$wallet = new Wallet($db);

$role = new Role($db);
$plan = new Plan($db);

$transaction = new Transaction($db);

if (isset($_GET['role'])) {
	$roleId = $_GET['role'];
	$userList = $user->getAllUser($roleId);
}else {
	$roleId = '';
	$userList = $user->getAllUser();
}
$allplan = $plan->getAllPlans();
$allrole = $role->getAllRoles();
?>
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="<?php echo BASE_URL.USER_ROOT?>assets/css/custom/style.css" rel="stylesheet" type="text/css" />
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
								<div class="mb-7 row">
									<div class="col-sm-4">
										<form action="" method="GET" class="d-flex align-items-center">
											<select name="role" class="form-control selectpicker" data-size="5">
												<option value="">All</option>
												<?php foreach ($allrole as $index => $roleDetail) { ?>
													<option value="<?php echo $roleDetail['id']?>" <?php echo ($roleId == $roleDetail['id']) ? 'selected':''?>><?php echo $roleDetail['role_name']?></option>
												<?php } ?>
											</select>

											<button type="submit" name="filter" class="btn btn-light-primary px-6 font-weight-bold mx-3">
												Filter
											</button>
											<a href="<?php echo BASE_URL.ADMIN_ROOT.'member-info'?>" type="reset" class="btn btn-light-danger px-6 font-weight-bold">
												Reset
											</a>
										
										</form>
									</div>
								</div>

								<?php if($userList !== false) {
									foreach ($userList as $index => $userDetail) { 

										if ($user->isSuperAdmin($userDetail->id)) {
											$icon = '<i class="flaticon2-correct text-success icon-md ml-2"></i>';
											$color = 'success';
										} elseif ($user->isAdmin($userDetail->id)) {
											$icon = '<i class="flaticon2-correct text-danger icon-md ml-2"></i>';
											$color = 'danger';
										} elseif ($user->isStaffAdmin($userDetail->id)) {
											$icon = '<i class="flaticon2-correct text-info icon-md ml-2"></i>';
											$color = 'info';
										} else {
											$icon = '';
											$color = 'primary';
										} 
									?>
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
											<div class="card-body">
												<!--begin::Top-->
												<div class="d-flex">
													<!--begin::Pic-->
													<div class="flex-shrink-0 mr-7">
														<div class="symbol symbol-50 symbol-lg-120 symbol-light-<?php echo $color?>">
															<span class="font-size-h3 symbol-label font-weight-boldest">
																<?php echo $userDetail->firstLetter?>
															</span>
														</div>
													</div>
													<!--end::Pic-->
													<!--begin: Info-->
													<div class="flex-grow-1">
														<!--begin::Title-->
														<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
															<!--begin::User-->
															<div class="mr-3">
																<!--begin::Name-->
																<a href="#" class="d-flex align-items-center text-dark text-hover-<?php echo $color ?> font-size-h5 font-weight-bold mr-3">
																	<?php echo  $userDetail->firstname.' '.$userDetail->lastname.' '.$icon?>
																</a>
																<!--end::Name-->
																<!--begin::Contacts-->
																<div class="d-flex flex-wrap my-2">
																	<a href="#" class="text-muted text-hover-<?php echo $color ?> font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
																		<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
																					<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																		<?php echo $userDetail->email ?>
																	</a>

																	<span class="text-muted text-hover-<?php echo $color ?> font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
																		<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<polygon points="0 0 24 0 24 24 0 24"/>
																				<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
																				<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
																			</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																		<?php echo $userDetail->role->role_name?>
																	</span>

																	<span class="text-muted text-hover-<?php echo $color ?> font-weight-bold  mr-lg-8 mr-5 mb-lg-0 mb-2">
																		<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24"/>
																				<path d="M21,5.5 L21,17.5 C21,18.3284271 20.3284271,19 19.5,19 L4.5,19 C3.67157288,19 3,18.3284271 3,17.5 L3,14.5 C3,13.6715729 3.67157288,13 4.5,13 L9,13 L9,9.5 C9,8.67157288 9.67157288,8 10.5,8 L15,8 L15,5.5 C15,4.67157288 15.6715729,4 16.5,4 L19.5,4 C20.3284271,4 21,4.67157288 21,5.5 Z" fill="#000000" fill-rule="nonzero"/>
																			</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																		<?php echo $userDetail->plan->plan_name?>
																	</span>

																	<span class="text-muted text-hover-<?php echo $color ?> font-weight-bold">
																		<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24"/>
																					<path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" fill="#000000"/>
																					<path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3"/>
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																		<?php echo $utility->niceDateFormat($userDetail->date_joined)?>
																	</span>
																</div>
																<!--end::Contacts-->
															</div>
															<!--begin::User-->

															<!--begin::Actions-->
															<div class="my-lg-0 my-1">
																<div class="dropdown dropdown-inline mr-2">
																	<button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
																	</span>Actions</button>
																	<!--begin::Dropdown Menu-->
																	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
																		<!--begin::Navigation-->
																		<ul class="navi flex-column navi-hover py-2">
																			<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an action:</li>
																			<li class="navi-item">
																				<a href="javascript:;" data-toggle="modal" data-target="#modifyWalletForm<?php echo $userDetail->id?>" class="navi-link">
																					<span class="navi-icon">
																						<i class="fab la-usps"></i>
																					</span>
																					<span class="navi-text">Modify User Wallet</span>
																				</a>
																			</li>
																			<li class="navi-item">
																				<?php if ($userDetail->disable == 0) { ?>
																					<a href="javascript:;" data-id="<?php echo $userDetail->id?>" class="navi-link" id="disable">
																						<span class="navi-icon">
																							<i class="la la-file-pdf-o"></i>
																						</span>
																						<span class="navi-text">Disable User</span>
																					</a>
																				<?php }else { ?>
																					<a href="javascript:;" data-id="<?php echo $userDetail->id?>" class="navi-link" id="enable">
																						<span class="navi-icon">
																							<i class="la la-file-pdf-o"></i>
																						</span>
																						<span class="navi-text">Enable User</span>
																					</a>
																				<?php } ?>
																			</li>
																			<li class="navi-item">
																				<?php if ($userDetail->suspend == 0) { ?>
																					<a href="javascript:;"  data-id="<?php echo $userDetail->id?>" class="navi-link" id="suspend">
																						<span class="navi-icon">
																							<i class="la la-file-pdf-o"></i>
																						</span>
																						<span class="navi-text">Suspend User</span>
																					</a>
																				<?php }else { ?>
																					<a href="javascript:;"  data-id="<?php echo $userDetail->id?>" class="navi-link" id="activate">
																						<span class="navi-icon">
																							<i class="la la-file-pdf-o"></i>
																						</span>
																						<span class="navi-text">Activate User</span>
																					</a>
																				<?php } ?>
																			</li>
																		</ul>
																		<!--end::Navigation-->
																	</div>
																	<!--end::Dropdown Menu-->
																</div>
																<a href="#"  data-toggle="modal" data-target="#manageUserForm<?php echo $userDetail->id?>" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Manage</a>
															</div>
															<!--end::Actions-->
														</div>

														<!--end::Title-->
														<!--begin::Content-->
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<!--begin::Description-->
															<?php
																$userPermissions = $role->getRolePermission($userDetail->role->id);
																// print_r($userPermissions);
															?>
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
															<?php foreach ($userPermissions as $index => $permission){?>
																<?php echo $permission['module_name']?>,
															<?php } ?>
															</div>
															<!--end::Description-->
															<!--begin::Progress-->
															<?php if ($userDetail->sales_amount !== NUll AND $userDetail->sales_amount !== 0) { ?>
																<div class="d-flex mt-4 mt-sm-0">
																	<span class="font-weight-bold mr-4">Sales Target Progress</span>
																	<div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
																		<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $userDetail->sumAllTxn/$userDetail->sales_amount*100?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																	</div>
																	<span class="font-weight-bolder text-dark ml-4"><?php echo number_format($userDetail->sumAllTxn/$userDetail->sales_amount*100, 2)?>%</span>
																</div>
															<?php } ?>
															<!--end::Progress-->
														</div>
														<!--end::Content-->
													</div>
													<!--end::Info-->
												</div>
												<!--end::Top-->
												<!--begin::Separator-->
												<div class="separator separator-solid my-7"></div>
												<!--end::Separator-->
												<!--begin::Bottom-->
												<div class="d-flex align-items-center flex-wrap">
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-folder icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-sm">Wallet balance</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold">
																	<?php echo $appInfo->currency_code?>
																</span>
																<?php echo number_format($userDetail->walletBalance, 2)?>
															</span>
														</div>
													</div>
													<!--end: Item-->
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-sm">Total Transactions</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold">
																	<?php echo $appInfo->currency_code?>
																</span>
																<?php echo number_format($userDetail->sumAllTxn, 2)?>
															</span>
														</div>
													</div>
													<!--end: Item-->
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-sm">Sales Target</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold">
																	<?php echo $appInfo->currency_code?>
																</span>
																<?php echo number_format($userDetail->sales_amount, 2)?>
															</span>
														</div>
													</div>
													<!--end: Item-->
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column flex-lg-fill">
															<span class="text-dark-75 font-weight-bolder font-size-sm"><?php echo ($userDetail->allTxns !== false)? count($utility->objectToArray($userDetail->allTxns)):0?> Transactions</span>
															<a href="<?php echo BASE_URL.ADMIN_ROOT.'user-transactions.php?id='.$userDetail->id?>" class="text-primary font-weight-bolder">View</a>
														</div>
													</div>
													<!--end: Item-->

													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-statistics icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column flex-lg-fill">
															<span class="text-dark-75 font-weight-bolder font-size-sm">Statistics</span>
															<a href="<?php echo BASE_URL.ADMIN_ROOT.'member-stats.php?id='.$userDetail->id?>" class="text-primary font-weight-bolder">View</a>
														</div>
													</div>
													<!--end: Item-->
												</div>
												<!--end::Bottom-->
											</div>
										</div>
										<!--end::Card-->

										<!-- Modal-->
										<form class="form" method="POST" id="manage-user-form<?php echo $userDetail->id?>" action="<?php echo BASE_URL?>controller/auth.php">
											<div class="modal fade" id="manageUserForm<?php echo $userDetail->id?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="manageUserForm" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel"><?php echo $userDetail->firstname.' '.$userDetail->lastname ?></h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<i aria-hidden="true" class="ki ki-close"></i>
															</button>
														</div>
														<div class="modal-body">
															<div data-scroll="true" data-height="400">
																<input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>member-info">
																<input type="hidden" name="user_id" value="<?php echo $userDetail->id?>">

																
																<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
																	<div class="card">
																		<div class="card-header" id="headingOne6">
																			<div class="card-title" data-toggle="collapse" data-target="#collapseOne6">
																				<i class="flaticon2-user-1"></i> User Information
																			</div>
																		</div>

																		<div id="collapseOne6" class="collapse show" data-parent="#accordionExample6">
																			<div class="card-body">
																				<div class="form-group row">
																					<div class="col-md">
																						<label class="col-form-label">First Name</label>
																						<input type="text" value="<?php echo $userDetail->firstname ?>" name="firstname" class="form-control" disabled />
																					</div>
																					<div class="col-md">
																						<label class="col-form-label">Last Name</label>
																						<input type="text" value="<?php echo $userDetail->lastname ?>" name="lastname" class="form-control" disabled />
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-md">
																						<label class="col-form-label">Plan</label>
																						<select name="plan" class="form-control selectpicker" data-size="4">
																							<?php foreach ($allplan as $index => $planDetail) { print_r($planDetail) ?>
																								<option value="<?php echo $planDetail['id']?>" <?php echo ($userDetail->plan_id == $planDetail['id']) ? 'selected':''?>><?php echo $planDetail['plan_name']?></option>
																							<?php } ?>
																						</select>
																					</div>
																					<div class="col-md">
																						<label class="col-form-label">Role</label>
																						<select name="role" class="form-control selectpicker" data-size="4">
																							<?php foreach ($allrole as $index => $roleDetail) { ?>
																								<option value="<?php echo $roleDetail['id']?>" <?php echo ($userDetail->role_id == $roleDetail['id']) ? 'selected':''?>><?php echo $roleDetail['role_name']?></option>
																							<?php } ?>
																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div class="card">
																		<div class="card-header" id="headingThree6">
																			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6">
																				<i class="flaticon2-line-chart"></i> Sales Target Information
																			</div>
																		</div>
																		<div id="collapseThree6" class="collapse" data-parent="#accordionExample6">
																			<div class="card-body">
																				<div class="form-group row">
																					<div class="col-md">
																						<label class="col-form-label">Sales Target Reward</label>
																						<input type="number" value="<?php echo $userDetail->sales_reward?>" name="sales_reward" class="form-control" />
																					</div>

																					<div class="col-md">
																						<label class="col-form-label">Sales Target Amount</label>
																						<input type="number" value="<?php echo $userDetail->sales_amount?>" name="sales_amount" class="form-control" />
																					</div>
																				</div>

																				<div class="form-group row">
																					<div class="col-md">
																						<label class="col-form-label">Sales Target Period</label>
																						<select name="sales_period" class="form-control selectpicker" data-size="3">
																							<option value="daily" <?php echo ($userDetail->sales_period == 'daily')? 'selected':''?>>Daily</option>
																							<option value="weekly" <?php echo ($userDetail->sales_period == 'weekly')? 'selected':''?>>Weekly</option>
																							<option value="monthly" <?php echo ($userDetail->sales_period == 'monthly')? 'selected':''?>>Monthly</option>
																						</select>
																					</div>
																				</div>

																				<div class="form-group row">
																					<div class="col-md">
																						<label class="col-form-label">Sales Services</label>
																						<select name="sales_services" class="form-control selectpicker" multiple>
																							<option>Airtime</option>
																							<option>Data Bundle</option>
																							<option>MTN SME</option>
																							<option>Cable TV</option>
																							<option>Electricity</option>
																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div class="card">
																		<div class="card-header" id="headingTwo6">
																			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6">
																				<i class="flaticon2-shopping-cart"></i> Other Infomation
																			</div>
																		</div>
																		<div id="collapseTwo6" class="collapse" data-parent="#accordionExample6">
																			<div class="card-body">
																				<div class="form-group row">
																					<div class="col-md">
																						<label class="col-form-label">Daily Minimum Purchase</label>
																						<input type="number" value="<?php echo $userDetail->daily_min_purchase ?>" name="daily_min_purchase" class="form-control" />
																					</div>
																					<div class="col-md">
																						<label class="col-form-label">Minimum Wallet Recharge</label>
																						<input type="number" value="<?php echo $userDetail->min_wallet_recharge ?>" name="min_wallet_recharge" class="form-control" />
																					</div>
																				</div>

																				<div class="form-group row">
																					<div class="col-md">
																						<label class="checkbox checkbox-outline checkbox-success">
																							<input type="checkbox" name="sms_noti" <?php echo ($userDetail->sms_noti == 1)? 'checked':''?>/>
																							<span></span>
																							SMS Notification
																						</label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
															<button type="submit" name="update_user" class="btn btn-primary font-weight-bold">Save</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!-- Modal-->
										
										<!-- Modal-->
										<form class="form" method="POST" id="modify-wallet-form<?php echo $userDetail->id?>" action="<?php echo BASE_URL?>controller/wallet.php">
											<div class="modal fade" id="modifyWalletForm<?php echo $userDetail->id?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modifyWalletForm" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel"><?php echo $userDetail->firstname ?>'s wallet</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<i aria-hidden="true" class="ki ki-close"></i>
															</button>
														</div>
														<div class="modal-body">
															<div>
																<input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>member-info">
																<input type="hidden" name="user_id" value="<?php echo $userDetail->id?>">

																<div class="form-group">
																	<label class="col-form-label">Type</label>
																	<select name="type" class="form-control selectpicker" data-size="4" title="Choose one of the following..." required>
																		<option value="fund">Fund</option>
																		<option value="refund">Refund</option>
																		<option value="deduct">Deduct</option>
																	</select>
																</div>

																<div class="form-group">
																	<label class="col-form-label">Amount</label>
																	<input type="number" name="amount" class="form-control" required/>
																</div>

																<div class="form-group">
																	<label class="col-form-label">Description</label>
																	<textarea class="form-control" name="description" rows="5" required></textarea>
																</div>

																<div class="form-group">
																	<label class="col-form-label">Admin Pin</label>
																	<input type="text" name="pin" class="form-control" required/>
																</div>

															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
															<button type="submit" name="modify_wallet" class="btn btn-primary font-weight-bold">Save Change</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!-- Modal-->									
									<?php } ?>

									<!--begin::Pagination-->
									<div class="card card-custom">
										<div class="card-body py-7">
											<!-- begin::Pagination -->
											<div class="d-flex justify-content-between align-items-center flex-wrap">
												<div class="d-flex flex-wrap mr-3">
													<a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
														<i class="ki ki-bold-double-arrow-back icon-xs"></i>
													</a>
													<a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
														<i class="ki ki-bold-arrow-back icon-xs"></i>
													</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
													<a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
													<a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
														<i class="ki ki-bold-arrow-next icon-xs"></i>
													</a>
													<a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
														<i class="ki ki-bold-double-arrow-next icon-xs"></i>
													</a>
												</div>
												<div class="d-flex align-items-center">
													<select class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">
														<option value="10">10</option>
														<option value="20">20</option>
														<option value="30">30</option>
														<option value="50">50</option>
														<option value="100">100</option>
													</select>
													<span class="text-muted">Displaying 10 of 230 records</span>
												</div>
											</div>
											<!-- end:: Pagination -->
										</div>
									</div>
									<!--end::Pagination-->

								<?php } else { ?>
									<div class="card card-custom gutter-b">
										<div class="card-body">
											No Record Found
										</div>
									</div>
								<?php } ?>
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
        <script src="<?php echo BASE_URL?>assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
		<?php include_once '../components/message.php'?>

		<script>
			$('#disable').on('click', function () {
				button = $(this);
				userId = button.attr('data-id')
				var data = {
					"disable_user" : 1,
					"user_id" : userId
				};
				$.ajax({
					url: "<?php echo BASE_URL.'controller/auth.php'?>",
					type: "post",
					data: data,

					beforeSend: function(){
						button.html("Loading <i class='fas fa-spinner fa-pulse'></i>");
						button.prop('disabled', true);
					},
					success: function(result) {
						msg = JSON.parse(result);
						console.log(result);
						window.location = '<?php echo BASE_URL.ADMIN_ROOT.'member-info'?>';
					}
				})
			})

			$('#enable').on('click', function () {
				button = $(this);
				userId = button.attr('data-id')
				var data = {
					"enable_user" : 1,
					"user_id" : userId
				};
				$.ajax({
					url: "<?php echo BASE_URL.'controller/auth.php'?>",
					type: "post",
					data: data,

					beforeSend: function(){
						button.html("Loading <i class='fas fa-spinner fa-pulse'></i>");
						button.prop('disabled', true);
					},
					success: function(result) {
						console.log(result);
						msg = JSON.parse(result);
						window.location = '<?php echo BASE_URL.ADMIN_ROOT.'member-info'?>';
					}
				})
			})

			$('#suspend').on('click', function () {
				button = $(this);
				userId = button.attr('data-id')
				var data = {
					"suspend_user" : 1,
					"user_id" : userId
				};
				$.ajax({
					url: "<?php echo BASE_URL.'controller/auth.php'?>",
					type: "post",
					data: data,

					beforeSend: function(){
						button.html("Loading <i class='fas fa-spinner fa-pulse'></i>");
						button.prop('disabled', true);
					},
					success: function(result) {
						msg = JSON.parse(result);
						console.log(result);
						window.location = '<?php echo BASE_URL.ADMIN_ROOT.'member-info'?>';
					}
				})
			})

			$('#activate').on('click', function () {
				button = $(this);
				userId = button.attr('data-id')
				var data = {
					"unsuspned_user" : 1,
					"user_id" : userId
				};
				$.ajax({
					url: "<?php echo BASE_URL.'controller/auth.php'?>",
					type: "post",
					data: data,

					beforeSend: function(){
						button.html("Loading <i class='fas fa-spinner fa-pulse'></i>");
						button.prop('disabled', true);
					},
					success: function(result) {
						msg = JSON.parse(result);
						console.log(result);
						window.location = '<?php echo BASE_URL.ADMIN_ROOT.'member-info'?>';
					}
				})
			})

			$('select[name=type]').on('change', function () {
				var type = $(this).val();
				var amount = $(this).parents('.form-group').siblings().find('input[name=amount]');
				var description = $(this).parents('.form-group').siblings().find('textarea[name=description]');
				var pin = $(this).parents('.form-group').siblings().find('input[name=pin]');
				
				if (type == 'fund') {
					description.removeAttr('required');
				}
			})

		</script>
		<!--end::Page Vendors-->
	</body>
	<!--end::Body-->
</html>