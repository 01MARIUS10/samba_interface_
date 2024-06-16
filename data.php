<?php
$users_ = [
	[
		"id" => "1",
		"Nom" => "root",
		"UID" => "0",
		"Groups" => "root ",
		"Usage" => 3,
		"max-usage" => 8,
	],
	[
		"id" => "2",
		"Nom" => "Toky",
		"UID" => "2010",
		"Groups" => "Toky",
		"Usage" => 4.3,
		"max-usage" => 8,
	],
	[
		"id" => "3",
		"Nom" => "Fiononana",
		"UID" => "2001",
		"Groups" => "Fiononana , www-data",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "4",
		"Nom" => "Nomena",
		"UID" => "2002",
		"Groups" => "Nomena , MIT",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "5",
		"Nom" => "Faby",
		"UID" => "2003",
		"Groups" => "Faby , MIT",
		"Usage" => 2.3,
		"max-usage" => 8,
	],
	[
		"id" => "6",
		"Nom" => "Miora",
		"UID" => "2004",
		"Groups" => "Miora , MISA",
		"Usage" => 2.3,
		"max-usage" => 8,
	]

];
$groups = [
	[
		"id" => "1",
		"Nom" => "root",
		"GID" => "0",
		"Users" => "root ",
		"created_at" => "23-01-2023 a 12h15",
        "storage" => 8
	],
	[
		"id" => "2",
		"Nom" => "www-data",
		"GID" => "33",
		"Users" => "www-data , Fiononana",
		"created_at" => "23-02-2023 a 02h14",
        "storage" => 4
	],
	[
		"id" => "3",
		"Nom" => "Fiononana",
		"GID" => "2001",
		"Users" => "Fiononana",
		"created_at" => "26-01-2023 a 03h13",
        "storage" => 3
	],
	[
		"id" => "4",
		"Nom" => "Nomena",
		"GID" => "2002",
		"Users" => "Nomena",
		"created_at" => "25-01-2023 a 11h05",
        "storage" => 3
	],
	[
		"id" => "5",
		"Nom" => "Faby",
		"GID" => "2003",
		"Users" => "Faby",
		"created_at" => "23-01-2023 a 12h35",
        "storage" => 3.3
	],
	[
		"id" => "6",
		"Nom" => "Miora",
		"GID" => "2004",
		"Users" => "Miora",
		"created_at" => "23-01-2023 a 12h50",
        "storage" => 2
	],
	[
		"id" => "7",
		"Nom" => "Toky",
		"GID" => "2005",
		"Users" => "Toky",
		"created_at" => "24-01-2023 a 10h15",
        "storage" => 4
	]

];

require_once('./api/sambaApi/User/userRepository.php');
$users =  (UserRepository::getAll());


require_once('./GroupManager/Group.php');
$groups =  (UserGroup::getAllGroups());
// var_dump($users);
// var_dump($users_);

$storages = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 2, 1, 2, 1, 2, 1, 2, 1, 2];
?>