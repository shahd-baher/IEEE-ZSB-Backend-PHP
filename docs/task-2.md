## 1. Database Schema and Structure :
- **Table Creation** -> Creating the `notes` table for the content and the `users` table for the users details.
- **Relationships** -> Making a **foreign key** `(user_id)` in the notes table to link each note with its creator.
- **Data Integrity** -> Using unique indices to prevent multiple accounts from using the same email.
- **Note :** using `cascade delete` to automatically delete a user's note if their accounts are deleted to keep the data consistent.
---
## 2. Routing and Controllers :
- **Dynamic Navigation** -> Adding `"Notes"` links to the navigation bar and registering new URI patterns.
- **The Request Cycle** -> Understanding how a Route leads to a Controller, which fetches data and then passes it to a View for rendering.
- **Data Display** -> Using `foreach` loops in PHP views to dynamically list notes retrieved from the database.
- **EX:**
```php
function routeToController($uri, $routes, $USER_ID = 1) {
    if (array_key_exists($uri, $routes))
        require $routes[$uri];
    else
        abort();
}
```
---
## 3. Authorization :
- **Security Logic** -> Preventing `"ID Hacking"` where a user tries to view another user's notes by manually changing the ID in the URL.
- **Status Codes** ->  `404 (Not Found)` -> Used if a note doesn't exist.
  - `403 (Forbidden)` -> Used if a note exists but the current user doesn't own it.
- **Readability** -> Replacing **"Magic Numbers"** `(like 403)` with descriptive constants `(like Response::FORBIDDEN)` to make code easier to read for other developers.
- **EX:**
```php
<?php
 
class Response {
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
}
```
---
## 4. Code Refactoring `(Database Class)` :
- **Abstraction** -> Creating a custom Database class to wrap PDO, providing cleaner methods like `find()` and `findOrFail()`.
- **EX:**
```php
<?php
 
class Database
{
    public $connection;
    public $statement;
 
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
 
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
 
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
 
        return $this;
    }
 
    public function findAll()
    {
        return $this->statement->fetchAll();
    }
 
    public function find()
    {
        return $this->statement->fetch();
    }
 
    public function findOrFail()
    {
        $result = $this->find();
 
        if (!$result) {
            abort();
        }
 
        return $result;
    }
}
```
- **Helper Functions** -> Writing a global `authorize()` function to keep permission checks consistent and dry (Don't Repeat Yourself).
- **EX:**
```php
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}
```
---
## 5. Validation :
- It prevents empty or incorrect data from being submitted to the database as it ensures its integrity.
- **Imprtance :**
  - It prevents empty or invalid data.
  - It improves application security.
  - It protects the database from wrong and invalid input.
- **Security Check** -> we use `htmlspecialchars()` to escape untrusted and malicious user input and prevent XSS vulnerabilities.
- **EX:**
```php
<?php foreach ($notes as $note) :  ?>
                <li>
                    <a href='/note?id=<?= $note['id'] ?>' class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($note['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
 ```
 ---