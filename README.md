# Read It

This web application is for users to share and read posts related to different subjects (forums).  Often this can be a replacement for a
blog for standalone forum

1. Download/clone the code package
2. Composer install dependencies
3. Copy .env.example, create new file called .env
4. php artisan key:generate
5. Start web server PHP/MySQL
6. Create database for project
7. Update .env file with MySQL settings
8. Update .env file with APP_URL 
   1. (default is htpp://localhost, may need to change to index URL when 'php artisan serve' e.g. http://127.0.0.1)
9. php artisan migrate:fresh
10. php artisan dusk:install
    1. delete ExampleTest from /tests/Browser as it will fail 
11. Create 'Unit' folder in /tests
12. php artisan serve
13. (in another terminal instance as website needs to be running) php artisan test && php artisan dusk
14. If passed, the test data can be replaced using php artisan migrate:fresh --seed
15. Website should function as expected now
    1. If database is seeded as above, test user account details are:
       1. email => 'admin@email.com'
       2. password => 'password'
