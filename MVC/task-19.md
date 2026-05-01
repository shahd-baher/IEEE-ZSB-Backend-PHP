# MVC Framework
## 1. Which part of MVC talks to the database? Why?
- The `Model` is the only component that should communicate directly with the database.
- **Why?**
- Because :
  - The Model is responsible for handling data and business logic.
  - It ensures separation of concerns, meaning each part of the application has a clear role.
  - If Controllers or Views accessed the database directly, the code would become messy, harder to maintain, and less secure.  
- So, the Controller asks the Model for data, and the Model handles all database interactions.
---
## 2. Why should we store sensitive information in a separate configuration file?
- **The reasons are :**
  - **`Security:`** If the main code is shared or uploaded publicly, credentials won’t be exposed. 
  - **`Flexibility:`** You can change settings (like switching databases) without modifying core code.
  - **`Environment management:`** Different environments (development, testing, production) can use different configs.
  - **`Cleaner code:`** Keeps your application organized and easier to maintain.
---
## 3. What is a PDO in PHP, and why is it preferred?
- PDO `"PHP Data Objects"` -> It is a database access layer that provides a consistent interface for working with different databases.
- **Why it is preferred over mysqli?**
-- **The reasons are :**
  - **`Security:`** PDO supports prepared statements by default.
  - **`Database flexibility:`** PDO supports multiple databases (MySQL, PostgreSQL, SQLite, etc.), while mysqli supports only MySQL.
  - **`Error handling:`** Offers better exception handling.
  - **`Cleaner API:`** More structured and easier to use in modern applications.
---
## 4. How do Prepared Statements protect against SQL Injection?
- **How does they work?**
  - The SQL query is written with placeholders
  ```SQL
  SELECT * FROM users WHERE email = ?
  ```
  - User input is sent separately.
  - The database treats input strictly as data, not executable SQL.
- **Why this is secure?**
  - As even if a user enters malicious input (like SQL commands), it will not be executed as part of the query.
---
## 5. Single row vs Multiple rows
- **`Single Row Example`**
- **`When a user logs in:`** 
  - You search for a user by email.
  - Only one record should match.
- **EX:**  
 ```SQL
  SELECT * FROM users WHERE email = 'user@example.com';
  ```
- **`Multiple Row Example`**
- **`When displaying a list of products:`** 
  - You need all products in a category.
- **EX:**  
 ```SQL
 SELECT * FROM products WHERE category = 'electronics';
  ```
  ---
## Summary
- The Model is responsible for database communication.
- Store sensitive data in configuration files for better security and flexibility.
- PDO is preferred because it supports multiple databases and is more secure.
- Prepared statements prevent SQL injection by separating code from input.
- Use single row queries for unique data (like login) and multiple rows for lists (like products).
---