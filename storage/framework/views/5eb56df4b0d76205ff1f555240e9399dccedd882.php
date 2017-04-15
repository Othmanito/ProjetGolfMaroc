<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	
	<title><?php echo $__env->yieldContent('title'); ?></title>

	
	<?php echo $__env->yieldContent('styles'); ?>

</head>
<body>
	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

			<?php echo $__env->yieldContent('menu_1'); ?>

			<?php echo $__env->yieldContent('menu_2'); ?>

		</nav>
		<!-- end Navigation -->

		<!-- Main Page -->
		<div id="page-wrapper">

		<?php echo $__env->yieldContent('main_content'); ?>

		</div>
		<!-- end Main Page -->
	</div>


	
	<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
