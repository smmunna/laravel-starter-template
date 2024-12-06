## Laravel Starter Template 2024
**You can use it for `server` as well as `Frontend+Backend` both.
**laravel/framework": "^10.10"**
**"php": "^8.1"**
### Frontend Purpose -Follow this way
1. After cloning the starter template , you need to run those commands for setup the authentication for laravel app when you will use it for frontend purposes.
   1. Clone repository first
      ```javascript
      https://github.com/smmunna/laravel-starter-template.git
      ```
	```javascript
      cd laravel-starter-template
      ```
      ```javascript
      composer install
      ```
      Remove the authorization of this repository
      ```javascript
         git remote rm origin
      ```
   2. goto `.env` file at the root of your project and write your own database name
   3. goto `create_users` migration file to add anyother columns whatever your need.
   4. Then run these commands
   ```javascript
    php artisan migrate
   ```
2. Delete the `uploads` folder from at the root `public/uploads` and run this command for managing the file management
```javascript
php artisan storage:link
```
1. Now register as `new user` then `login` and
   ```javascript
    http://localhost:8000/login
   ```
   ```javascript
    http://localhost:8000/register
   ```
2. `/logout` url will be logout the session

### Backend Purpose(Rest API)

1. Goto this route to show json data
```javascript
http://localhost:8000/api/users
```