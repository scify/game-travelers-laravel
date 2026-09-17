{{--
    Project code quality rules. Boost composes this into every agent guideline file.

    The commands render per environment: `$assist->composerCommand()` emits the DDEV
    prefix here, a bare `composer` on a plain setup, and the Sail binary under Sail.

    The Larastan block renders only where the package is installed.
--}}
## Code Quality

Code quality tools are your friends. Don't try to ignore or silence them, ever!

- **ALWAYS run code quality tools before completing work** (not in parallel):
    - `{{ $assist->composerCommand('lint:agent') }}` - Format PHP code (agent-optimised output via pao)
    - `{{ $assist->composerCommand('test:agent') }}` - Run static analysis and tests (agent-optimised output via pao)
- **Never leave code with formatting or static analysis errors**
- **Use project configuration**: Don't override defaults
@if($assist->hasPackage('larastan/larastan'))

### Everyone loves Larastan!

- Do not lie about types and do not promise types which cannot be guaranteed!
- If unsure about types, tinker to validate assumptions.
- Most errors caught by Larastan imply that something is wrong in the code's logic.
- You are not expected to *satisfy* Larastan. Instead, try to fix the underlying issue and lead the code to deliver the expected outcome. Use logic and analyse the paths carefully.
- On TESTS Larastan would most likely highlight either a (additional, yet) missing assertion or an assertion which by definition is useless.
@endif
