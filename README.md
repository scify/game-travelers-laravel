# Taxidiotes Game Web Application

[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](LICENCE.md)
[![Contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/scify/game-travelers-laravel/issues)

The Laravel 13 web application of the Taxidiotes game.

[Project URL](https://taxidiotes.scify.org/)

## Requirements

- **PHP 8.4.1** or newer, with the extensions `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`, `openssl`, `pcre`, `pdo`, `pdo_mysql`, `session`, `tokenizer`, and `xml`. The list in `composer.json` is the one that counts. With `platform-check` on, an older version is rejected as the application loads.
- **Composer 2**.
- **MySQL 8.0**. The test suite runs on SQLite in memory and needs no database server.
- **Node.js 24.21.0** or newer, the version in `.nvmrc` (`nvm use` selects it), and **npm 11.19.0** or newer. `.npmrc` sets `engine-strict`: npm refuses to install on an older version.
- A **web server** with `public/` as the document root, for example the Apache configuration below, or `php artisan serve` while developing.
- Optional, for local development only: **[DDEV](https://ddev.com/)**. `.ddev/config.yaml` is part of the repository and provides the PHP, MySQL, and Node.js versions above in containers. A development machine that uses DDEV needs none of them installed. Prefix the commands below with `ddev`: the first one starts the project and writes `.env` for the container.

## First time install

`composer setup` runs every step below in one go: the PHP and front-end dependencies, an `.env` file with a fresh `APP_KEY`, the database schema, and the `public/storage` link. It prints the next steps when it is done. Under DDEV, prefix the commands with `ddev`.

```bash
composer setup
```

With the requirements in place, the same steps one at a time:

1. Install the PHP dependencies: `composer install`
2. Copy `.env.example` to `.env`, then generate the application key: `php artisan key:generate`. Check the `DB_*` variables and `APP_URL`.
3. Create the database schema: `php artisan migrate`. Add `--seed` for the starter data, two users and sample players; `DEFAULT_USER_PASSWORD_FOR_SEED` in `.env` is their password.
4. Link `public/storage` to `storage/app/public`: `php artisan storage:link`
5. Install the front-end dependencies: `npm install`

To start over, `php artisan migrate:fresh --seed` drops every table, creates the schema again, and adds the starter data.

## Development

`composer dev` starts the development processes in one terminal: the Vite server with hot reload, [Pail](https://github.com/laravel/pail) streaming the log, and, on a local PHP, `artisan serve`.

```bash
composer dev
```

This is Laravel 13's `artisan dev`, and `AppServiceProvider` picks the processes. The queue worker is left out, because the default queue connection is `sync`.

## About the music files

The directories `public/audio/fx` and `public/audio/music` should contain audio (.mp3) files that are not checked in source control, because of copyright issues.

Please check `public/audio/fx/README.md` and `public/audio/music/README.md`, in order to see which files you should download and put there.

The application reads the list of audio files once and caches it with no expiry. After adding or removing files, clear the cache:

```bash
php artisan audios:clear
```

To upload the files to a server, you can use `scp`, for example:

```bash
scp -r /path/to/local/fx/* user@server:/path/to/project/public/audio/fx

scp -r /path/to/local/music/* user@server:/path/to/project/public/audio/music
```

## Apache configuration example

Create the site file:

```bash
sudo nano /etc/apache2/sites-available/taxidiotes.conf
```

```apache
<VirtualHost *:80>
        ServerName dev.taxidiotes
        ServerAlias dev.taxidiotes
        DocumentRoot "/home/path/to/project/public"
        <Directory "/home/path/to/project/public">
            Require all granted
            AllowOverride all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Make the symbolic link:

```bash
cd /etc/apache2/sites-enabled && sudo ln -s ../sites-available/taxidiotes.conf
```

Enable mod_rewrite, mod_ssl and restart apache:

```bash
sudo a2enmod rewrite && sudo a2enmod ssl && sudo service apache2 restart
```

Fix permissions for storage directory:

```bash
sudo chown -R ${USER}:www-data storage

sudo chmod 775 storage

cd storage/

sudo find . -type f -exec chmod 664 {} \;

sudo find . -type d -exec chmod 775 {} \;
```

Add `dev.taxidiotes` to `/etc/hosts`:

```
127.0.0.1       dev.taxidiotes
```

## SEO - Generate Sitemap

The public pages are listed in `public/sitemap.xml`, which is excluded from git. Generate it after every deployment; the
URLs in it are the installation's own:

```bash
php artisan sitemap:generate
```

The pages it lists are the `pages()` method of `app/Console/Commands/GenerateSitemap.php`, by route name; a new public
page is added there. `robots.txt` is served by the application and points crawlers to the sitemap.

## Front end

Vite builds four script entries and one stylesheet, listed in `vite.config.js`:

- `resources/js/app.js`, on every page: the Bootstrap and axios set-up.
- `resources/js/board.js`, on the board: Vue 3 and the components in `resources/js/components/`.
- `resources/js/settings.js`, on the settings pages, and `resources/js/switcher.js`, the switch scanning on the game setup pages.
- `resources/sass/app.scss`: Bootstrap 5 with the theme, and the Manrope font, self-hosted through Fontsource.

Shared modules live in `resources/js/lib/` and are imported through the `@` alias, for example `@/lib/audio.js`. The values Blade publishes on `window` are declared in `resources/js/types/global.d.ts`.

The build targets Chrome and Edge 109, Firefox 115, Safari and iOS 15. In development `composer dev` serves the assets with hot reload. An installation runs `composer install` for the PHP dependencies and `npm run build` for the production assets in `public/build/`. Images and sounds are served from `public/images` and `public/audio` by URL.

## Code quality

The composer scripts run the PHP tools: [Laravel Pint](https://laravel.com/docs/13.x/pint) for code style, [Rector](https://getrector.com/) for automated refactoring and [Larastan](https://github.com/larastan/larastan) for static analysis. The npm scripts run [ESLint](https://eslint.org/) and [Prettier](https://prettier.io/) over the JavaScript and Vue files, and [Stylelint](https://stylelint.io/) over the SCSS and the Vue style blocks.

```bash
composer lint        # fix: Rector, Pint, then the npm lint scripts
composer test:lint   # check only: Pint, Rector, then the npm check scripts; changes nothing
composer test:types  # Larastan
composer test:unit   # the test suite
composer test        # all three checks, in that order

npm run lint              # fix: ESLint, then Prettier
npm run lint:styles       # fix: Stylelint
npm run test:lint         # check only: ESLint, then Prettier; changes nothing
npm run test:lint:styles  # check only: Stylelint
```

Run `composer test` before you commit. The `lint:agent` and `test:agent` variants print output made for AI agents.

To raise the dependencies, `composer update:requirements` rewrites the Composer constraints to the installed versions (`composer bump`) and the npm pins to the latest releases at least seven days old, the same age `.npmrc` requires for installs. Then `composer update`, `npm install`, `composer test`, and read the diff before you commit.

## How to debug

### Debug mode: the board's strip and `travelersDebug`

In a local installation with `APP_ENV=local` and `APP_DEBUG=true`, the board carries debug tools. Elsewhere the route below answers 404 and the board renders no strip.

Press **F2** on the board to open the strip. It shows the game's state (phase, turn, positions, target square, selector, mistakes, card, whether input is ignored, the last event), a form that stages the game, and three buttons.

- **Stage a state:** fill any of the fields and press *Apply and reload*. The strip posts to `debug/game/{game_id}/state`, which writes the columns of the game row (the game must belong to the logged-in user), and the page reloads with the game in that state. Empty fields keep their value. *Next roll lands on* needs phase 1: the backend returns that square instead of rolling. *Next card* needs phase 2 and a pawn on a card square (colour 3 or 5, which means squares 3, 5, 9, 11, 15, 17 and so on): the backend draws that card, positive indexes move forward, negative ones back.
- **Roll (select key)** presses the player's select key: in phase 1 it rolls the dice, in phase 3 it resolves the card on screen.
- **Move to target** presses navigate until the selector sits on the target and then select, or waits for the scanning selector to reach it, exactly as the player would through a switch.
- **Mute** silences new sounds. A turn still takes as long as it takes, because the game waits for each narration to end.

Recipes:

- **A card:** pos1 13, phase 1, next roll lands on 17. Apply, Roll, Move. The card is dealt; Roll again resolves it.
- **The win screens:** pos1 29, phase 1, next roll lands on 30. Apply, Roll, Move.
- **Help after the configured mistakes:** pos1 0, phase 1, next roll lands on 4. Apply, Roll, then press *Roll (select key)* while the selector is on any square but 4, as many times as the player's mistakes setting allows.

The same tools are available to scripts as `window.travelersDebug`: `state()`, `press(key)`, `roll()`, `move()`, `mute(true|false)`, `setState({ pos1, pos2, phase, turn, next, card })`, and `on(event, handler)` or `once(event)` for the events the board emits while it plays: `input`, `rolled`, `selector`, `moved`, `card`, `phase`, `ended`. Never reach into the Vue instance; everything a test needs is published here.

### Xdebug

- Install and configure Xdebug on your machine
- At PhpStorm/IntelliJ click the "Start listening for PHP debug connections"

## AI agent guidelines - Laravel Boost

The sources of the instructions for AI coding agents are in `.ai/guidelines/`. They are composed with [Laravel Boost](https://github.com/laravel/boost), along with Laravel guidelines and related skills, into the file your agent reads: `CLAUDE.md` for Claude Code, `AGENTS.md` for Codex, and so on. The generated files are ignored by git. To generate them run:

```bash
php artisan boost:install
```

After a change in `.ai/guidelines/`, run `php artisan boost:update` to refresh the generated file.

If your PHP does not run on the machine where your agent runs, for example under DDEV, set the `BOOST_*_EXECUTABLE_PATH` variables in `.env` before installing. They are listed at the end of `.env.example`.

## How to contribute
- Send us a pull request describing your improvements/fixes/features
