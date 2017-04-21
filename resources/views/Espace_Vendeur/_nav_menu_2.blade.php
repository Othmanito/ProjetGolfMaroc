<div class="collapse navbar-collapse navbar-ex1-collapse">
  <ul class="nav navbar-nav side-nav">

    <li><a href="{{ Route('vendeur.home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
    <li><a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-shopping-cart"></i> Gestion des Ventes <i class="fa fa-fw fa-caret-down"></i></a>
      <ul id="demo" class="collapse">
        <li><a href="{{Route('vendeur.lister',['param' => 'transact','p_id_user'=>3 ]) }}">Ventes du Magasin <span class="badge">{{ App\Models\Transaction::where(['id_typeTrans'=> 3,'id_user'=> 3 ])->count() }} </span></a></li>
        <li><a href="{{Route('vendeur.lister',['param' => 'promotions','p_id_user'=>3] )}}">Promotions Magasin <span class="badge">{{ App\Models\Promotion::where(['id_magasin'=> 2 ])->count() }} </span></a></li>
        <li><a href="{{Route('vendeur.lister',['param' => 'stocks','p_id_user'=>3] )}}">Stock Magasin <span class="badge">{{ App\Models\Stock::where(['id_magasin'=> 2])->count() }} </span></a></li>

      </ul>
    </li>

    <!--<li><a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="glyphicon glyphicon-cube-black"></i> Gestion Stocks <i class="fa fa-fw fa-caret-down"></i></a>
      <ul id="demo1" class="collapse">
        <li><a href="{{ Route('direct.lister',['param' => 'magasins' ]) }}">    Magasins     <span class="badge">{{ App\Models\Magasin::count() }}     </span></a></li>
        <li><a href="{{ Route('direct.lister',['param' => 'stocks' ]) }}">     Stocks      <span class="badge">{{ App\Models\Stock::count() }}      </span></a></li>

      </ul>
    </li>-->
  </ul>
</div>
<!-- /.navbar-collapse -->
