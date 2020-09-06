<?php

error_reporting(0);
# Konek ke Web Server Lokal
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "";
$myDbs	= "servis_komputer"; // nama database, disesuaikan dengan database di MySQL

# Konek ke Web Server Lokal
$koneksidb	= mysql_connect($myHost, $myUser, $myPass);
if (! $koneksidb) {
  echo "Failed Connection !";
}

# Memilih database pd MySQL Server
mysql_select_db($myDbs) or die ("Database not Found !");

?>