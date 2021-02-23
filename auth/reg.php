<?php
    require "../class/app.php";
    if(isset($_COOKIE['auth']))
    {
        header("location: index");
    }



?>
<!doctype html>
<html lang="en">
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
<body>
    <div class="bg-info">
        <div class="container p-2">
            <span class="h3 text-light">
                <?php echo $app_name;?>
            </span>

            <span class="float-right">
                <a class="text-light" href="login.php">Login</a>
            </span>
        </div>
    </div>
    <div class="container">
            <div id="mssg"></div>
        <form id="form" method="post">
        <div class="shadow mt-5 p-3">
            <h3>Registration form</h3>
            <hr>
            <br>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <h6>
                        Full Name
                    </h6>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="name" id="name" autocomplete="off">
                    <small class="text-danger" id="msg_name"></small>
                </div>
                <div class="col-1">
                    <i class="" id="status_name"></i>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-sm-2">
                    <h6>
                       Email
                    </h6>
                </div>
                <div class="col-9">
                    <input class="form-control" type="email" name="email" id="email">
                    <small class="text-danger" id="msg_email"></small>
                </div>
                <div class="col-1">
                    <i class="" id="status_email"></i>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-sm-2">
                    <h6>
                       Phone
                    </h6>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" name="phone" id="phone">
                    <small class="text-danger" id="msg_phone"></small>
                </div>
                <div class="col-1">
                    <i class="" id="status_phone"></i>
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-sm-2">
                    <h6>
                       Address
                    </h6>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="address" id="address">
                    <small class="text-danger" id="msg_address"></small>
                </div>
                <div class="col-1">
                    <i class="" id="status_address"></i>
                </div>
            </div>


            <div class="row mb-5">
                <div class="col-sm-2">
                    <h6>
                       Password
                    </h6>
                </div>
                <div class="col-9">
                    <input class="form-control" type="password" name="password" id="password">
                    <small class="text-danger" id="msg_password"></small>
                </div>
                <div class="col-1">
                    <i class="" id="status_password" value="0"></i>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-6 mx-auto">
                    <button type="submit" id="run" class="form-control" onclick="sendMessage()">Create</button>
                </div>
            </div>
        </form>

        </div>
    </div>

