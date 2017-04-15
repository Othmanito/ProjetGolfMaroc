<?php $__env->startSection('title'); ?> Fournisseur: <?php echo e($data->libelle); ?> <?php $__env->stopSection(); ?>

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
		<h1 class="page-header">Fournisseur</h1>

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
									<td>Code</td>
									<td><strong><?php echo e($data->code); ?> </strong></td>
								</tr>
								<tr>
									<td>Nom du representant</td>
									<td><strong><?php echo e($data->agent); ?> </strong></td>
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
									<td>Fax</td>
									<td><strong><?php echo e($data->fax); ?> </strong></td>
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
								<a href="<?php echo e(Route('direct.delete',['p_table' => 'magasins', 'p_id' => $data->id_magasin ])); ?>" onclick="return confirm('Êtes-vous sure de vouloir effacer le fournisseur: <?php echo e($data->libelle); ?> ?')" type="button" class="btn btn-outline btn-danger">Supprimer </a>
								<a href="<?php echo e(Route('direct.update',['id_article' => $data->id_fournisseur, 'p_table' => 'fournisseurs' ])); ?>" type="button" class="btn btn-outline btn-info"> Modifier </a>

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