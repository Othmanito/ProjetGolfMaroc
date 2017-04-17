<?php $__env->startSection('title'); ?> Espace Vendeur <?php $__env->stopSection(); ?>

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
        <h1 class="page-header">Bienvenue dans votre Espace Vendeur </h1>
      <!--  <img width="100%" height="100%" src="images/golf.jpg"/>-->
      <div class="col-lg-3 col-md-6">
                              <div class="panel panel-yellow">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3">
                                              <i class="fa fa-shopping-cart fa-5x"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <div class="huge"><?php echo e(App\Models\Transaction::where(['id_typeTrans'=> 3,'id_user'=> 3 ])->count()); ?></div>
                                              <div>Ventes</div>
                                          </div>
                                      </div>
                                  </div>
                                  <a href="<?php echo e(Route('vendeur.lister',['param' => 'ventes','p_id_user'=>3])); ?>">
                                      <div class="panel-footer">
                                          <span class="pull-left">Voir Details ventes</span>
                                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                          <div class="clearfix"></div>
                                      </div>
                                  </a>
                              </div>
                          </div>


                                        <div class="col-lg-3 col-md-6">
                                            <div class="panel panel-green">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <i class="glyphicon glyphicon-gift fa-5x"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-right">
                                                            <div class="huge"><?php echo e(App\Models\Promotion::where(['id_magasin'=> 2])->count()); ?></div>
                                                            <div>Promotions</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="<?php echo e(Route('vendeur.lister',['param' => 'promotions','p_id_user'=>3] )); ?>">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">Voir Details Promotions</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-md-6">
                                                                <div class="panel panel-primary">
                                                                    <div class="panel-heading">
                                                                        <div class="row">
                                                                            <div class="col-xs-3">
                                                                                <i class="fa fa-tasks  fa-5x"></i>
                                                                            </div>
                                                                            <div class="col-xs-9 text-right">
                                                                                <div class="huge"><?php echo e(App\Models\Stock::where(['id_magasin'=> 2])->count()); ?></div>
                                                                                <div>Stock magasin</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <a href="<?php echo e(Route('vendeur.lister',['param' => 'stocks','p_id_user'=>3] )); ?>">
                                                                        <div class="panel-footer">
                                                                            <span class="pull-left">Voir Details Stock</span>
                                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>


    </div>
</div>
<!-- /.row -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('menu_1'); ?>
	<?php echo $__env->make('Espace_Vendeur._nav_menu_1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_2'); ?>
	<?php echo $__env->make('Espace_Vendeur._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>