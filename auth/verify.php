<?php
    require "../class/app.php";
    $v = new auth();
    if(isset($_GET['code']))
    {
        $code = $_GET['code'];

        $r = $v->emailverify($code);
        if($r == true)
        {
            $msg = "Email Verified... Lets <a href='login.php'>Login</a>";


        }else
        {
            $msg = "Wrong Code try again";
        }




    }else{
        header("location: login.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap-4.4.0-dist/css/bootstrap.min.css">
    <title><?php echo $app_name;?>-Email Verify</title>
</head>
<body>
    <div class="container">
        <div class="w-50 mx-auto mt-5">
            <div class="h2">
                <?php echo $msg;?>
            </div>
        </div>
    </div>
</body>
</html>
