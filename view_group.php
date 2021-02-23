<?php
    require "class/app.php";

    $auth = new auth();
    echo $auth->check();
    $object = new myclass();
    if(isset($_GET['id']))
    {
        $query = "SELECT * FROM `number_list` where group_id =". $_GET['id'] ." ";

        $count = $object->count($query);
        if($count > 0)
        {
            $status = $object->group_view($query);
        }

    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
    <title>View Group</title>
    <link rel="stylesheet" href="fa/css/all.css" />
</head>
<body>
    <div class="text-light bg-info p-2">
        <div class="container">
                <span class="h4">View Number</span>
                <span class="h5 float-right">				
				
                    <a class="text-light" href="index.php"><i class="fa fa-home"></i></a> &nbsp;
                    <a class="text-light" href="config/logout.php"><i class="fa fa-sign-out-alt"></i></a>
                </span>
        </div>
    </div>
    <div class="container">

            <table class="table">
                <tr>
                    <th>Name (<?php echo $count; ?>) </th>
                    <th>Number 1</th>
                                  
                    <th>Action</th>
                </tr>
                <?php
                if($count >0)
                {
                    foreach ($status as $view => $item)
                    {
                        $group = $item['group_id'];
                        $result = $object->group_view("select * from number_group where group_id=$group");
                      
                        foreach ($result as $value => $items)
                        {
                            $name = $items['group_name'];
                        }
                        echo "<tr> 
                                <td> ". $item['name']." </td>
                                <td>". $item['number_1']."<br>
                                ". $item['number_2']."</td>
                               
                                <td> 
                                 <a href='edit.php?id=".$item['id']."'>Edit</a>&nbsp;
                                    <a href='delete.php?id=".$item['id']."'><img src='../src/delete.png' width='20' alt='Delete'></a> 
                                   
                                </td>
                              
                               </tr>";
                    }
                }
                else{
                    echo "<tr><td colspan='5'>No Number found :)</td></tr>    ";
                }

                ?>
            </table>
        </div>

</body>
</html>
<script type="text/javascript">
		function deletes(){
	      $.ajax({
                      url: "ajax.php",
                      method: "GET",
                      data:{data:id},
                      success: function(data)
                      {
                          //$('#mon').html(data);
                          document.getElementById('got_number').innerHTML= data;

                          Ok();
                      }
                  });
				  }
</script>