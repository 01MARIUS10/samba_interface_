<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<link rel="stylesheet" href="style/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>

<body>
    <div id="root" class="d-flex ">
        <div class="nav h-100 d-flex flex-column align-items-center justify-content-between p-2" style="width: 60px;">
            <ul class="nav-top d-flex flex-column align-items-center justify-content-between gap-3">
                <li><a href=""><i class="text-light fa-solid fa-user"></i></a></li>
                <li><a href="test.php"><i class="text-light fa-solid fa-user-group"></i></a></li>
                <li><a href=""><i class="text-light fa-solid fa-database"></i></a></li>
            </ul>
            <ul class="nav-top d-flex flex-column align-items-center justify-content-between gap-3">
                <li><a href=""><i class="text-light fa-solid fa-gear"></i></a></li>
                <li><a href=""><img id="image-profil" src="./images/icon/profil.png" alt=""></a></li>
                <li><a href=""><i class="fa-solid fa-right-from-bracket text-light"></i></a></li>
            </ul>
        </div>
        <main class="h-100 gap-3 d-flex justify-content-center align-items" style="flex-grow: 1;">
            <?php
            $users = [
                [
                    "id" => "1",
                    "Nom" => "Mark",
                    "UID" => "10",
                    "Groups" => "root , mark",
                    "Usage" => 3,
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
            <!-- -------------------------------- -->
			<div class="component">
				<div class="component-statUser d-flex flex-column justify-content-end align-items-center w-100 h-100 p-5 gap-10p">
					<h1><?=count($users)?></h1>
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
        </main>
    </div>
</body>

</html>