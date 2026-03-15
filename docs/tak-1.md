# Documentation for basics of `PHP`
- First of all `PHP` is used in :
  - Creating dynamic webpages.
  - Dealing with database.
  - Session management.
  - Dealing with files and forums.
- `PHP` can be written in the same file with `html` but to recognize its code we put its code between `<?php code of?>`.
- **EX:**
 ```php
 <!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo 'Hello World!';
?>

</body>
</html>
```
## 1. Variables and Printing them :
- Variables are containers for storing information and they have many types like `(string , int , bool)` and in `PHP` the data type depends on the value assigned to the variable.
- The variable must start with `$` sign followed by the name of the variable.
- **EX:**
```php
$name="Amir";
$num=18;
```
- To print the variables or texts we have two ways :
 - `echo`
 - `print` 

| echo | print |
|:----:|:-----:|
| Has no return valye | Has return value of `1` so it is used in expressions |
| Can take multiple parameteres | Takes one parameter |
| Fast | Slow |
- **EX:**
```php
   <?php
   $greeting="Hi!";
   //using echo
   echo $greeting;
   //using print
   print $greeting;
   //using echo with multiple parameters
   echo "Hi"," ","Amir!";
   ?>
   ```
   ---
## 2. Booleans and Conditions :
- Conditional statements are used to perform different actions based on different conditions `ex: if....elseif....else` and `PHP` supports (`true` and `false`) values.
- **EX:**
```php
<?php
 $num=6;
 if($num>0)
 {
    echo "The num is positive"
 }
 else
 {
    echo "The num is negative"
 }
?>
```
---
## 3. Arrays :
- An array is a special variable that can hold many values under a single name.
- **There are many types of arrays :**
 - Indexed arrays -> Arrays with a numeric index.
 - Associative arrays -> Arrays with named keys.
- **EX: Indexed arrays**
```php
<?php
  $cars =["Volvo", "BMW", "Toyota"];
  foreach ($cars as $car)
   {
      echo "$car <br>";
   }
?>
```
- **EX: Associative arrays**
```php
<?php
  $car = [
    ["brand"=>"Ford",
     "model"=>"Mustang", 
     "year"=>1964],
    ["brand"=>"Kia",
     "model"=>"K3", 
     "year"=>2013],
  ];
echo $car["model"];
?>
```
---
