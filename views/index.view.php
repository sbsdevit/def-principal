<?php require_once('partials/head.php'); //Head include ?>
<style>
	.input-icon > .ace-icon {top: -30px;line-height: 20px}
	.form-floating > label {padding: .7rem .75rem}
</style>
	<body class="login-layout" style="background: url('assets/images/bg3.jpg') no-repeat 0 0;background-size: auto;background-position: center center;background-size: cover;">
		<div class="main-container" style="min-height: 100vh;background-color: #17527D;opacity: 0.87;">	
			<div class="main-content">
				<div class="space-18"></div>
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<img class="img img-circle" src="assets/images/dgi_logo.jpg" alt="" style="width: 110px;height: 110px;">
								<h4 class="white" id="id-company-text">&copy; DGI RDC</h4>
							</div>
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h3 class="header blue lighter bigger">
												<i class="ace-icon fa fa-unlock blue"></i>
												Authentifiez-vous
											</h3>
											<div class="space-6"></div>
											<form>
												<fieldset>
													<div class="field-wrapper">
														<input type="text" id="numerodef">
														<div class="field-placeholder"><span>Numéro DEF de l'assujetti <span class="required">*</span></span></div>
													</div>
													<div class="field-wrapper">
														<input type="text" id="iduser">
														<div class="field-placeholder"><span>Identifiant de l'utilisateur <span class="required">*</span></span></div>
													</div>
													<div class="field-wrapper">
														<input type="password" id="motdepasse">
														<div class="field-placeholder"><span>Mot de passe <span class="required">*</span></span></div>
													</div>
													<label>
														<input type="checkbox" class="ace showpw" />
														<span class="lbl"> Afficher le mot de passe</span>
													</label>
													<div class="space div-hidden"></div>
													<div class="clearfix div-hidden"></div>
													<div class="div-alert" style="width: 100%; margin-bottom:5px"></div>
													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-primary btnconnexion" style="padding: 4px 4px;">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Connexion</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
											<div class="space-6"></div>
											<div class="social-or-login center">
												<span class="bigger-130 registerLinck">Identification de l'assujetti</span>
											</div>
											<div class="space-6"></div>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="assets/js/bootbox.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">			
			//Ajuster les labels form-floating lors de la prise du curseur 
			jQuery(function($) {
				$(".field-wrapper .field-placeholder").on("click", function () {
					$(this).closest(".field-wrapper").find("input").focus();
				});

				$(".field-wrapper input").on("keyup", function () {
					var value = $.trim($(this).val());
					if (value) {
						$(this).closest(".field-wrapper").addClass("hasValue");
					} else {
						$(this).closest(".field-wrapper").removeClass("hasValue");
					}
				});

				$('.registerLinck').on('click', function(e){
					window.location.href='register.php';
					e.preventDefault();
				});

				$('.showpw').click(function(){
	                if (this.checked) {
	                    $('#motdepasse').attr('type', 'text');
	                }else{
	                    $('#motdepasse').attr('type', 'password');
	                }
	            });

				$('.btnconnexion').click(function(e){
					e.preventDefault();
					var numerodef=$.trim($('#numerodef').val());
					var motdepasse=$.trim($('#motdepasse').val());
					var iduser=$.trim($('#iduser').val());
					var action='loginAssujetti';

					$.ajax({
						url:"login.ajax.php",
						method:"POST",
						dataType:"json",
						data:{numerodef:numerodef, iduser:iduser, motdepasse:motdepasse, action:action},
						success:function(data){
							if ((data.failure !='') && (data.success =='')){
									bootbox.dialog({
										message: data.failure, 
										buttons: {
											"danger" : {
												"label" : "OK",
												"className" : "btn-sm btn-danger"
											}
										}
									});
							}else if ((data.failure =='') && (data.success !='')){
								$('.div-hidden').fadeOut(0);
								$('.div-alert').html(data.success);
								$('.div-alert').fadeIn();
								$('.div-alert').fadeOut(4000, function(){
									if (data.categorieAssujetti == 'pmc' || data.categorieAssujetti == 'ppc'){
										$('.div-hidden').fadeIn(0);
										location.href='trading/dashboard_trading.php';
									}else{
										//Pour les personnes morales non commerçantes
										//Est-ce une école ? un hôpital ? 
									}
									
								});	
							}
						}
					});
				});

				$('.login-layout').bind('keypress', function(e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if(code == 13) { //La touche Entrée a été appuyée
						$('.btnconnexion').click();
					}
				});
			 
			});
		</script>
	</body>
</html>
