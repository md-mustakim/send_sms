<?php
    require "../class/app.php";
    if(isset($_SESSION['id']))
    {
        header("location: ../index.php");
    }


	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../bootstrap-4.4.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap-4.4.0-dist/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../fa/css/all.css">
    <title>Registration -<?php echo $app_name;?></title>
</head>
<body class="">
<div class="m-2">
	<div class="mx-auto col-sm-6 p-4 mt-5 shadow">
            <form>
                <div class="h5">User Login</div>
                <hr>
                <div id="msg"></div>
                <label for="id">User Name</label>
                <input class="form-control" type="text" name="id" id="id">
                <br>
                <label for="pass">Password</label>
                <input class="form-control" type="password" name="pass" id="pass">
                <br>
            </form><button class="form-control btn btn-success" onclick="ajax()">Login</button>
            <p class="small mt-3">Not registered? Go for registration.. <a href="reg.php">Click Here</a></p>
        </div>
    </div>

</body>
<script>
   function ajax()
    {
        var id = document.getElementById("id").value;
        var pass = document.getElementById("pass").value;
        $.ajax({
            url: "../ajax.php",
            method: "POST",
            data:{
                login: 0,
                id: id,
                pass: pass},
            success: function(got)
            {
                var data = got.replace(/\s+/g, '');

                var t = data;
                console.log(t);
                var output =  document.getElementById("msg");
                var r;

                if(data == "1")
                {
                    output.innerHTML = "Email is not verified";
                }
                if(data == "2")
                {
                    output.innerHTML = "Account is not verified";
                }
                if(data == "3")
                {
                    output.innerHTML = "Password is incorrect";
                }
                if(data == "4")
                {
                    output.innerHTML = "User or password not found";
                }

                if(data == "9")
                {
                    output.innerHTML = "Login Success";
                    output.classList.add("bg-success");
                    output.classList.add("text-light");
                    output.classList.add("p-2");
                    var id = document.getElementById("id").value;
                        var cname = "id";
                        var cvalue = id;
                        var d = new Date();
                        d.setTime(d.getTime() + (60*60*60*3));
                        var expires = "expires="+ d.toUTCString();
                        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                        sessionStorage.getItem("id",id);










                    setTimeout(function () {
                        window.location.href="../index.php";
                    },2000);
                }



            }
        });
    }
</script>
</html>