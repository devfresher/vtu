<?php
require_once '../includes/config.php';
require_once '../components/head.php';

require_once '../model/User.php';
require_once '../model/Transaction.php';


if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = new User($db);
    $transaction = new Transaction($db);
    
    $transactionList = $transaction->getAllUserTxn($planId);
    $userDetail = $user->getUserById($userId);

    if ($userDetail === false) {
        http_response_code(404);
        include '../error/404.php';
        die();
    }
}else {
    http_response_code(404);
    include '../error/404.php';
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
                                                    <h3 class="card-label"><?php echo $planDetail->plan_name?> Plan
                                                    <span class="d-block text-muted pt-2 font-size-sm">Plan pricing settings</span></h3>
                                                </div>
                                                <div class="card-toolbar">
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
                                                <table class="datatable datatable-bordered datatable-head-custom" id="product_plan_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th title="Field #1" class="custom-th">S/N</th>
                                                            <th title="Field #2" class="custom-th">Product</th>
                                                            <th title="Field #3" class="custom-th">Cost Price</th>
                                                            <th title="Field #4" class="custom-th">Selling Percentage (%)</th>
                                                            <th title="Field #5" class="custom-th">Selling Price </th>
                                                            <th title="Field #6" class="custom-th">Extra Charge</th>
                                                            <th title="Field #7" class="custom-th">Net Selling Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if($productList !== false){
                                                            $i = 1;
                                                            foreach ($productList as $product) {
                                                                $sellingPrice = $appInfo->currency_code.number_format(($product['selling_percentage']/100)*$product['company_price'], 2);
                                                                $netSellingPrice = $appInfo->currency_code.number_format((($product['selling_percentage']/100)*$product['company_price'] + $product['extra_charge']), 2);
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $i?></td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center mb-6">
                                                                            <div class="symbol symbol-40 flex-shrink-0">
                                                                                <div class="symbol-label" style="background-image:url('<?php echo BASE_URL.$product['product_icon']?>')"></div>
                                                                            </div>
                                                                            <div class="ml-2">
                                                                                <?php echo $product['product_name']?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $appInfo->currency_code.number_format($product['cost_price'], 2)?></td>
                                                                    <td>    
                                                                        <div class="input-group">
                                                                            <input type="number" name="selling_percent<?php echo $product['id']?>" class="form-control list-input-sp" placeholder="0" value="<?php echo $product['selling_percentage']?>" aria-label="Percentage (to the nearest number)" disabled/>
                                                                            <input type="hidden" class="company_price" name="company_price<?php echo $product['id']?>" value="<?php echo $product['company_price']?>">
                                                                            <input type="hidden" class="product_code" name="product_code<?php echo $product['id']?>" value="<?php echo $product['product_code']?>">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class=""><span class="selling_price"><?php echo $sellingPrice?></span></td>
                                                                    <td> <input type="number" name="extra_charge<?php echo $product['id']?>" value="<?php echo $product['extra_charge']?>" class="form-control list-input-xc"  placeholder="0.00" aria-label="Extra Charge" disabled/></td>
                                                                    <td class=""><input type="text" name="selling_price<?php echo $product['id']?>" value="<?php echo $netSellingPrice?>" class="net_selling_price form-control" disabled /></td>
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
            $('.edit_list').on('click', function () {
                $('.edit_list').prop('disabled', true);
                $('.submit_prices').removeAttr('disabled');

                $('.list-input-sp').removeAttr('disabled')
                $('.list-input-xc').removeAttr('disabled')

            })

            $(document).on("keyup", '.list-input-sp', function () {
                var companyPrice = $(this).siblings('.company_price').val();
                var extraCharge = $(this).parents("tr").find(".list-input-xc").val();
                extraCharge = extraCharge == '' ? 0:extraCharge;
                
                var sp = parseFloat(($(this).val()/100)*companyPrice, 2);
                var nsp = sp + parseFloat(extraCharge);
                
                var spCol = $(this).parents("tr").find(".selling_price");
                var nSpCol = $(this).parents("tr").find(".net_selling_price");

                spCol.html('<?php echo $appInfo->currency_code ?>'+sp);
                nSpCol.val(nsp);
            })

            $(document).on("keyup", '.list-input-xc', function () {
                var companyPrice = $(this).parents("tr").find('.company_price').val();
                var sellingPrice = $(this).parents("tr").find(".list-input-sp").val();
                
                sellingPrice = parseFloat(sellingPrice == '' ? 0:sellingPrice);

                
                var sp = parseFloat((sellingPrice/100)*companyPrice);
                var nsp = sp + parseFloat($(this).val());
                
                var spCol = $(this).parents("tr").find(".selling_price");
                var nSpCol = $(this).parents("tr").find(".net_selling_price");

                spCol.html('<?php echo $appInfo->currency_code?>'+sp);
                nSpCol.val('<?php echo $appInfo->currency?>'+nsp);
            })

            $('.submit_prices').on('click', function () {

                Swal.fire({
                    icon: 'question',
                    text: 'Are you sure you want to save? This action is irreversible',
                    showCancelButton: true,
                    confirmButtonText: "Yes, sure",
                    cancelButtonText: "Cancel!",
                }).then(function(result) {
                    if (result.value) {
                        var button = $('.submit_prices');
                        var data = '{"update_plan_product" : 1, "data" : [';
                        
                        var i = 1;
                        $('.list-input-xc').each(function () {
                            // var productCodeName = $(this).parents("tr").find(".product_code").attr(name);
                            var productCode = $(this).parents("tr").find(".product_code").val();
        
                            var planId = '<?php echo $_GET['id']?>';
        
                            // var spercName = $(this).parents("tr").find(".list-input-sp").attr(name);
                            var sellingPercentage = $(this).parents("tr").find(".list-input-sp").val();
        
                            // var extraName = $(this).parents("tr").find(".list-input-xc").attr(name);
                            var extraCharge = $(this).parents("tr").find(".list-input-xc").val();
        
                            if(i  == $('.list-input-xc').length){
                                var priceItem = '{"product_code":'+ '"'+productCode+'", "plan_id":'+ '"'+planId+'", "selling_percentage":'+ '"'+sellingPercentage+'", "extra_charge":'+ '"'+extraCharge+'"}';
                            } else {
                                var priceItem = '{"product_code":'+ '"'+productCode+'", "plan_id":'+ '"'+planId+'", "selling_percentage":'+ '"'+sellingPercentage+'", "extra_charge":'+ '"'+extraCharge+'"},';
                            }
                            data += priceItem;
        
                            i++;
                        })
        
                        data += "]}";
        
                        updateData = JSON.parse(data);
        
                        $.ajax({
                            url: "<?php echo BASE_URL.'controller/plan.php'?>",
                            type: "post",
                            data: updateData,
                            beforeSend: function(){
                                button.html("Saving <i class='fas fa-spinner fa-pulse'></i>");
                                button.prop('disabled', true);
                            },
                            success: function(result) {
                                $('.edit_list').removeAttr('disabled');
                                button.html('Save Changes');

                                $('.list-input-sp').prop('disabled', true)
                                $('.list-input-xc').prop('disabled', true)

                                console.log(result);
                                window.location = '<?php echo BASE_URL.ADMIN_ROOT.'plan?id='.$planId?>';
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