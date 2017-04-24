<?php $__env->startSection('title'); ?> Modification Article <?php $__env->stopSection(); ?>

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
		<h1 class="page-header">Modifier un Article <small> </small></h1>

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

					
					<form role="form" method="post" action="<?php echo e(Route('direct.submitUpdate',[ 'p_table' => 'articles' ])); ?>">
						<?php echo e(csrf_field()); ?>


						<input type="hidden" class="form-control" name="id_article" value="<?php echo e($data->id_article); ?>" >


						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Categorie</label>
									<select class="form-control" name="id_categorie" autofocus>
										<?php if( $categories!=null ): ?>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id_categorie); ?>" <?php echo e($item->id_categorie == $data->id_categorie ? 'selected' : ''); ?>><?php echo e($item->libelle); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<option value="0" >aucune categorie</option>
										<?php endif; ?>
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Fournisseur</label>
									<select class="form-control" name="id_fournisseur">
										<?php if( $fournisseurs!=null ): ?>
										<?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id_fournisseur); ?>" <?php echo e($item->id_fournisseur == $data->id_fournisseur ? 'selected' : ''); ?>><?php echo e($item->libelle); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<option value="0" >aucune categorie</option>
										<?php endif; ?>
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Numero de l'article</label>
									<input type="text" class="form-control" placeholder="Numero Article" name="num_article" value="<?php echo e(isset($data->num_article) ? $data->num_article : old('num_article')); ?>" required>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Code a Barres</label>
									<input type="text" class="form-control" placeholder="Code a Barres" name="code_barre" value="<?php echo e(isset($data->code_barre) ? $data->code_barre : old('code_barre')); ?>" required>
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- Row 2 -->
						<div class="row">

							<div class="col-lg-6">
								
								<div class="form-group">
									<label>Designation Courte</label>
									<input type="text" class="form-control"  placeholder="Designation Courte" name="designation_c" value="<?php echo e(isset($data->designation_c) ? $data->designation_c : old('designation_c')); ?>" required>
								</div>
							</div>

							<div class="col-lg-6">
								
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="2" placeholder="Designation Longue" name="designation_l"><?php echo e(isset($data->designation_l) ? $data->designation_l : old('designation_l')); ?></textarea>
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Taille</label>
									<input type="text" class="form-control" placeholder="Taille" name="taille" value="<?php echo e(isset($data->taille) ? $data->taille : old('taille')); ?>">
								</div>
							</div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Sexe</label>
									<select class="form-control" name="sexe">
										<option value="aucun" <?php echo e($data->sexe == "aucun" ? 'selected' : ''); ?>>Aucun</option>
										<option value="h" <?php echo e($data->sexe == "h" ? 'selected' : ''); ?>>Homme</option>
										<option value="f" <?php echo e($data->sexe == "f" ? 'selected' : ''); ?>>Femme</option>
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Couleur</label>
									<input type="text"  class="form-control" placeholder="Couleur" name="couleur" value="<?php echo e($data->couleur); ?>">
								</div>
							</div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Prix d'achat</label>
									<input type="number" step="0.01" pattern=".##" min="0" class="form-control" placeholder="Prix d'achat" name="prix" value="<?php echo e($data->prix_achat); ?>">
								</div>
							</div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Prix (HT)</label>
									<input type="number" step="0.01" pattern=".##" min="0" class="form-control" placeholder="Prix de Vente" name="prix" value="<?php echo e($data->prix_vente); ?>">
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
								<button type="reset" class="btn btn-default">Effacer</button>
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