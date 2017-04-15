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
								<a href="<?php echo e(Route('direct.updateForm',['id_article' => $data->id_magasin, 'p_table' => 'magasins' ])); ?>" type="button" class="btn btn-outline btn-info"> Modifier </a>

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
									 <tr><th width="2%"> # </th><th> Article </th><th>Quantite</th><th width="10%">Autres</th></tr>
								 </thead>

								 <tbody>
									 <?php if( isset( $stocks ) ): ?>
									 <?php if( $stocks->isEmpty() ): ?>
									 <tr><td colspan="4">le stock de ce magasin est vide, appuyez sur le bouton en bas de la page pour lui ajouter des articles</td></tr>
									 <?php else: ?>
									 <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									 <tr class="odd gradeA">
										 <td><?php echo e($loop->index+1); ?></td>
										 <td><?php echo e(getChamp('articles','id_article',$item->id_article, 'designation_c')); ?></td>
										 <td <?php echo e($item->quantite<=$item->quantite_min ? 'bgcolor="red"' : ''); ?>> <?php echo e($item->quantite); ?></td>
										 <td>
											 <a href="<?php echo e(Route('direct.info',['p_table'=> 'magasins' , 'p_id' => $item->id_magasin  ])); ?>" title="detail"><i class="glyphicon glyphicon-eye-open"></i></a>
											 <a href="<?php echo e(Route('direct.updateForm',['p_table'=> 'magasins' , 'p_id' => $item->id_magasin  ])); ?>" title="modifier"><i class="glyphicon glyphicon-pencil"></i></a>
											 <a onclick="return confirm('Êtes-vous sure de vouloir effacer le magasin: <?php echo e($item->libelle); ?> ?')" href="<?php echo e(Route('direct.delete',['p_table' => 'magasins' , 'p_id' => $item->id_magasin ])); ?>" title="supprimer"><i class="glyphicon glyphicon-trash"></i></a>
										 </td>
									 </tr>
									 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									 <?php endif; ?>
									 <?php endif; ?>

								 </tbody>
							 </table>
						 </div>
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