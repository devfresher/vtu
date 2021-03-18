<?php
require_once './includes/config.php';
require_once './components/head.php';
require_once './model/Transaction.php';

$transaction = new Transaction($db);
if (!isset($_REQUEST['refId']) OR $_REQUEST['refId'] == '') {
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        header('Location: '.BASE_URL.USER_ROOT);
    }
} else {
    $refId = filter_var($_REQUEST['refId'], FILTER_SANITIZE_STRING);

    $transactionItem = $transaction->getTxn($refId);
}
?>
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="<?php echo BASE_URL.USER_ROOT?>assets/css/pages/invoice/invoice-6.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url(assets/media/bg/bg-10.jpg)" class="print-content-only quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
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
								<div class="card card-custom overflow-hidden">
									<div class="card-body invoice-6 p-0">
										<!--begin::Invoice-->
										<div class="invoice-6-container bgi-size-contain bgi-no-repeat bgi-position-y-top bgi-position-x-center" style="background-image: url(assets/media/svg/shapes/abstract-10.svg);">
											<div class="container">
												<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
													<div class="col-md-9">
														<!--begin::Invoice header-->
														<div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-40">
															<h1 class="display-3 font-weight-boldest text-white mb-5 mb-md-0">Receipt</h1>
															<div class="d-flex flex-column px-0 text-right">
																<span class="d-flex flex-column font-size-h5 font-weight-bold text-white align-items-center align-items-md-end">
                                                                    <span class="mb-2">Refrence <?php echo $transactionItem->reference?></span>
																	<span class="mb-2">Order Id # <?php echo $transactionItem->order_id?></span>
																	<span><?php echo $utility->niceDateFormat($transactionItem->date)?></span>
																</span>
															</div>
														</div>
														<!--end::Invoice header-->
														<!--begin::Invoice body-->
														<div class="table-responsive">
															<table class="datatable datatable-bordered datatable-head-custom p-5" id="receipt_datatable">
																<thead>
																	<tr class="font-weight-boldest title-color">
																		<th class="align-middle font-size-h4 pl-0 border-0 p-5">DESCRIPTION</th>
                                                                        <th class="align-middle font-size-h4 pl-0 border-0 p-5">RECEIPIENT</th>
                                                                        <th class="align-middle font-size-h4 pl-0 border-0 p-5">STATUS</th>
																		<!-- <th class="align-middle font-size-h4 text-right pr-0 border-0 p-5 pb-12">AMOUNT PAID</th> -->
																	</tr>
																</thead>
																<tbody>
																	<tr class="font-size-h5 font-weight-bolder">
																		<td class="align-middle pl-0 border-0 p-4"><?php echo $transactionItem->amount.'-'.$transactionItem->product_plan_name.' '.$transactionItem->category ?></td>
                                                                        <td class="align-middle pl-0 border-0 p-4"><?php echo $transactionItem->received_by ?></td>
                                                                        <td class="align-middle pl-0 border-0 p-4"><?php echo $transactionItem->status ?></td>
																		<!-- <td class="align-middle text-right text-primary font-weight-boldest font-size-h5 pr-0 border-0 p-4"><?php echo $appInfo->currency_code.$transactionItem->amount_charged?></td> -->
																	</tr>
																</tbody>
															</table>
														</div>
														<!--end::Invoice body-->
														<div class="border-bottom w-100 my-13 opacity-15"></div>
														<!--begin::Invoice note-->
														<div class="d-flex flex-wrap align-items-end mt-10">
															<div>
                                                            <div class="font-weight-boldest font-size-h4 mb-3 title-color">ISSUED TO</div>
                                                                <?php $receiptUser = $user->getUserById($transactionItem->user_id)?>
                                                                <div class="d-flex flex-column font-size-h5 font-weight-bold text-white">
                                                                    <span class="mb-2">
                                                                        <?php echo $receiptUser->firstname.' '.$receiptUser->lastname?>
                                                                    </span>
                                                                    <span class="">
                                                                        <?php echo $receiptUser->phone_number?>
                                                                    </span>
                                                                </div>
															</div>
															<button type="button" class="btn btn-danger font-weight-bolder font-size-lg ml-sm-auto px-5 py-4" onclick="window.print();"><i class="fas fa-print"></i>Print</button>
														</div>
														<!--end::Invoice note-->
														<!--begin::Invoice footer-->
														<div class="d-flex justify-content-between flex-column flex-sm-row text-center text-sm-left mt-30">
															<div class="font-size-h2 font-weight-bolder text-white">Thanks For Your Order</div>
														</div>
														<!--end::Invoice footer-->
													</div>
												</div>
											</div>
										</div>
										<!--end::Invoice-->
									</div>
								</div>
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
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>