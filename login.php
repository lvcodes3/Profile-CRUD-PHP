<?php
session_start();
// check if user is already logged in
if (isset($_SESSION["profile_crud_php"]["logged_in"]) && $_SESSION["profile_crud_php"]["logged_in"] === true) {
    header("location: ./home.php");
    exit;
}

// globals
$email = "";
$password = "";
$login_error = "";

// get post data from the login form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // get email input and remove all illegal chars
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // get password input and remove all illegal chars
    $password = htmlspecialchars($_POST["password"]);

    // connect to the db
    require_once "./db/db.php";

    // check if email exists in db
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = pg_query($con, $query);
    if (!$result) {
        echo (pg_last_error($con) . "\n");
        exit;
    } else {
        if (pg_num_rows($result) === 0) {
            $login_error = "Email is not registered.";
        }
    }

    if ($login_error === "") {
        // fetch row of data
        $row = pg_fetch_row($result);

        if (password_verify($password, $row[2])) {
            // set php session variables
            session_start();
            $_SESSION["profile_crud_php"]["logged_in"] = true;
            $_SESSION["profile_crud_php"]["email"] = $row[1];
            $_SESSION["profile_crud_php"]["color"] = $row[3];

            // redirect to home page
            header("location: ./home.php");
        } else {
            $login_error = "Incorrect Password.";
        }
    }
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
                <div class="group">
                    <p>
                        <?= $login_error; ?>
                    </p>
                    <input id="email" name="email" type="email" placeholder="Email" value="<?= $email; ?>" required />
                </div>

                <div class="group">
                    <input id="password" name="password" type="password" placeholder="Password"
                        value="<?= $password; ?>" required />
                </div>

                <button type="submit" value="submit">Login</button>
            </form>
            <p id="register-link">Don't have an account?
                <a href="./register.php">Register</a>
            </p>
        </div>
    </div>
</body>

</html>