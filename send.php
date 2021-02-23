<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="src/moment.min.js" type="text/javascript"></script>
<script src="src/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="src/jquery_2_1_3.min.js" type="text/javascript"></script>
<?php
	require 'class/app.php';
	$object = new myclass();
	$connect = $object->dbase();
	$auth = new auth();
	echo $auth->check();
	$quary= "select * from number_group";
	$view = $object->group_view($quary);

	
	
	
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>SMS Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.4.0-dist\css\bootstrap.min.css" />
    <link rel="stylesheet" href="fa/css/all.css" />
</head>
<body>
<div class="bg-info p-2">
    <div class="container text-light">
    <span class="h4">Send message</span>
    <span class="float-right h6">
        <a title="Home" class="text-light" href="index.php"><i class="fa fa-home"></i></a> &nbsp;
        <a class="text-light" href="config/logout.php" title="Logout"><i class="fa fa-sign-out-alt"></i></a>

    </span>
</div></div>
<br>
<div class="container">
    <div id="msg"></div>
    <form id="myForm">
            <div class="h6" for="receiver">Select numbers
                <span class="float-right">
                    <a href="add_group.php"><i class="fas fa-users"></i></a> &nbsp;
                    <a href="add_number.php"><i class="fas fa-user-plus"></i></a>
                </span>
            </div>
            <select name="select_number" id="select_number" class="form-control" required>
                <option value="0">Select</option>
                <?php
                $count = $object->count($quary);

                if($count > 0)
                {
                    foreach ($view as $value => $item)
                    {
                        echo "<option value=". $item['group_id'] .">(". $item['group_id'] .") ". $item['group_name']."</option>";
                    }
                }

                ?>
            </select>
			<span id="got_number" class="badge badge-success"> 0 </span> <span>Person</span>
            <br>
            <label class="h6"  for="message">Message</label> <br>
			
            <textarea id="mnTxtMessage" class="form-control" rows="5" title="SMS" placeholder="Type Your SMS Here"></textarea>
            <small>Font:</small> <span id="mnCharCount">0</span>
            <small>&nbsp;&nbsp;||&nbsp;&nbsp;SMS: </small><span id="mnSmsLength">1</span>
            <small>&nbsp;&nbsp;||&nbsp;&nbsp;Type : </small><span id="mnSmsType">Text</span>
            <small>&nbsp;&nbsp;||&nbsp;&nbsp;Cost : </small><span id="mnSmsCost">0.4</span> <span> &#2547; </span> <br><br>
                <div class="row">
                <div class="col">
                    <label class="h6"  for="title">Write a title</label>
                    <input type="text"  name="title" id="title" class="form-control">

                </div>

            </div>
            <br>
    </form>
           <div align="center">

               <button class="btn btn-info text-light" id="send" onclick="send()">Send</button>
           </div>






    </div>
