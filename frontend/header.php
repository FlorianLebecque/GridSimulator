<header class="head">

	<div class="collapse" id="navbarToggleExternalContent">
		<div class="p-4">
			<a class="btn" href="index.php?p=dashboard">Dashboard</a>
			<a class="btn" href="index.php?p=production">Production</a>
			<a class="btn" href="index.php?p=loads">Loads</a>
			<a class="btn" href="index.php?p=weathers">Weathers</a>
			<a class="btn" href="index.php?p=stock">Stock</a>
		</div>
	</div>
	<nav class="navbar">
		<a class="title" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false">
			<h1>
				<?php
					include("public/img/svgMenuIcon.html");
					$this->hdrData->getPageTitle();
				?>
			</h1>
		</a>

		<div class="nav justify-contend-end">

			<select class="btn margR" id="simSelect">
				<?php
				$this->hdrData->getCentral();
				?>
			</select>

			<button onclick="StartStop_Sim(1)" class="btn" id="status"><?php $this->hdrData->getSimState();?></button>

		</div>

	</nav>

</header>

<script type="text/javascript">
	function StartStop_Sim(str) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("status").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "ajaxHandler.php?q=" + str, true);
		xmlhttp.send();
	}
</script>