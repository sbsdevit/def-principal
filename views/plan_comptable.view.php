<?php require_once('partials/head.php'); ?>
<?php require_once('partials/sidebar.php'); ?>
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-content">

					<div class="page-header">
						<h1><?=$_SESSION['NOMASSUJETTI']; ?> >>Plan comptable : OHADA  </h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<?php require_once('partials/navbar.php'); ?>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="widget-box widget-color-blue2">
                                        <div class="widget-header">
                                            <h4 class="widget-title lighter smaller">
                                                Comptes définis et identifiés par des numéros et intitulés
                                            </h4>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main padding-8">
                                                <div class="treeview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="widget-box widget-color-dark">
                                        <div class="widget-header">
                                            <h5 class="widget-title">Gestion intégrée des classes</h5>

                                            <div class="widget-toolbar" id="div-classe-up">
                                                <a href="#" id="classe-up" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                            <div class="widget-toolbar" id="div-classe-down" style="display: none;">
                                                <a href="#" id="classe-down" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-down bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body" id="classeManagement" style="display: none;">
                                            <div class="widget-main">
                                                <div class="row">
							                        <div class="col-xs-12">
                                                        <div class="table-header">
                                                            Liste des classes enregistrées
                                                        </div>
                                                        <div>
                                                            <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                                <div class="row">
                                                                    <div class="col-xs-10">
                                                                        <select class="chosen-select form-control" id="filter-classe" data-placeholder="Filtrer par le numéro et par la description de la classe...">
                                                                            <?= loadClasses(); ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-12" style="margin-top: 10px;">
                                                                        <form action="" method="POST" class="form form-data">
                                                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 25%;">Numéro classe</th>
                                                                                    <th style="width: 60%;">Description de la classe</th>
                                                                                    <th style="width: 15%;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="display-classes"></tbody>
                                                                        </table>
                                                                        </form>

                                                                        <div class="div-alert-classe" style="width: 100%; margin-bottom:5px"></div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="pull-right tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a class="dt-button buttons-colvis btn btn-white btn-success btn-bold save-class-row" tabindex="0" href="" title="Valider l'enregistrement">
                                                                                    <span><i class="fa fa-check bigger-110 green"></i> Valider l'enregistrement</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="pull-left tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a class="dt-button buttons-colvis btn btn-white btn-primary btn-bold add-class-row" tabindex="0" href="" title="Ajouter une ligne">
                                                                                    <span><i class="fa fa-plus-circle bigger-110 purple"></i> Ajouter une ligne</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="widget-box widget-color-dark">
                                        <div class="widget-header">
                                            <h5 class="widget-title">Gestion intégrée des rubriques</h5>

                                            <div class="widget-toolbar" id="div-rubrique-up">
                                                <a href="#" id="rubrique-up" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                            <div class="widget-toolbar" id="div-rubrique-down" style="display: none;">
                                                <a href="#" id="rubrique-down" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-down bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body" id="rubriqueManagement" style="display: none;">
                                            <div class="widget-main">
                                                <div class="row">
							                        <div class="col-xs-12">
                                                        <div class="table-header">
                                                            Liste des rubriques enregistrées par classe
                                                        </div>
                                                        <div>
                                                            <form action="" method="POST" class="form-rubrique form-data">
                                                            <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                                <div class="row">
                                                                    <div class="col-md-7">
                                                                        <select class="chosen-select form-control" name="selectclasse" id="select-classe" data-placeholder="Veuillez sélectionner la description de la classe">
                                                                            <?= loadClasses(); ?>
                                                                        </select>
                                                                    </div>&nbsp;
                                                                    <div class="col-md-4" style="margin-left: 15px;" id="cmbrubrique">
                                                                    </div>
                                                                    <div class="col-md-12" style="margin-top: 10px;">
                                                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 28%;">Numéro rubrique</th>
                                                                                    <th style="width: 50%;">Description de la rubrique</th>
                                                                                    <th style="width: 9%;">Classe</th>
                                                                                    <th style="width: 13%;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="display-rubriques"></tbody>
                                                                        </table>
                                                                        <div class="div-alert-rubrique" style="width: 100%; margin-bottom:5px"></div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="pull-right tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a style="display: none;" class="dt-button buttons-colvis btn btn-white btn-success btn-bold save-rubrique-row" tabindex="0" href="" title="Valider l'enregistrement">
                                                                                    <span><i class="fa fa-check bigger-110 green"></i> Valider l'enregistrement</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="pull-left tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a class="dt-button buttons-colvis btn btn-white btn-primary btn-bold add-rubrique-row" tabindex="0" href="" title="Ajouter une ligne">
                                                                                    <span><i class="fa fa-plus-circle bigger-110 purple"></i> Ajouter une ligne</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="widget-box widget-color-dark">
                                        <div class="widget-header">
                                            <h5 class="widget-title">Gestion intégrée des postes</h5>

                                            <div class="widget-toolbar" id="div-poste-up">
                                                <a href="#" id="poste-up" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                            <div class="widget-toolbar" id="div-poste-down" style="display: none;">
                                                <a href="#" id="poste-down" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-down bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body" id="posteManagement" style="display: none;">
                                            <div class="widget-main">
                                                <div class="row">
							                        <div class="col-xs-12">
                                                        <div class="table-header">
                                                            Liste des postes enregistrées par rubrique
                                                        </div>
                                                        <div>
                                                            <form action="" method="POST" class="form-poste form-data">
                                                            <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                                <div class="row">
                                                                    <div class="col-md-7">
                                                                        <select class="chosen-select form-control" name="selectrubrique" id="select-rubrique" data-placeholder="Veuillez sélectionner la description de rubrique">
                                                                            <?= loadComboRubriques(); ?>
                                                                        </select>
                                                                    </div>&nbsp;
                                                                    <div class="col-md-4" style="margin-left: 15px;" id="cmbposte">
                                                                    </div>
                                                                    <div class="col-md-12" style="margin-top: 10px;">
                                                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 25%;">Numéro poste</th>
                                                                                    <th style="width: 50%;">Description poste</th>
                                                                                    <th style="width: 12%;">Rubrique</th>
                                                                                    <th style="width: 13%;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="display-postes"></tbody>
                                                                        </table>
                                                                        <div class="div-alert-poste" style="width: 100%; margin-bottom:5px"></div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="pull-right tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a style="display: none;" class="dt-button buttons-colvis btn btn-white btn-success btn-bold save-poste-row" tabindex="0" href="" title="Valider l'enregistrement">
                                                                                    <span><i class="fa fa-check bigger-110 green"></i> Valider l'enregistrement</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="pull-left tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a class="dt-button buttons-colvis btn btn-white btn-primary btn-bold add-poste-row" tabindex="0" href="" title="Ajouter une ligne">
                                                                                    <span><i class="fa fa-plus-circle bigger-110 purple"></i> Ajouter une ligne</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="widget-box widget-color-dark">
                                        <div class="widget-header">
                                            <h5 class="widget-title">Gestion intégrée des comptes</h5>

                                            <div class="widget-toolbar" id="div-compte-up">
                                                <a href="#" id="compte-up" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                            <div class="widget-toolbar" id="div-compte-down" style="display: none;">
                                                <a href="#" id="compte-down" style="color: #fff;">
                                                    <i class="1 ace-icon fa fa-chevron-down bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body" id="compteManagement" style="display: none;">
                                            <div class="widget-main">
                                                <div class="row">
							                        <div class="col-xs-12">
                                                        <div class="table-header">
                                                            Liste des comptes enregistrées par poste
                                                        </div>
                                                        <div>
                                                            <form action="" method="POST" class="form-compte form-data">
                                                            <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                                <div class="row">
                                                                    <div class="col-md-7">
                                                                        <select class="chosen-select form-control" name="selectposte" id="select-poste" data-placeholder="Veuillez sélectionner la description de poste">
                                                                            <?= loadComboPostes(); ?>
                                                                        </select>
                                                                    </div>&nbsp;
                                                                    <div class="col-md-4" style="margin-left: 15px;" id="cmbcompte">
                                                                    </div>
                                                                    <div class="col-md-12" style="margin-top: 10px;">
                                                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 25%;">Numéro compte</th>
                                                                                    <th style="width: 50%;">Description compte</th>
                                                                                    <th style="width: 12%;">Poste</th>
                                                                                    <th style="width: 13%;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="display-comptes"></tbody>
                                                                        </table>
                                                                        <div class="div-alert-compte" style="width: 100%; margin-bottom:5px"></div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="pull-right tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a style="display: none;" class="dt-button buttons-colvis btn btn-white btn-success btn-bold save-compte-row" tabindex="0" href="" title="Valider l'enregistrement">
                                                                                    <span><i class="fa fa-check bigger-110 green"></i> Valider l'enregistrement</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="pull-left tableTools-container">
                                                                            <div class="dt-buttons btn-overlap btn-group">
                                                                                <a class="dt-button buttons-colvis btn btn-white btn-primary btn-bold add-compte-row" tabindex="0" href="" title="Ajouter une ligne">
                                                                                    <span><i class="fa fa-plus-circle bigger-110 purple"></i> Ajouter une ligne</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

	<?php require_once('partials/footer.php'); ?>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
            $('#sidebar2').insertBefore('.page-content');
			$('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');

            loadTreeView();
            function loadTreeView(){
                let action = 'charger';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    data:{action : action},
                    success:function(data){
                        $('.treeview').html(data);
                    }
                });
            }

            function showBlock(className, ulShow, ulBlock){
                $(document).on('click', '.'+className , function(e){
                    e.preventDefault();
                    let id = $(this).attr('data-id');
                    $('#'+ulShow+''+id).fadeIn(1000);
                    $('#moins-'+ulBlock+''+id).fadeIn(0);
                    $('#plus-'+ulBlock+''+id).fadeOut(0);

                    $('#li-'+ulBlock+''+id).addClass('li-'+ulBlock+'-selected');          
                });
            }

            function hideBlock(className, ulHide, ulBlock){
                $(document).on('click', '.'+className , function(e){
                    e.preventDefault();
                    let id = $(this).attr('data-id');
                    $('#'+ulHide+''+id).fadeOut(500);
                    $('#moins-'+ulBlock+''+id).fadeOut(0);
                    $('#plus-'+ulBlock+''+id).fadeIn(0);
                    
                    $('#li-'+ulBlock+''+id).removeClass('li-'+ulBlock+'-selected');  
                });
            }

            showBlock('plus-classe', 'ul-rubrique', 'classe');
            hideBlock('moins-classe', 'ul-rubrique', 'classe');

            showBlock('plus-rubrique', 'ul-poste', 'rubrique');
            hideBlock('moins-rubrique', 'ul-poste', 'rubrique');

            showBlock('plus-poste', 'ul-compte', 'poste');
            hideBlock('moins-poste', 'ul-compte', 'poste');

            function upWidget(blockWidget){
                $('#'+blockWidget+'-up').click(function(e){
                    e.preventDefault();
                    $('#'+blockWidget+'Management').fadeIn(500);
                    $('#div-'+blockWidget+'-up').fadeOut(0);
                    $('#div-'+blockWidget+'-down').fadeIn(0);
                });
            }

            function downWidget(blockWidget){
                $('#'+blockWidget+'-down').click(function(e){
                    e.preventDefault();
                    $('#'+blockWidget+'Management').fadeOut(500);
                    $('#div-'+blockWidget+'-up').fadeIn(0);
                    $('#div-'+blockWidget+'-down').fadeOut(0);
                });
            }

            /* Tous ces scripts concernent la gestion intégrée des classes */

            upWidget('classe');
            downWidget('classe');

            loadClasses();
            function loadClasses(idClasse=""){
                let action = 'chargerClasses';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    data:{id : idClasse, action : action},
                    success:function(data){
                        $('.display-classes').html(data);
                    }
                });
            }

            $(document).on('change', '#filter-classe' , function(e){
                e.preventDefault();
                let idClasse = $(this).val();
                loadClasses(idClasse);
            });

            $(document).on('click', '.edit-classe' , function(e){
                e.preventDefault();
                let idclasse = $(this).attr("data-id");
                let nomclasse = $.trim($('#nom-classe'+idclasse).val());
                let action = 'update-classe';

                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idclasse : idclasse, nomclasse : nomclasse, action : action},
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
                            $('.div-alert-classe').html(data.success);
                            $('.div-alert-classe').fadeIn();
                            $('.div-alert-classe').fadeOut(2000, function(){
                                location.href='plan_comptable.php';                                
                            });	
                        }
                    }
                });
                
            });

            $(document).on('click', '.delete-classe' , function(e){
                e.preventDefault();
                let idclasse = $(this).attr("data-id");
                let nomclasse = $.trim($('#nom-classe'+idclasse).val());
                let action = 'delete-classe';

                bootbox.confirm({
                    message: "Cette action est irréversible ! En appuyant sur Oui, la classe "+nomclasse+" va être définitivement supprimé. Voulez-vous continuer ?",
                    buttons: {
                        confirm: {
                            label: "Oui",
                            className: "btn-primary btn-sm",
                        },
                        cancel: {
                            label: "Annuler",
                            className: "btn-danger btn-sm",
                        }
                    },
                    callback: function(result) {
                        if (result){
                            $.ajax({
                                url:"plan_comptable.ajax.php",
                                method:"POST",
                                data:{idclasse : idclasse, nomclasse : nomclasse, action : action},
                                success:function(data){
                                    $('.div-alert-classe').html(data);
                                    $('.div-alert-classe').fadeIn();
                                    $('.div-alert-classe').fadeOut(2000, function(){
                                        location.href='plan_comptable.php';                                
                                    });
                                }
                            });
                        }
                    }
                });
                
            });

            $(document).on('click', '.add-class-row', function(e){
                e.preventDefault();
                var html='';
                html+='<tr>\
                            <td>\
                                <input type="text" class="form-control form-table addidclasse" name="addidclasse[]">\
                            </td>\
                            <td>\
                                <input type="text" class="form-control form-table addnomclasse" name="addnomclasse[]">\
                            </td>\
                            <td class="action">\
                                <input type="hidden" class="form-control form-table action" name="action" value="insert-classe">\
                                <div class="hidden-sm hidden-xs action-buttons" style="text-align : center">\
                                    <a href="#" class="red remove-class-row"><i class="ace-icon fa fa-times-circle bigger-130"></i></a>\
                                </div>\
                            </td>\
                </tr>';

                $('.display-classes').append(html);
            });

            $(document).on('click', '.remove-class-row', function(){
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.save-class-row', function(e){
                e.preventDefault();

                var error='';

                $('.addidclasse').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le numéro de la classe dans toutes lignes</p>';
                        return false;
                    }
                });
                $('.addnomclasse').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le nom de la classe dans toutes lignes</p>';
                        return false;
                    }
                });

                var formData=$('.form').serialize();

                if (error=='') {
                    if (formData !=''){
                        $.ajax({
                            url:"plan_comptable.ajax.php",
                            method:"POST",
                            data:formData,
                            success:function(data){
                                $('.div-alert-classe').html(data);
                                $('.div-alert-classe').fadeIn();
                            }
                        });
                    }
                }else{
                    bootbox.dialog({
                        message: error, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

            /* Fin scripts concernent la gestion intégrée des classes */

            /* Tous ces scripts concernent la gestion intégrée des rubriques */
            upWidget('rubrique');
            downWidget('rubrique');

            function loadRubriques(idclasse="", idrubrique=""){
                let action = 'chargerRubriques';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idclasse : idclasse, idrubrique : idrubrique, action : action},
                    success:function(data){
                        $('.display-rubriques').html(data.table);
                    }
                });
            }

            function loadCmbRubriques(idclasse=""){
                let action = 'chargerCmbRubriques';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    data:{idclasse : idclasse, action : action},
                    success:function(data){
                        $('#cmbrubrique').html(data);
                    }
                });
            }

            $(document).on('change', '#select-classe' , function(e){
                e.preventDefault();
                let idclasse = $(this).val();
                loadRubriques(idclasse, '');
                loadCmbRubriques(idclasse);
            });

            $(document).on('change', '#filter-rubrique' , function(e){
                e.preventDefault();
                let idclasse = $('#select-classe').val();
                let idrubrique = $(this).val();
                loadRubriques(idclasse, idrubrique);
            });

            $(document).on('click', '.edit-rubrique' , function(e){
                e.preventDefault();
                let idrubrique = $(this).attr("data-id");
                let nomrubrique = $.trim($('#nom-rubrique'+idrubrique).val());
                let action = 'update-rubrique';

                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idrubrique : idrubrique, nomrubrique : nomrubrique, action : action},
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
                            $('.div-alert-rubrique').html(data.success);
                            $('.div-alert-rubrique').fadeIn();
                            $('.div-alert-rubrique').fadeOut(2000, function(){
                                location.href='plan_comptable.php';                                
                            });	
                        }
                    }
                });
                
            });

            $(document).on('click', '.delete-rubrique' , function(e){
                e.preventDefault();
                let idrubrique = $(this).attr("data-id");
                let nomrubrique = $.trim($('#nom-rubrique'+idrubrique).val());
                let action = 'delete-rubrique';

                bootbox.confirm({
                    message: "Cette action est irréversible ! En appuyant sur Oui, la rubrique "+nomrubrique+" va être définitivement supprimé. Voulez-vous continuer ?",
                    buttons: {
                        confirm: {
                            label: "Oui",
                            className: "btn-primary btn-sm",
                        },
                        cancel: {
                            label: "Annuler",
                            className: "btn-danger btn-sm",
                        }
                    },
                    callback: function(result) {
                        if (result){
                            $.ajax({
                                url:"plan_comptable.ajax.php",
                                method:"POST",
                                data:{idrubrique : idrubrique, nomrubrique : nomrubrique, action : action},
                                success:function(data){
                                    $('.div-alert-rubrique').html(data);
                                    $('.div-alert-rubrique').fadeIn();
                                    $('.div-alert-rubrique').fadeOut(2000, function(){
                                        location.href='plan_comptable.php';                               
                                    });
                                }
                            });
                        }
                    }
                });
                
            });

            $(document).on('click', '.add-rubrique-row', function(e){
                e.preventDefault();
                let idclasse = $('#select-classe').val();
                if (idclasse !=''){
                    $('.save-rubrique-row').fadeIn(0);
                    var html='';
                    html+='<tr>\
                                <td>\
                                    <input type="text" class="form-control form-table addidrubrique" name="addidrubrique[]">\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control form-table addnomrubrique" name="addnomrubrique[]">\
                                </td>\
                                <td style="text-align : center">\
                                    '+idclasse+'\
                                </td>\
                                <td class="action">\
                                    <input type="hidden" class="form-control form-table action" name="action" value="insert-rubrique">\
                                    <div class="hidden-sm hidden-xs action-buttons" style="text-align : center">\
                                        <a href="#" class="red remove-rubrique-row"><i class="ace-icon fa fa-times-circle bigger-130"></i></a>\
                                    </div>\
                                </td>\
                    </tr>';

                    $('.display-rubriques').append(html);
                }else{
                    let msg_erreur = 'Une classe d\'appartenance est réquise car, une rubrique appartient à une classe spécifique.';
                    bootbox.dialog({
                        message: msg_erreur, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove-rubrique-row', function(){
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.save-rubrique-row', function(e){
                e.preventDefault();

                var error='';

                $('.addidrubrique').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le numéro de la rubrique dans toutes lignes</p>';
                        return false;
                    }
                });
                $('.addnomrubrique').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le nom de la rubrique dans toutes lignes</p>';
                        return false;
                    }
                });

                var formData=$('.form-rubrique').serialize();

                if (error=='') {
                    $selectclasse = $('.select-classe').val();
                    if (formData !=''){
                        $.ajax({
                            url:"plan_comptable.ajax.php",
                            method:"POST",
                            data:formData,
                            success:function(data){
                                $('.div-alert-rubrique').html(data);
                                $('.div-alert-rubrique').fadeIn();
                            }
                        });
                    }   
                }else{
                    bootbox.dialog({
                        message: error, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

        /* Fin scripts concernent la gestion intégrée des rubriques */

        /* Tous ces scripts concernent la gestion intégrée des postes */
            upWidget('poste');
            downWidget('poste');

            function loadPostes(idrubrique="", idposte=""){
                let action = 'chargerPostes';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idrubrique : idrubrique, idposte : idposte, action : action},
                    success:function(data){
                        $('.display-postes').html(data.table);
                    }
                });
            }

            function loadCmbPostes(idrubrique=""){
                let action = 'chargerCmbPostes';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    data:{idrubrique : idrubrique, action : action},
                    success:function(data){
                        $('#cmbposte').html(data);
                    }
                });
            }

            $(document).on('change', '#select-rubrique' , function(e){
                e.preventDefault();
                let idrubrique = $(this).val();
                loadPostes(idrubrique, '');
                loadCmbPostes(idrubrique);
            });

            $(document).on('change', '#filter-poste' , function(e){
                e.preventDefault();
                let idrubrique = $('#select-rubrique').val();
                let idposte = $(this).val();
                loadPostes(idrubrique, idposte);
            });

            $(document).on('click', '.edit-poste' , function(e){
                e.preventDefault();
                let idposte = $(this).attr("data-id");
                let nomposte = $.trim($('#nom-poste'+idposte).val());
                let action = 'update-poste';

                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idposte : idposte, nomposte : nomposte, action : action},
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
                            $('.div-alert-poste').html(data.success);
                            $('.div-alert-poste').fadeIn();
                            $('.div-alert-poste').fadeOut(2000, function(){
                                location.href='plan_comptable.php';                                
                            });	
                        }
                    }
                });
                
            });

            $(document).on('click', '.delete-poste' , function(e){
                e.preventDefault();
                let idposte = $(this).attr("data-id");
                let nomposte = $.trim($('#nom-poste'+idposte).val());
                let action = 'delete-poste';

                bootbox.confirm({
                    message: "Cette action est irréversible ! En appuyant sur Oui, le poste "+nomposte+" va être définitivement supprimé. Voulez-vous continuer ?",
                    buttons: {
                        confirm: {
                            label: "Oui",
                            className: "btn-primary btn-sm",
                        },
                        cancel: {
                            label: "Annuler",
                            className: "btn-danger btn-sm",
                        }
                    },
                    callback: function(result) {
                        if (result){
                            $.ajax({
                                url:"plan_comptable.ajax.php",
                                method:"POST",
                                data:{idposte : idposte, nomposte : nomposte, action : action},
                                success:function(data){
                                    $('.div-alert-poste').html(data);
                                    $('.div-alert-poste').fadeIn();
                                    $('.div-alert-poste').fadeOut(2000, function(){
                                        location.href='plan_comptable.php';                               
                                    });
                                }
                            });
                        }
                    }
                });
                
            });

            $(document).on('click', '.add-poste-row', function(e){
                e.preventDefault();
                let idrubrique = $('#select-rubrique').val();
                if (idrubrique !=''){
                    $('.save-poste-row').fadeIn(0);
                    var html='';
                    html+='<tr>\
                                <td>\
                                    <input type="text" class="form-control form-table addidposte" name="addidposte[]">\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control form-table addnomposte" name="addnomposte[]">\
                                </td>\
                                <td style="text-align : center">\
                                    '+idrubrique+'\
                                </td>\
                                <td class="action">\
                                    <input type="hidden" class="form-control form-table action" name="action" value="insert-poste">\
                                    <div class="hidden-sm hidden-xs action-buttons" style="text-align : center">\
                                        <a href="#" class="red remove-poste-row"><i class="ace-icon fa fa-times-circle bigger-130"></i></a>\
                                    </div>\
                                </td>\
                    </tr>';

                    $('.display-postes').append(html);
                }else{
                    let msg_erreur = 'Une rubrique d\'appartenance est réquise car, un poste appartient à une rubrique spécifique.';
                    bootbox.dialog({
                        message: msg_erreur, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove-poste-row', function(){
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.save-poste-row', function(e){
                e.preventDefault();

                var error='';

                $('.addidposte').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le numéro de poste dans toutes lignes</p>';
                        return false;
                    }
                });
                $('.addnomposte').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le nom de poste dans toutes lignes</p>';
                        return false;
                    }
                });

                var formData=$('.form-poste').serialize();

                if (error=='') {
                    if (formData !=''){
                        $.ajax({
                            url:"plan_comptable.ajax.php",
                            method:"POST",
                            data:formData,
                            success:function(data){
                                $('.div-alert-poste').html(data);
                                $('.div-alert-poste').fadeIn();
                            }
                        });
                    }
                }else{
                    bootbox.dialog({
                        message: error, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

        /* Fin scripts concernent la gestion intégrée des postes */

        /* Tous ces scripts concernent la gestion intégrée des comptes */
            upWidget('compte');
            downWidget('compte');

            function loadComptes(idposte="", idcompte=""){
                let action = 'chargerComptes';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idposte : idposte, idcompte : idcompte, action : action},
                    success:function(data){
                        $('.display-comptes').html(data.table);
                    }
                });
            }

            function loadCmbComptes(idposte=""){
                let action = 'chargerCmbComptes';
                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    data:{idposte : idposte, action : action},
                    success:function(data){
                        $('#cmbcompte').html(data);
                    }
                });
            }

            $(document).on('change', '#select-poste' , function(e){
                e.preventDefault();
                let idposte = $(this).val();
                loadComptes(idposte, '');
                loadCmbComptes(idposte);
            });

            $(document).on('change', '#filter-compte' , function(e){
                e.preventDefault();
                let idposte = $('#select-poste').val();
                let idcompte = $(this).val();
                loadComptes(idposte, idcompte);
            });

            $(document).on('click', '.edit-compte' , function(e){
                e.preventDefault();
                let idcompte = $(this).attr("data-id");
                let nomcompte = $.trim($('#nom-compte'+idcompte).val());
                let action = 'update-compte';

                $.ajax({
                    url:"plan_comptable.ajax.php",
                    method:"POST",
                    dataType:"json",
                    data:{idcompte : idcompte, nomcompte : nomcompte, action : action},
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
                            $('.div-alert-compte').html(data.success);
                            $('.div-alert-compte').fadeIn();
                            $('.div-alert-compte').fadeOut(2000, function(){
                                location.href='plan_comptable.php';                                
                            });	
                        }
                    }
                });
                
            });

            $(document).on('click', '.delete-compte' , function(e){
                e.preventDefault();
                let idcompte = $(this).attr("data-id");
                let nomcompte = $.trim($('#nom-compte'+idcompte).val());
                let action = 'delete-compte';

                bootbox.confirm({
                    message: "Cette action est irréversible ! En appuyant sur Oui, le compte "+nomcompte+" va être définitivement supprimé. Voulez-vous continuer ?",
                    buttons: {
                        confirm: {
                            label: "Oui",
                            className: "btn-primary btn-sm",
                        },
                        cancel: {
                            label: "Annuler",
                            className: "btn-danger btn-sm",
                        }
                    },
                    callback: function(result) {
                        if (result){
                            $.ajax({
                                url:"plan_comptable.ajax.php",
                                method:"POST",
                                data:{idcompte : idcompte, nomcompte : nomcompte, action : action},
                                success:function(data){
                                    $('.div-alert-compte').html(data);
                                    $('.div-alert-compte').fadeIn();
                                    $('.div-alert-compte').fadeOut(2000, function(){
                                        location.href='plan_comptable.php';                               
                                    });
                                }
                            });
                        }
                    }
                });
                
            });

            $(document).on('click', '.add-compte-row', function(e){
                e.preventDefault();
                let idposte = $('#select-poste').val();
                if (idposte !=''){
                    $('.save-compte-row').fadeIn(0);
                    var html='';
                    html+='<tr>\
                                <td>\
                                    <input type="text" class="form-control form-table addidcompte" name="addidcompte[]">\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control form-table addnomcompte" name="addnomcompte[]">\
                                </td>\
                                <td style="text-align : center">\
                                    '+idposte+'\
                                </td>\
                                <td class="action">\
                                    <input type="hidden" class="form-control form-table action" name="action" value="insert-compte">\
                                    <div class="hidden-sm hidden-xs action-buttons" style="text-align : center">\
                                        <a href="#" class="red remove-compte-row"><i class="ace-icon fa fa-times-circle bigger-130"></i></a>\
                                    </div>\
                                </td>\
                    </tr>';

                    $('.display-comptes').append(html);
                }else{
                    let msg_erreur = 'Un poste d\'appartenance est réquis car, un compte appartient à un poste spécifique.';
                    bootbox.dialog({
                        message: msg_erreur, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove-compte-row', function(){
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.save-compte-row', function(e){
                e.preventDefault();

                var error='';

                $('.addidcompte').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le numéro de compte dans toutes lignes</p>';
                        return false;
                    }
                });
                $('.addnomcompte').each(function(){
                    if ($.trim($(this).val())=='') {
                        error+='<p> * Veuillez renseigner le nom de compte dans toutes lignes</p>';
                        return false;
                    }
                });

                var formData=$('.form-compte').serialize();

                if (error=='') {
                    if (formData !=''){
                        $.ajax({
                            url:"plan_comptable.ajax.php",
                            method:"POST",
                            data:formData,
                            success:function(data){
                                $('.div-alert-compte').html(data);
                                $('.div-alert-compte').fadeIn();
                            }
                        });
                    }
                }else{
                    bootbox.dialog({
                        message: error, 
                        buttons: {
                            "danger" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-danger"
                            }
                        }
                    });
                }
            });

        /* Fin scripts concernent la gestion intégrée des comptes */

            $(document).on('focus', '.form-table' , function(){
                $(this).closest('tr').addClass('selectedRow');
            });
            $(document).on('blur', '.form-table' , function(){
                $(this).closest('tr').removeClass('selectedRow');
            });

            $(document).on('click', '.close-alert' , function(){
                location.reload();
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

            $(document).on('keyup', '.addidclasse', function(e){
                e.preventDefault();
                validNumeric(this);
            });

            $(document).on('keyup', '.addidrubrique', function(e){
                e.preventDefault();
                validNumeric(this);
            });

            $(document).on('keyup', '.addidposte', function(e){
                e.preventDefault();
                validNumeric(this);
            });

            $(document).on('keyup', '.addidcompte', function(e){
                e.preventDefault();
                validNumeric(this);
            });

        });
	</script>
</body>
</html>