</body>
<script type="text/javascript">
     

      $('#mnTxtMessage').on('keyup', function()
          {
              Ok();
          }
      );

      function Ok(){
          var value = document.getElementById('mnTxtMessage').value;
          var length = value.length;
       
          var fullMessage = value;
          document.getElementById('mnCharCount').innerHTML = length;
          var fullMessageVarified = "";
          var maxSmsLimit = 5;
          var singleTextMsgLength = 160;
          var multiTextMsgLength = 150;
          var singleUnicodeMsgLength = 70;
          var multiUnicodeMsgLength = 65;

          var returnData = Array();
          var length = fullMessage.length;
          var msgType = "Text";
          var smsCount = 0;

          for (var i = 0; i < length; i++) {
              var chkUnicode = fullMessage.charCodeAt(i);
              if (chkUnicode == 8216 || chkUnicode == 8217) {
                  fullMessage[i] = '\'';
                  fullMessageVarified += "'";
                  continue;
              }
              if (chkUnicode == 8220 || chkUnicode == 8221) {
                  fullMessage[i] = '\"';
                  fullMessageVarified += "\"";
                  continue;
              }
              fullMessageVarified += fullMessage[i];
              if (chkUnicode > 256) {
                  msgType = "Bangla";
                  //break;
              }
          }

          document.getElementById('mnSmsType').innerHTML = msgType;


          if (msgType == "Text") {
              if (length <= singleTextMsgLength) {
                  smsCount = 1;
              }
              else {
                  smsCount = Math.ceil(length / multiTextMsgLength);
              }
          }
          else {
              if (length <= singleUnicodeMsgLength) {
                  smsCount = 1;
              }
              else {
                  smsCount = Math.ceil(length / multiUnicodeMsgLength);
              }
          }
          if (smsCount > maxSmsLimit) {
              smsCount = maxSmsLimit;
              if (msgType == "Text") {
                  fullMessageVarified = fullMessageVarified.substring(0, (maxSmsLimit * multiTextMsgLength));
                  length = maxSmsLimit * multiTextMsgLength;
              }
              else {
                  fullMessageVarified = fullMessageVarified.substring(0, (maxSmsLimit * multiUnicodeMsgLength));
                  length = maxSmsLimit * multiUnicodeMsgLength;
              }
          }
          document.getElementById('mnSmsLength').innerHTML = smsCount;
          var number_lists = document.getElementById('got_number').innerHTML;
          var number_count = number_lists.length;
          var totalnumber = (number_count * smsCount * 0.40);
          var cost = totalnumber.toFixed(2);
          document.getElementById('mnSmsCost').innerHTML = cost;
          var consoles = "number_lists--: "+number_lists+"SMSCOUNT:   "+smsCount+"cost:   "+cost;


      }
  </script>
  <script>

      $(document).ready(function()
          {
              $('#select_number').change(function()
              {
                  var id=  $(this).val();
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
              });
          }
      );



      function send() {

          var title = document.getElementById('title').value;

          var group_code = document.getElementById('select_number').value;
          var charcount = document.getElementById('mnCharCount').innerHTML;
          var message = document.getElementById('mnTxtMessage').value;
          var length = document.getElementById('mnSmsLength').innerHTML;
          var type = document.getElementById('mnSmsType').innerHTML;
          var cost = document.getElementById('mnSmsCost').innerHTML;
          var total_cost = (cost * group_code);
          total_cost = total_cost.toFixed(2);

          var errorcount = 0;
          if( group_code == 0)
          {
              document.getElementById('select_number').style.border = "2px solid red";
          }
          else {
              document.getElementById('select_number').style.border = "";
              errorcount = errorcount+1;
          }

          if( charcount == 0)
          {
              document.getElementById('mnTxtMessage').style.border = "2px solid red";
          }
          else {
              document.getElementById('mnTxtMessage').style.border = "";
              errorcount = errorcount+1;
          }

          if( title == 0)
          {
              document.getElementById('title').style.border = "2px solid red";
          }
          else {
              document.getElementById('title').style.border = "";
              errorcount = errorcount+1;
          }
          console.log(errorcount);
          if(errorcount === 3)
          {
              $.ajax({
                  url: "ajax.php",
                  method: "POST",
                  data:{
                      group: group_code,
                      fonts: charcount,
                      message_body: message,
                      length: length,
                      type: type,
                      cost: cost,
                      total_cost: total_cost,
                      msg_title: title

                  },
                  success: function(data)
                  {

                        var status = "Message Sent successfully";

                        var msg = document.getElementById("msg");
                         document.getElementById("myForm").reset();


                      msg.classList.add("bg-success");
                      msg.classList.add("text-light");
                      msg.classList.add("p-2");
                      msg.classList.add("mt-2");
                      msg.classList.add("mb-2");
                      setTimeout(function () {
                        msg.style.display = "none";

                      },5000);
                      msg.innerHTML= status;





                  }
              });
          }
      }


  </script>


</html>