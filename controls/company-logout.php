<?php
session_start();
if (isset($_SESSION['companyid']))
{
  session_destroy();
  echo ("<script>location.href='../companies/login.php?status=true';</script>");
}
else
{
  echo ("<script>location.href='../companies/login.php?status=true';</script>");
}
?>