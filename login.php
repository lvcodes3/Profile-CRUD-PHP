<?php
/*
// check if user is already logged in
session_start();
// unset all of the session variables
$_SESSION = array();
// destroy the session.
session_destroy();
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) {
header('');
exit;
}
*/

// globals
$email = "";
$password = "";
$login_error = "";

// get post data from the register form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // get email input and remove all illegal chars
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);


    // get password input and remove all illegal chars
    $password = htmlspecialchars($_POST["password"]);



    // if no errors exist send data to db
    /*
    if ($email_error === "" && $password_error === "") {
    }
    */
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="app">
        <div class="form-container">
            <h1>Login</h1>
            <form method="POST" action="">
                <p id="login_error">
                    <?= $login_error; ?>
                </p>

                <div class="group">
                    <input id="email" name="email" type="email" placeholder="Email" value="<?= $email; ?>" required />
                </div>

                <div class="group">
                    <input id="password" name="password" type="password" placeholder="Password"
                        value="<?= $password; ?>" required />
                </div>

                <button type="submit" value="submit">Login</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">

    </script>
</body>

</html>