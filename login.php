<?php
session_start(); // Initialize session
require_once('./db_login.php');

// Check if the user has submitted the form
if (isset($_POST["submit"])) {
    $valid = true; // Validation flag

    // Validate email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "Email is required";
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format";
        $valid = false;
    }

    // Validate password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = "Password is required";
        $valid = false;
    }

    if ($valid) {
        // Create and execute the query
        $query = "SELECT * FROM petugas WHERE email='" . $email . "' AND password='" . md5($password) . "'";
        $result = $db->query($query);

        if (!$result) {
            die("Could not query the database: <br />" . $db->error);
        } else {
            if ($result->num_rows > 0) { // Login successful
                $_SESSION['username'] = $email;
                $_SESSION['kategori'] = 'admin';
                header('Location: index_loker.php'); // Redirect to the index page for "loker"
                exit;
            } else { // Login failed
                $login_error = "Combination of email and password is not correct.";
            }
        }

        // Close the database connection
        $db->close();
    }
}
?>
<?php include('./header.html') ?>
<br>
<div class="card">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" size="30" value="<?php if (isset($_POST['submit'])) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email; ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <div class="error"><?php if (isset($error_password)) echo $error_password; ?></div>
            </div>
            <div class="error"><?php if (isset($login_error)) echo $login_error; ?></div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('./footer.html') ?>
