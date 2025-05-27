<?php
include "functions.php";

if(!is_file("datos.json")) {
  file_put_contents("datos.json", json_encode([]));
}
// Add Task
if($argv[1] === "add") {
  addTask($argv[2]);

} else if($argv[1] === "list") {

  getAllTasks("list", $argv[2] = "");

} else if($argv[1] === "update") {

  updateTask(intval($argv[2]), $argv[3]);

} else if($argv[1] === "delete") {

  deleteTask(intval($argv[2]));

} else if($argv[1] === "mark-in-progress") {

  markInProgress(intval($argv[2]));

} else if($argv[1] === "mark-done") {

  markDone(intval($argv[2]));
}

function addTask($description) {
  //Obtener los datos anteriores
  $file = file_get_contents("datos.json");
  $array = json_decode($file);

  //Get the last id element
  $id = end($array)->id ?? 0;
  
  $newTask = [
    "id" => newId($id),
    "description" => $description,
    "status" => 0,
    "created_at" => date('l jS \of F Y h:i:s A'),
    "updated_at" => date('l jS \of F Y h:i:s A')
  ];
  
  $array[] = $newTask;
  
  // Encode to JSON
  $json_data = json_encode($array, JSON_PRETTY_PRINT);
  
  // Write in the file
  file_put_contents("datos.json", $json_data);
  
  echo "Data Saved";
}

// TODO
function getAllTasks() {
  $file = file_get_contents("datos.json");
  echo "Getting all the tasks \n\n";
  echo $file;
}

function updateTask($id, $description) {
  updateContent($id, "description", $description, "La tarea se actualizo correctamente");
}

function markInProgress($id) {
  updateContent($id, "status", 0, "La tarea se cambio a: Pendiente");
}

function markDone($id) {
  updateContent($id, "status", 1, "La tarea se cambio a: Completada");
}

function updateContent($id, $key, $value, $message) {
  $file = file_get_contents("datos.json");
  $array = json_decode($file);

  foreach ($array as $task) {
    if($task->id === $id) {
      $task->$key = $value;
      $task->updated_at = date('l jS \of F Y h:i:s A');

      // Encode to JSON
      $json_data = json_encode($array, JSON_PRETTY_PRINT);
      
      // Write in the file
      file_put_contents("datos.json", $json_data);
      
      echo $message;
    }
  }
}

function deleteTask($id) {
  $file = file_get_contents("datos.json");
  $array = json_decode($file);

  // Filtrar las tareas que no coincidan con el ID
  $filtered = array_filter($array, function ($task) use ($id) {
    return $task->id !== $id;
  });

  // Reindexar los índices del array (opcional)
  $filtered = array_values($filtered);

  // Guardar el nuevo array en el archivo
  file_put_contents("datos.json", json_encode($filtered, JSON_PRETTY_PRINT));

  echo "Tarea con ID $id eliminada.\n";
}