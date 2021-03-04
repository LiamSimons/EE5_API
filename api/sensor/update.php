<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Sensor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate sensor object
  $sensor = new Sensor($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $sensor->id = $data->id;

  $sensor->name = $data->name;

  // Update sensor
  if($sensor->update()) {
    echo json_encode(
      array('message' => 'Sensor Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Sensor not updated')
    );
  }
