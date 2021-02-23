<?php
    require "class/app.php";
   if(!isset($_COOKIE['id']))
   {
       header("location: auth/login.php");
   }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fa/css/all.css" />
    <title>SMS Application</title>
</head>
<body>
<div class="bg-info p-2">
    <div class="container">
        <span class="h4 text-light"><?php echo $app_name;?></span>
        <span class="float-right">
            <a class="text-light" href="auth/logout.php"><i class="fa fa-sign-out-alt"></i></a>
        </span>
    </div>
</div>
<div class="container">
        <div class="row mt-3">
            <div class="col">
                <div class="card" style="width: 150px;">
                    <div class="p-3">
                        <a href="send.php"> <img src="img/message.png" class="card-img-top" alt="..."></a>
                    </div>
                    <div class="p-1">
                        <h6 class="card-title text-center">Send SMS</h6>
                    </div>
                </div>
            </div>
            <div class="col m-1" style="width: 150px;">
                <div class="card" style="width: 150px;">
                    <div class="p-3">
                        <a href="add_group.php"> <img src="img/group.png" class="card-img-top" alt="..."></a>
                    </div>
                    <div class="p-1">
                        <h6 class="card-title text-center">Group</h6>
                    </div>
                </div>
            </div>
            <div class="col m-1">
                <div class="card" style="width: 150px;">
                    <div class="p-3">
                        <a href="add_number.php"><img src="img/profile.png" class="card-img-top" alt="..."></a>
                    </div>
                    <div class="p-1">
                        <h6 class="card-title text-center">Contact</h6>
                    </div>
                </div>
            </div>
            <div class="col m-1" style="width: 150px;">
                <div class="card" style="width: 150px;">
                    <div class="p-3">
                        <a href="history.php">
                            <img src="img/messages.png" class="card-img-top" alt="...">
                        </a>
                    </div>
                    <div class="p-1">
                        <h6 class="card-title text-center">SMS History</h6>
                    </div>
                </div>
            </div>



        </div>

</div>

</body>
</html>