# Universidad De Dagupan Library Feedback App

An application for storing feedback for the library of Universidad De Dagupan.

## Applications required

- XAMPP
- A web browser (ex. Firefox, Chrome, Edge)

## Installation

Before starting, make sure you clone or download the repository to your local machine. Example below shows the repository files within the xampp/htdocs directory (recommended for virtual host configuration).

![repo_directory](readme_images/repo_directory.png)

### Database

Create a database using XAMPP with phpmyadmin, the database name should be named 'feedback_app'. After creating the database, import the 'feedback_app.sql' file that is inside the repository.

Creating a database
![database_create](readme_images/database_create.png)

Importing a database
![database_import](readme_images/database_import.png)

Database records examples

feedback table
![database_feedback](readme_images/feedback.png)

admin_accounts table
![database_admin_accounts](readme_images/admin_accounts.png)

## Running the application

### Running application with built-in PHP server

Open the XAMPP control panel as administrator and start the Apache and MySQL servers, these are needed so that we could run our application.

Open the terminal and change directory into the udd-library-feedback-app/public directory. After that enter the command below to start the application.

`php -S localhost:8080`

You can use any free port number on your local machine, port 8080 is being used for demonstration purposes. Type in 'localhost:8080' in the browser to view the webpage.

![database_admin_accounts](readme_images/index.png)

### Admin account default credentials

Make sure to change these credentials before deploying the application.

```
Username: admin
Password: uddlibrary
```

### Running the application with XAMPP's virtual hosts

Add virtual host to Apache(httpd.conf) file

File location (assuming you are using Windows and it is installed in the C
drive):
`C:\xampp\apache\conf\extra\httpd-vhosts.conf`

Paste the following virtual host in the file, this virtual host assumes that you put your file inside the xampp/htdocs directory.

```
## Virtual host for feedback app
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\udd-library-feedback-app\public"

    ServerName uddfeedback.local
    <Directory "C:\xampp\htdocs\udd-library-feedback-app\public">
        RewriteEngine On

        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php [L]
    </Directory>
</VirtualHost>
```

![virtual_host](readme_images/virtual_host.png)

Add the following to the hosts file in Windows

Hosts location:
`C:\Windows\System32\drivers\etc\hosts`

```
# UdD Library Feedback app
127.0.0.1 uddfeedback.local
```

![hosts](readme_images/hosts.png)

After adding these configurations, restart the Apache and MySQL server and type in `uddfeedback.local` in the web browser to access the webpage.

![uddfeedback.local](readme_images/uddfeedback.local.png)

## Pages

### Index

![feedback_index](readme_images/index.png)

### Submit Feedback

![feedback_submit](readme_images/feedback/submit_feedback.png)

### Login Admin

![feedback_admin_login](readme_images/feedback/admin_login.png)

### Admin Dashboard (Admin Account)

![admin_dashboard](readme_images/admin/admin_dashboard.png)

### Admin Search (Admin Account)

![admin_search](readme_images/admin/admin_search.png)

### Admin Search Details (Admin Account)

![admin_search_details](readme_images/admin/admin_search_details.png)

### Admin Accounts (Admin Account)

![admin_accounts](readme_images/admin/admin_accounts.png)

### Admin Account (Admin Account)

![admin_account](readme_images/admin/admin_account.png)

### Admin Account Edit (Admin Account)

![admin_account_edit](readme_images/admin/admin_edit.png)

### Admin Account Delete (Admin Account)

![admin_account_delete](readme_images/admin/admin_delete.png)

### Admin Search Details (Master Account)

![master_search_details](readme_images/admin/master_search_details.png)

### Admin Search Edit (Master Account)

![master_search_edit](readme_images/admin/master_search_edit.png)

### Admin Search Delete (Master Account)

![master_search_delete](readme_images/admin/master_search_delete.png)

### Admin Accounts (Master Account)

![master_admin_accounts](readme_images/admin/master_accounts.png)

### Admin Accounts Add (Master Account)

![master_admin_accounts_add](readme_images/admin/master_accounts_add.png)

### Admin Accounts Edit (Master Account)

![master_admin_accounts_edit](readme_images/admin/master_accounts_edit.png)

### Admin Accounts Delete (Master Account)

![master_admin_accounts_delete](readme_images/admin/master_accounts_delete.png)

### Admin Logout

![admin_logout](readme_images/admin/admin_logout.png)
