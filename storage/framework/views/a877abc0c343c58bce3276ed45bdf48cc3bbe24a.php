<?php $__env->startSection('title'); ?> Magasin: <?php echo e($data->libelle); ?> <?php $__env->stopSection(); ?>

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
<script>
$(document).ready(function(){
		$('[data-toggle="popover"]').popover();
});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Magasin </h1>

		<div id="page-wrapper">

			
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
			

			<div class="container-fluid">


				<div class="col-lg-1"></div>
				<div class="col-lg-10">

					<!-- debut panel -->
					<div class="panel panel-default">
						<div class="panel-heading" align="center">
							<h2><?php echo e($data->libelle); ?></h2>
						</div>

						<!-- debut panel body -->
						<div class="panel-body">
							<table class="table table-hover" border="0" cellspacing="0" cellpadding="5">
								<tr>
									<td>Libelle</td>
									<td><strong><?php echo e($data->libelle); ?> </strong></td>
								</tr>
								<tr>
									<td>Ville</td>
									<td><strong><?php echo e($data->ville); ?> </strong></td>
								</tr>
								<tr>
									<td>Nom du representant</td>
									<td><strong><?php echo isset($data->agent) ? $data->agent : '<i></i>'; ?> </strong></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><strong><?php echo e($data->email); ?> </strong></td>
								</tr>
								<tr>
									<td>Telephone</td>
									<td><strong><?php echo e($data->telephone); ?> </strong></td>
								</tr>
								<tr>
									<td>Date de creation</td>
									<td><strong><?php echo e(getDateHelper($data->created_at)); ?> a <?php echo e(getTimeHelper($data->created_at)); ?>    </strong></td>
								</tr>
								<tr>
									<td>Date de derniere modification</td>
									<td><strong><?php echo e(getDateHelper($data->updated_at)); ?> a <?php echo e(getTimeHelper($data->updated_at)); ?>     </strong></td>
								</tr>
							</table>


							<?php if( strlen($data->description) > 0 ): ?>
							<div class="page-header">
								<h3>Description</h3>
							</div>
							<div class="well">
								<p><?php echo e($data->description); ?></p>
							</div>
							<?php endif; ?>

							<div class="col-lg-4"></div>
							<div class="col-lg-4">
								<a href="<?php echo e(Route('direct.delete',['p_table' => 'magasins', 'p_id' => $data->id_magasin ])); ?>" onclick="return confirm('Êtes-vous sure de vouloir effacer le magasin: <?php echo e($data->libelle); ?> ?')" type="button" class="btn btn-outline btn-danger"
                  title="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Supprimer le magasin et vider son stock" >Supprimer </a>
								<a href="<?php echo e(Route('direct.update',['id_article' => $data->id_magasin, 'p_table' => 'magasins' ])); ?>" type="button" class="btn btn-outline btn-info"
									title="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Modifier les informations du magasin" > Modifier </a>

							</div>

						</div>
						<!-- fin panel body -->

					</div>
					<!-- fin panel -->

				</div>

				<div class="col-lg-1"></div>

			</div>
			<!-- /.container-fluid -->

			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">

					<div class="panel panel-default">
						<!-- Default panel contents -->
						<div class="panel-heading">Stock du Magasin</div>
						<div class="panel-body">
							<p>le tableau suivant montre, en detail, le stock de ce magasin</p>
						</div>

						
						<div class="table-responsive">

							
		          <div class="col-lg-12">
								<table class="table table-bordered table-hover table-striped" id="dataTables-example">

								<thead>
									<tr><th width="2%"> # </th><th> Article </th><th width="15%">Quantite</th><th width="50%">Etat</th></tr>
								</thead>

								<tbody>
									<?php if( isset( $stocks ) ): ?>
										<?php if( $stocks->isEmpty() ): ?>
											<tr><td colspan="4">le stock de ce magasin est vide, appuyez sur le bouton en bas de la page pour lui ajouter des articles</td></tr>
										<?php else: ?>

										
										<?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										
										<?php if( $item->quantite > $item->quantite_min ): ?>
										<tr class="success">
										<?php endif; ?>
										<?php if( $item->quantite < $item->quantite_min ): ?>
										<tr class="danger">
										<?php endif; ?>
										<?php if( $item->quantite == $item->quantite_min ): ?>
										<tr class="warning">
										<?php endif; ?>
										

										<td><?php echo e($loop->index+1); ?></td>
										<td><?php echo e(getChamp("articles", "id_article",  $item->id_article , "designation_c")); ?></td>
										<!--td><?php echo e($item->quantite_min); ?> | <?php echo e($item->quantite); ?> | <?php echo e($item->quantite_max); ?></td-->

										<td> <?php echo e($item->quantite); ?> unités (<?php echo e(($item->quantite / $item->quantite_max)*100); ?>%) </td>

										<td>
											<div class="progress">
												<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: <?php echo e(100*($item->quantite_min/$item->quantite_max)); ?>%"></div>
												<div class="progress-bar progress-bar-success progress-bar-striped" style="width: <?php echo e(100*($item->quantite/$item->quantite_max)); ?>%"></div>
											</div>
										</td>
										<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo e($loop->index+1); ?>">Detail</button></td>

										
										<div class="modal fade" id="myModal<?php echo e($loop->index+1); ?>" role="dialog">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title"><?php echo e(getChamp("articles", "id_article",  $item->id_article , "designation_c")); ?></h4>
														</div>
														<div class="modal-body">
															<p><b>Quantité </b> <?php echo e($item->quantite); ?> </p>
															<p><b>Quantité Min</b> <?php echo e($item->quantite_min); ?> </p>
															<p><b>Quantité Max</b> <?php echo e($item->quantite_max); ?> </p>
															<hr>
															<p><b>numero</b> <?php echo e(getChamp("articles", "id_article",  $item->id_article , "num_article")); ?></p>
															<p><b>code a barres</b> <?php echo e(getChamp("articles", "id_article",  $item->id_article , "code_barre")); ?></p>
															<p><b>Taille</b> <?php echo e(getChamp("articles", "id_article",  $item->id_article , "taille")); ?></p>
															<p><b>Couleur</b> <?php echo e(getChamp("articles", "id_article",  $item->id_article , "couleur")); ?></p>
															<p><b>sexe</b> <?php echo e(getSexeName(getChamp("articles", "id_article",  $item->id_article , "sexe") )); ?></p>
															<p><b>Prix d'achat</b> <?php echo e(getChamp("articles", "id_article",  $item->id_article , "prix_achat")); ?></p>
															<p><b>Prix de vente</b> <?php echo e(getChamp("articles", "id_article",  $item->id_article , "prix_vente")); ?></p>
															<p><?php echo e(getChamp("articles", "id_article",  $item->id_article , "designation_l")); ?></p>
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
						 </div>
						</div>
						 

						 <div calss="row" align="center">
							 <a href="<?php echo e(Route('direct.addStock',['p_id_magasin' => $data->id_magasin ])); ?>" type="button" class="btn btn-outline btn-info"
							 title="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Ajouter des articles au stock de ce magasin"> Remplir le Stock </a>
						 </div>

					</div>
				</div>
			</div>

		</div>
		<!-- /#page-wrapper -->
	</div>




</div>
<!-- /.row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_1'); ?>
	<?php echo $__env->make('Espace_Direct._nav_menu_1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_2'); ?>
	<?php echo $__env->make('Espace_Direct._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>