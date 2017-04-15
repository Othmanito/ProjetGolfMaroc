<?php $__env->startSection('title'); ?> Ajouter une vente du magasin <?php echo e($trans->libelle); ?>  <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/sb-admin.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.js')); ?>"></script>

<script src="<?php echo e(asset('table/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('table/dataTables.bootstrap.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ajouter une vente  <small> </small></h1>

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



                  
                  <form role="form" method="post" action="<?php echo e(Route('direct.submitAdd',['param' => 'stock'])); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden"  name="id_trans" value="<?php echo e($trans->id_trans_Article); ?>" />


								 <table class="table table-bordered table-hover table-striped" id="dataTables-example">

									 <thead bgcolor="#DBDAD8">
										 <tr><th width="2%"> # </th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Quantite</th><th width="10%">Autres</th></tr>
									 </thead>
									 <tfoot bgcolor="#DBDAD8">
										 <tr><th width="2%"> # </th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Quantite</th><th width="10%">Autres</th></tr>
									 </tfoot>

									 <tbody>
										 <?php if( isset( $articles ) ): ?>
										 <?php if( $articles->isEmpty() ): ?>
										 <tr><td colspan="5" align="center">Aucun Article</td></tr>
										 <?php else: ?>
										 <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										 <tr class="odd gradeA">
                       <input type="hidden" name="id_article[<?php echo e($loop->index+1); ?>]" value="<?php echo e($item->id_article); ?>" >
											 <td><?php echo e($loop->index+1); ?></td>
											 <td><?php echo e($item->designation_c); ?></td>
                       <td><?php echo e(getChamp('categories', 'id_categorie', $item->id_categorie, 'libelle')); ?></td>
                       <td><?php echo e(getChamp('fournisseurs', 'id_fournisseur',  $item->id_fournisseur, 'libelle')); ?></td>
											 <td><input type="number" min="0" placeholder="Quantite" name="quantite[<?php echo e($loop->index+1); ?>]"  ></td>
											 <td>
													 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo e($loop->index+1); ?>">Detail Article</button>
											 </td>

											 
											 <div class="modal fade" id="myModal<?php echo e($loop->index+1); ?>" role="dialog">
												 <div class="modal-dialog modal-sm">
													 <div class="modal-content">
														 <div class="modal-header">
															 <button type="button" class="close" data-dismiss="modal">&times;</button>
															 <h4 class="modal-title"><?php echo e($item->designation_c); ?></h4>
														 </div>
														 <div class="modal-body">
															 <p><b>numero</b> <?php echo e($item->num_article); ?></p>
															 <p><b>code a barres</b> <?php echo e($item->code_barre); ?></p>
															 <p><b>Taille</b> <?php echo e($item->taille); ?></p>
															 <p><b>Couleur</b> <?php echo e($item->couleur); ?></p>
															 <p><b>sexe</b> <?php echo e(getSexeName($item->sexe)); ?></p>
															 <p><b>Prix d'achat</b> <?php echo e($item->prix_achat); ?></p>
															 <p><b>Prix de vente</b> <?php echo e($item->prix_vente); ?></p>
															 <p><?php echo e($item->designation_l); ?></p>
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
								<center><button type="submit" name="submit" value="valider" class="btn btn-default">Valider la vente</button></center>

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