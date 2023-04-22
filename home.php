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
        <div class="container">
            <div class="content">
                <label for="email">Email:</label>
                <input id="email" name="email" type="text" value="<?= $_SESSION["profile_crud_php"]["email"]; ?>" />
            </div>
            <div class="content">
                <label for="email">Favorite Color:</label>
                <input id="color" name="color" type="text" value="<?= $_SESSION["profile_crud_php"]["color"]; ?>" />
            </div>
            <div class="content">
                <button id="delete-btn" onclick="handleDeleteAccount('<?= $_SESSION['profile_crud_php']['email']; ?>')">
                    Delete Account
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">


        const handleDeleteAccount = (email) => {
            if (confirm("Are you sure you want to delete your account?")) {
                let req = new XMLHttpRequest();
                req.open("POST", "./logic/delete.php");
                req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                req.send(`email=${email}`);
                req.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        alert(this.responseText);
                        window.location.reload();
                    }
                }
            }
        }


    </script>
</body>

</html>