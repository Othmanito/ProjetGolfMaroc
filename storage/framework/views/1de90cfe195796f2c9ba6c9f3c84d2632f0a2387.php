<?php $__env->startSection('title'); ?> Ajout Article <?php $__env->stopSection(); ?>

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
		<h1 class="page-header">Ajouter un Article <small> </small></h1>

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

					
					<form role="form" method="post" action="<?php echo e(Route('direct.submitAdd',['p_table' => 'articles'])); ?>">
						<?php echo e(csrf_field()); ?>



						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Categorie</label>
									<select class="form-control" name="id_categorie" autofocus>
									<?php if( !$categories->isEmpty() ): ?>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id_categorie); ?>" <?php if( $item->id_categorie == old('id_categorie') ): ?> selected <?php endif; ?>  > <?php echo e($item->libelle); ?> ( <?php echo e(DB::table('articles')->whereIdCategorie($item->id_categorie)->count()); ?> article(s) )</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</select>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Fournisseur</label>
									<select class="form-control" name="id_fournisseur">
									<?php if( !$fournisseurs->isEmpty() ): ?>
										<?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id_fournisseur); ?>" <?php if( $item->id_fournisseur == old('id_fournisseur') ): ?> selected <?php endif; ?>  > <?php echo e($item->libelle); ?> ( <?php echo e(DB::table('articles')->whereIdFournisseur($item->id_fournisseur)->count()); ?> article(s) )</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</select>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Numero de l'article</label>
									<input type="text" class="form-control" placeholder="Numero Article" name="num_article" value="<?php echo e(old('num_article')); ?>" required>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Code a Barres</label>
									<input type="text" class="form-control" placeholder="Code a Barres" name="code_barre" value="<?php echo e(old('code_barre')); ?>" required>
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- Row 2 -->
						<div class="row">

							<div class="col-lg-6">
								
								<div class="form-group">
									<label>Designation Courte</label>
									<input type="text" class="form-control"  placeholder="Designation Courte" name="designation_c" value="<?php echo e(old('designation_c')); ?>" required>
								</div>
							</div>

							<div class="col-lg-6">
								
								<div class="form-group">
									<label>Designation Logue</label>
									<textarea type="text" class="form-control" rows="2" placeholder="Designation Longue" name="designation_l"><?php echo e(old('designation_l')); ?></textarea>
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Taille</label>
									<input type="text" class="form-control" placeholder="Taille" name="taille" value="<?php echo e(old('taille')); ?>">
								</div>
							</div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Sexe</label>
									<select class="form-control" name="sexe">
										<option value="aucun" <?php echo e(old('sexe')=="aucun" ? 'selected' : ''); ?>>Aucun</option>
										<option value="h" <?php echo e(old('sexe')=="h" ? 'selected' : ''); ?>>Homme</option>
										<option value="f" <?php echo e(old('sexe')=="f" ? 'selected' : ''); ?>>Femme</option>
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Couleur</label>
									<input type="text" class="form-control" placeholder="Couleur" name="couleur" value="<?php echo e(old('couleur')); ?>">
								</div>
							</div>
							<div class="col-lg-5">
							<div class="form-group">

                                <label>Image de l'article</label>
                                <input type="file" class="form-control">
                            </div></div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Prix de Vente (HT)</label>
									<input type="number" step="0.01" pattern=".##" min="0" class="form-control" placeholder="Prix de vente" name="prix_vente" value="<?php echo e(old('prix_vente')); ?>">
								</div>
							</div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Prix d'achat (HT)</label>
									<input type="number" step="0.01" pattern=".##" min="0" class="form-control" placeholder="Prix d'achat" name="prix_achat" value="<?php echo e(old('prix_achat')); ?>">
								</div>
							</div>

						</div>
						<!-- end row 3 -->

						<!-- row 4 -->
						<div class="row" align="center">
								
								<label title="aa">cochez pour forcer l'ajout de l'article</label>
								<input type="checkbox" name="force" value="true"><br>
								<button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
								<button type="reset" class="btn btn-default">Effacer</button>
						</div>
						<!-- end row 4 -->

						
						<?php if( isset($data) && !$data->isEmpty()): ?>
						<hr>
						<!-- row 5 -->
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
						<!-- end row 5 -->
						<?php endif; ?>
						

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