</body>
<script>
function allCheck()
	{
		
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var address = document.getElementById('address').value;
        var pass = document.getElementById('password').value;
        var name_status = document.getElementById('status_name');
        var name_ok = recheck(name_status);
		var email_status = document.getElementById('status_email');
        var email_ok = recheck(email_status);
		var phone_status = document.getElementById('status_phone');
        var phone_ok = recheck(phone_status);
		var address_status = document.getElementById('status_address');
        var address_ok = recheck(address_status);
		var pass_status = document.getElementById('status_password');
        var pass_ok = recheck(pass_status);
        var total = name_ok + email_ok + pass_ok + phone_ok + address_ok;
		return total;
		
	}


    $("#name").keyup(function name(){
        var ids        = document.getElementById('name');
        var msg         = document.getElementById('msg_name');
        var status      = document.getElementById('status_name');
        var name_length = ids.value.length;
        if(name_length > 6)
        {
            var con = 1;
        }
        else {
            var con = 0;
            return false
        }
        check(ids,msg,status,'Name is too short',con);

    });

    $("#phone").keyup(function phone(){
        var ids        = document.getElementById('phone');
        var msg         = document.getElementById('msg_phone');
        var status      = document.getElementById('status_phone');
        var name_length = ids.value.length;


        if(name_length < 10)
        {
            var con = 0;
            var message = "Invalid Phone number";
        }
        else {
            var con = 1;
            var message = "";
        }
        check(ids,msg,status,message,con);
    });

    $("#password").keyup(function pass(){
        var ids        = document.getElementById('password');
        var msg         = document.getElementById('msg_password');
        var status      = document.getElementById('status_password');
        var name_length = ids.value.length;
        var capLetter = /[A-Z]/g;
        var numList = /[0-9]/g;
        var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
        var pcheck = 0;
        if(ids.value.match(capLetter))
        {

            var pcheck = pcheck + 1;
        }else {
            var message= "Password must content minimum 1 Capital letter";
        }
        if(ids.value.match(numList))
        {

            var pcheck = pcheck + 1;
        }else {
            var message= "Password must content minimum 1 Number letter";
        }
        if(ids.value.match(format))
        {

            var pcheck = pcheck + 1;
        }else {
            var message= "Password must content minimum 1 Special Character letter";
        }

        if(ids.value.length > 7)
        {
           var pcheck = pcheck + 1;
        }else
        {
            var message = "Password length minimum 8 character";
        }

        if(pcheck === 4)
        {
            var con = 1;
            var message='';

        }
        else {
            var con = 0;

        }
        check(ids,msg,status,message,con);

    });




    $("#email").keyup(function email(){
        var ids        = document.getElementById('email');
        var msg         = document.getElementById('msg_email');
        var status      = document.getElementById('status_email');
        var lengths = ids.value.length;
        var con = 0;
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(ids.value.match(mailformat))
        {
            var con = 1;
            var message = "";
        }
        else {
            var con = 0;
            var message = "Invalid email formate";
        }
        check(ids,msg,status,message,con);

    });


    $("#address").keyup(function address(){
        var ids        = document.getElementById('address');
        var msg         = document.getElementById('msg_address');
        var status      = document.getElementById('status_address');

        if(ids.value.length < 10)
        {
            var con = 0;
            var message = "Invalid Address";
        }
        else {
            var con = 1;
            var message="";

        }
        check(ids,msg,status,message,con);

    });


    function check(ids,msg,status,message,con) {
        if(con == 0)
        {
            msg.innerHTML = message;
            status.classList.add('fas');
            status.classList.add('fa-times');
            status.classList.remove('text-success');
            status.classList.add('text-danger');
            


        }else
        {
            status.classList.add('fas');
            status.classList.remove('fa-times');
            status.classList.add('fa-check');
            status.classList.remove('text-danger');
            status.classList.add('text-success');
            msg.innerHTML = "";
        }
		var runs = this.allCheck();
		
		if(runs === 5 )
		{
			var run = document.getElementById("run");
		   run.classList.remove('bg-danger');
		   run.classList.add('bg-success');
		   run.classList.add('text-light');
		   run.disabled= false;
		}else
		{
			var run = document.getElementById("run");
			run.classList.remove('text-light');
			run.classList.remove('bg-success');		
			run.disabled = true;
		}
	
		   

    }
	

    function sendMessage() {
		var total = this.allCheck();

        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var address = document.getElementById('address').value;
        var pass = document.getElementById('password').value;
		
		
       if(total === 5)
       {
           $.ajax({
               url: "../ajax.php",
               method: "POST",
               data:{ name: name,
			   email: email,
			   phone: phone,
			   address: address,
			   pass: pass},
               success: function(data)
               {
                   if(data == true)
                   {
                       var mssg = document.getElementById('mssg');
                       mssg.classList.add('bg-info');
                       mssg.classList.add('p-2');
                       mssg.classList.add('mt-4');
                       mssg.classList.add('text-light');
                       mssg.innerHTML = "Registration Success";
                       console.log(data);
                       setTimeout(function () {
                           document.getElementById('form').reset();
                       },5000);
                   }else
                   {
                       var mssg = document.getElementById('mssg');
                       mssg.classList.add('bg-info');
                       mssg.classList.add('p-2');
                       mssg.classList.add('mt-4');
                       mssg.classList.add('text-light');
                       mssg.innerHTML = "Registration failed";
                       console.log(data);
                   }


               }
           });

       }


    }

    function recheck(clas) {

        var xs =clas.classList.value;

        if(xs.match('text-success'))
        {
            return 1;
        }else {
            return 0;
        }

    }




</script>
</html>
