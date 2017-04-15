<?php $__env->startSection('title'); ?> Modifier Fournisseur <?php $__env->stopSection(); ?>

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
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Modifier un Fournisseur <small> </small></h1>

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

					
					<form role="form" method="post" action="<?php echo e(Route('direct.submitUpdate',['p_table' => 'fournisseurs' ])); ?>">
						<?php echo e(csrf_field()); ?>


						<input type="hidden" class="form-control" name="id_fournisseur" value="<?php echo e($data->id_fournisseur); ?>" >


						<!-- Row 1 -->
						<div class="row">

								<div class="col-lg-2">
									
									<div class="form-group">
										<label>Code du fournisseur</label>
										<input type="text" class="form-control" placeholder="Code" name="code" value="<?php echo e($data->code); ?>" autofocus>
									</div>
								</div>

								<div class="col-lg-5">
								
								<div class="form-group">
									<label>Libelle</label>
									<input type="text" class="form-control" placeholder="Libelle" name="libelle" value="<?php echo e($data->libelle); ?>" required>
								</div>
								</div>

								<div class="col-lg-5">
								
								<div class="form-group">
									<label>Nom du representant</label>
									<input type="text" class="form-control" placeholder="Agent" name="agent" value="<?php echo e($data->agent); ?>" >
								</div>
								</div>

						</div>
						<!-- end row 1 -->

						<!-- Row 2 -->
						<div class="row">

							<div class="col-lg-6">
								
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo e($data->email); ?>">
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Telephone</label>
									<input type="text" class="form-control" placeholder="Telephone" name="telephone" value="<?php echo e($data->telephone); ?>">
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Fax</label>
									<input type="text" class="form-control" placeholder="Fax" name="fax" value="<?php echo e($data->fax); ?>">
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-12">
								
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="2" placeholder="Description" name="description"><?php echo e($data->description); ?></textarea>
								</div>
							</div>

						</div>
						<!-- end row 3 -->

						<!-- row 4 -->
						<div class="row">

							<div class="col-lg-4"></div>
							<div>
								
								<button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
								<button type="submit" name="submit" value="verifier" class="btn btn-default" disabled>Vérifier</button>
								<button type="reset" class="btn btn-default">Réinitialiser</button>
							</div>

						</div>
						<!-- end row 4 -->

					</form>


			</div>
			<!-- /#page-wrapper -->
		</div>
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