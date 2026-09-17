{{--
    How the agent guideline files are maintained. Everything here is a Blade
    comment, so it stays out of CLAUDE.md, AGENTS.md, and every other target.
    The rendered paragraph below is deliberately one sentence: agents need the
    loop, not the manual.

    THE GENERATED FILES

    Boost replaces only the block between the <laravel-boost-guidelines>
    markers, so prose outside them survives a regeneration. Never hand-edit
    inside the markers. One side effect reaches the whole file: runs of three or
    more newlines collapse to one blank line, including in the prose above and
    below the block.

    boost.json (project root) names the targets: agents (claude_code writes
    CLAUDE.md, codex writes AGENTS.md), guidelines, skills.

    WRITING A MODULE

    Files compose from .ai/guidelines in filename order, so the number prefix is
    the running order. New files are discovered automatically; nothing registers
    them. 10- is project context and is the only module that cannot travel to
    another repository. Everything else stays project-agnostic so it can be
    lifted into the next project unedited.

    These are Blade templates. A literal @ compiles as a directive, so wrap it:
    `@verbatim` ... `@endverbatim`. Never hardcode a local runner; the $assist
    helpers resolve through executable_paths in config/boost.php and print the
    right one per project.

    Levers available to a template: PHP_VERSION, app()->version(),
    method_exists() and class_exists() (pass the class as a string, not ::class),
    and $assist, which offers artisanCommand(), composerCommand(), binCommand(),
    nodePackageManagerCommand(), hasPackage(), appPath(), enums(),
    enumContents(), inertia().

    OVERRIDING A BOOST GUIDELINE

    A file that overrides one of Boost's own guidelines is keyed by its path, so
    inertia-laravel/core.blade.php keeps exactly that name or it composes as a
    second guideline instead of a replacement. Core guidelines resolve without an
    override key and cannot be replaced this way at all: exclude them in
    config/boost.php and add a numbered module instead, which is why 'php' sits
    in guidelines.exclude. Without the exclusion, agents read two PHP sections.

    LIFTING A MODULE INTO ANOTHER PROJECT

    The target needs Laravel Boost (PHP 8.2, Laravel 11 or later); older projects
    paste the rules by hand. Publish the config there if it is missing
    (vendor:publish --tag=boost-config), add any exclusion the module relies on,
    copy the file into .ai/guidelines, and regenerate. That is once per project;
    after it, editing and regenerating is the whole loop.

    FLAGS

    Plain boost:update is enough. The two flags matter only occasionally:

      --no-discover    skips the prompt for newly discovered packages. The
                       command already returns early when the shell is not
                       interactive, so this is for humans in a terminal.
      --ignore-skills  leaves the installed skills alone, worth using when a
                       generated skill has drifted from project conventions.
--}}
## AI Guidelines

This project uses Laravel Boost. `CLAUDE.md` and `AGENTS.md` are generated: edit
the sources in `.ai/guidelines/`, then run `{{ $assist->artisanCommand('boost:update') }}`.
