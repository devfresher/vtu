<?php
require_once './components/head.php';
require_once './model/Product.php';
require_once './model/Transaction.php';

$wallet = new Wallet($db);
$product = new Product($db);
$transaction = new Transaction($db);

$electricitDiscos = $product->getProductsWithPlan($user->currentUser->plan->id, 'Electricity Bills');
$purchaseHistory = $transaction->getAllUserTxn($user->currentUser->id, 'Electricity Bills');
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
                                                                <span class="nav-icon"><i class="fas fa-upload"></i></span>
                                                                <span class="nav-text">Vend Electricity</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#wallet_history">
                                                                <span class="nav-icon"><i class="fas fa-history"></i></span>
                                                                <span class="nav-text">Purchase History</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="fund_wallet" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
														<div class="container">
															<form class="form" method="POST" id="buy-airtime-form" action="<?php echo BASE_URL?>controller/product.php">
																<input type="hidden" name="form_url" value="<?php echo BASE_URL.USER_ROOT?>electricity">

                                                                <div class="form-group">
                                                                    <label class="col-form-label">Select a Distribution Company</label>
                                                                    <div class="row">
																		<?php foreach ($electricitDiscos as $productName => $value) {?>
																			<div class="col-md-3 col-sm-3 col-6">
																				<label class="option">
																					<span class="option-control">
																						<span class="radio radio-bold radio-brand">
																							<input type="radio" name="disco_type" value="<?php echo $value['product_code']?>" data-percent = "<?php echo $value['selling_percentage']?>"/>
																							<span></span>
																						</span>
																					</span>
																					<span class="option-label">
																						<span class="option-head">
																							<span class="option-focus">
																								<?php echo 100 - $value['selling_percentage']?>% Off
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
																		<input type="number" id="amount" name="amount" class="form-control" />
																	</div>
																</div>

                                                                <div class="form-group" >
																	<label>Metre Number</label>
																	<div class="">
																		<input type="text" id="metre_no" name="metre_no" class="form-control" />
																	</div>
																</div>

																<div class="form-group" style="display: none;">
																	<label>Amount to pay</label>
																	<input type="text" class="form-control" name="to_pay" id="to_pay" disabled>
																</div>

                                                                <div class="form-group">
                                                                    <div class="checkbox-inline">
                                                                        <label class="checkbox checkbox-success">
                                                                            <input type="checkbox" id="send_sms" name="send_sms"/>
                                                                            <span></span>
                                                                            Send token as sms
                                                                        </label>
                                                                    </div>
																</div>
                                                                
																<div class="form-group" style="display: none;">
																	<label>Reciever's Phone Number</label>
																	<input type="text" name="phone_number" id="phone_number" class="form-control" maxlength="11" required/>
																</div>


																<div class="form-group" style="display: none;">
																	<label>Transaction Pin</label>
																	<input type="password" class="form-control" name="pin" id="pin">
																</div>

																<input type="submit" name="buy_electricity" class="btn btn-primary mr-2" value="Purchase" id="buyBtn" disabled>
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

															<!--begin: Datatable-->
															<table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
																<thead>
																	<tr>
																		<th title="Field #1" class="custom-th">Date / Reference</th>
																		<th title="Field #2" class="custom-th">Meter No / Token</th>
																		<th title="Field #3" class="custom-th">Amount & Balances</th>
																		<th title="Field #4" class="custom-th">Status</th>
																		<th title="Field #5" class="custom-th">Message</th>
																	</tr>
																</thead>
																<tbody>
																	<?php if($purchaseHistory !== false){
																	 	foreach ($purchaseHistory as $history) {?>
																			<tr>
																				<td><?php echo $utility->niceDateFormat($history['date']).'<br><br><strong>'.$history['reference']?></strong></td>
																				<td>
																					<?php echo $history['product_name'].' '.$history['amount'].' - '.'<strong>'.$history['received_by'].'</strong>'?>
																				</td>
																				<td>
																					<label class="label font-weight-bold label-lg label-light-info label-inline">Old: <?php echo $appInfo->currency_code.number_format($history['old_balance'],2)?></label><br><br>
																					<strong>Amount Charged: </strong> <?php echo $appInfo->currency_code.number_format($history['amount_charged'], 2)?><br><br>
																					<label class="label font-weight-bold label-lg label-light-success label-inline">New: <?php echo $appInfo->currency_code.number_format($history['balance_after'],2)?></label>
																				</td>
																				<td><?php echo $history['status']?></td>
																				<td>
																					<?php echo $history['message']?>
																					<?php echo ($history['status'] == 1) ? '<a href="'. BASE_URL.'webhook?requery&id='.$history['order_id'].'" class="btn btn-danger btn-sm requeryBtn" data-orderId="'.$history['order_id'].'">Requery</a>':''?>
																					<?php echo ($history['status'] != 1) ? '<a href="'. BASE_URL.'receipt?refId='.$history['reference'].'" data-orderId="'.$history['order_id'].'"><i class="text-success fas fa-print"></i></a>':''?>
																				</td>
																			</tr>
																		<?php } ?>
																	<?php } ?>
																</tbody>
															</table>
															<!--end: Datatable-->
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
		<script src="<?php echo BASE_URL?>assets/js/pages/crud/ktdatatable/base/txn-table.js"></script>
		<script src="<?php echo BASE_URL?>assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
		<?php include_once './components/message.php'?>

		<script>
			var ajaxProcessUrl = "<?php echo BASE_URL.'controller/product.php'?>";
			var currentUser = <?php echo "'".json_encode($user->currentUser)."'"?>;
			currentUser = JSON.parse(currentUser);

			function showTxnPin(discoType, metreNo, amount) {
				if (amount != '' && amount != undefined && metreNo != '' && metreNo != undefined && discoType != '' && discoType != undefined) {
					$('#pin').parent().show();
				} else {
					$('#pin').val('');
					$('#pin').parent().hide();
					showBtn();
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

            $('#send_sms').on('change', function name() {

                var discoType = $("input[name='disco_type']:checked").val();
                var amount = $('#amount').val()
                var metreNo = $('#metre_no').val();

                if ($('#send_sms').is(':checked')) {
                    $("#phone_number").parents('.form-group').show();
                }else{
                    $("#phone_number").parents('.form-group').hide();
                }

                showTxnPin(discoType, metreNo, amount);
            });

            $('#metre_no').on('keyup', function () {
                var amount = $('#amount').val();
                var metreNo = $(this).val();
                var discoType = $("input[name='disco_type']:checked").val();


                showTxnPin(discoType, metreNo, amount);
            })

            $('#amount').on('keyup', function () {

                var discoType = $("input[name='disco_type']:checked").val();
                var amount = $('#amount').val()
                var metreNo = $('#metre_no').val();
                var sellingPercentage = $("input[name='disco_type']:checked").attr('data-percent');

                var to_pay = amount*sellingPercentage/100;
                $('#to_pay').val(to_pay);

                if (discoType == '' || discoType == undefined) {
                    $('#amount').val('');
                    $('#to_pay').parent().hide();
                    Swal.fire({
                        title: "Error",
                        text: "Select a distribution company",
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
                    $('#to_pay').parent().show();
                }

                showTxnPin(discoType, metreNo, amount);
            })

            $("input[name='disco_type']").on('change', function () {
                var amount = $('#amount').val()
                var discoType = $("input[name='disco_type']:checked").val();
                var metreNo = $('#metre_no').val();

                $("input[name='disco_type']").parents('label.option').removeClass('selected');
                $("input[name='disco_type']:checked").parents('label.option').addClass('selected');

                var sellingPercentage = $("input[name='disco_type']:checked").attr('data-percent');

                var to_pay = amount*sellingPercentage/100;
                $('#to_pay').val(to_pay);

                showTxnPin(discoType, metreNo, amount);
            })

            $('#pin').on('keyup', function () {
                showBtn();
            })

            $("#buyBtn").closest('form').on('submit', function(e) {
                var form = this;
                var metreNo = $('#metre_no').val();
                e.preventDefault();

                var amount = $('#amount').val()	
                var discoType = $("input[name='disco_type']:checked").val();

                Swal.fire({
                    title: 'Electricity Purchase',
                    text: 'Are you sure you want to vend <?php echo $appInfo->currency_text?> '+amount+' '+discoType.toUpperCase() +' to '+ metreNo,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No, Cancel",
                }).then(function(result) {
                    if (result.value) {
                        $('form').append("<input type='hidden' name='buy_electricity'/>");
                        form.submit();
                    }
                });
                
            })

            $('.requeryBtn').each(function() {
                var button = $(this);
                var orderId = button.attr('data-orderId');

                $('.requeryBtn').on('click', function() {
                    $.ajax({
                        url: "<?php echo BASE_URL.'/webhook.php'?>",
                        type: "post",
                        data: {
                            "order_id" : orderId,
                            "requery" : 1
                        },
                        beforeSend: function(){
                            button.html("<i class='fas fa-stroopwafel fa-spin'></i>");
                        },
                        success: function(result) {
                            button.html('Requery');
                        }
                    })
                })
            })


		</script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>