## 1. Directory Structure & Organization 
- **Refactoring** -> Controllers and views are grouped by resources (ex: `controllers/notes/` , `views/notes/`).
- **Public Directory** -> `index.php` is moved to `/public` to prevent direct access on core files.
- **Core Directory** -> The infrastructure of the classes (Database , Router , Validator) are isolated in `/core`.
---
## 2. RESTful Conventions 
- It is a standardized naming for controllers to maintain consistency across the application.   

 |Method|URI|Controller|Acyion|
 |:----:|:-:|:--------:|:----:|
 |GET|`/notes`|`index.php`|List all resources|
 |GET|`/note`|`show.php`|View single resource|
 |GET|`/notes/create`|`create.php`|Show create form|
 |POST|`/notes`|`store.php`|Save new resources|
 |GET|`/notes/edit`|`edit.php`|Show edit forms|
 |PATCH|`/notes`|`update.php`|Update resources|
 |DELETE|`/notes`|`destroy.php`|Delete resources|
 ---
 ## 3. Core Helpers & Autoloading
 - `basebath()` -> A helper to resolve absolute paths from the project root.  
 **EX:**
  ```php
     // public/index.php
     define('BASE_PATH', dirname(__DIR__));

     // core/functions.php
     function basePath(string $path): string
     {
        return BASE_PATH . '/' . $path;
     }

     // Usage anywhere in the project
     require basePath('config.php');
     require basePath('views/notes/index.view.php');
 ```
-`view()` -> A function used to load views an `extract()` data variables into the view scope.
 **EX:**
  ```php
      // core/functions.php
      function view(string $path, array $attributes = []): void
     {
        extract($attributes);
       require basePath("views/{$path}");
     }

     //Usage in controllers
     view('notes/index.view.php', [
     'heading' => 'My Notes',
     'notes'   => $notes,
     ]);
 ```
- `Autoloading` -> It uses `spl_autoload_register` to automatically load classes based on their **Namespaces** , mapping `core\Database` to `core/Database.php`.
 **EX:**
```php
     spl_autoload_register(function ($class) {
     $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
     require basePath("{$class}.php");
     });
```
---
## 4. Advanced Routing & Middleware
- The Router is upgraded from a simple array **to a class-based system**.  
 **EX:**
```php
 namespace Core;

class Router
{
    protected $routes = [];

    public function add(string $method, string $uri, string $controller): static
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => strtoupper($method),
            'middleware' => null,
        ];

        return $this;
    }

    public function get(string $uri, string $controller): static
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): static
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete(string $uri, string $controller): static
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch(string $uri, string $controller): static
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, string $controller): static
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                require basePath($route['controller']);
                return;
            }
        }

        $this->abort();
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        require basePath("views/{$code}.php");
        die();
    }
}
```
  - **Method Routing** -> It supports specific `HTTP` verbs like **(GET, POST, PATCH, DELETE)**.  
      **EX:**
```php
<form method="POST" action="/notes">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="id" value="<?= $note['id'] ?>">
    <button type="submit">Delete</button>
</form>
 ```
  - **Method Spoofing** -> Since HTML forms supports only `GET/POST` , a hidden `_method` input is used to simulate `PATCH` and `DELETE`.
  - **Middleware** -> It is an added layer to filter requests.
    - `Auth` -> Allows only **Logged-in** users.  
    **Ex:**
    ```php
       namespace Core\Middleware;
       class Auth
        {
           public function handle(): void
           {
              if (! ($_SESSION['user'] ?? false)) {
              header('Location: /login');
              exit();
                       }
           }
        }
    ```    
    - `Guest` -> Allows only **Non-Logged-in** users.
        **Ex:**
    ```php
       namespace Core\Middleware;
       class Guest
        {
          public function handle(): void
          {
            if ($_SESSION['user'] ?? false) {
            header('Location: /');
            exit();
                                            }
          }
        }
    ``` 
---
## 5. Dependency Injection Container
- It Introduced a **Service Container** to merge objects instantiations.
  - `Container.php` -> Store `"bindings"` for objects like database.
  - `App.php` -> A static facade (Singleton pattern) to resolve dependencies anywhere in the app using `App::resolve()`
- **Benifits :**
  - Eliminates the need to manually create `$db` instances in every controller.    

 **Ex:**
 ```php 
namespace Core;

class Container
{
    protected array $bindings = [];

    public function bind(string $key, callable $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key): mixed
    {
        if (! array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding found for key {$key}.");
        }

        return call_user_func($this->bindings[$key]);
    }
}
```
---
## 6. CRUD Operations Logic
- Each CRUD actions follows some strict steps:
  1. **Authorization** -> Verifying if the user owns the resources (eg:`$note['user_id'] === $currentUserId`).
  2. **Validation** -> Use the `Validator` Class to check inputs.
  3. **Execution** -> Running the `SQL` query through the database class.
  4. **Redirection** -> Using `header('Location: ...')` to navigate a way after `POST/PATCH/DELETE`.
---
## 7. Authentication & Security
- **Session Management** -> Uses `session_start()` and `$_SESSION` to persist user state.   
**EX:**
```php
session_start();

// Write to the session
$_SESSION['user'] = ['email' => $user['email']];

// Read from the session
$email = $_SESSION['user']['email'] ?? 'guest';
```
- **Password Hashing** -> Uses `password_hassh()` with `BCRYPT` for storsge and `password_verify()` for login.
**EX:**
```php
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// Store $hashedPassword in the database
```
- **Registration/Login Flow** -> Validates the input , Checks for the existing users and regenerates session IDs to prevent fixation attacks.
```php
//login() Helper — core/functions.php
function login(array $user): void
{
    $_SESSION['user'] = [
        'email' => $user['email'],
    ];
}

//Login — controllers/sessions/store.php
use Core\App;
use Core\Database;
use Core\Validator;

$db       = App::resolve(Database::class);
$email    = $_POST['email'];
$password = $_POST['password'];
$errors   = [];

if (! Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (! Validator::string($password, 1, 255)) {
    $errors['password'] = 'Please provide your password.';
}

if (! empty($errors)) {
    return view('sessions/create.view.php', ['errors' => $errors]);
}

$user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->fetch();

// Intentionally vague error — don't reveal whether the email exists
if (! $user || ! password_verify($password, $user['password'])) {
    $errors['email'] = 'No matching account found for those credentials.';
    return view('sessions/create.view.php', ['errors' => $errors]);
}

login($user);

header('Location: /');
exit();
```
- **Secure Logouts** -> It is a 4-step process : 
  1. Clearing `$$_SESSION`.
  2. Destroying the session.
  3. Removing the cookie.
  4. Redirecting.
```php
//  Logout — controllers/sessions/destroy.php
// 1. Clear the session data
$_SESSION = [];

// 2. Delete the server-side session file
session_destroy();

// 3. Expire the session cookie in the browser
$params = session_get_cookie_params();
setcookie(
    'PHPSESSID',
    '',
    time() - 3600,
    $params['path'],
    $params['domain'],
    $params['secure'],
    $params['httponly']
);

// 4. Redirect
header('Location: /');
exit();
```
---
