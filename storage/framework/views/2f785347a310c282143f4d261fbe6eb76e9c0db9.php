<?php $__env->startSection('title'); ?> Espace Admin <?php $__env->stopSection(); ?>

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
        <h1 class="page-header">Espace Admin <small> Bienvenue</small></h1>
        <img width="100%" height="100%" src="images/golf.jpg"/>

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