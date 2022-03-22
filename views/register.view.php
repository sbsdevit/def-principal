<?php require_once('partials/head.php'); ?>
<style>
    .description-logo h3{margin:0px;line-height: 4em;font-weight: bold;}
    .breadcrumb .home-icon {vertical-align: middle;line-height: 3.5em}
    .page-header {border: 0; padding-bottom: 0px;padding-top: 5px}
</style>
	<body class="body-register">
		<div class="row">
			<div class="col-md-10 col-md-offset-1" style="padding: 0px;">
				<div style="background: #438EB9;min-height: 45px;color:#fff;padding-top:10px;padding-bottom:5px">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-2" style="margin-left:10px">
									<div class="center">
										<a href="#">
											<img class="img img-circle" src="assets/images/dgi_logo.jpg" alt="" style="width: 80px;height: 80px;">
										</a>
									</div>
								</div>
								<div class="col-md-9 description-logo">
									<h3>Dispositif Electronique Fiscal</h3>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<ul class="breadcrumb pull-right">
								<li style="color:#fff">
									<i class="ace-icon fa fa-key home-icon"></i>
									<a href="index.php" style="color:#fff">Je me connecte</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="main-container ace-save-state" id="main-container">
					<div class="main-content">
						<div class="main-content-inner">
							<div class="page-content">
								<div class="page-header">
									<h1 class="text-center">
										Fiche d'identification des assujetis
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div class="widget-box">
											<div class="widget-body">
												<div class="widget-main">
													<div id="fuelux-wizard-container">
														<div>
															<ul class="steps">
																<li data-step="1" class="active">
																	<span class="step">1</span>
																	<span class="title">Qui êtes-vous</span>
																</li>

																<li data-step="2">
																	<span class="step">2</span>
																	<span class="title">Identification</span>
																</li>

																<li data-step="3">
																	<span class="step">3</span>
																	<span class="title">Génération du N° DEF</span>
																</li>
															</ul>
														</div>

														<hr />

														<div class="step-content pos-rel">
															<div class="step-pane active" data-step="1" style="min-height: 100px">
																<div class="row">
																	<div class="col-md-4 col-md-offset-4">
																		<div class="widget-box">
																			<div class="widget-header">
																				<div class="widget-header">
																					<h4 class="widget-title">Qui êtes-vous</h4>
																				</div>
																			</div>
																			<div class="widget-body" style="padding-top: 10px;">
																				<div class="control-group">
																					<div class="radio" style="display: none;">
																						<label>
																							<input type="radio" value="" class="ace categorie-assujetti" name="categorie-assujetti">
																							<span class="lbl"></span>
																						</label>
																					</div>
																					<div class="radio">
																						<label>
																							<input type="radio" value="PersonneMoraleCommerçante" class="ace categorie-assujetti" name="categorie-assujetti">
																							<span class="lbl"> Personne morale commerçante</span>
																						</label>
																					</div>
																					<div class="radio">
																						<label>
																							<input type="radio" value="PersonneMoraleNonCommerçante" class="ace categorie-assujetti" name="categorie-assujetti">
																							<span class="lbl"> Personne morale non-commerçante</span>
																						</label>
																					</div>
																					<div class="radio">
																						<label>
																							<input type="radio" value="PersonnePhysiqueCommerçante" class="ace categorie-assujetti" name="categorie-assujetti">
																							<span class="lbl"> Personne physique commerçante</span>
																						</label>
																					</div>
																					<div class="radio">
																						<label>
																							<input type="radio" value="PersonnePhysiqueNonCommerçante" class="ace categorie-assujetti" name="categorie-assujetti">
																							<span class="lbl"> Personne physique non-commerçante</span>
																						</label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<div class="step-pane" data-step="2">
																<form>
																	<div class="row div-assujetti">
																	</div>
																</form>
															</div>

															<div class="step-pane" data-step="3">
																<div class="row">
																	<div class="col-md-6 col-md-offset-3 widget-container-col" id="widget-container-col-1">
																		<div class="widget-box" id="widget-box-1">
																			<div class="widget-header">
																				<h5 class="widget-title">Vérification de conformité et génération du N° DEF</h5>

																				<div class="widget-toolbar">
																					<a href="#" data-action="fullscreen" class="orange2">
																						<i class="ace-icon fa fa-expand"></i>
																					</a>
																					<a href="#" data-action="collapse">
																						<i class="ace-icon fa fa-chevron-up"></i>
																					</a>
																				</div>
																			</div>

																			<div class="widget-body">
																				<div class="widget-main">
																					<p class="alert alert-info">
																						Félicitation ! Après traitement et prise en charge de vos données, le système vous a 
																						fourni ci-dessous un numéro DEF qui vous servira pour toutes authentification et 
																						transactions commerciales dans la plateforme DEF-RDC. Votre Nom d'utilisateur et 
																						Mot de passe par défaut sont : <b>@Admin</b> et : <b><span class="defaultpw"></span></b>
																					</p>
																					<p class="alert alert-success">
																						Votre Numéro DEF est : <b><span class="numeroDEF"></span></b>
																					</p>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<hr style="margin-top: 5px;margin-bottom:5px" />
													<div class="wizard-actions" style="display: none;">
														<button class="btn btn-prev">
															<i class="ace-icon fa fa-arrow-left"></i>
															Prev
														</button>

														<button class="btn btn-success btn-next" data-last="Finish">
															Next
															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
													<div class="wizard-actions">
														<button class="btn btn-precedent2" style="display: none;">
															<i class="ace-icon fa fa-arrow-left"></i>
															Précédent
														</button>
														<button class="btn btn-success btn-suivant1" style="display: none;">
															Suivant
															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
														<button class="btn btn-success btn-suivant2" style="display: none;">
															Suivant
															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
														<button class="btn btn-success btn-suivant3" style="display: none;">
															Terminer
															<i class="ace-icon fa fa-check icon-on-right"></i>
														</button>
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
							</div><!-- /.page-content -->
						</div>
					</div><!-- /.main-content -->
					<?php require_once('partials/footer.php'); ?>
			</div>
		</div>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$.mask.definitions['~']='[+-]';

				//Pour les labels flottants des inputs
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

				function validNumeric(chars) {
			        // Caractères autorisés
			        var regex = new RegExp("[0-9]", "i");
			        var valid;
			        for (x = 0; x < chars.value.length; x++) {
			            valid = regex.test(chars.value.charAt(x));
			            if (valid == false) {
			                chars.value = chars.value.substr(0, x) + chars.value.substr(x + 1, chars.value.length - x + 1); x--;
			            }
			        }
			    }

				$(document).on('focus', '#dateCreation', function(){
					$(this).mask('99/99/9999');
				});

				$(document).on('focus', '#dateNaissance', function(){
					$(this).mask('99/99/9999');
				});

				$(document).on('keyup', '#nbreEmploye', function(e){
					e.preventDefault();
					validNumeric(this);
				});

				$(document).on('focus', '#telephoneEntreprise', function(e){
					$(this).mask('(+243)999999999');
				});

				$(document).on('focus', '#telephoneAssujetti', function(e){
					$(this).mask('(+243)999999999');
				});

				//Catégorie des assujettis
				$('.categorie-assujetti').click(function(){
					if (this.checked) {
						let categorieAssujetti=$(this).val();
						if (categorieAssujetti=='') {
							$('.btn-suivant1').fadeOut(0);
						}else{
							$('.btn-suivant1').fadeIn(0);
						}
					}
				});

				//Ceci concerne la comboBox Etat civil
				//Le bloc se cache et se réapparait selon que l'assujetti soit célibataire ou marié
				$(document).on("change", "#etatCivil", function(){
					let etatCivil = $(this).val();
					if (etatCivil == 'Célibataire') {
						$('.identite-conjoint').hide();
					}else{
						$('.identite-conjoint').show();
					}
				});

				//Le boutons suivant et précédent de l'étape 1 agissent sur les actions clic
				//de deux boutons btn-next et btn-prev
				function btnSuivant1(){
					let categorieAssujetti=getValueRadioChecked('categorie-assujetti');
					$.ajax({
						url:"categorieassujetti.ajax.php",
						method:"POST",
						data:{categorieAssujetti:categorieAssujetti},
						success:function(data){
							$('.div-assujetti').html(data);
							$('.btn-next').click();
							$('.btn-suivant1').fadeOut(0);
							$('.btn-precedent2').fadeIn(0);
							$('.btn-suivant2').fadeIn(0);
							$('.btn-suivant3').fadeOut(0);
						}
					});
				}
				$(document).on("click", ".btn-suivant1", function(){
					btnSuivant1();
				});

				//Le boutons suivant et précédent de l'étape 2 agissent sur les actions clic
				//de deux boutons btn-next et btn-prev
				$(document).on("click", ".btn-precedent2", function(){
					$('.btn-prev').click();
					$('.btn-precedent2').fadeOut(0);
					$('.btn-suivant1').fadeIn(0);
					$('.btn-suivant2').fadeOut(0);
					$('.btn-suivant3').fadeOut(0);
				});

				$('.btn-suivant3').on('click', function(e){
					location.href='index.php';
					e.preventDefault();
				});

				//Enregistrement des assujettis par rapport à la catégorie 
				// choisie à l'étape une
				function enregistrerAssujetti(){
					let categorieAssujetti=getValueRadioChecked('categorie-assujetti');
					//Les champs communs
					let secteurActivite = $('#secteurActivite').val();
					let rccm = $('#rccm').val();
					let nidNational = $('#nidNational').val();
					let nif = $('#nif').val();
					let siegeScoial = $('#siegeScoial').val();
					let siegeExploitation = $('#siegeExploitation').val();
					let telephoneEntreprise = $('#telephoneEntreprise').val();
					let emailEntreprise = $('#emailEntreprise').val();
					let nomsResponsable = $('#nomsResponsable').val();
					let nationaliteResponsable = $('#nationaliteResponsable').val();
					let fonctionResponsable = $('#fonctionResponsable').val();
					let nomsAssujetti = $('#nomsAssujetti').val();
					let sexe = $('#sexe').val();
					let etatCivil = $('#etatCivil').val();
					let lieuNaissance = $('#lieuNaissance').val();
					let dateNaissance = $('#dateNaissance').val();
					let numeroCarteIdentite = $('#numeroCarteIdentite').val();
					let profession = $('#profession').val();
					let domicile = $('#domicile').val();
					let adresseActivite = $('#adresseActivite').val();
					let nomsConjoint = $('#nomsConjoint').val();
					let typeMariage = $('#typeMariage').val();
					let regimeMatrimonial = $('#regimeMatrimonial').val();
					let professionConjoint = $('#professionConjoint').val();
					let telephoneAssujetti = $('#telephoneAssujetti').val();
					let emailAssujetti = $('#emailAssujetti').val();

					if (categorieAssujetti == 'PersonneMoraleCommerçante') {

						let raisonSociale = $('#raisonSociale').val();
						let sigle = $('#sigle').val();
						let lieuCreation = $('#lieuCreation').val();
						let dateCreation = $('#dateCreation').val();
						let typeSociete = $('#typeSociete').val();						
						let nbreEmploye = $('#nbreEmploye').val();
						let placeEntreprise = $('#placeEntreprise').val();
						let typeActivite = getValueRadioChecked('typeActivite');
						let action ='Insert_Personne_Morale_Com';

						$.ajax({
							url:"assujetti.ajax.php",
							method:"POST",
							data:{raisonSociale:raisonSociale, sigle:sigle, lieuCreation:lieuCreation, dateCreation:dateCreation,
									rccm:rccm, nidNational:nidNational, nif:nif, typeSociete:typeSociete, siegeScoial:siegeScoial,
									siegeExploitation:siegeExploitation, nbreEmploye:nbreEmploye, placeEntreprise:placeEntreprise,
									secteurActivite:secteurActivite, typeActivite:typeActivite, telephoneEntreprise:telephoneEntreprise, emailEntreprise:emailEntreprise,
									 action:action},
							dataType:"json",
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
									$('.numeroDEF').text(data.numdef);
									$('.defaultpw').text(data.defaultpw);
									$('.btn-next').click();
									$('.btn-suivant3').fadeIn(0);
									$('.btn-suivant2').fadeOut(0);
									$('.btn-precedent2').fadeOut(0);
								}
							}
						});
					}else  if (categorieAssujetti == 'PersonneMoraleNonCommerçante'){
						let nomsRepresentant = $('#nomsRepresentant').val();
						let numeroAccordSiege = $('#numeroAccordSiege').val();
						let numeroAutorisationFonctionnement = $('#numeroAutorisationFonctionnement').val();
						let siegeAdministratif = $('#siegeAdministratif').val();
						let action ='Insert_Personne_Morale_Non_Com';

						$.ajax({
							url:"assujetti.ajax.php",
							method:"POST",
							data:{secteurActivite:secteurActivite, nomsResponsable:nomsResponsable, nationaliteResponsable:nationaliteResponsable,
									fonctionResponsable:fonctionResponsable, nomsRepresentant:nomsRepresentant, numeroAccordSiege:numeroAccordSiege,
									numeroAutorisationFonctionnement:numeroAutorisationFonctionnement, nidNational:nidNational, nif:nif, siegeScoial:siegeScoial,
									siegeAdministratif:siegeAdministratif, siegeExploitation:siegeExploitation, telephoneEntreprise:telephoneEntreprise, 
									emailEntreprise:emailEntreprise, action:action},
							dataType:"json",
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
									$('.numeroDEF').text(data.numdef);
									$('.defaultpw').text(data.defaultpw);
									$('.btn-next').click();
									$('.btn-suivant3').fadeIn(0);
									$('.btn-suivant2').fadeOut(0);
									$('.btn-precedent2').fadeOut(0);
								}
							}
						});
					}else  if (categorieAssujetti == 'PersonnePhysiqueCommerçante'){
						let action ='Insert_Personne_Physique_Com';

						$.ajax({
							url:"assujetti.ajax.php",
							method:"POST",
							data:{profession:profession, professionConjoint:professionConjoint, secteurActivite:secteurActivite,
									rccm:rccm, nidNational:nidNational, nif:nif, nomsAssujetti:nomsAssujetti, sexe:sexe, etatCivil:etatCivil,
									lieuNaissance:lieuNaissance, dateNaissance:dateNaissance, numeroCarteIdentite:numeroCarteIdentite, 
									domicile:domicile, adresseActivite:adresseActivite, nomsResponsable:nomsResponsable, nationaliteResponsable:nationaliteResponsable,
									fonctionResponsable:fonctionResponsable, nomsConjoint:nomsConjoint, typeMariage:typeMariage, 
									regimeMatrimonial:regimeMatrimonial, siegeScoial:siegeScoial, siegeExploitation:siegeExploitation,
									telephoneAssujetti:telephoneAssujetti, emailAssujetti:emailAssujetti, action:action},
							dataType:"json",
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
									$('.numeroDEF').text(data.numdef);
									$('.defaultpw').text(data.defaultpw);
									$('.btn-next').click();
									$('.btn-suivant3').fadeIn(0);
									$('.btn-suivant2').fadeOut(0);
									$('.btn-precedent2').fadeOut(0);
								}
							}
						});
					}else  if (categorieAssujetti == 'PersonnePhysiqueNonCommerçante'){
						let action ='Insert_Personne_Physique_Non_Com';

						$.ajax({
							url:"assujetti.ajax.php",
							method:"POST",
							data:{profession:profession, professionConjoint:professionConjoint, nomsAssujetti:nomsAssujetti, 
									sexe:sexe, etatCivil:etatCivil, lieuNaissance:lieuNaissance, dateNaissance:dateNaissance, 
									numeroCarteIdentite:numeroCarteIdentite, domicile:domicile, adresseActivite:adresseActivite, 
									nomsConjoint:nomsConjoint, typeMariage:typeMariage, regimeMatrimonial:regimeMatrimonial, 
									telephoneAssujetti:telephoneAssujetti, emailAssujetti:emailAssujetti, action:action},
							dataType:"json",
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
									$('.numeroDEF').text(data.numdef);
									$('.defaultpw').text(data.defaultpw);
									$('.btn-next').click();
									$('.btn-suivant3').fadeIn(0);
									$('.btn-suivant2').fadeOut(0);
									$('.btn-precedent2').fadeOut(0);
								}
							}
						});
					}else{
						//Aucune catégorie choisie
					}
				}
				$(document).on("click", ".btn-suivant2", function(){
					enregistrerAssujetti();
				});

				//Validation de la saisie
				function keyValidation(idInput, key, action='check'){
					$(document).on("keyup", "#"+idInput, function(){
						let inputPost = $(this).val();
						$.ajax({
							url:"assujetti.ajax.php",
							method:"POST",
							data:{inputPost:inputPost, key:key, action:action},
							success:function(data){
								if (key == 'rccm') {
									$('#validation-rccm').html(data);
								}else if (key == 'idnat') {
									$('#validation-idnat').html(data);
								}else if (key == 'nif') {
									$('#validation-nif').html(data);
								}else if (key == 'email') {
									$('#validation-email').html(data);
								}
							}
						});
					});
				}

				//Controle la saisie du N° RCCM
				keyValidation('rccm', 'rccm');

				//Controle la saisie du N° Id National
				keyValidation('nidNational', 'idnat');

				//Controle la saisie du N° Impôt
				keyValidation('nif', 'nif');

				//Controle la saisie de l'@ email
				//keyValidation('emailEntreprise', 'email');

				//Controle la saisie de l'@ email
				//keyValidation('emailAssujetti', 'email');

				document.onkeydown = leftAndRightKey;
				function leftAndRightKey(e) {
				    e = e || window.event;
					if (e.keyCode == '37') { //Left Key
						e.preventDefault();
						if ($('.btn-precedent2').is(':visible')){
							$('.btn-precedent2').click();
						}else if ($('.btn-precedent3').is(':visible')){
							$('.btn-precedent3').click();
						}
					}else if (e.keyCode == '39'){ //Right Key
						e.preventDefault();
						if ($('.btn-suivant1').is(':visible')){
							btnSuivant1();
						}else if ($('.btn-suivant2').is(':visible')){
							enregistrerAssujetti();
						}
					}
				}

				$('.body-register').bind('keypress', function(e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if(code == 13) { //La touche Entrée a été appuyée
						if ($('.btn-suivant3').is(':visible')){
							$('.btn-suivant3').click();
						}
					}
				});

				//Renvoie la valeur correcte d'un bouton radio coché
				function getValueRadioChecked(radioclass){
					var elmtChecked=$('.'+radioclass+':checked');
					var elmtArray=Array();
					$(elmtChecked).each(function(){
						elmtArray.push($(this).val());
					});

					return elmtArray.toString();
				}

				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('finished.fu.wizard', function(e) {
					
				}).on('stepclick.fu.wizard', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});
			})
		</script>
	</body>
</html>
