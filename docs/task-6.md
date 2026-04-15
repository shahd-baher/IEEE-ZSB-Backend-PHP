# Continue PHP Security
## 1. HTTPS
- Always use **`HTTPS`** instead of **`HTTP`** but **Why ?**  
- **Because :**
  - It Encrypts data using SSL/TLS .
  - It Protects sensitive data (passwords, sessions) .
  - It Prevents Man-In-The-Middle (MITM) attacks .
- **Risks of `HTTP`:**
  - Data is sent as plain text.
  - Easy to be intercepted and stolen.
```php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}
```
---
## 2. Protect Directory with Firewall
- **Why ?**
  - Because it blocks unauthorized access.
  - Because it prevents brute-force & scanning attacks.
- **How can we do this ?**
  - By using Web Application Firewalls **(WAF)** like `Cloudflare` and `ModSecurity`.
---
## 3. Protect Directory with IP
- **Why ?**
  - Because it restricts access to specific IPs.
  - Because it is useful for admin panels.
- **EX:.htaccess**
```SQL
   Order Deny,Allow
   Deny from all
   Allow from 192.168.1.1
```
---
## 4. Prevent Executing Specific Files
- **Why ?**
  - Because it prevents execution of malicious files.
```php
<FilesMatch "\.(php|exe|sh)$">
    Deny from all
</FilesMatch>
```
---
## 5. Securing Uploads
- **Why ?**
  - Because it stores files outside public directory .
  - Because it validates file extension .
  - Because it checks MIME type .
  - Because it renames uploaded files .
  - Because it limits file size .
  - Because it disables script execution in upload folder .
- **Risks :**
  - It may causes Uploading malware or shell scripts .
  - It may causes Executing malicious files on server .
- **EX:.htaccess protection**
```php
<FilesMatch "\.php$">
    Deny from all
</FilesMatch>
```
- **EX: MIME Type Check**
```php
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$type = finfo_file($finfo, $_FILES['file']['tmp_name']);

if ($type !== 'image/jpeg') {
    die("Invalid MIME type");
}
```
- **EX: Extension Validation**
```php
$allowed = ['jpg', 'png', 'pdf'];
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if (!in_array($ext, $allowed)) {
    die("Invalid file type");
}
```
---
## 6. Fix Error Logs
- **Risks :**
  - The Errors may expose sensitive info (paths, database).
- **Prevention :**
  - Disable error display in production .
  - Use Log errors instead .
```php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_log("Error message");
```
---
## 7. Backend Validation
- **Why ?**
  - Because Frontend validation can be bypassed .
  - Because it Protects against XSS & SQL Injection .
```php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if (!$email) {
    die("Invalid email");
}
```
---
## 8. Prevent Session Fixation
- **Risks :**
  - The Attacker sets a known session ID .
- **Prevention :**
  - Regenerating session ID after login .
```php
session_start();
// After login
session_regenerate_id(true);
```
---
## **`Summary`**
- Always use HTTPS .
- Protect directories (Firewall + IP) .
- Secure file uploads carefully .
- Hide errors in production .
- Validate all inputs in backend .
- Secure sessions .