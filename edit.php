<?php

    include "class/app.php";
    $mc = new myclass();
    $auth = new auth();
    echo $auth->check();
    $con = $mc->dbase();
    $quary= "select * from number_group";
    $view = $mc->group_view($quary);
    $msg = "";
    if(!isset($_GET['id']))
    {
        header("location: index.php?back=Id or group not selected");
    }else
    {
        $got_id = $_GET['id'];
    }
    //------------- get data------------------------
    $qers = "SELECT * FROM `number_list` WHERE id = $got_id";
    $got_data = $mc->group_view($qers);



    if(isset($_POST['update']))
    {
        $name= $_POST['name'];
        $number1= $_POST['num_one'];
        $number2= $_POST['num_two'];
        $groups = $_POST['group'];
        $inserts= "UPDATE `number_list` SET `name` = '$name', `number_1` = '$number1',
 `number_2` = '$number2', `group_id` = '$groups' WHERE `number_list`.`id` = '$got_id'";
        $inserts;
        $insert = $mc->insert($inserts);

        if($insert == true)
        {
            $msg=  "Successfully Updated. Wait for refresh";
            echo"
            <script>
                var l = window.location.href;
                setTimeout(function() {
                  window.location.href = l;
                },2000);
            </script> 
            ";
        }else
        {
            $msg = "Sorry something is problem";
        }

    }





?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\bootstrap-4.4.0-dist\css\bootstrap.min.css" />
    <link rel="stylesheet" href="..\fa\css\all.css" />
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
        <form action="edit.php?id=<?php echo $got_id?>" method="post" id="form">
            <label class="h6" for="group">Select Group: </label>
            <select name="group" id="group" class="form-control" required>
                <option value="">Select</option>
                <?php

                foreach ($view as $value => $item)
                {

                     $got_group = $got_data[0]['group_id'];
                    $groups_list = "";
                    if($got_group == $item['group_id'])
                    {
                        echo "<option value=". $item['group_id'] ." selected>(".$item['group_id'].") &nbsp;". $item['group_name']."</option>";
                    }else
                    {
                        echo "<option value=". $item['group_id'] .">(".$item['group_id'].") &nbsp;". $item['group_name']."</option>";
                    }
                }
                ?>
            </select><br>
            <label class="h6" for="name">Contact Name: </label>
            <input class="form-control" type="text" name="name" id="name"  value="<?php echo $got_data[0]['name']?>"/>
            <div id="msg"></div>
            <label class="h6" for="num_one">Number (1): </label>

            <input class="form-control" type="text" name="num_one" id="num_one" value="<?php echo $got_data[0]['number_1']?>" /> <br>
            <label class="h6" for="num_two">Number (2): </label>
            <input class="form-control" type="text" name="num_two" id="num_two" value="<?php echo $got_data[0]['number_2']?>"/> <br>
            <input type="submit" name="update" id="submit" value="Update" class="form-control btn-info"/>

        </form>


    </div>
</div>


</body>

</html>