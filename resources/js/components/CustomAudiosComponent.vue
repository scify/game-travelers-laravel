<template>
	<div>
		<div class="border-bottom border-1 my-3">
			<h2>{{ title }}</h2>
		</div>

		<!-- audio-files -->
		<div
			id="audioFiles"
			class="audiofiles mb-5"
			v-if="audios.length === 12"
		>
			<div class="audiofiles-category pb-1" v-for="i in 4" :key="i">
				<div
					class="audiofiles-category--header my-3 border-bottom border-1"
				>
					<h3>{{ audioHeaders[i - 1] }}</h3>
				</div>
				<div class="audiofiles-category--body" v-for="j in 3" :key="j">
					<div
						class="input-group input-group-sm mb-3 audiofiles-item"
					>
						<label class="input-group-text">
							{{ getSoundName(i, j) }}
						</label>
						<input
							v-if="this.audios[index] === false"
							class="form-control"
							type="file"
							v-bind:id="getSoundInputId(i, j)"
							accept="audio/mpeg,.mp3"
						/>
						<span v-if="this.audios[index]" class="form-control">
						</span>
						<button
							v-on:click="uploadSound(i, j)"
							type="button"
							class="btn btn-primary"
							v-if="this.audios[index] === false"
						>
							Upload
						</button>
						<button
							type="button"
							class="btn btn-secondary"
							v-if="this.audios[index]"
						>
							Αναπαραγωγή
						</button>
						<button
							type="button"
							class="btn btn-danger"
							v-if="this.audios[index]"
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
		playerId: Number,
		uploadAudioUrl: String,
		removeAudioUrl: String,
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
			audioNames: [],
			audios: [],
			audioHeaders: [],
		};
	},
	mounted() {
		console.log("Component mounted.");
		let self = this;
		this.title = window.trans("messages.sounds_custom");
		this.sound = window.trans("messages.sound");
		Object.keys(this.playerAudioFiles).forEach((key) => {
			let innerObjects = self.playerAudioFiles[key];
			self.audioHeaders.push(self.getMessage(key));
			Object.keys(innerObjects).forEach((innerKey) => {
				self.audioNames.push(self.getNameOfAudioFile(innerKey));
				self.audios.push(innerObjects[innerKey]);
			});
		});
		//console.log(JSON.stringify(self.audios, null, 3));
	},
	methods: {
		getIndexFromName(audioKey) {
			let s = audioKey.split("_");
			return s[s.length - 1];
		},
		getNameOfAudioFile(audioFile) {
			let s = audioFile.split(".");
			return s[s.length - 1];
		},
		getMessage(key) {
			return window.trans("messages." + key);
		},
		getSoundName(i, j) {
			let name = this.getAudioName(i, j);
			return this.sound + " " + this.getIndexFromName(name);
		},
		getSoundInputId(i, j) {
			let index = this.getIndex(i, j);
			return "soundInput_" + index;
		},
		uploadSound(i, j) {
			let self = this;
			let id = this.getSoundInputId(i, j);
			let index = this.getIndex(i, j);
			let path = document.getElementById(id).value;
			if (path.length > 0) {
				let data = {
					player_id: this.playerId,
					audio_name: this.audioNames[index],
					path: path,
					index: index,
				};
				axios
					.post(this.uploadAudioUrl, data, {
						headers: {
							Accept: "application/json",
						},
					})
					.then(function (response) {
						if (response.status > 300) {
							console.log(response);
						} else {
							let index = response.data.index;
							self.audios[index] = true;
						}
					})
					.catch(function (error) {
						alert(error);
					});
			}
		},
		getIndex(i, j) {
			return (i - 1) * 3 + (j - 1);
		},
		getAudio(i, j) {
			let index = this.getIndex(i, j);
			if (this.audios[index]) return true;
			else return false;
		},
		getAudioName(i, j) {
			let index = this.getIndex(i, j);
			return this.audioNames[index];
		},
	},
};
</script>
