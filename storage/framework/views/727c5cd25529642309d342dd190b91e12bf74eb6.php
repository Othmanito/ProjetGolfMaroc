<?php $__env->startSection('title'); ?> Ajouter Utilisateur <?php $__env->stopSection(); ?>

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
		<h1 class="page-header">Ajouter un Utilisateur <small> </small></h1>

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

					
					<form role="form" method="post" action="<?php echo e(Route('admin.submitAdd',['p_table' => 'users'])); ?>">
						<?php echo e(csrf_field()); ?>



						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Role</label>
									<select class="form-control" name="id_role" id="id_role">
									<?php if( !$roles->isEmpty() ): ?>
										<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id_role); ?>" <?php if( $item->id_role == old('id_role') ): ?> selected <?php endif; ?>  ><?php echo e($item->libelle); ?> </option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</select>
								</div>
							</div>

							<div class="col-lg-2">
								
								<div class="form-group">
									<label>Magasin</label>
									<select class="form-control" name="id_magasin" id="id_magasin">
									<option value="0" selected>Aucun</option>
									<?php if( !$magasins->isEmpty() ): ?>
										<?php $__currentLoopData = $magasins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id_magasin); ?>" <?php if( $item->id_magasin == old('id_magasin') ): ?> selected <?php endif; ?>  ><?php echo e($item->libelle); ?> a <?php echo e($item->ville); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</select>
								</div>
							</div>

							<div class="col-lg-4">
								
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" placeholder="E-mail" name="email" id="email" value="<?php echo e(old('email')); ?>" required autofocus>
									<p class="help-block">utilisé pour l'authentification</p>
								</div>
							</div>

							<div class="col-lg-4">
								
								<div class="form-group">
									<label>Password</label>
									<input type="text" class="form-control" placeholder="Password" name="password" id="password" required min="9">
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- row 2 -->
						<div class="row">

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Nom</label>
									<input type="text" class="form-control" placeholder="Nom" name="nom" id="nom" value="<?php echo e(old('nom')); ?>" required>
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Prenom</label>
									<input type="text" class="form-control" placeholder="Prenom" name="prenom" id="prenom" value="<?php echo e(old('prenom')); ?>">
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Ville</label>
									<input type="text" class="form-control" placeholder="Ville" name="ville" id="ville" value="<?php echo e(old('ville')); ?>">
								</div>
							</div>

							<div class="col-lg-3">
								
								<div class="form-group">
									<label>Telephone</label>
									<input type="number" class="form-control" placeholder="Telephone" name="telephone" id="telephone" value="<?php echo e(old('telephone')); ?>">
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-6">
								
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="5" placeholder="Description" name="description" id="description"><?php echo e(old('description')); ?></textarea>
								</div>
							</div>

							<div class="col-lg-6">
								<br/><br/>
								
								<button type="submit" name="submit" value="valider" class="btn btn-default" width="60">Valider</button>
								<button type="reset" class="btn btn-default">Effacer</button>
							</div>

						</div>

					</form>

					
					<?php if( isset($error) ): ?>
					<div class="col-lg-12">
						<div class="alert alert-danger">
							<strong>Oh snap!</strong> <?php echo e($error); ?>

						</div>
					</div>
					<?php endif; ?>



			</div>
			<!-- /#page-wrapper -->
		</div>
	</div>
</div>
	<!-- /.row -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('menu_1'); ?>

<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="./">Golf-Maroc</a>
</div>

			<!-- Top Menu Items -->
			<ul class="nav navbar-right top-nav">

				<!-- Messages -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
					<ul class="dropdown-menu message-dropdown">
						<li class="message-preview">
							<a href="#">
								<div class="media">
									<span class="pull-left"><img class="media-object" src="http://placehold.it/50x50" alt=""></span>
									<div class="media-body">
										<h5 class="media-heading"><strong>John Smith</strong></h5>
										<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
										<p>Lorem ipsum dolor sit amet, consectetur...</p>
									</div>
								</div>
							</a>
						</li>
						<li class="message-footer">
							<a href="#">Read All New Messages</a>
						</li>
					</ul>
				</li>

				<!-- Alerts -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
					<ul class="dropdown-menu alert-dropdown">
						<li><a href="#">Alert Name <span class="label label-default">Alert Badge</span></a></li>
						<li class="divider"></li>
						<li><a href="#">View All</a></li>
					</ul>
				</li>

				<!-- Profile -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
						<li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
						<li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
						<li class="divider"></li>
            <li><a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
			<!-- end Top Menu Items -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_2'); ?>
	<?php echo $__env->make('Espace_Admin._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>