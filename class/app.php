<?php
	$app_name = "Office kit";
	class myclass{
		function dbase()
		{
			$datab = mysqli_connect('localhost','root','','sms_data');
			if($datab->connect_error)
			{
				$datab = "Database Problem". $datab->connect_error;
			}
			return $datab;
		}	
		
		function test()
		{
			return "test success";
		}
        function count($query)
        {
            $c = $this->dbase();
            $q= mysqli_query($c,$query);
            $result= mysqli_num_rows($q);
            return $result;

        }


        function insert($query)
		{
			$connect = $this->dbase();
			$status = $connect->query($query);
			if($connect->error)
			{
				return false;
			}
			else
				return true;
		}
		
		
		function group_view($id)
		{
			$c = $this->dbase();
			$query= mysqli_query($c,$id);
			if($this->count($id) >0)
            {
                while($r=mysqli_fetch_assoc($query))
                {
                    foreach ($r as $key => $value)
                    {
                        //echo $key . $value . "<br>";
                    }
                    $array[] = $r;
                }
                return $array;
            }

			
		}

		function delete($type,$id)
        {
            if($type == 1)
            {

                $qrery="DELETE FROM `number_group` WHERE `number_group`.`group_id` = $id";
                $connect_object = $this->dbase();
                $delete = $connect_object->query($qrery);


            }
            else{
                $qrery="DELETE FROM `number_list` WHERE `number_list`.`id` = $id";
                $connect_object = $this->dbase();
                $delete = $connect_object->query($qrery);

            }


            if($connect_object->error)
            {
                return $connect_object->error;
            }
            else return true;
        }
	}
	
	class auth extends myclass {
		
				function check()
				{
					if(!isset($_COOKIE['id']))
					{
						header("location: auth/login.php");
					}
					
				}
				function emailverify($code)
				{
					$query = "SELECT * FROM `auth` WHERE email_varify= $code";
					$checkup = $this->group_view($query);
					$userid= $checkup[0]['id'];
					$dbcode = $checkup[0]['email_varify'];
					$update = "UPDATE `auth` SET `email_varify` = '1' WHERE `auth`.`id` = $userid";
					$this->insert($update);

					if($code == $dbcode)
					{
						return true;
					}else
					{
						return false;
					}
				}
				
				function login($user,$pass)
				{
					$login_query= "SELECT * FROM auth where name like '%".$user."%' or email like '%".$user."%' or phone like '%".$user."%'";
					$cons= $this->count($login_query);


					if($cons>0)
					{
						$co = $this->dbase();
						$mq = mysqli_query($co,$login_query);
						$ro = mysqli_fetch_assoc($mq);
						$pas = $ro['pass'];
						$email_verify = $ro['email_varify'];
						$account_status = $ro['account_status'];
						if($email_verify == 0)
						{
							$msg = 1;
						}else if($account_status == 0)
						{
							$msg = 2;
						}else
						{
							if($pas == $pass)
							{
								$msg = 9;

							}else
							{
								$msg = 3;

							}
						}

					}else
					{
						$msg = 4;


					}
					return $msg;

				}

				function reg($name,$username,$email,$phone,$address,$pass)
				{
					$insert_query = "INSERT INTO `auth`(`name`, `username`, `email`, `phone`, `address`, `pass`)
 												 VALUES('$name','$username','$email','$phone','$address','$pass') ";
					$status = $this->insert($insert_query);
					return $status;
				}
	}

?>


