# Tasks for Today Management System

IT0049 Technical Summative Assessment 3 by Inah Angela Gregorio, BSITCST - AC32.

A Laravel application with four read-only pages: Welcome shows only today's tasks, Task List shows every task ordered by date, Profile displays one user, and About identifies the developer. Records come from Eloquent models, not arrays in controllers.

## Requirements

PHP 8.2+, Composer 2, and Laravel's standard PHP extensions including PDO SQLite. Laravel 12 matches the installed PHP 8.2 environment. CSS is served directly from public/css/app.css, so no Node or npm build is required.

## First setup in PowerShell

Open PowerShell inside the project folder:

```powershell
composer install
if (!(Test-Path .env)) { Copy-Item .env.example .env }
php artisan key:generate
if (!(Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite }
php artisan migrate --seed
php artisan serve --host=127.0.0.1 --port=8003
```

Open http://127.0.0.1:8003. Generate an app key only on first setup. On subsequent runs, start the server using the final command. Keep that terminal open; Ctrl+C stops it.

SQLite is the local default, so XAMPP MySQL does not need to be running. Use a new database for this project; do not reuse the POS database.

## Routes and source files

| URL | Behavior | Source |
| --- | --- | --- |
| / | Only tasks whose task_date equals today | TaskController::welcome, welcome.blade.php |
| /tasks | All tasks ordered by task_date, then id | TaskController::index, tasks.blade.php |
| /profile | Single user record loaded from users | ProfileController::show, profile.blade.php |
| /about | Static developer and application information | about.blade.php |

Task::scopeForDate uses whereDate. TaskController calls Task::forDate($today) for Welcome. Both task pages share the task-table Blade partial and Task model. All pages share one layout with navigation. Displayed data uses Blade escaped output.

## Database

- tasks: id, title, status (default pending), task_date, created_at, updated_at.
- users: id, username (unique), full_name, email, created_at, updated_at.
- DatabaseSeeder creates 8 sample tasks across yesterday, today, and tomorrow, including 4 tasks for today, plus exactly 1 user on a fresh database.
- The profile email inah.gregorio@example.com is an example address.
- Repeating the seeder updates its fixed sample IDs instead of inserting duplicates.
- No authentication, task editing, or task deletion is required by this assessment.

The application timezone defaults to Asia/Manila (UTC+08:00), configurable with APP_TIMEZONE. The seed dates are relative to the date you run the seeder. If documenting on a later day, run php artisan db:seed again to refresh the sample dates; this replaces the sample titles, statuses, dates, and profile fields. Do not run this demo seeder against real production data. The Welcome query always uses the actual application day, even if no sample tasks remain for that day.

## Verification and screenshots

```powershell
php artisan migrate:status
php artisan tasks:summary
php artisan route:list --except-vendor
php artisan test
```

The tests use an isolated in-memory SQLite database with a controlled clock. They verify today's filter, all-task ordering, midnight rollover, seeding counts and repeatability, database defaults, unique usernames, profile retrieval, empty states, navigation, and escaped task titles.

See POWERSHELL-GUIDE.txt for the exact screenshot sequence and suggested captions.

## GitHub submission

Suggested repository name: it0049-tsa3-tasks-for-today-laravel

Upload raw project files including app, bootstrap, config, database migration/seeder files, public, resources, routes, storage placeholder files, tests, artisan, composer.json, composer.lock, .env.example, .gitignore, and README.

Exclude .env and other real environment files, vendor, node_modules, SQLite databases, logs, sessions, caches, auth.json, and credentials. The migrations and seeder satisfy the database submission requirement; no database export is needed.

For GitHub browser uploads, upload the CONTENTS of the separate TSA3-GitHub-Upload folder. artisan and composer.json must be at the repository root. Include .gitignore and .env.example. The website's manual upload does not apply .gitignore rules, so use the prepared folder.

For Git-based uploads, initialize Git inside the project and review the staged filenames before committing:

```powershell
git init
git add .
git status --short
git diff --cached --name-only
```

Create an empty repository on GitHub, then follow its remote and push commands.

## Hosting

GitHub Pages cannot execute Laravel/PHP. Use PHP 8.2+ hosting with Composer and a persistent SQLite database or a MySQL service. Point the web document root to public and make storage and bootstrap/cache writable.

Install production packages with composer install --no-dev --optimize-autoloader. Set APP_ENV=production, APP_DEBUG=false, APP_URL to the real HTTPS URL, a newly generated production APP_KEY, APP_TIMEZONE=Asia/Manila, SESSION_DRIVER=file, CACHE_STORE=file, and QUEUE_CONNECTION=sync through the host's environment settings.

For SQLite, provision a persistent writable database file and set DB_CONNECTION=sqlite and DB_DATABASE to its absolute path. For MySQL, set DB_CONNECTION=mysql with the host-provided DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD. Never commit credentials.

Run php artisan migrate --seed --force on the fresh hosted database, then php artisan optimize. The supplied Dockerfile is an optional deployment starting point; it has not been built or tested in this environment. Run migrations through your host's console. Recreate the demo dates with the seeder before documentation if needed.

Submit both the real repository URL and a verified public HTTPS app URL. Localhost is only for local documentation. Hosting has not been provisioned.

## References

- https://laravel.com/docs/12.x/migrations
- https://laravel.com/docs/12.x/eloquent#query-scopes
- https://laravel.com/docs/12.x/seeding
- https://laravel.com/docs/12.x/deployment
