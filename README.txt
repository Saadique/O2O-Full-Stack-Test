-----------Setting up the Backend API services in local server---------

Requirements
  -- xampp/wampp server package
  -- Composer (PHP package manager)
  -- Laravel Framework
  
1. Create a database with the name "O2OeventsExam" 
   and set it up on MySql server hosted on 127.0.0.1:3306(localhost:3306).
   
2. Open terminal on O2O-Full-Stack-Test and type the command "php artisan passport:install", to
   create laravel passport client.
   
3. Then type "php artisan migrate", to generate database migration.

4. Then type "php artisan serve" to run the services on localhost(default port http://127.0.0.1:8000)

-note-
https://drive.google.com/drive/folders/1endjTcyHqMzygMDBQ0YdVMW_kRzkcCxS

In the above link I have attached the postman collection with all the APIs
which can be tested seperatly.