<?php
    require "class/app.php";
    $object = new myclass();
    if(isset($_GET['id']) && isset($_GET['type']))
    {
        $id= $_GET['id'];
        $type= $_GET['type'];
        $delete = $object->delete($type,$id);
        
        if($delete === true)
        {
            echo "Success";
			echo"<script> goBack('../'); </script>";
			
        }
        else
            {
            var_dump($delete);
        }


    }
?>
<script type="text/javascript">

	function goBack(paths) {
    var paths = "../";
    setTimeout(function () {
        window.location.href = paths;        
    }, 2000)
}
</script>
