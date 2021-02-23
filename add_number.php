<?php

	include "class/app.php";
	$mc = new myclass();
	$auth = new auth();
	echo $auth->check();
	$con = $mc->dbase();
    $quary= "select * from number_group";
    $view = $mc->group_view($quary);
    $msg = "";
if(isset($_POST['submit']))
    {
        $name= $_POST['name'];
        $number1= $_POST['num_one'];
        $number2= $_POST['num_two'];
        $groups = $_POST['group'];
        $inserts= "INSERT INTO `number_list`(`name`, `number_1`, `number_2`, `group_id`) VALUES ('$name','$number1','$number2','$groups')";
        $inserts;
        $insert = $mc->insert($inserts);

        if($insert == true)
        {
            $msg=  "Successfully added";
        }else
        {
            $msg = "Sorry something is problem";
        }
        echo "
    <script>
      document.getElementById('form').reset();
    </script>";
    }

	
	
	

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap-4.4.0-dist\css\bootstrap.min.css" />
	<link rel="stylesheet" href="fa\css\all.css" />
</head>
<body>

	<div class="bg-info p-2">
        <div class="container">
            <span class="h4 text-light">Create New Contact</span>
            <span class="h7 float-right">
                <a class="text-light" href="index.php"><i class="fas fa-home"></i></a> &nbsp;
                <a class="text-light" href="config/logout.php"><i class="fa fa-sign-out-alt"></i></a>
            </span>
        </div>
    </div>
    <div class="container">
    <div class="p-3 bg-light mt-3">
        <div class="h5"><?php echo $msg;?></div>
		<form action="add_number.php" method="post" id="form">
            <label class="h6" for="group">Select Group: </label>
            <select name="group" id="group" class="form-control" required>
                <option value="">Select</option>
                <?php
                foreach ($view as $value => $item)
                {
                    echo "<option value=". $item['group_id'] .">(".$item['group_id'].") &nbsp;". $item['group_name']."</option>";
                }
                ?>
            </select><br>
			<label class="h6" for="name">Contact Name: </label>
			<input class="form-control" type="text" name="name" id="name" />
			<div id="msg"></div>
            <label class="h6" for="num_one">Number (1): </label>
		
			<input class="form-control" type="text" name="num_one" id="num_one" /> <br>
            <label class="h6" for="num_two">Number (2): </label>
			<input class="form-control" type="text" name="num_two" id="num_two" /> <br>
			<input type="submit" name="submit" id="submit" value="Create" class="form-control btn-info"/>
	
		</form>
	</div>
	</div>

</body>

</html>