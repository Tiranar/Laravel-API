# Example API 

## Get Project Running

1.  Navigate to project root folder
2.  Copy `.env.example` and rename to `.env`. See dev environment file database configuration below
3.  Run `composer update`
4.  Once this is complete, run `php artisan jwt:secret`
5.  Open a new terminal tab/window, and run `php artisan migrate`
