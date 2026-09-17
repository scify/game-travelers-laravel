{{--
    Project context for Taxidiotes. The only module that cannot travel to another
    repository. Boost composes it into every agent guideline file.
--}}
## Project: Taxidiotes (Ταξιδιώτες, "Travelers")

Web board game for children with disabilities, live at [taxidiotes.scify.org](https://taxidiotes.scify.org/). Every screen is driven by two keys, navigate and select, with a configurable scanning speed, so the game can be played with switches.

Laravel {{ explode('.', app()->version())[0] }} application. Blade renders every page; a single Vue 2 component renders the game board. Styles are Bootstrap 5.3 and Sass, compiled by Laravel Mix (webpack 5). The default language is Greek with English as fallback. The timezone is Europe/Athens.

### Every installation is someone else's

This repository is open source and installed by others, each with their own app name, domain, analytics id and mail setup. A change here changes every installation, not one site. Nothing in `config/`, `resources/` or `lang/` may assume a particular installation: no names, hosts, ids or cookie names spelt out. Whatever differs between installations comes from `.env`, is documented in `.env.example`, and when two settings must agree it is derived once, from that source, in code that is tested (see `app/Support/CookieNames.php`). Prefer the framework's defaults to pinned values.

### Architecture

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
- `database/seeders/`: two users (@verbatim`admin-taxidiotes@scify.org`, `user-taxidiotes@scify.org`@endverbatim, password from `DEFAULT_USER_PASSWORD_FOR_SEED` in `.env`), roles and sample players.

**Build output:** everything in `public/` is generated and ignored by git, except `.htaccess`, `index.php`, `robots.txt` and `vendor/` (assets published by the cookie consent package). Never edit generated files; change `resources/` and rebuild.

### Code style, project specifics

- **PHP:** Laravel Pint, configured in `pint.json`: opening braces on the same line, one space around the `.` operator.
- **JavaScript and Vue:** tabs, double quotes, semicolons (`.eslintrc.json`). ESLint runs with `--fix` inside the webpack build.
- **SCSS:** Stylelint with `stylelint-config-standard-scss`.
- **Everything else:** 4 spaces, LF, UTF-8, final newline (`.editorconfig`).
- **Commits:** Conventional Commits (`feat`, `fix`, `refactor`, `docs`, `build`, `chore`). Messages name packages and versions, never people, hosts or other projects.

### Common Development Commands

Run from the project root. The README describes the full first-time setup.

- `{{ $assist->composerCommand('install') }}`: PHP dependencies
- `{{ $assist->artisanCommand('migrate --seed') }}`: database schema and starter data
- `{{ $assist->artisanCommand('storage:link') }}`: links `public/storage` to `storage/app/public`
- `{{ $assist->nodePackageManagerCommand('install') }}`: front-end dependencies (Node.js version in `.nvmrc`)
- `{{ $assist->nodePackageManagerCommand('run dev') }}`: build CSS and JS, copy images and audio into `public/`. `run watch` rebuilds on change; `run prod` is the minified production build
- `{{ $assist->artisanCommand('sitemap:generate') }}`: writes `public/sitemap.xml`
- `{{ $assist->artisanCommand('test') }}`: feature tests (SQLite in memory, no build needed). Conventions in `tests/CLAUDE.md`
