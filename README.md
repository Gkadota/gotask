# GoTask

<br>

## How to Setup Backend:
#### Install vendor packages:
```composer
composer install
```
<br> 

> #### Note: Create **.env** file using ***.env.example***

<br> 


#### Generate Laravel key:
```composer
php artisan key:generate
```

#### Run the app using laravel Sail:
```composer
./vendor/bin/sail up
```

#### Migrate Database:
```composer
sail artisan migrate:refresh --seed
```

<br>

## How to Setup Frontend:

#### Install Dependecies:
```bash
npm run install
```

#### Start development server:
```bash
npm run dev
```

<br>

### Then visit the app on: http://localhost:3000

> ## Note: You can visit the **Part 2** test on http://localhost:3000/profile

<br>

## Default Accounts
| Email | Password
 |--- | --- |
| johndoe@gmail.com | password

