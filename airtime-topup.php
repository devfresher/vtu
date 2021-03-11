<?php
require_once './components/head.php';
require_once './model/Product.php';

$wallet = new Wallet($db);
$product = new Product($db);
$airtime_products = $product->getProductsWithCat(1, $user->currentUser->plan->id);
?>
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="<?php echo BASE_URL.USER_ROOT?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url(assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		
		<?php include_once './components/mobileHeader.php'; ?>

		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<?php include_once './components/toolbar.php';?>

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Heading-->
									<div class="d-flex flex-column">
										<!--begin::Title-->
										<h2 class="text-white font-weight-bold my-2 mr-5">Airtime Topup</h2>
										<!--end::Title-->
										<!--begin::Breadcrumb-->
										<div class="d-flex align-items-center font-weight-bold my-2">
											<!--begin::Item-->
											<a href="#" class="opacity-75 hover-opacity-100">
												<i class="flaticon2-shelter text-white icon-1x"></i>
											</a>
											<!--end::Item-->
											<!--begin::Item-->
											<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
											<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Airtime</a>
											<!--end::Item-->
										</div>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Heading-->
								</div>
								<!--end::Info-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center">
									<!--begin::Button-->
									<a href="#" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Reports</a>
									<!--end::Button-->
									<!--begin::Dropdown-->
									<div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="top">
										<a href="#" class="btn btn-white font-weight-bold py-3 px-6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</a>
										<div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
											<!--begin::Navigation-->
											<ul class="navi navi-hover py-5">
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-drop"></i>
														</span>
														<span class="navi-text">New Group</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-list-3"></i>
														</span>
														<span class="navi-text">Contacts</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-rocket-1"></i>
														</span>
														<span class="navi-text">Groups</span>
														<span class="navi-link-badge">
															<span class="label label-light-primary label-inline font-weight-bold">new</span>
														</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
														<span class="navi-text">Calls</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-gear"></i>
														</span>
														<span class="navi-text">Settings</span>
													</a>
												</li>
												<li class="navi-separator my-3"></li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-magnifier-tool"></i>
														</span>
														<span class="navi-text">Help</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
														<span class="navi-text">Privacy</span>
														<span class="navi-link-badge">
															<span class="label label-light-danger label-rounded font-weight-bold">5</span>
														</span>
													</a>
												</li>
											</ul>
											<!--end::Navigation-->
										</div>
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::Toolbar-->
							</div>
						</div>
						<!--end::Subheader-->

						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">

							<!--begin::Container-->
							<div class="container">

								<!--begin::Wallet-->
								<!--begin::Row-->
								<div class="row">
									<div class="col-xl-3">
										<?php include_once './components/walletBallance.php'?>
									</div>
									<div class="col-xl-9">
                                        <div class="card card-custom card-stretch">
                                            <div class="card-header card-header-tabs-line">
                                                <div class="card-toolbar">
                                                    <ul class="nav nav-tabs nav-bold nav-tabs-line" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#fund_wallet">
                                                                <span class="nav-icon"><i class="fas fa-upload"></i></span>
                                                                <span class="nav-text">Topup</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#wallet_history">
                                                                <span class="nav-icon"><i class="fas fa-history"></i></span>
                                                                <span class="nav-text">Airtime Purchase History</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="fund_wallet" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
														<div class="container">
															<?php if (isset($_SESSION['errorMessage'])) { ?>
																<div class="alert alert-danger alert-dismissible fade show" role="alert">
																	<strong>Error:</strong> <?php echo $_SESSION['errorMessage'];?>
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
															<?php unset($_SESSION['errorMessage']); }?>

															<?php if (isset($_SESSION['successMessage'])) { ?>
																<div class="alert alert-custom alert-success fade show text-center" role="alert">
																	Money Sent.
																</div>
															<?php } unset($_SESSION['successMessage']) ?>

															<form class="form" method="POST" action="<?php echo BASE_URL?>controller/product.php">
																<input type="hidden" name="form_url" value="<?php echo BASE_URL.USER_ROOT?>aitime-topup.php">

                                                                <div class="form-group">
                                                                    <label class="col-form-label">Select a Network</label>
                                                                    <div class="row">
																		<?php foreach ($airtime_products as $product => $value) {?>
																			<div class="col-md-3 col-sm-3 col-6">
																				<label class="option">
																					<span class="option-control">
																						<span class="radio radio-bold radio-brand"/>
																							<input type="radio" name="networkType" value="<?php echo $value['product_code']?>"/>
																							<span></span>
																						</span>
																					</span>
																					<span class="option-label">
																						<span class="option-head">
																							<span class="option-focus">
																								<?php echo $value['percentage_discount']?>%
																							</span>
																						</span>
																						<span class="option-body">
																							<img class="img-fluid" src="<?php echo BASE_URL.$value['product_icon']?>" alt="">
																						</span>
																					</span>
																				</label>
																			</div>
																		<?php } ?>
                                                                    </div>
                                                                </div>

																<div class="form-group" >
																	<label>Amount</label>
																	<div class="">
																		<input type="number" name="" id="amount" class="form-control" />
																	</div>
																	<span class="text-danger" id="notice">
																		<strong>NOTICE:</strong> Minimum airtime vending is <?php echo $appInfo->currency_code.number_format($appInfo->min_airtime_vending, 2)?> and maximum airtime vending is <?php echo $appInfo->currency_code.number_format($appInfo->max_airtime_vending, 2)?> 
																	</span>
																</div>

																<div class="form-group" style="display: none;">
																	<label>Amount to pay</label>
																	<input type="text" class="form-control" name="amount" id="to_pay" disabled>
																</div>
	
																<div class="form-group">
																	<label>Reciever's Phone Number</label>
																	<input type="text" name="phone_number" id="phone_number" class="form-control" maxlength="11"/>
																	<span class="text-danger" id="networkMsg"></span>
																</div>


																<div class="form-group" style="display: none;">
																	<label>Transaction Pin</label>
																	<input type="password" class="form-control" name="pin" id="pin">
																</div>

																<input type="submit" name="buy_airtime" class="btn btn-primary mr-2" value="Buy Airtime" id="buyBtn" disabled>
															</form>
														</div>
                                                    </div>

                                                    <div class="tab-pane fade" id="wallet_history" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
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

															<?php include_once './components/walletOutTable.php'?>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<!--end::Wallet-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					
					<?php include_once './components/footer.php';?>

				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->

		<?php include_once './components/quickUser.php';?>

		<?php include_once './components/scrollTop.php';?>
		<?php include_once './components/js.php';?>
		
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
		<script src="assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
		<script>
			var ajaxProcessUrl = "<?php echo BASE_URL.'controller/product.php'?>";
			var currentUser = <?php echo "'".json_encode($user->currentUser)."'"?>;
			currentUser = JSON.parse(currentUser);


			function getNetwork(phone, output) {

				$.ajax({
					url: ajaxProcessUrl,
					type: "post",
					data: {
						"phone" : phone,
						"get_network_code" : 1
					},
					beforeSend: function(){
						output.html("Getting network...");
					},
					success: function(result) {
						output.html(result);
					}
				}) 
        	}

			function getProductDetail(product_code, plan_id) {
				$.ajax({
					url: ajaxProcessUrl,
					type: "post",
					data: {
						"product_code" : phone,
						"plan_id" : plan_id,
						"get_product" : 1
					},
					beforeSend: function(){
					},
					success: function(result) {
						return result;
					}
				}) 
				}

			function showTxnPin(amount, phone, networkType) {
				if (amount != '' && amount != undefined && phone.length == 11 && networkType != '' && networkType != undefined) {
					$('#pin').parent().show();
				} else {
					$('#pin').val('');
					$('#pin').parent().hide();
					$('#buyBtn').prop('disabled', true);
				} 
			}

			function showBtn() {
				var password = $('#pin').val();
				if (password != '' && password != undefined) {
					$('#buyBtn').removeAttr('disabled');
				} else {
					$('#buyBtn').prop('disabled', true);
				} 
			}
			
			// $(document).ready(function() {
				$('#phone_number').on('keyup', function () {
					var amount = $('#amount').val()
					var to_pay = $('#to_pay').val()
	
					var phone = $(this).val();
					var networkMsg = $("#networkMsg");
					var networkType = $("input[name='networkType']:checked").val();
	
					if(phone != '' && phone.length >= 4){
						getNetwork(phone, networkMsg);
					}else{
						networkMsg.html("");
					}
	
					showTxnPin(amount, phone, networkType);
				})
	
				$('#amount').on('keyup', function () {
					
					var phone = $("#phone_number").val();
					var networkType = $("input[name='networkType']:checked").val();
					var minAirtime = <?php echo $appInfo->min_airtime_vending;?>;
					var maxAirtime = <?php echo $appInfo->max_airtime_vending;?>;
	
					var amount = $('#amount').val()
					var to_pay = amount -(amount*1/100);
	
					$('#to_pay').val(to_pay);
	
	
					if (networkType == '' || networkType == undefined) {
						$('#amount').val('');
						$('#to_pay').parent().hide();
						Swal.fire({
							title: "Error",
							text: "Select a network",
							icon: "error"
						});
					} else if (to_pay > currentUser.walletBalance) {
						$('#amount').val('');
						$('#to_pay').parent().hide();
						Swal.fire({
							title: "Error",
							text: "Insufficient wallet balance",
							icon: "error"
						});
					} else if (amount == '' || amount == undefined) {
						$('#to_pay').parent().hide();
					} else {
						showTxnPin(amount, phone, networkType);
						$('#to_pay').parent().show();
					}
				})
	
				$("input[name='networkType']").on('change', function () {
					var amount = $('#amount').val()
					var phone = $("#phone_number").val();
					var networkType = $("input[name='networkType']:checked").val();
	
					$("input[name='networkType']").parents('label.option').removeClass('selected');
					$("input[name='networkType']:checked").parents('label.option').addClass('selected');
	
					showTxnPin(amount, phone, networkType);
				})
	
				$('#pin').on('keyup', function () {
					showBtn();
				})
			// })


		</script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>