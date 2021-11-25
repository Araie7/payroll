<?php
    include "dbConnection.php";
    $login_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        $conn = OpenCon();
        // username and password sent from form     
        $login_username = mysqli_real_escape_string($conn,$_POST['username']);
        $login_password = mysqli_real_escape_string($conn,$_POST['password']);
    

        $sql =  "SELECT * FROM users ".
                "WHERE username = '$login_username' AND password = '$login_password'";
        $result = $conn -> query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        $count = $result -> num_rows;
        // If result matched $myusername and $mypassword, table row must be 1 row
	    //echo "<script> alert('aaaa'); </script>";
        if($count == 1) {
            session_start();
            $_SESSION['session_id'] = $row['id'];
            $_SESSION['session_name'] = $row['username'];
            if($row['role'] == 'user'){
                header("location: user-home.php?username=".$row['username']);
            } else if($row['role'] == 'admin'){
                header("location: admin-home.php?name=".$row['username']);        
            }

            exit();
        } else{
            $login_err = "Invalid email or password.";
        }

        CloseCon($conn);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Payroll System </title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    </head>
    <body>
        <div class="login-background">
            <div class="login-container">
                <div class="header-container">
                    <h1>
                        Payroll System
                    </h1>

                </div>
                <div class="login">
                        <p class="login-p">Login</p>
                        <div class="login-form">
                            <!-- send the form to itself for data processing at the backend -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input id="username-field" type="text" name="username" placeholder="Enter username" required>
                                <input type="password" name="password" placeholder="Enter your password" required>
                                <div class="login-button-container">
                                    <button type="submit" class="hero-btn red-btn btn">Login</button>
                                </div>
                                <p class="login-error"><?php echo $login_err; ?></p>
                                <div class="login-button-container">
                                    <a class="sign-up-link" href='sign-up.php'>Create account</a>
                                </div>
                            </form>
                        </div>
                        <!--
                        <div class="signup-button-container">
                            <div>Don't have an account?</div>
                            <a href='sign-up.php'>Create account</a>
                        </div>
                    -->
                </div>
            </div>
        </div>
    </body>
</html>