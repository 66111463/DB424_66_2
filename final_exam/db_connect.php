<?php
try {
  $conn = new mysqli('db403-mysql', 'root', 'P@ssw0rd', 'DB211');
}
catch (Exception) {
  die('Connection error');
}