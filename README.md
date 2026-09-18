# Taxidiotes Game Web Application

[![JavaScript Style Guide: Good Parts](https://img.shields.io/badge/code%20style-goodparts-brightgreen.svg?style=flat)](https://github.com/dwyl/goodparts "JavaScript The Good Parts")
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/dwyl/esta/issues)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://GitHub.com/scify)

Laravel 13 Web Application for the Taksidiotes Game Web app

[Project URL](https://taxidiotes.scify.org/)

# Installation Instructions:

## First time install

`composer setup` runs every step below in one go: the PHP and front-end dependencies, an `.env` file with a fresh `APP_KEY`, the database schema and the `public/storage` link. It prints the next steps when it is done. Under DDEV, prefix the commands with `ddev`.

```bash
composer setup
```

The same steps, one at a time:

1. Make sure PHP 8.4 is installed with the extensions listed in `composer.json`, and the Node.js version in `.nvmrc` (`nvm use` selects it).
2. Install the PHP dependencies: `composer install`
3. Copy `.env.example` to `.env`, then generate the application key: `php artisan key:generate`. Check the `DB_*` variables and `APP_URL`.
4. Create the database schema: `php artisan migrate`. For the starter data, two users and sample players: `php artisan db:seed`; `DEFAULT_USER_PASSWORD_FOR_SEED` in `.env` is their password.
5. Link `public/storage` to `storage/app/public`: `php artisan storage:link`
6. Install the front-end dependencies: `npm install`. Then `npm run dev` starts the development server with hot reload, and `npm run build` writes the production build.

## SEO - Generate Sitemap

This application uses [Spatie - Laravel Sitemap](https://github.com/spatie/laravel-sitemap) plugin, in order to create
the `public/sitemap.xml` file (which is excluded from git), that will be crawled by the search engines.
In order to run the generator for the current application installation, run the embedded Laravel command:

```bash
php artisan sitemap:generate
```

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

## AI agent guidelines - Laravel Boost

The sources of the instructions for AI coding agents are in `.ai/guidelines/`. They are composed with [Laravel Boost](https://github.com/laravel/boost), along with Laravel guidelines and related skills, into the file your agent reads: `CLAUDE.md` for Claude Code, `AGENTS.md` for Codex, and so on. The generated files are ignored by git. To generate them run:

```bash
php artisan boost:install
```

After a change in `.ai/guidelines/`, run `php artisan boost:update` to refresh the generated file.

If your PHP does not run on the machine where your agent runs, for example under DDEV, set the `BOOST_*_EXECUTABLE_PATH` variables in `.env` before installing. They are listed at the end of `.env.example`.

## Apache configuration example:

```
% sudo touch /etc/apache2/sites-available/taxidiotes.conf
% sudo nano /etc/apache2/sites-available/taxidiotes.conf
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
% cd /etc/apache2/sites-enabled && sudo ln -s ../sites-available/taxidiotes.conf
```

Enable mod_rewrite, mod_ssl and restart apache:

```bash
% sudo a2enmod rewrite && sudo a2enmod ssl && sudo service apache2 restart
```

Fix permissions for storage directory:

```bash
sudo chown -R ${USER}:www-data storage

sudo chmod 775 storage

cd storage/

sudo find . -type f -exec chmod 664 {} \;

sudo find . -type d -exec chmod 775 {} \;
```

Change hosts file so dev.taxidiotes points to localhost:

```$xslt
sudo nano /etc/hosts
127.0.0.1       dev.taxidiotes
```

## About the music files

The directories `public/audio/fx` and `public/audio/music` should contain audio (.mp3) files that are not checked in source control, because of copyright issues.

Please check `public/audio/fx/README.md` and `public/audio/music/README.md`, in order to see which files you should download and put there.

To upload the files to a server, you can use `scp`, for example:

```bash
scp -r /path/to/local/fx/* user@server:/path/to/project/public/audio/fx

scp -r /path/to/local/music/* user@server:/path/to/project/public/audio/music
```

## How to debug

### Debug mode: the board's strip and `travelersDebug`

In a local installation with `APP_ENV=local` and `APP_DEBUG=true`, the board carries debug tools. Elsewhere the route below answers 404 and the board renders no strip.

Press **F2** on the board to open the strip. It shows the game's state (phase, turn, positions, target square, selector, mistakes, card, whether input is ignored, the last event), a form that stages the game, and three buttons.

- **Stage a state:** fill any of the fields and press *Apply and reload*. The strip posts to `debug/game/{game_id}/state`, which writes the columns of the game row (the game must belong to the logged-in user), and the page reloads with the game in that state. Empty fields keep their value. *Next roll lands on* needs phase 1: the backend returns that square instead of rolling. *Next card* needs phase 2 and a pawn on a card square (colour 3 or 5, so squares 3, 5, 9, 11, 15, 17 and so on): the backend draws that card, positive indexes move forward, negative ones back.
- **Roll (select key)** presses the player's select key: in phase 1 it rolls the dice, in phase 3 it resolves the card on screen.
- **Move to target** presses navigate until the selector sits on the target and then select, or waits for the scanning selector to reach it, exactly as the player would through a switch.
- **Mute** silences new sounds; the game still waits for each narration to end, so a turn takes as long as it takes.

Recipes:

- **A card:** pos1 13, phase 1, next roll lands on 17. Apply, Roll, Move. The card is dealt; Roll again resolves it.
- **The win screens:** pos1 29, phase 1, next roll lands on 30. Apply, Roll, Move.
- **Help after the configured mistakes:** pos1 0, phase 1, next roll lands on 4. Apply, Roll, then press *Roll (select key)* while the selector is on any square but 4, as many times as the player's mistakes setting allows.

The same tools are available to scripts as `window.travelersDebug`: `state()`, `press(key)`, `roll()`, `move()`, `mute(true|false)`, `setState({ pos1, pos2, phase, turn, next, card })`, and `on(event, handler)` or `once(event)` for the events the board emits while it plays: `input`, `rolled`, `selector`, `moved`, `card`, `phase`, `ended`. Never reach into the Vue instance; everything a test needs is published here.

### Xdebug

- Install and configure Xdebug on your machine
- At Chrome
  install [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc?utm_source=chrome-app-launcher-info-dialog)
- At PhpStorm/IntelliJ click the "Start listening for PHP debug connections"

## How to contribute
- Send us a pull request describing your improvements/fixes/features
