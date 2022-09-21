# NOTAS

- laravel new nuxthouse
- cd nuxthouse
- php artisan serve  
- edit .env
  - database
  - smtp: mailtrap = fake email

- composer require laravel/ui
- php artisan ui bootstrap --auth

## JWT

- composer require php-open-source-saver/jwt-auth  
- php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
- php artisan jwt:secret
- edit Models/User + config/auth.php

1. Register user

    - composer require grimzy/laravel-mysql-spatial:^5.0  
    - add datatype point() for migrations
    - edit $fillable (User.php) and migrations_user
    - edit User.php -> spatialTrait
    - edit REgisterController
    - validator, create, registered

2. Verify user

    - edit api.php
    - php artisan make:notification VerifyEmail (override)
    - edit config/app.php
    - edit User.php --> extends mustverifyEmail
    - edit verificationController

3. login  
4. logout  
5. get ME  
    - artisan make:controller **User/MeController**
    - artisan make:resource UserResources
6. reset password
7. settings profile/password
    - artisan make:controller **User/SettingsController**

8. desing table = UPLOAD IMAGE
    - art make:model Design -m
    - edit api.php
    - edit $fillable && migration_design
    - create config/site.php
    - art make:migration add_fields_to_designs --table=designs
    - art migrate

9. REPOSITORY PATTERN
    - create folder Repositories/Contracts
    - create folder Repositories/Eloquent
    - create files Repositories/Contracts/IUser
    - create folder Repositories/Contracts/UserRepository
    - art make:provider RepositoryServiceProvider
    
### LINKs

[spatial](https://github.com/grimzy/laravel-mysql-spatial)
[jwt](https://morioh.com/p/2c79e62dd5bb)
