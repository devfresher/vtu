        <?php if (isset($_SESSION['errorMessage'])) {?>
			<script>
				Swal.fire({
					title: "Failed",
					text: "<?php echo $_SESSION['errorMessage']?>",
					icon: "error"
				});
			</script>
		<?php unset($_SESSION['errorMessage']); }?>

		<?php if (isset($_SESSION['successMessage'])) { ?>
			<script>
				Swal.fire({
					title: "Completed",
					text: "<?php echo $_SESSION['successMessage']?>",
					icon: "success"
				});
			</script>
		<?php } unset($_SESSION['successMessage']) ?>

		<?php if (isset($_SESSION['infoMessage'])) { ?>
			<script>
				Swal.fire({
					title: "Processing",
					text: "<?php echo $_SESSION['infoMessage']?>",
					icon: "info"
				});
			</script>
		<?php } unset($_SESSION['infoMessage']) ?>