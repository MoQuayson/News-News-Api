
# About News-News Api

A news aggregator web api in Laravel 9
(Backend service for News-News. The url link to the [frontend project](https://www.github.com/MoQuayson/News-News)

## Run Locally

### Clone the project

```bash
  git clone https://github.com/MoQuayson/News-News-Api.git news_news_api
```

### Go to the project directory

```bash
  cd  news_news_api
```

### Install dependencies

#### Install node modules
```bash
  npm install
```

#### Install composer vendors
```bash
  composer install
```

### Generate .env file
```bash
   cp .env.example .env
   php artisan key:generate
```

### Migrate tables with seeders
```bash
   php artisan migrate --seed
```

### Start the server

```bash
  php artisan serve
```

Runs the app in the development mode.

Open http://127.0.0.1:8000 to view it in your browser.

## Screenshots

![App Screenshot]("https://github.com/MoQuayson/CodeHaven.Assignment/blob/master/screenshots/get feeds.png")

## Authors

- [@MoQuayson](https://www.github.com/MoQuayson)


## License

[MIT](https://choosealicense.com/licenses/mit/)
