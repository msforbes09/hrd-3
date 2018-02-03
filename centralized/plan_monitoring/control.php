<?php
session_start();
if( is_null($_SESSION["id"]) )  {
	header('location: ../log_in');
}
?>