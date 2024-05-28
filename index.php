<?php
$users = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 1, 2, 1, 2, 1, 2, 1, 2];
$groups = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 1, 2, 1, 2, 1, 2, 1, 2];
$storages = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 1, 2, 1, 2, 1, 2, 1, 2];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/bootstrap/bootstrap.css">
	<link rel="stylesheet" href="style/style.css">
	<title>Document</title>
</head>

<body>
	<div id="root" class="d-flex ">
		<div class="nav h-100" style="width: 60px;">

		</div>
		<main class="h-100 gap-3" style="flex-grow: 1;">
			<div class="component"></div>
			<div class="component" id="userList">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">First</th>
							<th scope="col">Last</th>
							<th scope="col">Handle</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $a) : ?>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>
			<div class="component"></div>
			<div class="component"></div>
			<div class="component" id="groupList">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">First</th>
							<th scope="col">Last</th>
							<th scope="col">Handle</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($groups as $a) : ?>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>
			<div class="component"></div>
			<div class="component storageList">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">First</th>
							<th scope="col">Last</th>
							<th scope="col">Handle</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($storages as $a) : ?>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>
			<div class="component"></div>
		</main>
	</div>
</body>

</html>