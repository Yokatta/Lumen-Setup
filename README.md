
Please have docker installed before running this project.

navagate to project folder and run: docker-compose up -d

run: cp .env.example .env

for testing postman is suggested since its just API with no frontend.

for php enviroment please run: docker-compose exec lumen sh

to migrate the database and the schema and test user data run inside docker container lumen sh: php artisan migrate --seed

test login with users listed in DatabaseSeeder.php OR use the signup api.

copy the token response and add it to your bearer headers to use the apis or else you will get unauth response.

Cheers, 
Drew
