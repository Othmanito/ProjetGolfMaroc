<?php $__env->startSection('title'); ?> Stock du magasin  <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/sb-admin.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.js')); ?>"></script>

<script src="<?php echo e(asset('table/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('table/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('table/dataTables.bootstrap.js')); ?>"></script>

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<div class="container-fluid">
  <!-- main row -->
  <div class="row">

    <h1 class="page-header">Stock du magasin <strong><?php echo e(getChamp('magasins','id_magasin',$data->first()->id_magasin, 'libelle')); ?></strong> <small> </small></h1>

    <!-- row -->
    <div class="row">

      
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
      

      <div class="table-responsive">
	       <table class="table table-bordered table-hover table-striped" id="dataTables-example">

           <thead>
             <tr><th width="2%"> # </th><th> Article </th><th>Quantite</th><th width="10%">Autres</th></tr>
           </thead>

           <tbody>
             <?php if( isset( $data ) ): ?>
             <?php if( $data->isEmpty() ): ?>
             <tr><td colspan="4">Aucun Magasin</td></tr>
             <?php else: ?>
             <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr class="odd gradeA">
               <td><?php echo e($loop->index+1); ?></td>
               <td><?php echo e(getChamp('articles','id_article',$item->id_article, 'designation_c')); ?></td>
               <td <?php echo e($item->quantite<=$item->quantite_min ? 'bgcolor="red"' : ''); ?>> <?php echo e($item->quantite); ?></td>
               <td>
                 <a href="<?php echo e(Route('direct.info',['p_table'=> 'magasins' , 'p_id' => $item->id_magasin  ])); ?>" title="detail"><i class="glyphicon glyphicon-eye-open"></i></a>
                 <a href="<?php echo e(Route('direct.update',['p_table'=> 'magasins' , 'p_id' => $item->id_magasin  ])); ?>" title="modifier"><i class="glyphicon glyphicon-pencil"></i></a>
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
    <!-- row -->


      <!-- row -->
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-8">
          <a onclick="return alert('Printing ....')" type="button" class="btn btn-outline btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true">  Imprimer </i></a>
          <a href="<?php echo e(Route('direct.addStock',[ 'p_id_magasin' => $data->first()->id_magasin ])); ?>" type="button" class="btn btn-outline btn-default">  Ajouter Au Stock </a>
        </div>
      </div>
      <!-- row -->

    </div>
    <!-- end main row -->

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('menu_1'); ?>
	<?php echo $__env->make('Espace_Direct._nav_menu_1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_2'); ?>
	<?php echo $__env->make('Espace_Direct._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>