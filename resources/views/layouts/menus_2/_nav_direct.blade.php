<!-- Begin SideBar Menu -->
<ul class="nav navbar-nav side-nav">

	<li><a href="/direct"><i class="fa fa-fw fa-dashboard"></i> Dashboard Direct</a></li>

	<li>
		<a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-arrows-v"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
		<ul id="demo1" class="collapse">
			<li><a href="{{ Route('direct.addForm',['param' => 'categorie']) }}">Ajouter</a></li>
			<li><a href="{{ Route('direct.lister' ,['param' => 'categorie']) }}">Afficher</a></li>
		</ul>
	</li>

	<li>
		<a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-arrows-v"></i> Fournisseurs <i class="fa fa-fw fa-caret-down"></i></a>
		<ul id="demo2" class="collapse">
			<li><a href="{{ Route('direct.addForm',['param' => 'fournisseur']) }}">Ajouter</a></li>
			<li><a href="{{ Route('direct.lister' ,['param' => 'fournisseur']) }}">Afficher</a></li>
		</ul>
	</li>

	<li>
		<a href="javascript:;" data-toggle="collapse" data-target="#demo3"><i class="fa fa-fw fa-arrows-v"></i> Articles <i class="fa fa-fw fa-caret-down"></i></a>
		<ul id="demo3" class="collapse">
			<li><a href="{{ Route('direct.addForm',['param' => 'article']) }}">Ajouter</a></li>
			<li><a href="{{ Route('direct.lister' ,['param' => 'article']) }}">Afficher</a></li>
		</ul>
	</li>

	<li><a href=""><i class="glyphicon glyphicon-user"></i> Lister les Utilisateurs</a></li>


	<li><a href=""><i class="glyphicon glyphicon-minus"></i> Autre</a></li>

	<li><a href=""><i class="fa fa-database"></i> Exporter la base de donnees </a></li>
</ul>
<!-- End SideBar Menu -->
