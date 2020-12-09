<header class="head">

	<div class="collapse" id="navbarToggleExternalContent">
		<div class="p-4">
			<a class="btn" href="index.php?p=dashboard">Dashboard</a>
			<a class="btn" href="index.php?p=production">Production</a>
			<a class="btn" href="index.php?p=loads">Loads</a>
			<a class="btn" href="index.php?p=weathers">Weathers</a>
			<a class="btn" href="index.php?p=stock">Stock</a>
			<a class="btn" href="index.php?p=editor">Editor</a>
		</div>
	</div>
	<nav class="navbar">
		<a class="title" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false">
			<h1>
				<?php
					include("public/img/svgMenuIcon.html");
					headerData::getPageTitle();
				?>
			</h1>
		</a>

		<div class="nav justify-contend-end">

			<a href="index.php?a=logoff" class="btn margR">Exit</a>

			<button onclick="StartStop_Sim(1)" class="btn" id="status"><?php headerData::getSimState_icon();?></button>

		</div>

	</nav>

</header>

<script type="text/javascript" src="frontend\JS\header.js"></script>