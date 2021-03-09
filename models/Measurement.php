<?php
  class Measurement {
    // DB Stuff
    private $conn;
    private $table = 'Measurement';

    // Properties
    public $id_measurement;
    public $sensor_id;
    public $time;
    public $value;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get sensors
    public function read() {
      // Create query
      $query = 'SELECT
 

        id_measurement,
        sensor_id,
        time,
        value
      FROM
        ' . $this->table . '
      ORDER BY
        time DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Sensor
  public function read_single(){
    // Create query
    $query = 'SELECT
        id_measurement,
        sensor_id,
        time,
        value
        FROM
          ' . $this->table . '
      WHERE id_measurement = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->sensor_id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->sensor_type = $row['sensor_type'];
  }

  // Create Sensor
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
    id_measurement = :id_measurement,
    sensor_id = :sensor_id,
    time=:time,
    value=:value'
      ;

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  //$this->sensor_type = htmlspecialchars(strip_tags($this->sensor_type));

  // Bind data
  $stmt-> bindParam(':id_measurement', $this->id_measurement);
  $stmt-> bindParam(':sensor_id', $this->sensor_id);
  $stmt-> bindParam(':time', $this->time);
  $stmt-> bindParam(':value', $this->value);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Sensor
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
       id_measurement = :id_measurement,
    sensor_id = :sensor_id,
    time=:time,
    value=:value
      WHERE
      sensor_id = :sensor_id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  //$this->sensor_type = htmlspecialchars(strip_tags($this->sensor_type));
  //$this->sensor_id = htmlspecialchars(strip_tags($this->sensor_id));

  // Bind data
  $stmt-> bindParam(':id_measurement', $this->sensor_type);
  $stmt-> bindParam(':sensor_id', $this->location);
  $stmt-> bindParam(':time', $this->sample_rate);
  $stmt-> bindParam(':value', $this->value);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Sensor
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id_measurement = : id_measurement';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    //$this->sensor_id = htmlspecialchars(strip_tags($this->sensor_id));

    // Bind Data
    $stmt-> bindParam(':id_measurement', $this->sensor_type);
    $stmt-> bindParam(':sensor_id', $this->location);
    $stmt-> bindParam(':time', $this->sample_rate);
    $stmt-> bindParam(':value', $this->value);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
