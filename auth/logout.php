<?php

if(isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
         $name = trim($parts[0]);
        setcookie($name, '', time() - (7*24));
        setcookie($name, '', time() - (7*24), "/");
        setcookie($name, '', time() - (7*24), "/sms/file");


    }
}

?>
<script>

    setTimeout(function () {
        alert("logout Success");
        window.location.href="login.php";

    },1000);

</script>
