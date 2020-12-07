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

			<select class="btn margR" id="simSelect">
				<?php
				headerData::getCentral();
				?>
			</select>

			<button onclick="StartStop_Sim(1)" class="btn" id="status"><?php headerData::getSimState();?></button>

		</div>

	</nav>

</header>

<script type="text/javascript">

	function StartStop_Sim(str) {
		let ajx = new ajaxHandler()
		if(status == 0){
			ajx.sendRequest("startSim","a",updateButton);
		}else{
			ajx.sendRequest("stopSim","a",updateButton);
		}
		
	}

	function updateButton(data){
		
		let dt = JSON.parse(data)
		status = dt["1"]
		$("#status").html(dt["2"])
	}

</script>