<?php $__env->startSection('title'); ?> Article: <?php echo e($data->designation_c); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/sb-admin.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Article </h1>

		<div id="page-wrapper">

			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					
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
					
			</div>
			<div class="col-lg-2"></div>
			</div>

			<div class="container-fluid">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">

					<!-- debut panel -->
					<div class="panel panel-default">
						<div class="panel-heading" align="center">
							<h2><?php echo e($data->designation_c); ?></h2>
						</div>
						<!-- debut panel body -->
						<div class="panel-body">
							<table class="table table-hover" border="0" cellspacing="0" cellpadding="5">
								<tr>
									<td>Numero de l'article</td>
									<td><strong><?php echo e($data->num_article); ?> </strong></td>
								</tr>
								<tr>
									<td>Code a Barres</td>
									<td><strong><?php echo e($data->code_barre); ?> </strong></td>
								</tr>
								<tr>
									<td>Designation Courte</td>
									<td><strong><?php echo e($data->designation_c); ?> </strong></td>
								</tr>
								<tr>
									<td>Taille</td>
									<td><strong><?php echo e($data->taille); ?> </strong></td>
								</tr>
								<tr>
									<td>Couleur</td>
									<td><strong><?php echo e($data->couleur); ?> </strong></td>
								</tr>
								<tr>
									<td>Sexe</td>
									<td><strong><?php echo e(getSexeName($data->sexe)); ?> </strong></td>
								</tr>
								<tr>
									<td>Prix d'achat</td>
									<td><strong><?php echo e($data->prix_achat); ?> </strong></td>
								</tr>
								<tr>
									<td>Prix de vente</td>
									<td><strong><?php echo e($data->prix_vente); ?> </strong></td>
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


							<?php if( strlen($data->designation_l) > 0 ): ?>
							<div class="page-header">
								<h3>Designation Longue</h3>
							</div>
							<div class="well">
								<p><?php echo e($data->designation_l); ?></p>
							</div>
							<?php endif; ?>


							<div class="row" align="center">
								<a href="<?php echo e(Route('direct.delete',['p_table' => 'articles', 'p_id' => $data->id_article ])); ?>" onclick="return confirm('Êtes-vous sure de vouloir effacer l\'article: <?php echo e($data->designation_c); ?> ?')" type="button" class="btn btn-outline btn-danger">Supprimer </a>
								<a href="<?php echo e(Route('direct.update',['id_article' => $data->id_article, 'p_table' => 'articles' ])); ?>" type="button" class="btn btn-outline btn-info"> Modifier </a>
							</div>

						</div>
						<!-- fin panel body -->

					</div>
					<!-- fin panel -->

				</div>

				<div class="col-lg-1"></div>

			</div>
			<!-- /.container-fluid -->

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