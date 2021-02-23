<?php
    require "../../class/app.php";
    $c = new myclass();
    $create_table_message = "CREATE TABLE `sms_data`.`messages` (
 msg_id INT NOT NULL AUTO_INCREMENT,
  group_code INT, 
  font INT, 
  length INT, 
  type VARCHAR(10), 
  cost VARCHAR(20), 
  total_cost VARCHAR(20), 
  msg_body TEXT, 
   PRIMARY KEY(msg_id),
  FOREIGN KEY (group_code) REFERENCES number_group(group_id),	
  time TIMESTAMP)";

    $database = $c->dbase();
    $database->query($create_table_message);
    if(!$database->error)
    {
        $msg['database_success'] = "table created successfully";
    }else
    {
        $msg['database_error'] = $database->error;
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        var_dump($msg);
    ?>
</body>
</html>
