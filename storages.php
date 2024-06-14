<?php require_once './data.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/bootstrap/bootstrap.css">
	<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet" />
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<link rel="stylesheet" href="style/style.css">
	<title>Document</title>
</head>

<body>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
	<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet" />

	<div id="root" class="d-flex ">
		<div class="nav h-100 d-flex flex-column align-items-center justify-content-between p-2" style="width: 60px;">
			<?php require('./components/nav.php'); ?>
		</div>
		<div id="main" class="h-100 gap-3" style="flex-grow: 1;">
			
			<!-- -------------------------------- -->
			<div class="component h-100" id="groupList">
				<?php require('./components/dashboard/storageList.php'); ?>
			</div>
			<style>#storageList{height: 100% !important;}</style>
			<!-- -------------------------------- -->
			
</div>
	</div>
</body>

</html>