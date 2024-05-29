<?php
$users = [
	[
		"id" => "1",
		"Nom" => "Mark",
		"UID" => "10",
		"Groups" => "root , mark",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "1",
		"Nom" => "Mark",
		"UID" => "10",
		"Groups" => "root , mark",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "1",
		"Nom" => "Mark",
		"UID" => "10",
		"Groups" => "root , mark",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "1",
		"Nom" => "Mark",
		"UID" => "10",
		"Groups" => "root , mark",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "1",
		"Nom" => "Mark",
		"UID" => "10",
		"Groups" => "root , mark",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "1",
		"Nom" => "Mark",
		"UID" => "10",
		"Groups" => "root , mark",
		"Usage" => 2.3,
		"max-usage" => 8,
	],

];
$groups = [
	[
		"id" => "1",
		"Nom" => "Masimo",
		"GID" => "1010",
		"Users" => "root , mark",
		"created_at" => "23-01-2023 a 12h15",
	],
	[
		"id" => "1",
		"Nom" => "Masimo",
		"GID" => "1010",
		"Users" => "root , mark",
		"created_at" => "23-01-2023 a 12h15",
	],
	[
		"id" => "1",
		"Nom" => "Masimo",
		"GID" => "1010",
		"Users" => "root , mark",
		"created_at" => "23-01-2023 a 12h15",
	],
	[
		"id" => "1",
		"Nom" => "Masimo",
		"GID" => "1010",
		"Users" => "root , mark",
		"created_at" => "23-01-2023 a 12h15",
	],
	[
		"id" => "1",
		"Nom" => "Masimo",
		"GID" => "1010",
		"Users" => "root , mark",
		"created_at" => "23-01-2023 a 12h15",
	],
	[
		"id" => "1",
		"Nom" => "Masimo",
		"GID" => "1010",
		"Users" => "root , mark",
		"created_at" => "23-01-2023 a 12h15",
	]

];

$storages = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 1, 2, 1, 2, 1, 2, 1, 2];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/bootstrap/bootstrap.css">
	<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet" />
	<link rel="stylesheet" href="style/style.css">
	<title>Document</title>
</head>

<body>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
	<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet" />

	<div id="root" class="d-flex ">
		<div class="nav h-100" style="width: 60px;">

		</div>
		<main class="h-100 gap-3" style="flex-grow: 1;">
			<!-- -------------------------------- -->
			<div class="component">
				<div class="component-statUser d-flex flex-column justify-content-end align-items-center w-100 h-100 p-5 gap-10p">
					<h1>ZERO</h1>
					<p>Total users</p>
				</div>
			</div>
			<!-- -------------------------------- -->
			<div class="component" id="userList">
				<?php require('./components/dashboard/userList.php'); ?>
			</div>
			<!-- -------------------------------- -->
			<div class="component">
				<?php require('./components/dashboard/userStat.php'); ?>
			</div>
			<!-- -------------------------------- -->
			<div class="component">
				<div class="component-statGrp d-flex flex-column justify-content-end align-items-center w-100 h-100 p-5 gap-10p">
					<h1>ZERO</h1>
					<p>Total Groups</p>
				</div>
			</div>
			<!-- -------------------------------- -->
			<div class="component" id="groupList">
				<?php require('./components/dashboard/groupList.php'); ?>
			</div>
			<!-- -------------------------------- -->
			<div class="component">
				<?php require('./components/dashboard/groupStat.php'); ?>
			</div>
			<!-- -------------------------------- -->
			<div class="component storageList">
				<?php require('./components/dashboard/storageList.php'); ?>
			</div>
			<!-- -------------------------------- -->
			<div class="component d-flex justify-content-center" id="chartRound">
				<?php require('./components/dashboard/storageStat.php'); ?>
			</div>
		</main>
	</div>
</body>

</html>