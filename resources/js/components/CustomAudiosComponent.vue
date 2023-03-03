<template>
	<div class="audiofiles-category--body">
		<div class="input-group input-group-sm mb-3 audiofiles-item">
			<label class="input-group-text">
				{{ sound1 }}
			</label>
			<input class="form-control" type="file" accept="audio/mpeg,.mp3" />
			<span v-if="true" class="form-control"> </span>
			<button type="button" class="btn btn-primary" v-if="true">
				Upload
			</button>
			<button type="button" class="btn btn-secondary" v-if="false">
				Αναπαραγωγή
			</button>
			<button type="button" class="btn btn-danger" v-if="false">
				Αφαίρεση
			</button>
		</div>
		<div class="input-group input-group-sm mb-3 audiofiles-item">
			<label class="input-group-text">
				{{ sound2 }}
			</label>
			<input class="form-control" type="file" accept="audio/mpeg,.mp3" />
			<span v-if="true" class="form-control"> </span>
			<button type="button" class="btn btn-primary" v-if="true">
				Upload
			</button>
			<button type="button" class="btn btn-secondary" v-if="false">
				Αναπαραγωγή
			</button>
			<button type="button" class="btn btn-danger" v-if="false">
				Αφαίρεση
			</button>
		</div>
		<div class="input-group input-group-sm mb-3 audiofiles-item">
			<label class="input-group-text">
				{{ sound3 }}
			</label>
			<input class="form-control" type="file" accept="audio/mpeg,.mp3" />
			<span v-if="true" class="form-control"> </span>
			<button type="button" class="btn btn-primary" v-if="true">
				Upload
			</button>
			<button type="button" class="btn btn-secondary" v-if="false">
				Αναπαραγωγή
			</button>
			<button type="button" class="btn btn-danger" v-if="false">
				Αφαίρεση
			</button>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		playerId: Number,
		uploadAudioUrl: String,
		removeAudioUrl: String,
		audios: {
			type: Object,
			default: function () {
				return {};
			},
		},
	},
	data: function () {
		return {
			sound1: "sound1",
			sound2: "sound2",
			sound3: "sound3",
		};
	},
	mounted() {
		console.log("Component mounted.");
	},
	methods: {},
};
</script>
