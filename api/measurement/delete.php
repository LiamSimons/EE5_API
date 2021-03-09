<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Measurement.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $sensor = new Sensor($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $measurement ->id_measurement = $data->id_measurement;
  $measurement ->sensor_id =  $data->sensor_id;
  $measurement ->value = $data->value;
  $measurement -> time = $data->time;

  // Delete post
  if($measurement->delete()) {
    echo json_encode(
      array('message' => 'Sensor deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Sensor not deleted')
    );
  }
