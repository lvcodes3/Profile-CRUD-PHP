<?php
session_start();
// check if user is already logged in
if (!isset($_SESSION["profile_crud_php"]["logged_in"]) || $_SESSION["profile_crud_php"]["logged_in"] !== true) {
    header("location: ../login.php");
    exit;
}

// get post data from the register form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // get email
    $email = $_POST["email"];

    // connect to the db
    require_once "../db/db.php";

    // delete account
    $query = "DELETE FROM users WHERE email='$email'";
    $result = pg_query($con, $query);
    if (!$result) {
        echo (pg_last_error($con) . "\n");
        exit;
    } else {
        // unset all of the session variables
        $_SESSION = array();
        // destroy the session.
        session_destroy();
        // send response
        echo "Account has been deleted.";
        exit;
    }
}

?>