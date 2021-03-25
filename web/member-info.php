<?php
require_once '../includes/config.php';
require_once '../components/head.php';

require_once '../model/User.php';
require_once '../model/Wallet.php';
require_once '../model/Role.php';
require_once '../model/Plan.php';

$user = new User($db);
$wallet = new Wallet($db);

$role = new Role($db);
$plan = new Plan($db);

$userList = $user->getAllUser(2);
$allplan = $plan->getAllPlans();
$allrole = $role->getAllRoles();
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
								<?php if($userList !== false){
									foreach ($userList as $index => $userDetail) { ?>
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
											<div class="card-body">
												<!--begin::Top-->
												<div class="d-flex">
													<!--begin::Pic-->
													<div class="flex-shrink-0 mr-7">
														<div class="symbol symbol-50 symbol-lg-120">
															<div class="symbol-label text-dark-50" style="font-size: 35px;">
																<?php echo $userDetail->firstLetter?>
															</div>
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
																<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?php echo  $userDetail->firstname.' '.$userDetail->lastname?>
																	<?php if ($userDetail->role->id == 1) { ?>
																		<i class="flaticon2-correct text-success icon-md ml-2"></i>
																	<?php } elseif ($userDetail->role->id == 3) { ?>
																		<i class="flaticon2-correct text-danger icon-md ml-2"></i>
																	<?php } ?>
																</a>
																<!--end::Name-->
																<!--begin::Contacts-->
																<div class="d-flex flex-wrap my-2">
																	<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

																	<span class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

																	<span class="text-muted text-hover-primary font-weight-bold">
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
																</div>
																<!--end::Contacts-->
															</div>
															<!--begin::User-->
															<!--begin::Actions-->
															<div class="my-lg-0 my-1">
																<a href="#" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Actions</a>
																<a href="#"  data-toggle="modal" data-target="#manageUserForm" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Manage</a>
															</div>
															<!--end::Actions-->
														</div>

														<!-- Modal-->
														<form class="form" method="POST" id="new-plan-form" action="<?php echo BASE_URL?>controller/plan.php">
															<div class="modal fade" id="manageUserForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="manageUserForm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Manage User #<?php echo $userDetail->id ?></h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																		<div class="modal-body">
																			<div data-scroll="true" data-height="300">
																				<input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>member-info">

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
														<!-- Modal-->

														<!--end::Title-->
														<!--begin::Content-->
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<!--begin::Description-->
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">I distinguish three main text objectives could be merely to inform people.
															<br />A second could be persuade people. You want people to bay objective.</div>
															<!--end::Description-->
															<!--begin::Progress-->
															<div class="d-flex mt-4 mt-sm-0">
																<span class="font-weight-bold mr-4">Progress</span>
																<div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
																	<div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<span class="font-weight-bolder text-dark ml-4">78%</span>
															</div>
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
															<span class="font-weight-bolder font-size-sm">Wallet Ballance</span>
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
																	<?php echo $appInfo->currency?>
																</span>
																<?php echo number_format(3000, 2)?>
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
															<span class="font-weight-bolder font-size-sm">Net</span>
															<span class="font-weight-bolder font-size-h5">
															<span class="text-dark-50 font-weight-bold">$</span>782,300</span>
														</div>
													</div>
													<!--end: Item-->
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column flex-lg-fill">
															<span class="text-dark-75 font-weight-bolder font-size-sm">73 Tasks</span>
															<a href="#" class="text-primary font-weight-bolder">View</a>
														</div>
													</div>
													<!--end: Item-->
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-chat-1 icon-2x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column">
															<span class="text-dark-75 font-weight-bolder font-size-sm">648 Comments</span>
															<a href="#" class="text-primary font-weight-bolder">View</a>
														</div>
													</div>
													<!--end: Item-->
												</div>
												<!--end::Bottom-->
											</div>
										</div>
										<!--end::Card-->
									<?php } ?>
								<?php } ?>

								<!--begin::Pagination-->
								<div class="card card-custom">
									<div class="card-body py-7">
										<!--begin::Pagination-->
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
										<!--end:: Pagination-->
									</div>
								</div>
								<!--end::Pagination-->
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