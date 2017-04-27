<?php $__env->startSection('title'); ?> Ajouter une vente   <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/sb-admin.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('table2/datatables.min.js')); ?>"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" size="10" class="form-control" placeholder="Rechercher par ' + title + '" />');
        });
        // DataTable
        var table = $('#example').DataTable();
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ajouter une vente <small> </small></h1>

		<div id="page-wrapper">

			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-8">
						
						<?php if(session('alert_success')): ?>
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_success'); ?>

						</div>
						<?php endif; ?>

						<?php if(session('alert_info')): ?>
						<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_info'); ?>

						</div>
						<?php endif; ?>

						<?php if(session('alert_warning')): ?>
						<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_warning'); ?>

						</div>
						<?php endif; ?>

						<?php if(session('alert_danger')): ?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_danger'); ?>

						</div>
						<?php endif; ?>
						
					</div>

					<div class="col-lg-2"></div>

				</div>




						<!-- Row 1 -->
						<div class="row">

							<div class="table-responsive">

								<div class="col-lg-12">



                  
                  <form role="form" method="post" action="<?php echo e(Route('vendeur.submitAddVente')); ?>">
                    <div class="row">
                      <div class="col-lg-2">

                      <div class="form-group">


                                                    </div></div>

                    <div class="col-lg-5">

                    <div class="form-group">

                                                    <label>Mode de Paiement</label>

                                                    <select class="form-control" name="mode">
                                                      <?php $__currentLoopData = $mode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <option value="<?php echo e($mo->id_mode); ?>"><?php echo e($mo->libelle); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                </div></div>

                                          <div class="col-lg-5">
                                              <?php $__currentLoopData = $mode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($mo->id_mode==1): ?>
                                            <label>Reference chequier</label>
                                            <input class="form-control" type="text" min="0" placeholder="Refchequier" name="ref" ></input>

                                            <?php endif; ?>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </div>




                    <?php echo e(csrf_field()); ?>




								 <table class="table table-striped table-bordered table-hover" id="example">
									 <thead bgcolor="#DBDAD8">
										 <tr><th width="2%"> # </th><th width="25%"></th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Prix de vente</th><th>Quantite en stock</th><th>Quantité vendue</th><th width="10%">Autres</th></tr>
									 </thead>
									 <tfoot bgcolor="#DBDAD8">
										 <tr><th width="2%"> # </th><th width="25%"></th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Prix de vente</th><th>Quantité en stock</th><th>Quantité vendue</th><th width="10%">Autres</th></tr>
									 </tfoot>

									 <tbody>
										 <?php if( isset( $articles ) ): ?>
										 <?php if( $articles->isEmpty() ): ?>
										 <tr><td colspan="5" align="center">Aucun Article</td></tr>
										 <?php else: ?>
										 <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


										 <tr class="odd gradeA">
                       <input type="hidden" name="id_article[<?php echo e($loop->index+1); ?>]" value="<?php echo e($item->id_article); ?>" >
                       <input type="hidden" name="designation_c[<?php echo e($loop->index+1); ?>]" value="<?php echo e(getChamp('articles', 'id_article', $item->id_article , 'designation_c')); ?>" />
                       <input type="hidden" name="id_transaction[<?php echo e($loop->index+1); ?>]" value="<?php echo e(getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_transaction')); ?>" />
                       <input type="hidden" name="id_magasin" value="<?php echo e($item->id_magasin); ?>" >
                       <input type="hidden" name="id_user" value="<?php echo e(getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_user')); ?>" >
                       <input type="hidden" name="id_typeTrans" value="<?php echo e(getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_typeTrans')); ?>" >
                       <input type="hidden" name="id_paiement" value="<?php echo e(getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_paiement')); ?>" >
                       <input type="hidden" name="quantiteV" value="<?php echo e($item->quantite); ?>" >

											 <td align="right"><?php echo e($loop->index+1); ?></td>
                        <td><?php echo e(getChamp('articles', 'id_article', $item->id_article , 'image')); ?></td>
                       <td><?php echo e(getChamp('articles', 'id_article', $item->id_article , 'designation_c')); ?></td>
                       <td><?php echo e(getChamp('categories', 'id_categorie', getChamp('articles', 'id_article', $item->id_article, 'id_categorie') , 'libelle')); ?></td>
                       <td><?php echo e(getChamp('fournisseurs', 'id_fournisseur', getChamp('articles', 'id_article', $item->id_article, 'id_fournisseur') , 'libelle')); ?></td>
                       <td align="right"><?php echo e(number_format(getChamp('articles', 'id_article', $item->id_article , 'prix_vente'),2,',','')); ?> DH</td>

                       <td align="right"><?php echo e($item->quantite); ?></td>
											 <td><input type="number" min="0" placeholder="Quantite" name="quantite[<?php echo e($loop->index+1); ?>]"  max="<?php echo e($item->quantite); ?>" ></td>
											 <td>
													 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo e($loop->index+1); ?>">Detail Article</button>
											 </td>
											 
											 <div class="modal fade" id="myModal<?php echo e($loop->index+1); ?>" role="dialog">
												 <div class="modal-dialog modal-sm">
													 <div class="modal-content">
														 <div class="modal-header">
															 <button type="button" class="close" data-dismiss="modal">&times;</button>
															 <h4 class="modal-title"><?php echo e(getChamp('articles', 'id_article', $item->id_article , 'designation_c')); ?></h4>
														 </div>
														 <div class="modal-body">
															 <p><b>numero</b> <?php echo e(getChamp('articles', 'id_article', $item->id_article , 'num_article')); ?></p>
															 <p><b>code a barres</b> <?php echo e(getChamp('articles', 'id_article', $item->id_article , 'code_barre')); ?></p>
															 <p><b>Taille</b> <?php echo e(getChamp('articles', 'id_article', $item->id_article , 'taille')); ?></p>
															 <p><b>Couleur</b> <?php echo e(getChamp('articles', 'id_article', $item->id_article , 'couleur')); ?></p>
															 <p><b>sexe</b> <?php echo e(getSexeName(getChamp('articles', 'id_article', $item->id_article , 'sexe'))); ?></p>
															 <p><b>Prix d'achat</b> <?php echo e(getChamp('articles', 'id_article', $item->id_article , 'prix_achat')); ?></p>
															 <p><b>Prix de vente</b> <?php echo e(getChamp('articles', 'id_article', $item->id_article , 'prix_vente')); ?></p>

															 <p><?php echo e(getChamp('articles', 'id_article', $item->id_article , 'designation_l')); ?></p>

														 </div>
														 <div class="modal-footer">
															 <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
														 </div>
													 </div>
												 </div>
											 </div>
											 
										 </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										 <?php endif; ?>
										 <?php endif; ?>

									 </tbody>



								 </table>
								<center><button type="submit" name="submit" value="valider" class="btn btn-primary">Valider la vente</button></center>

