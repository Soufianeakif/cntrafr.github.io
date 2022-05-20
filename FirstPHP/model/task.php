<?php
require_once('../model/data_provider.php');

class Task extends DataProvider {

  // Post Task
  public function addTask($id, $title) {
    
    //Etablir la connection
    $db_connection = $this->connect();

    if($db_connection == null) {
      return;
    }
    $_REQUEST = "INSERT INTO firsttable (ID, TITLE) VALUES (:ID, :TITLE)";

    $statement = $db_connection->prepare($_REQUEST);

    $statement->execute([
      ":ID => "$id",
      ":TITLE => "$title"
    ]);

    $statement = null;
    $db_connection = null;
  }

  // Get ALL Tasks
  public function getAllTasks() {

    $db_connection = $this->connect();

    if($db_connection == null) {
      return;
    }
    $query = $db_connection->query("SELECT * FROM firsttable");

    $data = $query->fetchAll(PDO:: FETCH_OBJ);

    $query = null;
    $db_connection = null;
    return $data;
  }


  // Post Task
  public function getTaskById($id) {
    
    $db_connection = $this->connect();

    if($db_connection == null) {
      return;
    }
    $_REQUEST = "SELECT * FROM tasks WHERE id = :id";

    $statement = $db_connection->prepare($_REQUEST);

    $statement->execute([
      ":id => "$id"
    ]);

    $data = $statement->fetch();

    $statement = null;
    $db_connection = null;
  }
}
?>