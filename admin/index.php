<?php
session_start();
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Matrix Admin</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
    <div id="loginbox">            
        <form id="loginform" class="form-vertical" action="" method="POST">
         <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
         <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
            <span class="pull-right"><button type="submit" name="login" class="btn btn-success" /> Login</button></span>
        </div>
    </form>
    <form id="recoverform" action="" class="form-vertical" method="POST">
        <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
            <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
        </div>
    </form>
</div>

<script src="js/jquery.min.js"></script>  
<script src="js/matrix.login.js"></script> 
</body>

</html>
<?php
if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];

   if(empty($username) || empty($password)){
    echo "<script> alert('Username / Pasword Masih Kosong'); location.replace('index.php') </script>";
}

$sql = mysql_query("SELECT * FROM m_admin WHERE username = '$username' AND password = '$password'")or die(mysql_error());
$cek = mysql_num_rows($sql);
$row = mysql_fetch_array($sql);

if($cek>0){
    $_SESSION['id_admin'] = $row['id_admin'];

    if($row['username']=='admin'){
        echo "<script> alert('Login Berhasil'); location.replace('pages/index.php') </script>";    
    }else{
        echo "<script> alert('Login Berhasil'); location.replace('penyewaan/index.php') </script>";
    }

}else{
    echo "<script> alert('Username / Pasword Salah'); location.replace('index.php') </script>";
}
}
?>