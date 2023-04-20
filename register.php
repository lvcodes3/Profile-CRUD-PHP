<?php
// check to see if already logged in


// globals
$email = "";
$password = "";
$color = "";
$email_error = "";
$password_error = "";
$color_error = "";

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

    // get color input and remove all illegal chars
    $color = htmlspecialchars($_POST["color"]);
    $colors = ["black", "white", "red", "green", "yellow", "blue", "pink", "gray", "brown", "orange", "purple"];
    // validate color
    if (!in_array($color, $colors)) {
        $color_error = "The color you selected is invalid.";
    }

    // if no errors exist send data to db
    if ($email_error === "" && $password_error === "" && $color_error === "") {

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

                <div class="group">
                    <p id="color-error">
                        <?= $color_error; ?>
                    </p>
                    <select id="color" name="color" required>
                        <option value="" disabled>Favorite Color</option>
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
        </div>
    </div>

    <script type="text/javascript">

    </script>
</body>

</html>