<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Sensor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $sensor = new Sensor($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $sensor->name = $data->name;

  // Create Sensor
  if($sensor->create()) {
    echo json_encode(
      array('message' => 'Sensor Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Sensor Not Created')
    );
  }
