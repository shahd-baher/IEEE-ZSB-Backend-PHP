# PHP OOP
## 1. Inheritance
- **What is the main benefit of Inheritance in OOP?**
  - It allows tha child class to reuse (`inherit`) the properties and the methods in the parent class and this reduces the code duplication and improves the code maintanence and organization.
- **EX:**
```php
class vehicle {
    public $color;
    public $model;
    function Setmodel($m)
    {
      $this->model=$m;
      echo "the vehicle model is " . $m;
    }
}
class bycicle extends vehicle{
    public $speed;
    function Setspeed($s)
    {
      $this->speed=$s;
      echo "the speed is " . $s;
    }
}
- Here, `bycicle` inherits `$color` , `$model` properties and `Setmodel()` method from `vehicle`.
```
---
## 2. The final Keyword
- **What happens if you put the final keyword before a class or a method?** 
  - The `final class` -> Can't be inherited or instantiated.
  - The `final method` -> Can't be overridden.
- **Why would a developer want to use this?**
  - As it protects the code from modification.
  - As it ensures that the behavior remaims unchanged.
  - As it improves the security and the design control.
---
## 3. Overriding Methods
- **What does it mean to "override" a method in a child class?**
  - It means redfining or rewriting a method in the child class that is already exists in the parent class with the same name and parameters.
- **How can you call the original parent method from inside the child's overridden method?**
  - You can call the parent method using the parent:: keyword inside the child class. This allows you to reuse the original functionality of the parent method even after overriding it.
- **EX:**
```php
class Vehicle {
    public $color;
    public $model;

    function setModel($m) {
        $this->model = $m;
        echo "The vehicle model is " . $m . "<br>";
    }
}

class Bicycle extends Vehicle {

    // Overriding the parent method
    function setModel($m) {
        echo "This is Bicycle model <br>";

        // Calling parent method
        parent::setModel($m);
    }
}
```
---
## 4. Abstract Class vs. Interface
- **What is the main difference between an Abstract Class and an Interface?**

|`Abstract Class`|`Interface`|
|:--------------:|:---------:|
|It Can have both abstract and concrete methods|Contains only method declarations (and constants)|
|It Can have constructors and fields|No constructors|
|A class can extend only one abstract class|Noconstructors|A class can implement multiple interfaces|

- **Key Difference:**
  - `Abstract class` = partial implementation.
  - `Interface` = full abstraction (contract).
- **Can a class implement multiple interfaces?**
  - Yes, a class can implement multiple interfaces.
---
## 5. Polymorphism
- **what is Polymorphism?**
  - Polymorphism means "one method but different behavior" depending on the object from a specific class that inherits from a parent class.
- **EX:**
```php
class Vehicle {
    public $model;

    function move() {
        echo "Vehicle is moving <br>";
    }
}

class Bicycle extends Vehicle {
    function move() {
        echo "Bicycle is moving by pedaling <br>";
    }
}

class Car extends Vehicle {
    function move() {
        echo "Car is moving with engine <br>";
    }
}

class Train extends Vehicle {
    function move() {
        echo "Train is moving on rails <br>";
    }
}
```
```php
// using the functions 
$b = new Bicycle();
$c = new Car();
$t = new Train();
testMove($b);
testMove($c);
testMove($t);
```
```php
// output
Bicycle is moving by pedaling 
Car is moving with engine 
Train is moving on rails 
```
---
## Summary
- Inheritance → Reuse code.
- final → Prevent change.
- Overriding → Customize behavior.
- Abstract vs Interface → Structure vs Contract.
- Polymorphism → Same method, different results.
---