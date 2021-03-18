<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Measurement.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $measurement = new Measurement($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  var_dump(file_get_contents('php://input'));
  //$measurement ->id_measurement = $data->id_measurement;
  $measurement ->sensor_id =  $data->sensor_id;
  $measurement ->value = $data->value;
  $measurement -> time = $data->time;
  $measurement ->session_id =  $data->session_id;
  // Create Sensor
  if($measurement->create()) {
    echo json_encode(
      array('message' => 'Measurement Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Measurement Not Created')
    );
  }
