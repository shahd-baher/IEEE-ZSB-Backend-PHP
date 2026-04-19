# PHP OOP
## 1. Traits
- Traits are a mechanism for code reuse in single inheritance languages like PHP. Since a class can only inherit from one parent class, Traits allow you to "inject" sets of methods into multiple independent classes.
- PHP does not support multiple inheritance
(extending multiple classes). **How do "Traits" solve this problem?**
  - Traits allow to reuse or inherit methods and properties from multiple sources inside a single class.
- **When should you use them?**
  - When multiple classes need the same property or method.
  - When inheritance is not suitable.
- **EX:**
```php
// Since PHP does not support multiple inheritance (a class cannot inherit from more than one parent), Traits are used to declare methods that can be used in multiple classes.
trait GpsSystem {
    public function showLocation() {
        echo "Location: Cairo, Egypt (GPS Enabled)\n";
    }
}
class vehicle {
    public $model;
}
class bycicle extends vehicle {
    use GpsSystem; 
    public $speed;
    function Setspeed($s) {
        $this->speed = $s;
        echo "the speed is " . $s;
    }
}

$bike = new bycicle();
$bike->showLocation(); 
```
---
## 2. Namespaces:
- **What is a Namespace in PHP?** 
  - It is a way to organize code and avoid naming conflicts.
  - It works like folders for classes.
- **How it prevents "naming collisions" when you have two classes with the same name?**
  - As Two classes with the same name can conflict so, Namespaces separate them by qualifying the name  `App\Models\User` and `ExternalLib\User` are seen as distinct entities.
- **EX:**
```php
// Concept: Namespaces organize classes into virtual folders. This prevents errors when two different files or libraries have classes with the exact same name.
namespace MyProject; // in a separate namespace
class vehicle {
    public $model;
    function Setmodel($m) {
        $this->model = $m;
        echo "Vehicle in MyProject: " . $m;
    }
}
// when using it in another file
$v = new \MyProject\vehicle();
```
---
## 3. Autoloading:
- **What is Autoloading?**
  - It is a strategy that `automatically` includes the necessary PHP file when a class is instantiated, rather than requiring the developer to manually write `require` or `include` at the top of every file.
- **How does it save time?**
  - `Maintenance`: You don't have to manage hundreds of require statements.
  - `Performance`: PHP only loads the files it actually needs for that specific request.
  - `Standardization`: Using standards like PSR-4, the file path corresponds to the namespace, making project structures predictable.
- **EX:**
```php
// Instead of manually writing require for every class file, Autoloading automatically detects which class is being called and includes the corresponding file.

// Standard Autoloader logic
spl_autoload_register(function ($className) {

    // Automatically includes 'vehicle.php' or 'bycicle.php' when called
    include $className . '.php';
});

// No need for require 'bycicle.php';
$bike = new bycicle();
```
---
## 4.Magic Methods `(__get and __set)`
- **What are the __get and __set magic methods used for?**
  - These methods are triggered automatically when accessing inaccessible `(protected/private)` or undefined properties.
- **When are they automatically triggered?**

|`__get `|`__set`|
|:------:|:-----:|
|Called when reading a property that is not accessible or non-existent property.|Called when writing to a property that is not accessible or non-existent property.|

- **EX:**
```php
// These methods act as "interceptors." They are triggered when you try to access or assign values to properties that are not defined in the class or are private.

class vehicle {
    public $model;
    private $data = [];

    // Triggered when writing to an undefined property
    public function __set($name, $value) {
        echo "Automatically setting $name to $value\n";
        $this->data[$name] = $value;
    }

    // Triggered when reading an undefined property
    public function __get($name) {
        return $this->data[$name] ?? "Property not found";
    }
}

$v = new vehicle();
$v->price = "500 USD"; // Triggers __set
echo $v->price;        // Triggers __get
```
---
## 5. Static Methods and Properties
- **What does it mean when a method or property is declared as `static`?**
  - It means that a method or a property belongs to the class itself, not an object.
- **Do you need to create an object using the `new` keyword to access a static method?**
  - No, you do not need to create an object using the `new` keyword as you can access static members using the scope resolution operator `(className::)`.
- **EX:**
```php
// Declaring a method or property as static means it belongs to the class itself, not to a specific object. You do not need to use the new keyword to access them.

class vehicle {
    public static $type = "Land Transport";

    public static function getClassName() {
        echo "This is the Vehicle Class.";
    }
}

// Accessing directly using the scope resolution operator (::)
echo vehicle::$type;
vehicle::getClassName();
```
---
## Summary
- `Traits`: Reuse code across classes (like multiple inheritance workaround).
- `Namespaces`: Prevent naming conflicts.
- `Autoloading`: Automatically load classes.
- `Magic Methods`: Handle dynamic properties.
- `Static`: Belongs to class, not object.
---