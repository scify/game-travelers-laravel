<template>
	<div
		class="w-100 h-100 p-0 m-0"
		v-bind:style="{
			backgroundImage: 'url(\'' + this.getSizePath() + 'board.png\')',
		}"
	>
		<Transition name="fade">
			<img
				v-if="this.showPawn1"
				v-bind:src="this.computePawn1Src"
				style="z-index: 2; position: absolute; display: block"
			/>
		</Transition>
		<Transition name="fade">
			<img
				v-if="this.showPawn2"
				v-bind:src="this.computePawn2Src"
				style="z-index: 2; position: absolute; display: block"
			/>
		</Transition>
		<img
			v-bind:src="this.computeLeftSrc"
			style="z-index: 2; position: absolute; display: block"
		/>
		<img
			v-bind:src="this.computeRightSrc"
			style="z-index: 2; position: absolute; display: block"
		/>

		<img
			:class="{
				shake: this.rollingAnimation,
				moveUpDown: this.rollAnimation,
			}"
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
		backendUrl: String,
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
			boardSize: this.gameData["board_size"],
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
			gamePhase: this.gameData["game_phase"], // 1 roll, 2 move, 3 draw
			center_src: "",
			rollAnimation: false,
			rollingAnimation: false,
			showPawn1: false,
			showPawn2: false,
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
			this.sendToBackend();
			this.rollingAnimation = true;
			this.rollAnimation = false;
			window.setTimeout(() => {
				this.rollingAnimation = false;
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
			if (this.gamePhase == 1) {
				// need to roll
				this.center_src = this.setCenter(this.diceType, 0);
				window.setTimeout(() => {
					this.showPawn1 = true;
					this.showPawn2 = true;
					this.rollAnimation = true;
				}, 500);
			}
		},
		sendToBackend() {
			let data = {
				player_id: this.playerId,
				game_id: this.gameId,
				first_player_turn: this.firstPlayerTurn,
				location_1: this.pos1,
				location_2: this.pos2,
				game_phase: this.gamePhase,
			};
			axios
				.post(this.backendUrl, data, {
					headers: {
						Accept: "application/json",
					},
				})
				.then(function (response) {
					if (response.status > 300) {
						console.log(response);
					} else {
						alert(JSON.stringify(response.data, null, 2));
					}
				})
				.catch(function (error) {
					console.log(error);
				});
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

.moveUpDown {
	animation: moveUpDown 1s linear infinite;
}

@keyframes moveUpDown {
	0%,
	100% {
		transform: translateY(5px);
	}
	50% {
		transform: translateY(-5px);
	}
}

.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.9s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}
</style>
