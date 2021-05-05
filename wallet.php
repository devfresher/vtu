<?php
require_once './includes/config.php';
require_once './components/head.php';

$loggedInUser = $user->loggedInUser();
$wallet = new Wallet($db);
$histories = $wallet->getWalletFundingHistories($user->currentUser->id);
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

						<?php include_once './components/subToolBar.php'?>

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
                                                                <span class="nav-icon"><i class="fas fa-wallet"></i></span>
                                                                <span class="nav-text">Fund Wallet Request</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#wallet_history">
                                                                <span class="nav-icon"><i class="fas fa-history"></i></span>
                                                                <span class="nav-text">Wallet History</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="fund_wallet" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
														<div class="container">
															<form class="form" method="POST" action="<?php echo BASE_URL?>controller/wallet.php">
																<input type="hidden" name="form_url" value="<?php echo BASE_URL.USER_ROOT?>wallet.php">
																<div class="form-group">
																	<label>Amount</label>
																	<div class="">
																		<input type="number" name="amount_requested" id="amount_requested" class="form-control" id="" min="<?php echo $appInfo->min_fund_request?>"/>
																		<span class="form-text text-muted"><code>Minimum wallet funding is <?php echo $appInfo->currency_code.$appInfo->min_fund_request?></code></span>
																	</div>
																</div>
	
																<div class="form-group">
																	<label>Payment Method:</label>
																	<select name="method" id="pay_method" class="form-control selectpicker" data-size="4">
																		<option value="">--Select--</option>
																		<?php if ($appInfo->payment_settings->allowMonnifyPayment === true OR $appInfo->payment_settings->allowPaystackPayment === true OR $appInfo->payment_settings->allowRavePayment === true) {?>
																			<option value="auto_fund">Auto Funding</option>
																		<?php } ?>
																		<option value="manual">Manual Funding (Bank Deposit/Tranfer)</option>
																	</select>
																	<span class="form-text text-muted">A preferred method of payment</span>
																</div>

																<div class="form-group" style="display: none;">
																	<label>Amount to be Credited</label>
																	<input class="form-control" name="" id="wallet_credit" value="0" disabled>
																</div>
																<?php if ($appInfo->payment_settings->allowMonnifyPayment === true OR $appInfo->payment_settings->allowPaystackPayment === true OR $appInfo->payment_settings->allowRavePayment === true) {?>

																	<div class="form-group" style="display: none;">
																		<label>Auto Type:</label>
																		<select name="auto_type" id="auto_type" class="form-control selectpicker" data-size="4">
																			<option value="">--Select--</option>

																			<?php if ($appInfo->payment_settings->allowMonnifyPayment === true) {?>
																				<option value="monnify_wema">Monify Payment (Wema)</option>
																				<option value="monify_sterling">Monify Payment (Sterling)</option>
																			<?php } ?>

																			<?php if ($appInfo->payment_settings->allowRavePayment === true) {?>
																				<option value="rave">Rave Payment</option>
																			<?php } ?>

																			<?php if ($appInfo->payment_settings->allowPaystackPayment === true) {?>
																				<option value="paystack">Paystack Payment</option>
																			<?php } ?>

																		</select>
																	</div>
																<?php } ?>
																
																<input type="submit" name="fund_wallet" class="btn btn-primary mr-2" value="Request">
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

															<?php include_once './components/walletInTable.php'?>
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
		<script src="<?php echo BASE_URL?>assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
		<script src="<?php echo BASE_URL?>assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
		<?php include_once './components/message.php'?>
		
		<script>
			function selectOption(selectElementId, selectValue) {
				$("#"+selectElementId+" option:selected").prop("selected", false);
				$("#"+selectElementId+" option[value='"+selectValue+"']").prop('selected', true);
			}

			$('#amount_requested').on('keypress', function () {
				selectOption('pay_method', '');
			})

			$('#pay_method').on('change', function () {
				var method = $('#pay_method').val();
				var amountRequested = $('#amount_requested').val();
				var minFundRequest = <?php echo $appInfo->min_fund_request;?>;

				if (amountRequested == '' || amountRequested == undefined) {
					if (method != '' && method != undefined) {
						selectOption('pay_method', '');
						Swal.fire({
							title: "Error",
							text: "Enter a valid amount",
							icon: "error",
						});
					}
				} else if (amountRequested < minFundRequest){
					selectOption('pay_method', '');
					Swal.fire({
						title: "Error",
						text: "Your Requested amount must be <?php echo $appInfo->currency.$appInfo->min_fund_request?> and above.",
						icon: "error",
					});
				} else {
					switch (method) {
						case 'manual':
							Swal.fire({
								title: "Bank Deposit",
								text: "Funding via Bank Deposit or Transfer attracts <?php echo $appInfo->currency.$appInfo->bank_stampduty ?> stamp duty on every payment of <?php echo $appInfo->currency.$appInfo->min_stampduty ?> and above. You need to contact the admin for manual crediting",
								icon: "info",
								showCancelButton: true,
								confirmButtonText: "Ok",
								cancelButtonText: "Cancel!",
							}).then(function(result) {
								if (result.value) {
									var bank_stampduty = <?php echo $appInfo->bank_stampduty;?>;
									var min_stampduty = <?php echo $appInfo->min_stampduty;?>;
									
									if (amountRequested >= min_stampduty) {
										var walletCredit = amountRequested - bank_stampduty;
									} else {
										var walletCredit = amountRequested;
									}

									$('#wallet_credit').val(walletCredit);
									$('#wallet_credit').parents().show();
									$('#auto_type').parents('.form-group').hide();


									$('#amount_requested').on('keyup', function () {
										amountRequested = $('#amount_requested').val();
										if (amountRequested >= min_stampduty){
											var walletCredit = amountRequested - bank_stampduty;
										} else {
											var walletCredit = amountRequested;
										}

										$('#wallet_credit').val(walletCredit);
									})
								}
							})

							break;
							
						case 'auto_fund':
							Swal.fire({
								title: "Auto Funding",
								text: "Auto Funding attracts <?php echo $appInfo->currency.$appInfo->auto_funding_charge ?> charge on every payment. Wallet will be credited instantly after successful payment.",
								icon: "info",
								showCancelButton: true,
								confirmButtonText: "Ok",
								cancelButtonText: "Cancel!",
							}).then(function(result) {
								if (result.value) {
									var autoFundingCharge = <?php echo $appInfo->auto_funding_charge;?>;
	
									if (amountRequested < autoFundingCharge) {
										Swal.fire({
											title: "Error",
											text: "Your Requested amount must be greater than <?php echo $appInfo->currency.$appInfo->auto_funding_charge?>.",
											icon: "error",
										});
									} else {
										var walletCredit = amountRequested - autoFundingCharge;

										$('#wallet_credit').val(walletCredit);

										$('#wallet_credit').parent().show();

										$('#auto_type').parents('.form-group').show();
									}

									$('#amount_requested').on('keyup', function () {
										amountRequested = $('#amount_requested').val();

										if (amountRequested < autoFundingCharge) {
											Swal.fire({
												title: "Error",
												text: "Your Requested amount must be greater than <?php echo $appInfo->currency.$appInfo->auto_funding_charge?>.",
												icon: "error",
											});
										} else {
											var walletCredit = amountRequested - autoFundingCharge;
											$('#wallet_credit').val(walletCredit);
										}
									})
								}
							});
							break;
	
						default:
							$('#wallet_credit').val(0);
							$('#wallet_credit').parent().hide();
							$('#auto_type').parents('.form-group').hide();
							break;
					}

				}


			});
		</script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>