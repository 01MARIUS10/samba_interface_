<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div data-name="Toavina-jr" id="user">Toavina</div>
    <script>
        let user = document.querySelector('#user').dataset.name
    
        console.log(user);
        document.querySelector('#user').addEventListener('click', function() {
            fetch(`http://localhost:8888/api.php?User=${user}`)
                .then (res => res.json())
                .then ( data => {
                    
                })
        })
    </script>

    <?php
        var_dump($_GET);
    ?>
</body>
</html>