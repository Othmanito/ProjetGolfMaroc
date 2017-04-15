<?php $__env->startSection('title'); ?> Ajout Stock du magasin <?php echo e($magasin->libelle); ?> <?php $__env->stopSection(); ?>

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
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<div class="container-fluid">
    <div class="row">
        <h1 class="page-header">Ajouter au Stock du magasin <?php echo e($magasin->libelle); ?> <small> </small></h1>

        
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

                <input type="hidden" name="id_magasin" value="<?php echo e($magasin->id_magasin); ?>" />
                <table id="example" class="table table-striped table-bordered table-hover">
                  <thead bgcolor="#DBDAD8">
                      <tr>
                          <th width="1%"> # </th>
                          <th>Article</th>
                          <th>Categorie</th>
                          <th>Fournisseur</th>
                          <th>Quantite</th>
                          <th>Quantite min</th>
                          <th>Quantite max</th>
                          <th width="10%">Autres</th>
                      </tr>
                  </thead>
                  <tfoot bgcolor="#DBDAD8">
                      <tr>
                          <th width="1%"> # </th>
                          <th>Article</th>
                          <th>Categorie</th>
                          <th>Fournisseur</th>
                          <th>Quantite</th>
                          <th>Quantite min</th>
                          <th>Quantite max</th>
                          <th width="10%">Autres</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <?php if( isset( $articles ) ): ?>
                    <?php if( $articles->isEmpty() ): ?>
                    <tr>
                      <td colspan="5" align="center">Aucun Article</td>
                    </tr>
                    <?php else: ?>
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <input type="hidden" name="id_article[<?php echo e($loop->index+1); ?>]" value="<?php echo e($item->id_article); ?>">
                        <td><?php echo e($loop->index+1); ?></td>
                        <td><?php echo e($item->designation_c); ?></td>
                        <td><?php echo e(getChamp('categories', 'id_categorie', $item->id_categorie, 'libelle')); ?></td>
                        <td><?php echo e(getChamp('fournisseurs', 'id_fournisseur', $item->id_fournisseur, 'libelle')); ?></td>
                        <td><input type="number" min="0" placeholder="Quantite"     name="quantite[<?php echo e($loop->index+1); ?>]"></td>
                        <td><input type="number" min="0" placeholder="Quantite Min" name="quantite_min[<?php echo e($loop->index+1); ?>]" value="<?php echo e(old('quantite_min[$loop->index+1]')); ?>"></td>
                        <td><input type="number" min="0" placeholder="Quantite Max" name="quantite_max[<?php echo e($loop->index+1); ?>]" value="<?php echo e(old('quantite_max[$loop->index+1]')); ?>"></td>
                        <td>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo e($loop->index+1); ?>">Detail Article</button>
                        </td>

                        
                        <div class="modal fade" id="myModal<?php echo e($loop->index+1); ?>" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><?php echo e($item->designation_c); ?></h4>
                              </div>
                              <div class="modal-body">
                                <p><b>numero</b> <?php echo e($item->num_article); ?></p>
                                <p><b>code a barres</b> <?php echo e($item->code_barre); ?></p>
                                <p><b>Taille</b> <?php echo e($item->taille); ?></p>
                                <p><b>Couleur</b> <?php echo e($item->couleur); ?></p>
                                <p><b>sexe</b> <?php echo e(getSexeName($item->sexe)); ?></p>
                                <p><b>Prix d'achat</b> <?php echo e($item->prix_achat); ?></p>
                                <p><b>Prix de vente</b> <?php echo e($item->prix_vente); ?></p>
                                <p><?php echo e($item->designation_l); ?></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php endif; ?>
                  </tbody>
                  <tr>
                    <td colspan="8" align="center">
                      <button data-toggle="popover" data-placement="top" data-trigger="hover" title="Valider l'ajout" data-content="Cliquez" type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
                    </td>
                  </tr>
                </table>
              </form>
              
            </div>
          </div>
        </div>
        <!-- end row 1 -->


    </div>
</div>
<!-- /.row -->
<?php $__env->stopSection(); ?> <?php $__env->startSection('menu_1'); ?> <?php echo $__env->make('Espace_Direct._nav_menu_1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('menu_2'); ?> <?php echo $__env->make('Espace_Direct._nav_menu_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>