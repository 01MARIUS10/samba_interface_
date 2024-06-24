<?php
require_once './data.php';
function isGroupPage()
{
	return  $_SERVER['REQUEST_URI'] === "/groups.php" ? "true" : "false";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/bootstrap/bootstrap.css">
	<!-- <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
	<link rel="stylesheet" href="style/style.css">
	<title>Document</title>
</head>

<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script> -->
	<!-- <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet" />  -->

	<div id="root" class="d-flex ">
		<div class="nav h-100 d-flex flex-column align-items-center justify-content-between p-2" style="width: 60px;">
			<?php require('./components/nav.php'); ?>
		</div>
		<div id="main" class="h-100 gap-3 pt-4" style="flex-grow: 1;">
			<div class="head d-flex justify-content-between p-3">
				<div class="">
					<h1>Total users :<span><?= count($users) ?></span> </h1>

				</div>
				<button class="btn btn-primary px-4" data-toggle="modal" data-target="#modalCreationUser"> Ajouter</button>
			</div>
			<!-- -------------------------------- -->
			<div class="component h-100" id="groupList">
				<?php require('./components/dashboard/userList.php'); ?>
			</div>
			<!-- -------------------------------- -->

		</div>
	</div>
</body>

</html>