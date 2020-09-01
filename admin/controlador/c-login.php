<?php
  //verificar si existe un mensaje para visualizar
  $msg=(isset($_SESSION["spam_message"]))?  $_SESSION["spam_message"]: "";
  $notif_script="";
  if($msg!="")//si existe un mensaje se lo muestra
  {
      $notif_script="<script>OpenMsg('$msg')</script>";
      $_SESSION["spam_message"]=null;

  }
  include_once("vista/v-login.php");
?>