## Context
The current implementation uses a traditional Laravel Controller-View pattern. While functional, it lacks the reactivity desired for a modern property catalog.

## Decisions
- **Full-page Components:** Use Livewire components as full-page routes to maintain SEO and simplify the transition.
- **Query Parameter Synchronization:** Use Livewire's `Url` attribute to sync filters (type, location) with the URL.
- **Reuse UI:** Maintain the existing daisyUI and HyperUI styling during the refactor.

## Risks / Trade-offs
- **Re-rendering:** Ensure performance is maintained by optimizing Eloquent queries within the component.
