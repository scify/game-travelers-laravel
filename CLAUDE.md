# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Taxidiotes (Ταξιδιώτες, "Travelers") is a web board game for children with disabilities, live at [taxidiotes.scify.org](https://taxidiotes.scify.org/). Every screen is driven by two keys, navigate and select, with a configurable scanning speed, so the game can be played with switches.

It is a [Laravel](https://laravel.com/) 9 application. Blade renders every page; a single Vue 2 component renders the game board. Styles are Bootstrap 5.3 and Sass, compiled by [Laravel Mix](https://laravel-mix.com/) (webpack 5). The default language is Greek with English as fallback. The timezone is Europe/Athens.

## Development Commands

Run from the project root. The README describes the full first-time setup.

```bash
composer install               # PHP dependencies
php artisan migrate --seed     # database schema and starter data
php artisan storage:link       # public/storage -> storage/app/public
npm install                    # front-end dependencies (Node.js version in .nvmrc)
npm run dev                    # build CSS and JS, copy images and audio into public/
npm run watch                  # rebuild on change
npm run prod                   # minified production build
php artisan sitemap:generate   # public/sitemap.xml
./vendor/bin/pint --test -v    # PHP code style check; drop --test to fix
```

## Architecture

Business logic lives in `app/BusinessLogicLayer/` (managers) and data access in `app/Repository/` (one repository per model, all extending `Repository`). Controllers use these.

- `app/Http/Controllers/`: `HomeController` (landing page), `UserController` (select and create a player), `SettingsController` (profile, controls, difficulty), `SetupGameController` (continue, board, mode, pawns, options), `BoardController` (the game; `fromVue` receives the board's state), `CustomAudioController` (volumes), `Auth/` (login, registration).
- `app/Http/Middleware/EnsureIdsAreValid.php`: guards every route that carries `{player_id}` and `{game_id}`.
- `app/Models/`: `User`, `Player` (a user's game profiles, soft deleted), `Game`, `UserRole/`.
- `routes/web.php`: all game routes require `auth` and follow `/{step}/{player_id}/{from}/{game_id}`. `routes/auth.php`: login and registration.
- `resources/views/`: Blade templates. `components/layout.blade.php` is the page shell. It loads `js/vue.js` only when the view sets `$hasVue`.
- `resources/js/app.js`: Bootstrap, translations (`lang.js`), key handling (`keys.js`) and the audio player (`audio.js`), loaded on every page. `vue.js`: Vue and the two components in `components/`, loaded only on the board.
- `resources/js/settings/*.js` and `resources/js/switcher/*.js`: bundled into `public/js/functions/settings.js` and `switcher.js`.
- `resources/sass/app.scss`: Bootstrap customisation and the theme's components.
- `resources/images/`: about 5000 files, copied to `public/images/` on every build. Optimise images before committing them; the build does not.
- `resources/audio/`: `sounds/` is in git. `fx/` and `music/` hold copyrighted files that are not in git; their README files list what to download. Everything is copied to `public/audio/`.
- `lang/el/`, `lang/en/`: translations.
- `database/seeders/`: two users (`admin-taxidiotes@scify.org`, `user-taxidiotes@scify.org`, password from `DEFAULT_USER_PASSWORD_FOR_SEED` in `.env`), roles and sample players.

**Build output:** everything in `public/` is generated and ignored by git, except `.htaccess`, `index.php`, `robots.txt` and `vendor/` (assets published by the cookie consent package). Never edit generated files; change `resources/` and rebuild.

## Code Style

- **PHP:** Laravel Pint, configured in `pint.json`: opening braces on the same line, one space around the `.` operator.
- **JavaScript and Vue:** tabs, double quotes, semicolons (`.eslintrc.json`). ESLint runs with `--fix` inside the webpack build.
- **SCSS:** Stylelint with `stylelint-config-standard-scss`.
- **Everything else:** 4 spaces, LF, UTF-8, final newline (`.editorconfig`).
- **Commits:** [Conventional Commits](https://www.conventionalcommits.org/) (`feat`, `fix`, `refactor`, `docs`, `build`, `chore`). Messages name packages and versions, never people, hosts or other projects.
