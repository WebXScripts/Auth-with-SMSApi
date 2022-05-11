
# Auth-with-SMSApi

Simple auth with 2fa authorization provided by SMSApi.pl



## Features

- 5-character SMS code message (ex. 5W4f3).
- User can't access dashboard without pass 2fa auth.
- Code resend.


## Run locally

```bash
  #Edit SMSAPI_TOKEN in .env
  nano .env
  #Migrate & start
  php artisan migrate
  php artisan serve

  #(Optional) Change $message->from in app/Models/User.php
```

## Based on

 - [Laravel](https://github.com/laravel/laravel)
 - [SMSApi](https://github.com/smsapi/smsapi-php-client)


## Authors

- [@WebXScripts](https://github.com/WebXScripts)

