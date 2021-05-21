<?php
require_once '../includes/config.php';
require_once '../components/head.php';
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
                                                    <h3 class="card-label">SMS Settings
                                                    <span class="d-block text-muted pt-2 font-size-sm">Default settings</span></h3>
                                                </div>
                                                <div class="card-toolbar">
                                                    <ul class="nav nav-tabs nav-bold nav-tabs-line" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#settings">
                                                                <span class="nav-icon"><i class="fas fa-cogs"></i></span>
                                                                <span class="nav-text">Settings</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#messages">
                                                                <span class="nav-icon"><i class="far fa-comment-alt"></i></span>
                                                                <span class="nav-text">Messages</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">                                            
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                                        <div class="container">
                                                            <form class="form" method="POST" id="sms-settings-form" action="<?php echo BASE_URL?>controller/sms-settings.php">
                                                                <input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>sms-settings">

                                                                <div class="form-group" >
                                                                    <label>Sender ID</label>
                                                                    <div class="">
                                                                        <input type="text" id="sender_id" name="sender_id" value="<?php echo $appInfo->sms_sender_id?>" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>SMS Route</label>
                                                                    <select name="sms_route" id="sms_route" class="form-control selectpicker" data-size="4">
																		<option value="">--Select--</option>
																		<option value="dnd" <?php echo ($appInfo->sms_route == 'dnd') ? 'selected':''?>>DND</option>
																		<option value="non_dnd" <?php echo ($appInfo->sms_route == 'non_dnd') ? 'selected':''?>>Non DND</option>
                                                                        <option value="premium" <?php echo ($appInfo->sms_route == 'premium') ? 'selected':''?>>Premium Route</option>
																	</select>
                                                                </div>

                                                                <input type="submit" name="save_settings" class="btn btn-primary mr-2" value="Save Changes" id="saveSettings">
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                                        <div class="card-body">
                                                            <!--begin: Datatable-->
                                                            <form class="form" method="POST" id="sms-messages-form" action="<?php echo BASE_URL?>controller/sms-settings.php">
                                                                <input type="hidden" name="form_url" value="<?php echo BASE_URL.ADMIN_ROOT?>sms-settings">

                                                                <table class="datatable datatable-bordered datatable-head-custom" id="sms_settings_datatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th title="Field #1" class="custom-th">Title</th>
                                                                            <th title="Field #2" class="custom-th">Message</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Registration Message</td>
                                                                            <td>
                                                                                <textarea name="reg_msg" id="reg_msg" row="7" value="<?php echo $appInfo->sms_registration_msg?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Blocked Registration Message</td>
                                                                            <td>
                                                                                <textarea name="bl_reg_msg" id="bl_reg_msg" row="7" value="<?php echo $appInfo->sms_blocked_registeration?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Approval Message</td>
                                                                            <td>
                                                                                <textarea name="approval_msg" id="approval_msg" row="7" value="<?php echo $appInfo->sms_wallet_request_approval?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Order Refund Message</td>
                                                                            <td>
                                                                                <textarea name="order_refund_msg" id="order_refund_msg" row="7" value="<?php echo $appInfo->sms_order_refund?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Wallet Crediting Request Message</td>
                                                                            <td>
                                                                                <textarea name="wallet_request_msg" id="wallet_request_msg" row="7" value="<?php echo $appInfo->sms_wallet_crediting?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Low Credit Message</td>
                                                                            <td>
                                                                                <textarea name="low_wallet_msg" id="low_wallet_msg" row="7" value="<?php echo $appInfo->sms_low_credit?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Wallet Share (Sender)</td>
                                                                            <td>
                                                                                <textarea name="sender_wallet_share_msg" id="sender_wallet_share_msg" row="7" value="<?php echo $appInfo->sms_sender_wallet_share?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Wallet Share (Receiver)</td>
                                                                            <td>
                                                                                <textarea name="receiver_wallet_share_msg" id="receiver_wallet_share_msg" row="7" value="<?php echo $appInfo->sms_receiver_wallet_share?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Deduction Message</td>
                                                                            <td>
                                                                                <textarea name="deduction_msg" id="deduction_msg" row="7" value="<?php echo $appInfo->sms_deduction?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Electricity Message</td>
                                                                            <td>
                                                                                <textarea name="electricity_msg" id="electricity_msg" row="7" value="<?php echo $appInfo->sms_electricity?>" class="form-control"></textarea>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                
                                                                <input type="submit" name="save_messages" class="btn btn-primary mr-2" value="Save Changes" id="saveSettings">
                                                            </form>
                                                            <!--end: Datatable-->                                                     
                                                        </div>
                                                    </div>
                                                </div>
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
            
        </script>
		<!--end::Page Vendors-->
	</body>
	<!--end::Body-->
</html>