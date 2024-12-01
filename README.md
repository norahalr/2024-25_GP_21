# 2024-25_GP_21
## Project Title: Innovation Engine.
### Introduction 
#### Our website addresses the challenges students and supervisors face in managing graduation projects by enhancing coordination and efficiency. The centralized system allows students to submit project ideas and match with available supervisors based on expertise and preferences. This reduces delays and frustration, while a built-in feature checks for project duplication, encouraging innovation.

#### Additionally, the platform fosters interdisciplinary collaboration, enabling faculties to request support from other departments. This promotes knowledge sharing and effective teamwork across various disciplines.

### Technology:
#### Backend: Python 
#### Frontend: HTML, CSS, JavaScript
#### Database: MySQL

# Instructions for Opening and Launching the Application


1. **Download and Extract the Files**
   - Clone or download the repository to your local machine. The repository should contain the following files and folders:
     - `.vscode/` (VS Code configuration folder)
     - `home page/` (Website files)
     - `Innovation/` (Project files)
     - `db/` (Database SQL file)
     - `AUTHORS` (List of authors)
     - `README.md` (This file)
     - place the folder in "C:\MAMP\htdocs"

2. **Install MAMP**
   - Download and install [MAMP](https://www.mamp.info/en/).
   - MAMP provides a local server environment (Apache, MySQL, PHP) for Windows.

3. **Database Setup**
   - Import the database into MySQL via MAMP:
     - Open MAMP and start the servers (Apache and MySQL).
     - Open the MAMP MySQL Admin panel (phpMyAdmin).
     - Create a new database (e.g., `InnovationEngine`).
     - Import the `db/InnovationEngine.sql` file into the newly created database.

4. **Configure Database Connection**
   - Open the `home page/config/connect.php` file in a text editor (e.g., VS Code).
   - Set the database connection details:
     ```php
     $host = 'localhost'; // MAMP default host
     $db = 'InnovationEngine'; // Database name
     $username = 'root'; // Default MAMP username
     $password = 'root'; // Default MAMP password or (empty by default)
     ```

5. **Launch the Application**
   - Open the `"C:\MAMP\htdocs\2024-25_GP_21\Innovation\index.php"` file  using [VS Code](https://code.visualstudio.com/).
   - Right-click on the `index.php` file in VS Code and select "Open with Live Server" to launch the website.
   - Alternatively, you can navigate to `http://localhost` in your web browser.

6. **Access the Application**
   - Your website should load automatically. If it doesn't, open the app's address bar and go to: `http://localhost/`.

7. **Troubleshooting**
   - If the app closes immediately, enable error reporting in `index.php` by adding these lines at the top of the file:
     ```php
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     ```
   - Check the PHP settings in VS Code:
     - Ensure that the `php` executable is correctly set in your system PATH or configure it in VS Code's settings.
     - Check that the PHP version in MAMP matches the version specified in your code.

8. **Closing the Application**
   - Simply close the window when you're done. No installation is required.


