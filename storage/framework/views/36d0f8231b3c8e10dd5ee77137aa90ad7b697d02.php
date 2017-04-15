<?php $__env->startSection('title'); ?> Ajout Stock du magasin <?php echo e($magasin->libelle); ?>  <?php $__env->stopSection(); ?>

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
		<h1 class="page-header">Ajouter au Stock du magasin <?php echo e($magasin->libelle); ?> <small> </small></h1>

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

                    <input type="hidden"  name="id_magasin" value="<?php echo e($magasin->id_magasin); ?>" />


								 <table class="table table-bordered table-hover table-striped" id="dataTables-example">

									 <thead>
										 <tr><th width="2%"> # </th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Quantite</th><th>Quantite min</th><th>Quantite max</th><th width="10%">Autres</th></tr>
									 </thead>

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
                       <td><input type="number" min="0" placeholder="Quantite Min" name="quantite_min[<?php echo e($loop->index+1); ?>]" value="<?php echo e(old('quantite_min[$loop->index+1]')); ?>"></td>
                       <td><input type="number" min="0" placeholder="Quantite Max" name="quantite_max[<?php echo e($loop->index+1); ?>]" value="<?php echo e(old('quantite_max[$loop->index+1]')); ?>"></td>
											 <td>
                         autre
                       </td>
										 </tr>

										 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										 <?php endif; ?>
										 <?php endif; ?>

									 </tbody>

                   <tr><td colspan="8" align="center"><button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button></td></tr>


								 </table>
</form>

							 </div>
							</div>

						</div>
						<!-- end row 1 -->



						
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