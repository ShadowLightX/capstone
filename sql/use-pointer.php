<?php
// require the shared mySQL class
require_once("/etc/apache2/captstone-mysql/net-neutrality.php", "net_neutrality", "hatscrimwispycellscala", "net_neutrality");

// every time one needs mySQL access, all one needs to do is run a single method...
try {
    $mysqli = Pointer::getPointer();
} catch (mysqli_sql_exception $sqlException) {
    // handle connection errors here
}
?>