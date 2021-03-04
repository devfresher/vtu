<?php
require_once '../includes/config.php';
require_once '../model/App.php';

	$app = new App($db);
	$appInfo = $app->getAppInfo();
?>

<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>2021VTU</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->

		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?php echo BASE_URL.USER_ROOT?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo BASE_URL.USER_ROOT?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo BASE_URL.USER_ROOT?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->

		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->

		<link rel="shortcut icon" href="<?php echo BASE_URL.$appInfo->logo?>" />