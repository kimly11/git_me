<!DOCTYPE html> 
<html lang="em"> 
<head> 
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum"> 
    <title>Document</title> 
</head> 
<body> 
    <h1>Form Tag</h1> 
    <form action="Info.php" method="POST"> 
        <label>Username</label> 
        <input type="email" name="txtemail" require placeholder="Enter email"/><br/><br/> 
        <label>Password</label> 
        <input type="password" name="txtpwd" require placeholder="Enter email"/><br/><br/> 
        <input type="submit" name="btnlogin" value="login"/> 
    </form> 
    <?php 
         $email = $_POST['txtemail'];
         $pass = $_POST['txtpwd'];
         echo"Username:".$email;
         echo"<br/>Password".$pass;
    
        // echo ($_POST['txtemail']); 
        // echo ($_POST['txtpwd']); 
    ?> 
</body> 
</html>
