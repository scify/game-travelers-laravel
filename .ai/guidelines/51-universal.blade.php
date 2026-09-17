### Universal

- **Unicode Support**: Ensure full UTF support throughout

### Comments & Inline Documentation

- Style baseline: MS Writing Style Guide for all developer-facing prose (comments, commit messages, docs).
- Prefer concise blocks to inline comments. The code itself should be self-explanatory.
- Docblock shape: Concise, one line, under 80 chars. If a short description is absolutely necessary, add a blank line followed by the shortest body that adds information; standalone `@see` (internal) and `@link` (URLs) at the bottom if needed. No `@param`/`@return` unless they add information the signature cannot (array shapes, generics).
- Plain international English: Colleagues read English as a second language: short declarative sentences, common words, no idiom. Technical terms stay where they are the exact word. Many people read this project, and not all of them code.
- No mannered prose: where a literal phrase exists, use it. "A parameter worth varying", not "a dial worth turning". "This still matters", not "this earns its keep". A metaphor carries connotations the writer did not choose and cannot control, and it makes the reader work harder so the writer can perform. Same rule as plain international English, aimed at figures of speech rather than idiom.
- Domain vocabulary takes precedence: When the codebase names a concept, documentation uses the same word, even when a plainer synonym exists.
- State the positive: Describe what the code does. Only describe what it avoids when the avoidance is the point.
- Timeless wording: No dates, ticket IDs, internal codenames, or references to removed systems. No possessives (our/your), no em dashes; use commas, parentheses, or semicolons.
