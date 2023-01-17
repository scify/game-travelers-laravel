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
			console.log(e);
			alert(key);
			//console.log(String.fromCharCode(e.keyCode));
			//console.log("my object: %o", this.playerData);
			//alert(e.keyCode);
		},
		init() {},
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
