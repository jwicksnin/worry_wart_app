<?php 
session_start();
if (isset($_POST["action"])) {
	$db = new PDO("mysql:dbname=worry", "root", "root");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$username = $_POST["user"];
    $action = $_POST["action"];
    if ($action == "add") {
	    $new = $_POST["item"];
	 
		$stmt = $db->prepare("INSERT INTO $username (worries) VALUES (:new)");
		$stmt->execute(array(':new'=>$new));
    } else if ($action == "delete") {
    	$result = $_POST["result"];

    	$id = $_SESSION["id"];

    	if ($result == "over_it") {

    		$sql = $db->prepare("UPDATE results SET over_it = over_it + 1 WHERE user_id = $id");
    		$better = $sql->execute();

    	} else if ($result == "came_true") {
    		$sql = $db->prepare("UPDATE results SET came_true = came_true + 1 WHERE user_id = $id");
    		$better = $sql->execute();
 
    	} else if ($result == "current") {
    		$sql = $db->prepare("UPDATE results SET current = current + 1 WHERE user_id = $id");
    		$better = $sql->execute();
 
    	}
    	$index = (int)$_POST["index"];
    	$stmt = $db->prepare("DELETE FROM $username WHERE (worry_id = :index)");
		$good = $stmt->execute(array(':index'=>$index));
	
    }
   header("Location: worries.php");
               die();
}


	

?>
