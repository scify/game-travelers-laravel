<template>
    <div
        v-if="visible"
        class="board-debug"
    >
        <pre class="board-debug__state">{{ stateText }}</pre>
        <form
            class="board-debug__form"
            @submit.prevent="tools.setState(form)"
        >
            <label for="board-debug-pos1">pos1</label>
            <input
                id="board-debug-pos1"
                v-model.number="form.pos1"
                type="number"
                min="0"
                max="45"
            />
            <label for="board-debug-pos2">pos2</label>
            <input
                id="board-debug-pos2"
                v-model.number="form.pos2"
                type="number"
                min="0"
                max="45"
            />
            <label for="board-debug-phase">phase</label>
            <input
                id="board-debug-phase"
                v-model.number="form.phase"
                type="number"
                min="1"
                max="3"
            />
            <label for="board-debug-turn">turn</label>
            <select
                id="board-debug-turn"
                v-model="form.turn"
            >
                <option :value="null">keep</option>
                <option :value="true">first player</option>
                <option :value="false">second player</option>
            </select>
            <label for="board-debug-next">next roll lands on</label>
            <input
                id="board-debug-next"
                v-model.number="form.next"
                type="number"
                min="1"
                max="45"
            />
            <label for="board-debug-card">next card</label>
            <input
                id="board-debug-card"
                v-model.number="form.card"
                type="number"
                min="-10"
                max="10"
            />
            <button type="submit">Apply and reload</button>
        </form>
        <div class="board-debug__actions">
            <button
                type="button"
                @click="tools.roll()"
            >
                Roll (select key)
            </button>
            <button
                type="button"
                @click="tools.move()"
            >
                Move to target
            </button>
            <button
                type="button"
                @click="muted = tools.mute(!muted)"
            >
                {{ muted ? 'Unmute' : 'Mute' }}
            </button>
        </div>
    </div>
</template>

<script>
/**
 * The board's debug strip: F2 toggles it. Shows the game's state, stages the
 * game row and plays through the tools the board publishes (see debug.js).
 * Rendered only where window.Laravel.debug is true.
 */
export default {
    props: {
        tools: { type: Object, required: true },
        lastEvent: { type: String, default: '' },
    },
    data() {
        return {
            visible: false,
            muted: false,
            form: { pos1: null, pos2: null, phase: null, turn: null, next: null, card: null },
        };
    },
    computed: {
        stateText() {
            const state = Object.entries(this.tools.state())
                .map(([key, value]) => key + ': ' + JSON.stringify(value))
                .join('  ');
            return state + '\nlast event: ' + this.lastEvent;
        },
    },
    mounted() {
        window.addEventListener('keydown', (e) => {
            if (e.key === 'F2') {
                e.preventDefault();
                this.visible = !this.visible;
            }
        });
    },
};
</script>

<style scoped>
/* Above the cookie consent button, which sits at 1000000. */
.board-debug {
    position: fixed;
    inset: auto 0 0;
    z-index: 1000001;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem 1.5rem;
    align-items: center;
    padding: 0.5rem 1rem;
    font:
        12px/1.4 ui-monospace,
        monospace;
    color: #fff;
    background: rgba(0, 0, 0, 0.85);
}

.board-debug__state {
    margin: 0;
    font: inherit;
    white-space: pre-wrap;
}

.board-debug__form,
.board-debug__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
}

.board-debug input,
.board-debug select,
.board-debug button {
    font: inherit;
}

.board-debug input {
    width: 4.5rem;
}
</style>
