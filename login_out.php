<?php
session_unset();
session_destroy();
echo "<meta http-equiv='refresh' content='0; url=index.php?logout=anda telah keluar'>";

exit;
?>