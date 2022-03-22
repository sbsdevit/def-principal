<?php require_once('../partials/_head.php'); ?>
<?php require_once('../partials/_sidebar.php'); ?>
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-content" style="padding : 0px 0px 24px;">
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<?php require_once('../partials/_navbar.php'); ?>
							<div class="page-header">
								<h1><?=$_SESSION['NOMASSUJETTI']; ?> >> MENU GENERAL  </h1>
							</div><!-- /.page-header -->
                            <div class="row">
                            </div>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

	<?php require_once('../partials/_footer.php'); ?>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
            $('#sidebar2').insertBefore('.page-content');
			$('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');
        });
	</script>
</body>
</html>