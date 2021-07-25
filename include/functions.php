<?php
// Redirect function
function redirectTo($msg, $to = '')
{
  echo "<script>alert('$msg');window.location.href='$to';</script>";
}
