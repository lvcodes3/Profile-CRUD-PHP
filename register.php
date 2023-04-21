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
$confirm_password = "";
$color = "";
$email_error = "";
$password_error = "";
$confirm_password_error = "";
$color_error = "";

// get post data from the register form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // get email input and remove all illegal chars
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Your email is invalid.";
    } else {
        if (strlen($email) > 320) {
            $email_error = "Your email can not be above 320 characters.";
        }
    }

    // get password input and remove all illegal chars
    $password = htmlspecialchars($_POST["password"]);
    // validate password
    if (strlen($password) < 4 || strlen($password) > 12) {
        $password_error = "Your password must be in the character range of 4-12.";
    }

    // get confirm password input and remove all illegal chars
    $confirm_password = htmlspecialchars($_POST["confirm-password"]);
    // validate confirm password
    if ($password !== $confirm_password) {
        $confirm_password_error = "Your passwords do not match.";
    }

    // get color input and remove all illegal chars
    $color = htmlspecialchars($_POST["color"]);
    $colors = ["black", "white", "red", "green", "yellow", "blue", "pink", "gray", "brown", "orange", "purple"];
    // validate color
    if (!in_array($color, $colors)) {
        $color_error = "The color you selected is invalid.";
    }

    // if no errors exist
    if ($email_error === "" && $password_error === "" && $confirm_password_error === "" && $color_error === "") {

        // connect to the db
        require_once "./db/db.php";

        // check if email already exists in the db
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = pg_query($con, $query);
        if (!$result) {
            echo (pg_last_error($con) . "\n");
            exit;
        } else {
            if (pg_num_rows($result) !== 0) {
                $email_error = "Your email is already registered.";
            }
        }

        if ($email_error === "") {
            // bcrypt the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // insert into db
            $query = "INSERT INTO users(email, password, color) VALUES('$email', '$password_hash', '$color')";
            $result = pg_query($con, $query);
            if (!$result) {
                echo (pg_last_error($con) . "\n");
                exit;
            } else {
                // set php session variables
                session_start();
                $_SESSION["profile_crud_php"]["logged_in"] = true;
                $_SESSION["profile_crud_php"]["email"] = $email;
                $_SESSION["profile_crud_php"]["color"] = $color;

                // redirect to home page
                header("location: ./home.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>
    <div class="app">
        <div class="form-container">
            <h1>Register</h1>
            <form method="POST" action="">
                <div class="group">
                    <p>
                        <?= $email_error; ?>
                    </p>
                    <input id="email" name="email" type="email" placeholder="Email" value="<?= $email; ?>" required />
                </div>

                <div class="group">
                    <p>
                        <?= $password_error; ?>
                    </p>
                    <p>
                        <?= $confirm_password_error; ?>
                    </p>
                    <input id="password" name="password" type="password" placeholder="Password"
                        value="<?= $password; ?>" required />
                </div>

                <div class="group">
                    <input id="confirm-password" name="confirm-password" type="password" placeholder="Confirm Password"
                        value="<?= $confirm_password; ?>" required />
                </div>

                <div class="group">
                    <p>
                        <?= $color_error; ?>
                    </p>
                    <select id="color" name="color" required>
                        <option value="" disabled>Select your Favorite Color</option>
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

                <button type="submit" value="submit">Register</button>
            </form>
            <p id="login-link">Already have an account?
                <a href="./login.php">Login</a>
            </p>
        </div>
    </div>
</body>

</html>