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

## For Windows

1. **Extract the Files**
   - Extract the zip folder to a location on your computer (e.g., `Desktop` or `C:\phpdesktop`). The folder should contain:
     - `phpdesktop-chrome.exe`
     - `www` (Our website files)
     - `settings.json`

2. **Launch the Application**
   - Double-click `phpdesktop-chrome.exe` to open the PHP Desktop application. This will open your website in a browser-like window.

3. **Database Setup**
   - Import the database into your preferred MySQL setup (e.g., XAMPP or MAMP).
   - If you are using XAMPP, ensure that you change the `$password` variable in the `www\config\connect.php` file to:
     ```php
     $password = ""; // Default XAMPP password
     ```
   - Ensure MySQL is running, and the database is successfully imported.

4. **Access the Application**
   - Your website should load automatically. If it doesn't, open the app's address bar and go to: `http://localhost/`

5. **Troubleshooting**
   - If the app closes immediately, enable error reporting in `index.php` by adding these lines at the top of the file:
     ```php
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     ```
   - Look for any errors and ensure the database is correctly set up.

6. **Closing the Application**
   - Simply close the window when you're done. No installation is required.

---

## For Mac

1. **Extract the Files**
   - Extract the zip folder to a location on your Mac (e.g., `Desktop` or `~/phpdesktop`). The folder should contain:
     - `phpdesktop-chrome` (the application to launch PHP Desktop)
     - `www` (Our website files)
     - `settings.json`

2. **Install PHP and MySQL**
   - If you haven't already, install Homebrew (a package manager for macOS) and use it to install PHP and MySQL:
     ```bash
     brew install php
     brew install mysql
     ```
   - Start MySQL with:
     ```bash
     brew services start mysql
     ```

3. **Database Setup**
   - Import the database into MySQL by running:
     ```bash
     mysql -u root -p < path/to/your/InnovationEngine.sql
     ```
   - Update the `www/config/connect.php` file with the correct password (for MySQL):
     ```php
     $password = ""; // Default MySQL password on Mac
     ```

4. **Launch the Application**
   - Open the `phpdesktop-chrome` application from the extracted folder. This will launch the application in a browser-like window.

5. **Access the Application**
   - Your website should load automatically. If not, open the app's address bar and go to: `http://localhost/`

6. **Troubleshooting**
   - If the app closes immediately, enable error reporting in `index.php` by adding these lines at the top of the file:
     ```php
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     ```
   - Look for any errors and ensure the database is correctly set up.

7. **Closing the Application**
   - Simply close the window when you're done. No installation is required.

---

**Optional:** You can also set up a Virtual Machine (VM) to run the application if needed.

