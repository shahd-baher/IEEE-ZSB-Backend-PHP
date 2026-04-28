# MVC Framework
## 1. The Controller's Job
- **If a user clicks a button to "View Profile," what exactly does the Controller do before sending the final page back to the user?**
  -  The Controller receives the request first then decides what to do, so it:
  - Calls the Model to fetch the user data (like `name, email`, etc.)
  -  Processes or organizes this data if needed.
  - Chooses the correct View (profile page).
  - Sends the data to the View to be displayed.
---
## 2. Dynamic Views
- **What is the difference between a static HTML file and a dynamic PHP View?** 
- A **`static HTML file`** always shows the same content every time it loads. 
- A **`dynamic PHP View`** can change its content based on data as it can display different usernames, posts, or messages depending on the user or database results.
---
## 3.Data Passing
- **How does a Controller pass data (like a user's name fetched from the database) into a View so it can be displayed on the screen?**
  - It passes the data to the view using the variables.
- **Example:**
```php
$data = ["name" => "Shahd"];
return view("profile", $data);
<h1>Hello, <?php echo $name; ?></h1>
// So the View can display the data sent by the Controller.
```
## 4.Templating (Headers & Footers)
- **How does the MVC structure help you avoid copying and pasting the exact same navigation bar and footer code on every single page of your website?**
- Instead of repeating code on every page, MVC uses reusable components as it creates separate files as :
  - `header.php`
  - `footer.php`
- **Example: Using them in Views:**
```php
include "header.php";
include "footer.php";
// This reduces duplication and makes updates easier.
```
---
## 5. Logic in Views:
- **Why is it considered a bad practice to put complex if statements and heavy data-processing loops directly inside your View files?**
- **`Because :`** 
  - It breaks separation of concerns.
  - It makes code harder to read.
  - It is difficlt to be maintained and debugged.
- **Note:**  
  - Views should only display data, not process it.
## Summary
- The Controller handles requests and connects Model with View.
- Dynamic Views display changing data, unlike static HTML.
- Data is passed from Controller to View using variables.
- Templating avoids repeating header and footer code.
- Keep logic out of Views to maintain clean and organized code.
---