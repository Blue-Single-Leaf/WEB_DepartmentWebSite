<?php
   session_start();
   $username = $_SESSION["username"];
   $_SESSION = array();
   if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-42000,'/');
   }
   session_destroy();
//ת���½ҳ��
   header("location:../frontPage/staff.html");
?>
