### HTML/Styling

- Always use the most modern HTML, CSS, and JS you can. If it's supported in every browser, even if it's only the most recent version, use it.
- Always nest CSS selectors to avoid specificity issues.
@if($assist->hasPackage('lucide-vue-next'))
- Lucide Icons must be imported & used with the Lucide prefix, e.g. LucideClipboard instead of Clipboard.
@endif
@if($assist->hasPackage('bootstrap'))
- Leverage Bootstrap's classes before writing custom CSS.
@endif
@if($assist->hasPackage('vue'))
- Use the `scoped` attribute on Vue style blocks to avoid global CSS pollution.
@endif
- A11y matters.

@if($assist->hasPackage('typescript'))
### TypeScript

- Use strict mode, concise/short JSDoc comments only when necessary, follow best practices
@if($assist->hasPackage('vue'))
- Use Vue's Composition API with `script setup lang="ts"` blocks, type-based props/emits declarations
@endif
@endif

@if(config('inertia.ssr.enabled'))
### SSR (Server-Side Rendering)

This project is using SSR: Vue code executes on both server (Node.js) and client (browser). Write SSR-safe code always.

- **`import.meta.env.SSR`** is the canonical guard for Vite. Prefer it over `typeof window === 'undefined'` which is a runtime check that ships in both bundles.
- **No mutable state at module scope** in composables or shared modules. `ref()`, `shallowRef()`, `let`, `new Map()` at module level persist across SSR requests in the same Node process, leaking state between users. Create state inside function bodies or use provide/inject.
- **Browser APIs** (`window`, `document`, `localStorage`) do not exist on the server. Access them inside `onMounted()` or behind `if (!import.meta.env.SSR)`.
- **State that crosses component boundaries**: use provide/inject (fresh per `createSSRApp()`). See `useKosovoDisclaimer.ts` for the pattern.
@endif
