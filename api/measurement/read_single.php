<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Measurement.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog sensor object
  $sensor = new Sensor($db);

  // Get ID
  $measurement->id_measurement = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $measurement->read_single();

  // Create array
  $category_arr = array(
    'id_measurement' => $sensor->id_measurement,
  );

  // Make JSON
  print_r(json_encode($category_arr));
