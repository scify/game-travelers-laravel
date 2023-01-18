<template>
	<div
		class="w-100 h-100 p-0 m-0"
		v-bind:style="{
			backgroundImage: 'url(\'' + this.getSizePath() + 'board.png\')',
		}"
	>
		<img
			v-bind:src="this.computePawn1Src"
			style="z-index: 2; position: absolute; display: block"
		/>
		<img
			v-bind:src="this.computePawn2Src"
			style="z-index: 2; position: absolute; display: block"
		/>
		<img
			v-bind:src="this.computeLeftSrc"
			style="z-index: 2; position: absolute; display: block"
		/>
		<img
			v-bind:src="this.computeRightSrc"
			style="z-index: 2; position: absolute; display: block"
		/>

		<img
			:class="{ shake: this.dice_animation }"
			v-bind:src="this.center_src"
			style="z-index: 2; position: absolute; display: block"
		/>
	</div>
</template>

<script>
export default {
	mounted() {
		console.log("Component mounted.");
		window.addEventListener("keypress", (e) => {
			this.key_press(e);
		});
		// window.AudioPlayer.playBackgroundMusic();
		// window.AudioPlayer.playStartMusic();
		this.init();
	},
	props: {
		playerId: Number,
		gameId: Number,
		playerData: {
			type: Object,
			default: function () {
				return {};
			},
		},
		gameData: {
			type: Object,
			default: function () {
				return {};
			},
		},
	},
	data: function () {
		return {
			playerName: this.playerData["name"],
			avatarId: this.playerData["avatar_id"],
			autoMove: this.playerData["auto"],
			selectKey: this.playerData["select_key"],
			navigateKey: this.playerData["navigate_key"],
			maxMistakes: this.playerData["help_after_x_mistakes"],
			scanningSpeed: this.playerData["scanning_speed"],
			diceType: this.playerData["dice_type"],
			boardSize: this.playerData["board_size"],
			difficulty: this.playerData["difficulty"],
			movementMode: this.playerData["movement_mode"],
			board: this.gameData["board"],
			mode: this.gameData["mode"],
			pawn1: this.gameData["pawn1"],
			pawn2: this.gameData["pawn2"],
			tutorial: this.gameData["tutorial"],
			pos1: this.gameData["pos1"],
			pos2: this.gameData["pos2"],
			firstPlayerTurn: this.gameData["firstPlayerTurn"],
			center_src: "",
			dice_animation: false,
		};
	},
	methods: {
		getBoardPath() {
			return "/images/board/board_" + this.board + "/";
		},
		getSizePath() {
			return this.getBoardPath() + "size_" + this.boardSize + "/";
		},
		make_location_blue(pos) {
			alert(pos);
		},
		key_press(e) {
			let key = e.key;
			if (key === " ") key = "Space";
			//console.log(e);
			//alert(key);
			//console.log(String.fromCharCode(e.keyCode));
			//console.log("my object: %o", this.playerData);
			//alert(e.keyCode);
			this.dice_animation = true;
			window.setTimeout(() => {
				this.dice_animation = false;
			}, 1000);
		},
		setCenter(isDice, value) {
			let src = this.getBoardPath() + "center/";
			if (isDice) {
				// show dice
				if (value == 0) {
					if (this.diceType === 1) src += "dice_numbers";
					else if (this.diceType === 2) src += "dice_dots";
					else if (this.diceType === 3) src += "dice_colours";
				} else {
					if (this.diceType == 3) {
						if (value == 1) src += "o";
						else if (value == 2) src += "g";
						else if (value == 3) src += "b";
						else if (value == 4) src += "p";
						else if (value == 5) src += "r";
						else if (value == 6) src += "y";
					} else {
						src += value;
						if (this.diceType == 2) src += "d";
					}
				}
			} else {
				//show cloud
				if (value > 0) src += "p";
				else src += "m";
				src += Math.abs(value);
			}
			return src + ".png";
		},
		init() {
			this.center_src = this.setCenter(this.diceType, 0);
		},
	},
	computed: {
		computePawn1Src() {
			return (
				this.getSizePath() +
				"pieces/" +
				this.pawn1 +
				"/" +
				this.pos1 +
				".png"
			);
		},
		computePawn2Src() {
			return (
				this.getSizePath() +
				"pieces/" +
				this.pawn2 +
				"/" +
				this.pos2 +
				"b.png"
			);
		},
		computeLeftSrc() {
			if (this.firstPlayerTurn) {
				return this.getBoardPath() + "left/" + this.pawn1 + "a.png";
			} else {
				return this.getBoardPath() + "left/" + this.pawn1 + ".png";
			}
		},
		computeRightSrc() {
			if (this.firstPlayerTurn) {
				return this.getBoardPath() + "right/" + this.pawn2 + ".png";
			} else {
				return this.getBoardPath() + "right/" + this.pawn2 + "a.png";
			}
		},
	},
};
</script>

<style scoped>
.shake {
	animation: shake 1s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
	transform: translate3d(0, 0, 0);
}

@keyframes shake {
	10%,
	90% {
		transform: translate3d(-2px, -1px, 0);
	}

	20%,
	80% {
		transform: translate3d(3px, 1px, 0);
	}

	30%,
	50%,
	70% {
		transform: translate3d(-6px, -2px, 0);
	}

	40%,
	60% {
		transform: translate3d(6px, 2px, 0);
	}
}
</style>
