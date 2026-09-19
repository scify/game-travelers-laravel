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

Business logic lives in `app/BusinessLogicLayer/` (managers) and data access in `app/Repository/` (one repository per model, all extending `Repository`). Controllers use these. Every database read and write goes through a repository; do not call Eloquent from controllers or managers.

- `app/Http/Controllers/`: `HomeController` (landing page), `UserController` (select and create a player), `SettingsController` (profile, controls, difficulty), `SetupGameController` (continue, board, mode, pawns, options), `BoardController` (the game; `fromVue` receives the board's state), `CustomAudioController` (volumes), `Auth/` (login, registration).
- `app/Http/Middleware/EnsureIdsAreValid.php`: guards every route that carries `{player_id}` and `{game_id}`.
- `app/Models/`: `User`, `Player` (a user's game profiles, soft deleted), `Game`, `UserRole/`.
- `app/Console/Commands/`: `GenerateSitemap` (`sitemap:generate`, run by the deployment; its `pages()` method is the list of public pages by route name, rendered by `resources/views/sitemap.blade.php`), `ClearAudioCache` (`audios:clear`, forgets the cached audio file list).
- `routes/web.php`: all game routes require `auth` and follow `/{step}/{player_id}/{from}/{game_id}`; `robots.txt` is a route, rendering `resources/views/robots.blade.php`, so it can name the installation's sitemap URL. `routes/auth.php`: login and registration.
- `resources/views/`: Blade templates. `components/layout.blade.php` is the page shell. It loads the `board.js` entry only when the view sets `$hasVue`.
- `resources/js/`: four Vite entries at the root. `app.js` (Bootstrap and axios set-up, loaded on every page), `board.js` (Vue and the components in `components/`, mounted from Blade markup, loaded only where a view sets `$hasVue`), `settings.js` (the settings pages' scripts, one file each in `settings/`) and `switcher.js` (switch scanning on the game setup pages). Shared modules live in `lib/`: `audio.js` (`sound()` and `music()`), `debug.js` (the logger and event bus behind the board's debug tools, on only where `App\Support\DebugMode` says so, a local installation with `APP_DEBUG`), `keys.js` (the keys a player may assign), `lang.js` (`trans()`), `volumes.js` (saving a player's volumes). Imports use the `@` alias for `resources/js`. The only `window` globals are `window.bootstrap`, for one inline Blade script, and `window.travelersDebug`.
- **Debug mode:** F2 on the board opens a strip that stages the game (`POST debug/game/{game_id}/state`, a 404 unless `DebugMode` is on) and plays through real key events. Scripts use `window.travelersDebug` (`state()`, `press()`, `roll()`, `move()`, `setState()`, `on()`, `once()`); never reach into the Vue instance. The README describes it.
- `vite.config.js` lists the five entries: the four scripts and `resources/sass/app.scss`.
- `resources/sass/app.scss`: Bootstrap customisation and the theme's components.
- `public/images/`: about 5000 files, tracked and served as they are. Optimise images before committing them; the build does not.
- `public/audio/`: `sounds/` is in git. `fx/` and `music/` hold copyrighted files that are not in git; their README files list what to download. The game loads audio by URL, never through the bundler.
- `lang/el/`, `lang/en/`: translations.
- `database/seeders/`: two users (@verbatim`admin-taxidiotes@scify.org`, `user-taxidiotes@scify.org`@endverbatim, password from `DEFAULT_USER_PASSWORD_FOR_SEED` in `.env`), roles and sample players.

**Build output:** Vite writes `public/build/`; everything in `public/` is generated and ignored by git, except `.htaccess`, `index.php`, `favicon.ico`, `images/`, `audio/` and `vendor/` (assets published by the cookie consent package). Never edit generated files; change `resources/` and rebuild.

### The board

The board is a fixed stack of artwork, 1366 by 768 pixels. It does not scale, reflow or adapt to the viewport, and there is no separate small-screen layout. Every layer is a PNG drawn at the full board size and placed on top of the previous one.

`resources/views/board.blade.php` renders the frame that holds the stack. Three classes on that frame are load-bearing, and removing any of them moves artwork:

- `position-relative` makes the frame the containing block. Every layer is absolutely positioned, and the two layers that carry explicit offsets use `calc(50% - ...)`. Without a positioned ancestor those percentages resolve against the viewport, so the elements drift as the window changes size and only land correctly at one window width.
- `flex-shrink-0` holds the frame at its declared width. Every child is absolutely positioned, so the frame has a min-content width of zero and the flex container would otherwise collapse it.
- `m-auto`, with no `justify-content` on the flex container, centres the frame while there is free space and collapses to zero when there is none. An overflowing board then starts at the left edge and all of it can be reached by scrolling. Centring through `justify-content` splits the overflow instead, and content placed left of the origin cannot be scrolled to.

Layers with no `left` or `top` sit at their static position, the top-left of the frame content box, which is what stacks the artwork. Only the info button and the card carry explicit offsets.

The rule `#app img { max-width: initial }` in `resources/sass/_reset.scss` is load-bearing. The frame is a border-box with a 1px border, so its content box is 2 pixels narrower than the artwork, and the reset rule `max-width: 100%` would rescale every layer to fit.

Overlay artwork can sit inside a padded canvas. Measure where the artwork begins inside its file before positioning a state image, rather than assuming it fills the file. The info button shows both cases: the resting state fills its file, while the hover state begins 9 pixels from the left edge and 6 from the top, so the style subtracts that padding and both states share one corner.

Artwork lives in `public/images/boards/board_{n}/`, with `size_{n}` variants for board length. Cards are 344 by 482 pixels in every board and every mode. The info button states are shared across boards in `public/images/boards/info/`.

When changing anything on the board, measure positions relative to the frame rather than to the viewport, and take the same measurements at several window widths. One layer carries a one second animation, so two screenshots of the same state never match exactly; a pixel comparison has to allow for it.

### Code style, project specifics

- **PHP:** Laravel Pint under `pint.json`: Laravel preset plus `declare(strict_types=1)`, strict comparisons and `mb_` string functions.
- **JavaScript and Vue:** ESLint (`eslint.config.js`: the recommended rules and `eslint-plugin-vue`) and Prettier (`.prettierrc`: 4 spaces, single quotes, 120 columns, one attribute per line).
- **SCSS and Vue style blocks:** Stylelint (`.stylelintrc.json`: `stylelint-config-standard-scss`, `stylelint-config-standard-vue`, Prettier through `stylelint-prettier`).
- **Everything else:** 4 spaces, LF, UTF-8, final newline (`.editorconfig`).
- **Commits:** Conventional Commits (`feat`, `fix`, `refactor`, `docs`, `build`, `chore`). Messages name packages and versions, never people, hosts or other projects.

### Common Development Commands

Run from the project root. The README describes the full first-time setup.

- `{{ $assist->composerCommand('setup') }}`: first-time setup in one run: dependencies, `.env` with a key, the schema, the storage link; prints the next steps
- `{{ $assist->composerCommand('install') }}`: PHP dependencies
- `{{ $assist->artisanCommand('migrate --seed') }}`: database schema and starter data
- `{{ $assist->artisanCommand('storage:link') }}`: links `public/storage` to `storage/app/public`
- `{{ $assist->nodePackageManagerCommand('install') }}`: front-end dependencies (Node.js version in `.nvmrc`)
- `{{ $assist->nodePackageManagerCommand('run dev') }}`: Vite's development server with hot reload; under DDEV the browser reaches it through the port in `.ddev/config.yaml`
- `{{ $assist->nodePackageManagerCommand('run build') }}`: the production build into `public/build/`; `run prod` is its alias for the deploy workflow
- `{{ $assist->composerCommand('dev') }}`: Pail and the Vite dev server in one terminal (`artisan dev`); on a local PHP also `artisan serve`. If pages still ask the dev server for their assets after it stopped, delete the stale `public/hot`
- `{{ $assist->artisanCommand('sitemap:generate') }}`: writes `public/sitemap.xml`
- `{{ $assist->artisanCommand('test') }}`: feature tests (SQLite in memory, no build needed). Conventions in `tests/CLAUDE.md`
- `{{ $assist->composerCommand('test') }}`: PHP and front-end code style, static analysis and the test suite in one run. Green before every commit
