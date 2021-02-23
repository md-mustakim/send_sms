<?php
	require "class/app.php";
	$c = new myclass();
	$l = new auth();
	$messagecode="";
	
	

	if(isset($_POST['login']))
	{
		$id = $_POST['id'];
		$pid = $_POST['pass'];
		$login = $l->login($id,$pid);
		echo $login;
		if($login == 1)
        {
            setcookie("id",$id,time()+10*60,"/");
            $_SESSION['id'] = $id;
            echo "Login Success";

        }

	}	

	if(isset($_GET['data']))
	{
		$id = $_GET['data'];

        $count = $c->count("SELECT * FROM `number_list` WHERE group_id=$id");
		echo $count;
	}

	if(isset($_POST['group']))
	{
        $group = $_POST['group'];
        $fonts = $_POST['fonts'];
        $message_body = $_POST['message_body'];
        $length = $_POST['length'];
        $type = $_POST['type'];
        $cost = $_POST['cost'];
        $total_cost = $_POST['total_cost'];
        $msg_title = $_POST['msg_title'];

        $insert ="INSERT INTO `messages`(`group_code`, `font`, `length`, `type`, `cost`, `total_cost`, `msg_body`,`msg_title`)  
                                VALUES('$group','$fonts','$length','$type','$cost','$total_cost','$message_body','$msg_title')";

       $inset_query = $c->insert($insert);

		echo $inset_query;
	}

	if(isset($_POST['name'])) //registration
	{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['pass'];
        $gcode = random_int(1000,9999);

        $messagecode = "Dear $name, Your Office Kit Account Activation Code is $gcode . Please (https://sms.holycareschool.com/auth/verify.php?code=$gcode) Click Here to Active your account";

        $messagecode = str_replace("\n.", "\n..", $messagecode);


        $insert ="INSERT INTO `auth`(`name`, `email`, `phone`, `address`, `pass`, `email_varify`)      
                                VALUES('$name','$email','$phone','$address','$password','$gcode') ";
        mail($email,"Office Kit Account Verify",$messagecode);

       $inset_query = $c->insert($insert);

		echo $inset_query;

	}
?>