</form>

							 </div>
							</div>

						</div>
						<!-- end row 1 -->


<!--
						
						<?php if( isset($data) && !$data->isEmpty()): ?>
						<hr>

						<div class="row">
							<div class="col-lg-3"></div>

							<div class="col-lg-6" align="center">
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo10" title="Cliquez ici pour visualiser la liste des articles existants">Liste des Articles</button>
								<div id="demo10" class="collapse">
									<br>
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title" align="center">Articles <span class="badge"><?php echo e(App\Models\Article::count()); ?></span></h3>
										</div>
										<div class="panel-body">
											<ul class="list-group" align="center">
												<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li class="list-group-item"><a href="<?php echo e(route('direct.info',[ 'p_table' => 'articles' , 'p_id' => $item->id_article ])); ?>" title="detail sur l'article"><?php echo e($item->num_article); ?>: <?php echo e($item->designation_c); ?></a></li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                    </ul>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-3"></div>
						</div>
						<!-- end row 5
						<?php endif; ?>
						
					-->


			</div>
			<!-- /#page-wrapper -->
		</div>
	</div>
</div>
	<!-- /.row -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('menu_1'); ?>
	<?php echo $__env->make('Espace_Vendeur._nav_menu_1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_2'); ?>
	<?php echo $__env->make('Espace_Vendeur._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>