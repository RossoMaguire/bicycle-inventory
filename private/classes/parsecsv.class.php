<?php

class ParseCSV {

  private $filename;
  public static $delimiter = ',';

  private $header;
  private $data = [];
  private static $row_count = 0;

  public function __construct($filename='') {
    if($filename != '') {
      $this->test_file($filename);
    }
  }

  public function test_file($filename) {
    if(!file_exists($filename)) {
      echo 'File does not exist';
      return false;
    } else if(!is_readable($filename)) {
      echo 'File is not readable';
      return false;
    }
    $this->filename = $filename;
    return true;
  }

  public function row_count() {
    return self::$row_count;
  }

  public function parse() {

    if(!isset($this->filename)) {
        echo "File not set";
        return false;
    }

    //clear any previous parse results
    $this->reset();

    $file = fopen($this->filename, 'r');

    while(!feof($file)) {
      $row = fgetcsv($file, 0, self::$delimiter);
      if($row == [NULL] || $row == FALSE) {
        continue;
      }
      if(!$this->header) {
        $this->header = $row;
      } else {
        $this->data[] = array_combine($this->header, $row);
        $this->row_count++;
      }
    }
    fclose($file);

    return $this->data;
  }

  public function last_results() {
    return $this->data;
  }

  private function reset() {
    $this->header = NULL;
    $this->data = [];
    self::$row_count = 0;
  }


}




?>
