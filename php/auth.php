<?php
require_once("php/header.php");
require_once("/etc/apache2/capstone-mysql/net-neutrality.php");
if (isset($_GET["auth"]) === true){
    try{
        $database = Pointer::getPointer();
        $record = Login::selectLoginByAuthenticationToken($database,$auth);
        if ($record != null){
            $login = new Login($record->getLoginId(),$record->getUserId(),null,$record->getPassword(),$record->getSalt(),$record->getUserName());
            $login->update($database);
            echo "<h2>Welcome</h2>";
            echo "<p>You are now registered with us please login. Thanks.</p>";
        }
        else{
            throw(new RuntimeException("Sorry but this link is no longer valid."))
        }
    }
    catch (Exception $newException){
        echo "<span class='badForm'>$newException</span>";
    }
else{
    echo "<span class='badForm'>We are sorry but you got to this page by mistake</span>";
}
require_once("footer.html");
?>