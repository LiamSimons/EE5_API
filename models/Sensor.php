<?php
  class Sensor {
    // DB Stuff
    private $conn;
    private $table = 'Sensor';

    // Properties
    public $sensor_id;
    public $type;
    public $location;
    public $sample_rate;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get sensors
    public function read() {
      // Create query
      $query = 'SELECT
        sensor_id,
        type,
        location,
        sample_rate
      FROM
        ' . $this->table . '
      ORDER BY
        location DESC';

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
        sensor_id,
        type,
        location,
        sample_rate
        FROM
          ' . $this->table . '
      WHERE sensor_id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->sensor_id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->sensor_id = $row['sensor_id'];
      $this->type = $row['type'];
  }

  // Create Sensor
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      type = :type';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->type = htmlspecialchars(strip_tags($this->type));

  // Bind data
  $stmt-> bindParam(':type', $this->type);

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
      type = :type
      WHERE
      sensor_id = :sensor_id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->type = htmlspecialchars(strip_tags($this->type));
  $this->sensor_id = htmlspecialchars(strip_tags($this->sensor_id));

  // Bind data
  $stmt-> bindParam(':type', $this->type);
  $stmt-> bindParam(':sensor_id', $this->sensor_id);

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
    $query = 'DELETE FROM ' . $this->table . ' WHERE sensor_id = :sensor_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->sensor_id = htmlspecialchars(strip_tags($this->sensor_id));

    // Bind Data
    $stmt-> bindParam(':sensor_id', $this->sensor_id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
