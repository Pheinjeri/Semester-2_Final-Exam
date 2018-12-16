<?php

    session_start();

    $conn = mysqli_connect("localhost","root","","faithnjeri");

    if(!mysqli_connect()){
        
        echo "Unable to connect to the database " . mysqli_connect_error();
        
    }else{
        
//        Check if user is already logged in 
        if(!empty($_SESSION['email'])){
            
            header("location: profile/");
            
        }else{
            
//        Logging in registered users
        if(isset($_POST['loginsubmit'])){
            
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($conn, $query);
            
            if($result){
                
                $_SESSION['email'] = $email;
                header("location: profile/");
                
            }else{
                
                $_SESSION['email'] = "";
                echo "Your email and password do not match. Please try again.";
                
            }
            
        }
        
//        Signing up new users to the site
        if(isset($_POST['registersubmit'])){
            
            $names = $_POST['names'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            
            if(!empty($names) && !empty($email) && !empty($password)){
                
                $query = "INSERT INTO users (names, email, password) 
                      VALUES('$names', '$email', '$password')";
                $result = mysqli_query($conn, $query);

                if($result){

                    $_SESSION['email'] = $email;
                    header("location: profile/");

                }else{

                    $_SESSION['email'] = "";
                    echo "Error signing up. Please try again";

                }
                
            }else{
                
                echo "Please fill in all the required fields to sign up.";
                
            }
            
        }
            
        }
        
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Final Exam - Faith Njeri</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
   
   <nav>
       <h1>
           Faith Njeri
       </h1>
       <form action="" method="post">
           <h3>Log In -> </h3>
            <input type="email" placeholder="Your Email" name="email">
            <input type="password" placeholder="Your Password" name="password">
            <input type="submit" value="Log In" name="loginsubmit">
       </form>
   </nav>
   
   <main>
       <form action="" method="post">
       <h3>
           Sign Up
       </h3>
        <input type="text" placeholder="Your Name" name="names">
        <input type="email" placeholder="Your Email" name="email">
        <input type="password" placeholder="Your Password" name="password">
        <hr>
        <input type="submit" value="Register" name="registersubmit">
    </form>
   </main>
    
</body>
</html>