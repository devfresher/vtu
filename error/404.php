<?php
require_once '../includes/config.php';
require_once '../'.COMPONENT_DIR.'head.php';
?>
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="<?php echo BASE_URL?>assets/css/pages/error/error-3.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
	</head>
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url(<?php echo BASE_URL?>assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
	    <!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Error-->
			<div class="error error-3 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url(<?php echo BASE_URL?>assets/media/error/bg3.jpg);">
				<!--begin::Content-->
				<div class="px-10 px-md-30 py-10 py-md-0 d-flex flex-column justify-content-md-center">
					<h1 class="error-title text-stroke text-transparent">404</h1>
					<p class="display-4 font-weight-boldest text-white mb-12">How did you get here</p>
					<p class="font-size-h1 font-weight-boldest text-dark-75">Sorry we can't seem to find the page you're looking for.</p>
					<p class="font-size-h4 line-height-md">There may be a misspelling in the URL entered,or the page you are looking for may no longer exist.</p>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Error-->
		</div>
		<!--end::Main-->

        <?php include_once './components/js.php';?>

        <!--begin::Page Scripts(used by this page)-->
        <script>
        </script>
        <!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>