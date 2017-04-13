<div class="collapse navbar-collapse navbar-ex1-collapse">
  <ul class="nav navbar-nav side-nav">

    <li><a href="{{ Route('direct.home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>

    <li><a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-text-color"></i> Gestion Articles <i class="fa fa-fw fa-caret-down"></i></a>
      <ul id="demo" class="collapse">
        <li><a href="{{ Route('direct.lister',['param' => 'fournisseurs' ]) }}">Fournisseurs <span class="badge">{{ App\Models\Fournisseur::count() }} </span></a></li>
        <li><a href="{{ Route('direct.lister',['param' => 'categories' ]) }}">  Categories   <span class="badge">{{ App\Models\Categorie::count() }}   </span></a></li>
        <li><a href="{{ Route('direct.lister',['param' => 'articles' ]) }}">    Articles     <span class="badge">{{ App\Models\Article::count() }}     </span></a></li>
      </ul>
    </li>

    <li><a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="glyphicon glyphicon-cube-black"></i> Gestion Stocks <i class="fa fa-fw fa-caret-down"></i></a>
      <ul id="demo1" class="collapse">
        <li><a href="{{ Route('direct.lister',['param' => 'magasins' ]) }}">    Magasins     <span class="badge">{{ App\Models\Magasin::count() }}     </span></a></li>
        <li><a href="{{ Route('direct.lister',['param' => 'stocks' ]) }}">     Stocks      <span class="badge">{{ App\Models\Stock::count() }}      </span></a></li>

      </ul>
    </li>

    <li class="active">
      <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
    </li>
  </ul>
</div>
<!-- /.navbar-collapse -->
