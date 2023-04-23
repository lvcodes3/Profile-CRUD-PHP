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
            <h1>Profile</h1>
            <div class="content">
                <label for="email">Email:</label>
                <input id="email" type="text" value="<?= $_SESSION["profile_crud_php"]["email"]; ?>" readonly />
            </div>
            <div class="content">
                <label for="email">Favorite Color:</label>
                <select id="color" disabled>
                    <option value="<?= $_SESSION["profile_crud_php"]["color"]; ?>" selected>
                        <?= $_SESSION["profile_crud_php"]["color"]; ?>
                    </option>
                    <option value="black">Black</option>
                    <option value="white">White</option>
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                    <option value="yellow">Yellow</option>
                    <option value="blue">Blue</option>
                    <option value="pink">Pink</option>
                    <option value="gray">Gray</option>
                    <option value="brown">Brown</option>
                    <option value="orange">Orange</option>
                    <option value="purple">Purple</option>
                </select>
            </div>
            <div id="edit-content" class="content">
                <button id="edit-btn" onclick="handleEdit()">
                    Edit Account
                </button>
            </div>
            <div id="update-content" class="content" style="display:none">
                <button id="update-btn"
                    onclick="handleUpdate('<?= $_SESSION['profile_crud_php']['email']; ?>', document.getElementById('color').value)">
                    Update Account
                </button>
            </div>
            <div class="content">
                <button id="delete-btn" onclick="handleDeleteAccount('<?= $_SESSION['profile_crud_php']['email']; ?>')">
                    Delete Account
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        const handleEdit = () => {
            document.getElementById("color").disabled = false;
            document.getElementById("update-content").style.display = "";
            document.getElementById("edit-content").style.display = "none";
        }

        const handleUpdate = (email, color) => {

        }

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