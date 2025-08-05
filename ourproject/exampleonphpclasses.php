<?php
class Car{
    public $color;
    public $model;
    public $year;

    public function __construct($color, $model, $year) {
        $this->color = $color;
        $this->model = $model;
        $this->year = $year;
    }
     // called method
    public function displayInfo() {
        return "Car Model: {$this->model}, Color: {$this->color}, Year: {$this->year}";
    }
    public static function show(){
        return "Car Model: aa";
    }

}
// instantiate the class by creating an object by new 
$car = new Car("Red", "Toyota", '2020');
echo $car->displayInfo(); // Outputs: Car Model: Toyota, Color: Red, Year: 2020
echo $car::show();
// extending the class
class ElectricCar extends Car {
    public $batteryCapacity;

    public function __construct($color, $model, $year, $batteryCapacity) {
        parent::__construct($color, $model, $year);
        $this->batteryCapacity = $batteryCapacity;
    }

    public function displayInfo() {
        return parent::displayInfo() . ", Battery Capacity: {$this->batteryCapacity} kWh";
    }
}
echo "<hr><br>";
$electricCar = new ElectricCar("Blue", "Tesla Model S", '2021', 100);
echo $electricCar->displayInfo(); // Outputs: Car Model: Tesla Model S, Color: Blue, Year: 2021, Battery Capacity: 100 kWh

// traits 
trait Vehicle {
    public function start() {
        return "Vehicle started";
    }
}
trait Electric {
    public function charge() {
        return "Vehicle charging";
    }   
}
class HybridCar extends Car {
    use Vehicle, Electric;  
    public function displayInfo() {
        return "Hybrid Car Model: {$this->model}, Color: {$this->color}, Year: {$this->year}";
    }
}
$hybridCar = new HybridCar("Green", "Toyota Prius", '2022');
echo "<hr><br>";
echo $hybridCar->displayInfo(); // Outputs: Hybrid Car Model: Toyota Prius, Color: Green, Year: 2022
echo $hybridCar->start();
echo $hybridCar->charge();