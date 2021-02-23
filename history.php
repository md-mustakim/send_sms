<?php
    require "class/app.php";
    $all = new myclass();
    $auth = new auth();
    echo $auth->check();
    $oldmessage_query = "SELECT * FROM `messages` ORDER BY msg_id DESC LIMIT 30";
    $view_data = $all->group_view($oldmessage_query);
    $count = $all->count($oldmessage_query);



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.4.0-dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="fa/css/all.css">
    <title>SMS History</title>

    <style>
        .button{
            background: #0c5460;
            height: 50px;
            transition: height 5s;

        }
        .button_change{
            background: #1e7e34;
            transition: background 5s;
        }

    </style>
</head>
<body>

    <div class="bg-info p-2">
        <div class="container">
            <span class="h5 text-light">Message History</span>
            <span class="float-right">
                <a class="text-light" href="logout.php"><i class="fa fa-sign-out-alt"></i></a> &nbsp;&nbsp;
                <a class="text-light" href="index.php"><i class="fa fa-home"></i></a>
            </span>
        </div>
    </div>
    <div class="container">
        <table class="table">

            <?php
            foreach ($view_data as $data)
            {
                    $group_id = $data['group_code'];
                    $groupname = $all->group_view("select * from number_group where group_id=$group_id");
                        ?>
                        <tr>
                            <td rowspan="2"> <?php echo $groupname[0]['group_name'];?> </td>
                            <td rowspan="2"> <?php echo $data['msg_body'];?></td>
                        <td> <?php echo $data['length'];?> </td>

                        </tr><tr>

                        <td> <?php echo $data['total_cost'];?> </td>

                        </tr>


                        <?php
                }
                ?>


        </table>
    </div>

</body>
<script>

        function sshow() {
            var x = document.getElementById('full_msg');
            var current = x.classList.value;
            if(current === "sr-only")
            {
                x.classList.remove("sr-only")
                x.classList.add("button_change");

                c = x.classList.value;
                console.log(c);

            }else {
                x.classList.remove("button_change")
                x.classList.add("button");
                c = x.classList.value;
                console.log(c);
            }


        }

</script>
</html>
