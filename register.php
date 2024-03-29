<?php
    session_start();
	require_once("database/database.php");
    require_once("database/auditors.php");
    
    if(isset($_POST["submit"])){
        $fullname=$_POST["fullname"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];
        $password=$_POST["password"];
        $repeat_password=$_POST["repeat_password"];
        $db = new Auditors();
        if($password===$repeat_password){
            $user_id = $db->insert($fullname,$email,$phone,$password);
            if($user_id == "error duplicate key"){
                $message = "Email already registered";
                echo '<script language="Javascript" type="text/javascript">';
                echo 'alert('. json_encode($message) .');';
                echo '</script>';
            }
            else if($user_id != -1){
                $_SESSION ["user_id"] = $user_id;
                $message = "Register successful";
                $header = "Refresh: 0; url=index.php";
                echo '<script language="Javascript" type="text/javascript">';
                echo 'alert('. json_encode($message) .');';
                echo '</script>';
                header($header);
            }
        }
        else{
            $message = "Password isn\'t match";
            echo '<script language="Javascript" type="text/javascript">';
            echo 'alert('. json_encode($message) .');';
            echo '</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Register</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" method="post">
                        <div class="form-group">
                            <input value="<?php if(isset($_POST['fullname'])){echo htmlspecialchars($_POST['fullname'], ENT_QUOTES);}else{echo '';}?>" type="text" class="form-control form-control-user" id="exampleInputFullName" placeholder="Full Name" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <input value="<?php if(isset($_POST['email'])){echo htmlspecialchars($_POST['email'], ENT_QUOTES);}else{echo '';}?>" type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" required>
                        </div>
                        <div class="form-group">
                            <input value="<?php if(isset($_POST['phone'])){echo htmlspecialchars($_POST['phone'], ENT_QUOTES);}else{echo '';}?>" type="text" class="form-control form-control-user" id="exampleInputPhoneNumber" placeholder="Phone Number" name="phone" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="repeat_password" required>
                            </div>
                        </div>
                        <input type="submit" name="submit" id="btnRegister" class="btn btn-primary btn-user btn-block" value="Register Account"/>
                    </form>
                    <div class="text-center">
                        <a class="small" href="login.php">Already have an account? Login!</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#btnRegister").hover(function(){
                    $("#btnRegister").val("Register Now!");
                },
                function(){
                    $("#btnRegister").val("Register Account");
                });
            });
        </script>
    </body>
</html>