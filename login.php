<?php
// check to see if already logged in


// globals
$email = "";
$password = "";
$email_error = "";
$password_error = "";

// get post data from the register form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // get email input and remove all illegal chars
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Your email is invalid.";
    }

    // get password input and remove all illegal chars
    $password = htmlspecialchars($_POST["password"]);
    // validate password
    if (strlen($password) < 4 || strlen($password) > 12) {
        $password_error = "Your password must be in the character range of 4-12.";
    }


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
                <div class="group">
                    <p id="email-error">
                        <?= $email_error; ?>
                    </p>
                    <input id="email" name="email" type="email" placeholder="Email" value="<?= $email; ?>" required />
                </div>

                <div class="group">
                    <p id="password-error">
                        <?= $password_error; ?>
                    </p>
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