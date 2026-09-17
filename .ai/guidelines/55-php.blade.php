## PHP

- Use `declare(strict_types=1);`, 4-space indentation.
@if(version_compare(PHP_VERSION, '8.2', '>='))
- Everything should be `final readonly` unless there's a reason not to.
@else
- Everything should be `final` unless there's a reason not to.
@endif
- Always use curly braces for control structures, even for single-line bodies.
@if(version_compare(PHP_VERSION, '8.0', '>='))
- Use constructor property promotion. No empty zero-parameter constructors unless private.
@endif
- Always add PHPDoc types for arrays (e.g. `{!! '@var array<string, mixed>' !!}`), complex return types, and variables where type inference isn't obvious. Use array shape definitions where appropriate.
- The `@verbatim@throws@endverbatim` annotations are NOT optional.
- Always type-hint method parameters and return types explicitly.
- Never assert() on production code. If unsure of a type, validate versus actual code: NO LIES!
- Do not use curly braces in string interpolation: `"$var"` not `"{$var}"` unless disambiguation needed (e.g. `"{$obj->prop}"`, `"{$arr['key']}"`)
- Throw guards: classic `if (...) { throw ... }` only; `throw_if`/`throw_unless` are banned (double negation, IDE-opaque narrowing). `abort_if`/`abort_unless` stay: controller guards carry HTTP semantics and load-bearing Larastan narrowing.
@if(version_compare(PHP_VERSION, '8.1', '>='))
- Enum cases should be TitleCase: `FavoritePerson`, `BestLake`, `Monthly`.
@endif
@if(method_exists('Illuminate\Validation\Rule', 'string'))
- Fluent validation rule builders: `Rule::string()`, `Rule::numeric()`, `Rule::email()`, `Rule::date()` in FormRequests. Plain strings when no fluent method (e.g. `regex`).
@endif
@if(version_compare(PHP_VERSION, '8.4', '>='))
- Prefer the array functions over manual loops when not using collections: `array_find()`, `array_find_key()`, `array_any()`, `array_all()`.
- Chain directly on new instances, without wrapping parentheses: `new JsonResponse($data)->setStatusCode(201)`.
@endif
