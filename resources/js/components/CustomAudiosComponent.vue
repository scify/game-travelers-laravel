<template>
    <div class="audiofiles-category--body">
        <div class="input-group input-group-sm mb-3 audiofiles-item">
            <label
                class="input-group-text"
                :for="`${uid}-sound1`"
            >
                {{ sound1 }}
            </label>
            <input
                :id="`${uid}-sound1`"
                class="form-control"
                type="file"
                accept="audio/mpeg,.mp3"
            />
            <span
                v-if="true"
                class="form-control"
            >
            </span>
            <button
                v-if="true"
                type="button"
                class="btn btn-primary"
            >
                Upload
            </button>
            <button
                v-if="false"
                type="button"
                class="btn btn-secondary"
            >
                Αναπαραγωγή
            </button>
            <button
                v-if="false"
                type="button"
                class="btn btn-danger"
            >
                Αφαίρεση
            </button>
        </div>
        <div class="input-group input-group-sm mb-3 audiofiles-item">
            <label
                class="input-group-text"
                :for="`${uid}-sound2`"
            >
                {{ sound2 }}
            </label>
            <input
                :id="`${uid}-sound2`"
                class="form-control"
                type="file"
                accept="audio/mpeg,.mp3"
            />
            <span
                v-if="true"
                class="form-control"
            >
            </span>
            <button
                v-if="true"
                type="button"
                class="btn btn-primary"
            >
                Upload
            </button>
            <button
                v-if="false"
                type="button"
                class="btn btn-secondary"
            >
                Αναπαραγωγή
            </button>
            <button
                v-if="false"
                type="button"
                class="btn btn-danger"
            >
                Αφαίρεση
            </button>
        </div>
        <div class="input-group input-group-sm mb-3 audiofiles-item">
            <label
                class="input-group-text"
                :for="`${uid}-sound3`"
            >
                {{ sound3 }}
            </label>
            <input
                :id="`${uid}-sound3`"
                class="form-control"
                type="file"
                accept="audio/mpeg,.mp3"
            />
            <span
                v-if="true"
                class="form-control"
            >
            </span>
            <button
                v-if="true"
                type="button"
                class="btn btn-primary"
            >
                Upload
            </button>
            <button
                v-if="false"
                type="button"
                class="btn btn-secondary"
            >
                Αναπαραγωγή
            </button>
            <button
                v-if="false"
                type="button"
                class="btn btn-danger"
            >
                Αφαίρεση
            </button>
        </div>
    </div>
</template>

<script>
import { useId } from 'vue';

export default {
    props: {
        playerId: { type: Number, required: true },
        uploadAudioUrl: { type: String, required: true },
        removeAudioUrl: { type: String, required: true },
        audios: {
            type: Object,
            default: function () {
                return {};
            },
        },
    },
    setup() {
        return { uid: useId() };
    },
    data: function () {
        return {
            sound1: 'sound1',
            sound2: 'sound2',
            sound3: 'sound3',
        };
    },
    mounted() {
        console.log('Component mounted.');
    },
    methods: {},
};
</script>
