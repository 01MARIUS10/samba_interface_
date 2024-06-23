<?php
if(isset($_GET['name']) && $_GET['name']=='root'){
    header('Location: dashboard.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@-5.0.2/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="./style/bootstrap-5.0.2-dist/css/bootstrap.css"> -->
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="/style/bootstrap/bootstrap.css">
    <title>Login Samba explorer</title>
</head>
<body class="d-flex justify-content-center align-items-center p-4 bg-light">
    <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12 rounded p-4">
        <form action="" class="d-flex flex-column justify-content-center p-5 gap-3 rounded forl-group">
            <div class="text-center">
                <h1 class="h1 form-title text-light">Samba Explorer</h1>
            </div>
            <div class="text-center">
                <img src="./images/logo_1.jpg" alt="" class="img-fluid col-4 opacity-50">
            </div>
            <div class="mb-2">
                <label for="" class="mb-2 text-light">Nom</label>
                <input type="text" class="form-control p-3 text-dark" name="name" placeholder="Votre nom" required>
            </div>

            <div class="mb-2">
                <label for="password" class="mb-2 text-light">Password</label>
                <input class="form-control p-3 text-dark" type="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <div class="my-3">
                <input id="submit-btn" class="btn btn-primary w-100 p-3 text-light" type="submit" value="Se connecter">
            </div>
        </form>
    </div>

</body>
</html>
