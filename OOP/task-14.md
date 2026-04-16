# PHP OOP
## 1. Class vs Object
- **Class :**
  - It is the blueprint or the template that defines the shape and the characteristics and the object is created from it .
- **Object :**
  - It is an instance or a member of the class . 
- **EX:**
```php
class Car {
    public $color;
}

$car1 = new Car(); // object
$car1->color = "Red";
```
---
## 2. $this vs. self::
- **$this** 
  - It is called pseudo variable .
  - It refers to the current object properties .
  - It accesses the Non-static members .
  - It uses $ Because it represents a variable not a class construction .
- **EX:**
```php
class User {
    public $name;

    public function sayHello() {
        return "Hello " . $this->name;
    }
}
```
- **self::**
  - It refers to the current class .
  - It accesses the static members .
  - Deosn't use $ Because it doesn't represent variable but represents a class construction .
- **EX:**
```php
class User {
    public static $count = 0;

    public static function showCount() {
        return self::$count;
    }
}
```
- **Summary**  
|**Feature**|`$this`|`self::`|  
|:-----:|:-----:|:------:|  
|**Works with**|Object|Class|  
|**Used with**|Non-static members|Static members|  
|**Needs object?**|Yes|No|  
|**Operator**|Object operator (->)|Scope Resolution Operator (::)|
---
## 3. Access Modifiers (Encapsulation)
- **`Public`**
  - The properties/methods can be accessed from anywhere (inside the class, outside the      class, or by child classes) .
- **`Protected`**
  - The properties/methods Can only be accessed within the class itself and by classes that inherit from it (children) .
- **`Private`**
  - The properties/methods Can only be accessed within the specific class where it is defined .
- **Why use Private?**
  - To prevent users to change data directly and this keep the data safe .
---
## 4. Typed Properties
- **`Typed Properties`**
  - It means that the class properties where you explicitly declare the data type of the value they should hold (like `int`, `string` ,  `bool` , etc.).
- **EX:**
```php
class User {
    public string $name;
    public int $age;
}
```
**Here :**
- `$name` -> must always be a string .
- `$age` -> must always be an integer .
- **How do Typed Properties prevent bugs?**
  - As without typed properties, PHP allows any type of value and this cause errors in the code and the program itself.
- **EX: without typed properties**
```php
class User {
    public $age;
}

$user = new User();
$user->age = "twenty"; // wrong but allowed
```
- **EX: with typed properties**
```php
class User {
    public int $age;
}

$user = new User();
$user->age = "twenty"; // ERROR (not allowed)
// PHP will immediately throw an error because the value does not match the expected type.
```
- **Summary**
- Catch errors early .
- Ensure correct data types .
- Make code more reliable and predictable .
- Help developers understand what kind of data is expected .
---
## 5. Constructor Methods
- **What is the__construct() method used for?**
  - It is a special method that runs automatically when you create an object .
- **EX:**
```php
class User {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}
```
- **Why is it useful to pass arguments into a constructor when creating a new object?**
  - Because it ensures the object starts with correct values immediately .
  - Because it initializes object properly .
  - Because it forces required data (like name, id, email) .
  - Because it reduces errors because object is not empty .
- **EX:**
```php
$user = new User("Shahd");
echo $user->name; // Shahd
```
---