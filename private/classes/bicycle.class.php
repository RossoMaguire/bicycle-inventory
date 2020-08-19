<?php
class Bicycle {

  public const CATEGORIES = ['road', 'mountain', 'hybrid', 'cruiser', 'city', 'BMX'];
  public const GENDERS = ['mens', 'womens', 'unisex'];
  protected const CONDITION = [
    1 => 'Beat Up',
    2 => 'Decent',
    3 => 'Good',
    4 => 'Great',
    5 => 'Like New'
  ];

  public $brand;
  public $model;
  public $year;
  public $category;
  public $colour;
  public $description;
  public $gender;
  public $price;

  protected $weight_kg = 0.0;
  protected $condition_id = 0;

  public function __construct($args=[]) {

    foreach($args as $k => $v) {
      if(property_exists($this, $k)) {
        $this->$k = $v;
      }
    }
  }

  public function name() {
    return $this->brand . " " . $this->model . " " . "(" . $this->year . ")" .  "<br/><br/>";
  }

  public function condition() {
    if($this->condition_id > 0) {
      return self::CONDITION[$this->condition_id];
    } else {
      return self::CONDITION[3];
    }
  }

  public function get_weight_kg() {
    $weight_string = $this->weight_kg == null ? "You must set a weight first" : "{$this->weight_kg} kg";
    return $weight_string;

  }

  public function set_weight_kg($lbs_val) {
    $this->weight_kg = floatval($lbs_val) / 2.2046226218;
  }

  public function get_weight_lbs() {
    return floatval($this->weight_kg * 2.2046226218) . "lbs";
  }

  public function set_weight_lbs() {
    $this->weight_kg = floatval($lbs_val) * 2.2046226218;
  }

}

?>
