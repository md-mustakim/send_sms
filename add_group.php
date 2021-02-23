<?php

	include "class/app.php";
	$auth = new auth();
	echo $auth->check();
	$mc = new myclass();
	$con = $mc->dbase();
	$group_view = $mc->group_view("select * from number_group");
    $group_count = $mc->count("select * from number_group");
	if(isset($_POST['submit']))
    {

        $query= "INSERT INTO `number_group` (`group_name`) VALUES ('".$_POST['name']."')";
        $insert = $mc->insert($query);
        if($insert == true)
        {
            echo"Successfully added";
        }else
        {
            echo "Sorry cannot added Contact Admin";
        }
        echo "
    <script>
        refresh();
    </script>";
    }

	
	
	

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Modify Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap-4.4.0-dist\css\bootstrap.min.css" />
    <link rel="stylesheet" href="fa/css/all.css" />
    

</head>
<body>
    <div class="bg-info p-2">
        <div class="container">
        <sapn class="h4 text-light">Group</sapn>
            <span class="float-right h6">
                    <a class="text-light" href="index.php"><i class="fa fa-home"></i></i></a> &nbsp;
                    <a class="text-light" href="config/logout.php"><i class="fa fa-sign-out-alt"></i></a>
                </span>
        </div>
    </div>
    <br>
	<div class="container">

		<form action="add_group.php" method="post">
			<label for="name">Create Group: </label>
			<input class="form-control m-2 p-2" type="text" name="name" id="name" />
			<input type="submit" name="submit" id="submit" value="Create" class="form-control btn-info"/>
		</form>

        <table class="table overflow-auto">
            <tr>
                <th>id</th>
                <th>Number</th>
                <th colspan="2">Name</th>

            </tr>
            <?php
            if($group_count >0){
            foreach ($group_view as $item =>$value)
                {

                    $count_number = $mc->count("SELECT * FROM `number_list` where group_id=".$value['group_id']."");
                    echo "<tr>
                            <td>". $value['group_id']."</td> 
                            <td>$count_number</td> 
                            <td> <a href='view_group.php?id=".$value['group_id']."'>". $value['group_name']." </a></td> 
                            <td align='right'><a href='delete.php?id=".$value['group_id']."&type=1'><img src='../src/delete.png' width='20px' alt='delete'></a></td>
                           </tr>";
                }
            }
            else
            {
                echo "<tr><td colspan='3'>No Group Created</td></tr>";
            }
            ?>
        </table>
	</div>

</body>

</html>