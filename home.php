<?php
session_start();
// check if user is already logged in
if (!isset($_SESSION["profile_crud_php"]["logged_in"]) || $_SESSION["profile_crud_php"]["logged_in"] !== true) {
    header("location: ./login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile CRUD PHP</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div class="app">
        <header>
            <div>
                <h1 id="main">Profile CRUD PHP</h1>
            </div>
            <div>
                <a id="logout" href="./logic/logout.php">Logout</a>
            </div>
        </header>
        <br>
        <div class="container">
            <div class="content">
                <h1>
                    Welcome Back,
                    <?= $_SESSION["profile_crud_php"]["email"]; ?>
                </h1>
            </div>
            <div class="content">
                <h2>
                    Your favorite color is
                    <?= $_SESSION["profile_crud_php"]["color"]; ?>.
                </h2>
            </div>

        </div>
    </div>

    <script type="text/javascript">

        /*
        const handleLogout = () => {
            let req = new XMLHttpRequest();
            req.open("GET", "./logic/logout.php");
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            req.send();
            req.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    console.log(this.responseText);
                }
            }
        }
        */

    </script>
</body>

</html>