<template>
	<div>
		<div class="border-bottom border-1 my-3">
			<h2>{{ title }}</h2>
		</div>

		<!-- audio-files -->
		<div id="audioFiles" class="audiofiles mb-5">
			<div
				class="audiofiles-category pb-1"
				v-for="(playerAudioFile, index) in playerAudioFiles"
				:key="index"
			>
				<div
					class="audiofiles-category--header my-3 border-bottom border-1"
				>
					<h3>{{ getMessage(index) }}</h3>
				</div>
				<div class="audiofiles-category--body">
					<div
						class="input-group input-group-sm mb-3 audiofiles-item"
						v-for="(playerAudioFile, audioIndex) in playerAudioFile"
						:key="audioIndex"
					>
						<label class="input-group-text">
							{{ getSoundName(audioIndex) }}
						</label>
						<input
							v-if="!playerAudioFile"
							class="form-control"
							type="file"
							v-bind:id="getSoundInputId(index, audioIndex)"
							accept="audio/mpeg,.mp3"
						/>
						<span v-if="playerAudioFile" class="form-control">
						</span>
						<button
							v-on:click="uploadSound(index, audioIndex)"
							type="button"
							class="btn btn-primary"
							v-if="!playerAudioFile"
						>
							Upload
						</button>
						<button
							type="button"
							class="btn btn-secondary"
							v-if="playerAudioFile"
						>
							Αναπαραγωγή
						</button>
						<button
							type="button"
							class="btn btn-danger"
							v-if="playerAudioFile"
						>
							Αφαίρεση
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "CustomAudiosComponent",
	props: {
		backendUrl: String,
		playerAudioFiles: {
			type: Object,
			default: function () {
				return {};
			},
		},
	},
	data: function () {
		return {
			title: "",
			sound: "",
		};
	},
	mounted() {
		console.log("Component mounted.");
		this.title = window.trans("messages.sounds_custom");
		this.sound = window.trans("messages.sound");
	},
	methods: {
		getIndex(audioKey) {
			let s = audioKey.split("_");
			return s[s.length - 1];
		},
		getMessage(key) {
			return window.trans("messages." + key);
		},
		getSoundName(audioKey) {
			return this.sound + " " + this.getIndex(audioKey);
		},
		getSoundInputId(key, audioKey) {
			return "soundInput_" + key + "_" + this.getIndex(audioKey);
		},
		uploadSound(key, audioKey) {
			let id = this.getSoundInputId(key, audioKey);
			let path = document.getElementById(id).value;
			if (path.length > 0) {
				alert(key + "!" + this.getIndex(audioKey) + "!" + path);
			}
		},
	},
};
</script>
