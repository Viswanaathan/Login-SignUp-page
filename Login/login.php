<?php
session_start();
$username_style=$password_style="";
$valid_username="user";
$valid_password= "pass";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $username=$_POST['username']??'';
    $password=$_POST['password']??'';
    if(isset($_POST['remember'])){
        setcookie("remember_username",$username,time()+36000,"/");
    }else{
        setcookie("remember_username","",time()-3600,"/");
    }
    if($username===$valid_username && $password===$valid_password){
        $_SESSION["username"]=$username;
        header("Location:dashboard.php");
        exit();
    }else{
        $error="Incorrect username or password.";
        $username_style = "style='border: 2px solid red;'";
        $password_style = "style='border: 2px solid red;'";
    }
}
$remembered_username=$_COOKIE["remember_username"]??"";
$checked=$remembered_username?'checked':'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    if(!empty($error)){
        echo"<p style='color:red;'>$error</p>";
    }?>
    <form action="" method="post" autocomplete="off">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($remembered_username) ?>" readonly onfocus="this.removeAttribute('readonly');" <?php echo $username_style ?>><br><br>
        <label>Password:</label>
        <input type="password" name="password" autocomplete="new-password" <?php echo $password_style; ?>><br><br>
        <label><input type="checkbox" name="remember" <?php echo $checked; ?> > Remember Me</label>
        <input type="submit" value="Login">
    </form>
</body>
</html>