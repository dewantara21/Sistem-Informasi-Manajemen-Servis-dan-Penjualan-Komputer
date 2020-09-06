

    <?php

    $host="localhost";

    $user="root";

    $pass="";

    $dbName="servis_komputer";

    $conn = mysqli_connect($host, $user, $pass, $dbName);

    if(!$conn){

                    "Connection:Failed".mysqli_connect_error();

    }

    ?>
