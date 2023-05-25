<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/xclvry21/MyNotes/blob/main/public/images/mynotes_logo-light.png" width="400" alt="MyNotes"></a></p>

## About MyNotes

MyNotes is a simple web-app for note-taking using [Laravel](https://laravel.com). The system's function flow is like a [Google Keep](https://www.google.com/keep/)

- Uses Multi-Authentication
- Admin and User Dashboard
- Email Verification, and Password Reset
- Tags, Archives and Trash controls

## Clone and Run on Local Machine

1. Run `git clone <noteapp-url>` or manually download the zip project
2. Run `composer install`
3. Run `npm install`
4. Run `npm run build`
5. Make a duplicate of **_.env.example_** file using `cp .env.example .env` and set the values according to your preference/local machine values.
6. Generate an app key using `php artisan key:generate`
7. Migrate a database using `php artisan migrate`
8. Run `php artisan serve` and open the generated url on your preferred browser

- Create a link of storage folder to public folder using `php artisan storage:link`
- Run database seeder using the command `php artisan db:seed`

___
### Add-ons
- **[Laravel Breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze)**
- **[Moment.js](https://momentjs.com)**
- **[Summernote](https://summernote.org)**
- **[toastr](https://github.com/CodeSeven/toastr)**
- **[Select2](https://select2.org)**

