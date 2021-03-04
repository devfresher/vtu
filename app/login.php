<?php
require_once '../includes/config.php';
require_once '../model/App.php';
require_once '../components/head.php';

$app = new App($db);
$appInfo = $app->getAppInfo();
?>
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/css/pages/login/classic/login-3.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
	</head>
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url(assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
			<div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(assets/media/bg/bg-1.jpg);">
				<div class="login-form text-center text-white p-7 position-relative overflow-hidden">
					<!--begin::Login Header-->
					<div class="d-flex flex-center mb-15">
						<a href="#">
							<img src="<?php echo BASE_URL.$appInfo->logo?>" class="max-h-100px" alt="" />
						</a>
					</div>
					<!--end::Login Header-->

					<?php include_once '../components/signin.php'?>
					<?php include_once '../components/signup.php'?>
					<?php include_once '../components/forgotPassword.php'?>
					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->

		<?php include_once '../components/js.php';?>
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>