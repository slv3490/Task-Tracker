<?php
// Crea el archivo si es que no existe
if(!is_file("datos.json")) {
  file_put_contents("datos.json", json_encode([]));
}

$command = $argv[1] ?? '';

switch ($command) {
    case 'add':
        addTask($argv[2]); break;
    case 'list':
        $status = $argv[2] ?? "";
        getTasks($status); break;
    case 'update':
        updateTask(intval($argv[2]), $argv[3]); break;
    case 'delete':
        deleteTask(intval($argv[2])); break;
    case 'mark-in-progress':
        markInProgress(intval($argv[2])); break;
    case 'mark-done':
        markDone(intval($argv[2])); break;
    default:
        echo "Commands: add, list, update, delete, mark-in-progress, mark-done\n";
        break;
}

function addTask($description) {
  //Obtener los datos anteriores
  $file = file_get_contents("datos.json");
  $array = json_decode($file);

  //Get the last id element
  $id = end($array)->id ?? 0;
  
  $newTask = [
    "id" => $id + 1,
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
  
  echo "Task added successfully (ID:" . $id + 1 . ")";
}

// TODO: Agregar el listado por filtro de estado
function getTasks($args) {
  $file = file_get_contents("datos.json");
  $array = json_decode($file);
  
  if($args === "done") {

    foreach ($array as $task) {
      if($task->status === 1) {
        $json_data = json_encode($task, JSON_PRETTY_PRINT);
        echo "Getting tasks: done \n\n";
        echo $json_data;
      }
    }
    return;

  } else if ($args === "in-progress") {

    foreach ($array as $task) {
      if($task->status === 0) {
        $json_data = json_encode($task, JSON_PRETTY_PRINT);
        echo "Getting tasks: in progress \n\n";
        echo $json_data;
      }
    }
    return;

  }
  echo "Getting all the tasks \n\n";
  echo $file;
}

function updateTask($id, $description) {
  updateContent($id, "description", $description, "The task was updated successfully");
}

function markInProgress($id) {
  updateContent($id, "status", 0, "The task was changed to: Pending");
}

function markDone($id) {
  updateContent($id, "status", 1, "The task was changed to: Completed");
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

  echo "Task with ID ${id} has been deleted\n";
}