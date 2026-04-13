# `Security in PHP`
## What's meant by `security`?
- It is the state of being protected or safe.
## Some tips to increase the security :
- Use framework (Laravel , Symphony).
- Use Templates Engines (Smarty).
- Update to the latest version.
- Maintain the code.
- Follow Exploits websites.
- Follow Security Specialists.
- Use Kali Linux when it comes to presentation testing.
## Why `Web security` is important?
- Websites are public.
- Users add personal information.
## Input Handling 
- **Validation**
  - Type(int,string,email,password,...).
  - Length.
  - Format.
- **Sanitization**
  - Removing and escaping harmful data.
**`Note`**
- Most Vulnerabilities happens with input.
## Common Vulnerabilities
- `XSS` (Cross-Site Scripting)
  - Injecting malicious JS into pages.
  - **Risks**
    - Stealing cookies/sessions.
    - Defacing pages.
  - **Prevention**
    - Input Filtering :
       - It is a security mechanism designed to detect and block cross-site scripting (XSS) attempts by inspecting user input for potentially harmful scripts.
       ```php
          filter_var($email, FILTER_SANITIZE_EMAIL);
       ```
- `SQL Injection`
  - Injecting SQL commands through the inputs.
  - **Risks**
    - Data leak.
    - Data deleting.
    - Data modifying.
  - **Prevention**
    - Using prepared statements.
    ```php
       $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
       $stmt->execute([$email]);
    ```
- `Remote File Injection`
  - Injecting or loading malicious files from external sources and Often related to RFI or insecure file uploads.
   - **Risks**
     - Remote Code Execution (RCE).
     - Full system compromise.
     - Data theft or manipulation.
     - Backdoor installation.
   - **Prevention**
     - Disable remote file inclusion.
     ```php
        allow_url_include = Off
     ```
     - Validate and restrict input (whitelisting).
     - Avoid dynamic file inclusion.
     - Secure file uploads (limit types, rename files).
     - Store uploads outside web root.
     - Apply least privilege permissions.
- `Password Security`
  - Don't store plain text in passwords.
  - Always Hash Passwords.
  ```php
     password_hash($password, PASSWORD_DEFAULT);
  ```
  - **Note :** Use password_verify() to verify passwords and to protect users if database leaked.
- Error Handling -> `Production`
  - Controlling error display to the user.
  - **Risks**
    - Detection of file paths.
    - Detection of database structure.
    - Detection of system logic.
  - **Prevention**
    - Disable error display in production.
    ```php
       display_errors = Off
    ```
    - instead of displaying log errors
    ```php
       log_errors = On
    ```
- `Directory Listing`
  - Prevents displaying folder contents when there is no index file.
  - **Risks**
    - Attacker can see file names.
    - Attacker can see sensitive files (configs / backups).
    - Helps the attacker to plan an attack.
  - **Prevention**
    - Disable Directory Listing in the server or put `index.php` or `index.html` in each folder.
    ```php
       Options -Indexes
    ```
- `Header Location Redirect`
  - It is used to redirect the user to another page.
  ```php
     header("Location: test.php"); 
  ```
  - **Risks**
    - `Open Redirect` -> The attacker can redirect users to a malicious website.
    - `Phishing` -> Abusing your trusted domain to trick users into visiting fake sites.
  - **Prevention**
    - Do NOT use user input directly.
    - Use a whitelist of allowed pages.
    ```php
       $allowed = ["home.php", "profile.php"];
    ```
    - Validate and sanitize input.
    - Use relative paths only.
    - Always stop execution after redirect.
    ```php
       header("Location: home.php");
       exit;
    ```
**Notes**
- Security is continuous and important.
- Input handling is the most important point.