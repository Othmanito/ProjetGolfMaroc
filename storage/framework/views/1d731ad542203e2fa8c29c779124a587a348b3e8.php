<?php $__env->startSection('title'); ?> Utlisateurs <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/sb-admin.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('table2/datatables.min.js')); ?>"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" size="10" class="form-control" placeholder="Rechercher par ' + title + '" />');
        });
        // DataTable
        var table = $('#example').DataTable();
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<div class="container-fluid">
  <div class="row">
    <h1 class="page-header">Liste des Employes <small> </small></h1>

    
    <div class="row">
        <div class="col-lg-2"></div>

        <div class="col-lg-8">
             <?php if(session('alert_success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_success'); ?>

            </div>
            <?php endif; ?> <?php if(session('alert_info')): ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_info'); ?>

            </div>
            <?php endif; ?> <?php if(session('alert_warning')): ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_warning'); ?>

            </div>
            <?php endif; ?> <?php if(session('alert_danger')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?php echo session('alert_danger'); ?>

            </div>
            <?php endif; ?> 
        </div>

        <div class="col-lg-2"></div>
    </div>
    

    
    <div class="table-responsive">
        
        <div class="col-lg-12">
            <table id="example" class="table table-striped table-bordered table-hover" width="100%">
                <thead bgcolor="#DBDAD8">
                    <tr>
                        <th width="2%">#</th>
                        <th>Role</th>
                        <th>Nom et Prenom</th>
                        <th>Ville</th>
                        <th>Email</th>
                        <th>Magasin</th>
                        <th width="5%">Autres</th>
                    </tr>
                </thead>
                <tfoot bgcolor="#DBDAD8">
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Nom et Prenom</th>
                        <th>Ville</th>
                        <th>Email</th>
                        <th>Magasin</th>
                        <th>Autres</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if( isset( $data ) ): ?> <?php if( $data->isEmpty() ): ?>
                    <tr>
                        <td colspan="7" align="center">Aucun employe</td>
                    </tr>
                    <?php else: ?> <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->index+1); ?></td>
                        <td><?php echo e(getRoleName( $item->id_role )); ?></td>
                        <td><?php echo e($item->nom); ?> <?php echo e($item->prenom); ?></td>
                        <td><?php echo e($item->ville); ?></td>
                        <td><?php echo e($item->email); ?></td>
                        <td><a href=""> <?php echo getMagasinName( $item->id_magasin )!=null ? getMagasinName( $item->id_magasin ) : '<i>Aucun</i>'; ?></a></td>
                        <td>
                            <a href="<?php echo e(Route('admin.info',['p_id' => $item->id_user, 'p_table' => 'users' ] )); ?>" title="Detail"><i class="glyphicon glyphicon-user"></i></a>
                            <a href="<?php echo e(Route('admin.update',['p_id' => $item->id_user, 'p_table' => 'users' ])); ?>" title="Modifier"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a onclick="return confirm('Êtes-vous sure de vouloir effacer l\'utilisateur: <?php echo e($item->nom); ?> <?php echo e($item->prenom); ?> ?')" href="<?php echo e(Route('admin.deleteUser',['id' => $item->id_user ])); ?>" title="Supprimer"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <?php endif; ?>
                </tbody>

                <script type="text/javascript">
                    // For demo to fit into DataTables site builder...
                    $('#example').removeClass('display').addClass('table table-striped table-bordered');
                </script>

            </table>
          </div>
          

        </div>
        


        <div class="row" align="center">
          <a target="_blank" href="<?php echo e(Route('admin.export',[ 'p_table' => 'users' ])); ?>" type="button" class="btn btn-outline btn-default" title="Exporter la liste des utilisateur" > Export Excel</a>
        </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_1'); ?>
  <?php echo $__env->make('Espace_Admin._nav_menu_1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu_2'); ?>
  <?php echo $__env->make('Espace_Admin._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>