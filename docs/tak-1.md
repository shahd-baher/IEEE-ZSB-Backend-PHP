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
 - `PHP` statement ends with `;`.
 - `PHP` statement isn't case sensitive.
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
## 2. String Concatination :
- `String Concatination` means to compine two strings or more together.
- To concatenate strings together we use the `.` operator.
- **EX:**
```php
<?php
$x = "Hello";
$y = " World";
$z = $x . $y;
echo $z;
?>
```
- and the output of this code will be -> `Hello World`.
---
## 3. Booleans and Conditions :
- Conditional statements are used to perform different actions based on different conditions `ex: if....elseif....else` and `PHP` supports (`true` and `false`) values.
- We use `===` sign to check the condition but we use `=` to assign a value to a variable.
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
## 4. Arrays :
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
## 5. Loops :
- We used the loop in the array to print its content so we will talk about the loops :  
**For loop :**
- Loops through a block of code a specified number of times.
- It is used when you know how many times the script should run.
- **EX:**
```php
<?php
for ($x = 0; $x <= 10; $x++) {
  echo "The number is: $x <br>";
}
?>
```
**For-Fach loop :**
- Loops through a block of code for each element in an array or each property in an object.
- **EX:**
```php
<?php
$cars =["Volvo", "BMW", "Toyota"];
  foreach ($cars as $car)
   {
      echo "$car <br>";
   }
?>
```
---
## 6.Functions  :
- A function is a block of statements that can be used repeatedly in a program.
- A function is not executed automatically when a page loads.
- A function is executed only when it is called.
- **Types of functions :**
  -  Built-in Functions.
  -  User Defined Functions.
     - Named functions.
     - Anonymous `"Lambda"` functions.
- **Built-in Functions :**     
  - Functions that can be called directly, from within a script, to perform a specific task.
- **User Defined Functions :**
   - A user-defined function declaration starts with the keyword `function` followed by the name of the function.
   - The opening curly brace { indicates the beginning of the function code, and the closing curly brace } indicates the end of the function.
- **Named functions :**
  -  It is declared by the keyword `function` and it is called `Named function` as we give it a name and it is called anywhere by its name .
  - **EX:**
  ```php
    <?php
   // Filter books by a specific author
   function filterByAuthor(array $books, string $author): array
   {
    $result = [];

    foreach ($books as $book) {
        if ($book["author"] === $author) {
            $result[] = $book;
        }
    }

    return $result;
   }
   $martinBooks = filterByAuthor($books, "Robert C. Martin");
   echo $martinBooks[0]["title"];
   ?>
   ```
- **Anonymous `"Lambda"` functions :**
  - It is a function that has no name and can be assigned to a variable.
  - **EX:**
  ```php
    $filterByAuthor = function ($books,$author){ // notice that we're using "$filterByAuthor" variable
    $filterBooks = [];
    foreach ($books as $book) {
    if($book['author']===$author){
        $filterBooks[]=$book;
      }
    }
    return $filterBooks;
    }
    ?>
    <?php foreach ($filterByAuthor($books,"Philip k.Dick") as $book) : ?> // using the variable to call the function
    <li>
        <a href="<?= $book['purchaseUrl'] ?>">
            <?= $book["name"];?> (<?= $book ['releaseYear'] ?>) - By <?= $book['author'] ?>
        </a>
    </li>
    
    <?php endforeach?>
    ```
    ---
## 7. Superglobals :
- They are built-in variables that are accessible from any where without needing to declare them as global.
**Common Superglobals :**
  - `$GLOBALS` -> An array that contains references to all global variables of the script
  - `$GEt` -> Used to collect data sent via URL.
  - `$_SERVER` -> Holds information about the web server including headers, paths, and script locations.
  - `$_REQUEST` ->  An array containing data from $_GET, $_POST, and $_COOKIE superglobals.
  - `$_POST` -> An array of variables received via the HTTP POST method and Used to collect data from forms.
  - `$_FILES` -> An array of items uploaded to the current script via the HTTP POST method (filename, type, size).
  - `$_ENV` -> Holds environment variables passed to the current script.
  - `&_COOKIE` -> An array of variables passed to the current script via HTTP Cookies and Stores data in the browser.
  - `&SESSION` -> An array of session variables and Stores user session data.
- **EX:**
  ```php
  <?php
  $name = $_GET['name'];
  ?>
  ```
  ---
## 8. Require statement :
- It is used to include files in `PHP`.
- It helps in organizing the code by separating it inti multiple files.
- **Importance :**
   - Improves the code organization.
   - Reduces the repiyition.
   - Makes the maintenance easier.
   - stops execution if a file is missing.
- **EX:**
  ```php 
   <?php
   require "database.php";
   require "functions.php";
   ?>
   ```
   ---
## 9. PDO `"PHP Data Object"`:
- It is a database access method in `PHP` that helps us to connect to database in a secure and flexible way.
- **Advantages :**
  - Supports multiple databases `(MySQL, PostgreSQL, etc.)`.
  - More secure than traditional methods.
  - Works well with prepared statements.
- **EX:**
  ```php 
  $this->connection = new PDO($dsn, $username, $password, [
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
  ```
  ---
## 10. SQL injection :
- It is a security vulnerability where an attacker can manipulate database queries by inserting malicious SQL code.
- This can allow the attacker to access or modify data they shpuldn't have access to.
**EX:**
```php
$query = "SELECT * FROM users WHERE name = '$name'";
```
---
## 11. Prepared Statements :
- They protect against SQL Injection by separating SQL code from user input.
**EX:**
```php
$var = $pdo->prepare("SELECT * FROM users WHERE name = ?");
$var->execute([$name]);
```
- **Why it's safe ?**
  - User input is treated as data only.
  - Prevents execution of malicious SQL.
  ---
