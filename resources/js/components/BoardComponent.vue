<template>
	<div
		class="w-100 h-100 p-0 m-0"
		v-bind:style="{
			backgroundImage: 'url(\'' + this.getSizePath() + 'board.png\')',
		}"
	>
		<Transition name="fade">
			<img
				v-if="this.computeCardSrc.length > 0"
				v-bind:src="this.computeCardSrc"
				style="
					z-index: 10;
					position: absolute;
					display: block;
					left: calc(50% - 344px / 2);
					top: calc(50% - 482px / 2);
				"
			/>
		</Transition>
		<div v-if="this.gameEnd === 0">
			<Transition name="fade_blue">
				<img
					v-if="this.blue_position_show"
					v-bind:src="this.computeBlueSrc"
					style="z-index: 2; position: absolute; display: block"
				/>
			</Transition>
			<Transition name="fade">
				<img
					v-if="this.showPawn1"
					v-bind:src="this.computePawn1Src"
					style="z-index: 2; position: absolute; display: block"
				/>
			</Transition>
			<div v-if="this.gameMode > 1">
				<Transition name="fade">
					<img
						v-if="this.showPawn2"
						v-bind:src="this.computePawn2Src"
						style="z-index: 2; position: absolute; display: block"
					/>
				</Transition>
			</div>
			<img
				v-bind:src="this.computeLeftSrc"
				style="z-index: 2; position: absolute; display: block"
			/>
			<div v-if="this.gameMode > 1">
				<img
					v-bind:src="this.computeRightSrc"
					style="z-index: 2; position: absolute; display: block"
				/>
			</div>
			<Transition name="fade">
				<img
					:class="{
						shake: this.rollingAnimation,
						moveUpDown: this.rollAnimation,
					}"
					v-if="this.center_src.length > 0"
					v-bind:src="this.center_src"
					style="z-index: 2; position: absolute; display: block"
				/>
			</Transition>
		</div>

		<Transition name="fade">
			<img
				v-if="this.gameEnd === 1"
				v-bind:src="this.getWinSrc()"
				style="z-index: 10; position: absolute; display: block"
			/>
		</Transition>
		<Transition name="fade">
			<img
				v-if="this.gameEnd === -1"
				v-bind:src="this.getLoseSrc()"
				style="z-index: 10; position: absolute; display: block"
			/>
		</Transition>
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
		exitUrl: String,
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
		cards: {
			type: Object,
			default: function () {
				return {};
			},
		},
	},
	data: function () {
		return {
			ignoreInput: false,
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
			gameMode: this.gameData["mode"],
			pawn1: this.gameData["pawn1"],
			pawn2: this.gameData["pawn2"],
			tutorial: this.gameData["tutorial"],
			pos1: this.gameData["pos1"],
			pos2: this.gameData["pos2"],
			newPosition: -1,
			firstPlayerTurn: this.gameData["firstPlayerTurn"],
			gamePhase: this.gameData["game_phase"], // 1 roll, 2 move, 3 draw
			center_src: "",
			blueIndex: 0,
			blue_position_show: false,
			blue_blinking_allowed: false,
			rollAnimation: false,
			rollingAnimation: false,
			showPawn1: false,
			showPawn2: false,
			gameEnd: 0,
			mistakes: 0,
			cardName: "",
		};
	},
	methods: {
		getBoardPath() {
			return "/images/boards/board_" + this.board + "/";
		},
		getSizePath() {
			return this.getBoardPath() + "size_" + this.boardSize + "/";
		},
		getWinSrc() {
			return this.getBoardPath() + "win.png";
		},
		getLoseSrc() {
			return this.getBoardPath() + "lose.png";
		},
		activate_blue_rotation(start, end, current, second) {
			if (this.blue_blinking_allowed) {
				this.blueIndex = current;
				this.blue_position_show = true;
				window.setTimeout(() => {
					this.blue_position_show = false;
				}, 500);
				window.setTimeout(() => {
					let nextSecond = second + 1;
					if (nextSecond === this.scanningSpeed) {
						nextSecond = 0;
						let next_current = current + 1;
						if (next_current > end) next_current = start;
						this.activate_blue_rotation(
							start,
							end,
							next_current,
							nextSecond
						);
					} else
						this.activate_blue_rotation(
							start,
							end,
							current,
							nextSecond
						);
				}, 1000);
			} else {
				this.blue_position_show = false;
				this.blueIndex = 0;
			}
		},
		key_press(e) {
			if (!this.ignoreInput) {
				let key = e.key;
				if (key === " ") key = "Space";
				let isSelect = false;
				let isNavigate = false;
				if (this.selectKey === key) isSelect = true;
				else if (this.autoMove === 2 && this.navigateKey === key)
					isNavigate = true;
				if (isSelect || isNavigate) {
					if (this.gameEnd !== 0) window.location.href = this.exitUrl;
					else if (this.gamePhase === 1) {
						this.ignoreInput = true;
						this.sendToBackend();
					} else if (this.gamePhase === 2) {
						if (isNavigate) {
							this.blue_position_show = false;
							let nextBlue = this.blueIndex + 1;
							if (nextBlue > this.newPosition) {
								nextBlue = this.pos1 + 1;
								if (!this.firstPlayerTurn)
									nextBlue = this.pos2 + 1;
							}
							this.blueIndex = nextBlue;
							this.blue_position_show = true;
						} else if (isSelect) {
							if (this.newPosition === this.blueIndex) {
								this.applyCorrectMovement();
							} else {
								this.mistakes += 1;
								if (this.mistakes === this.maxMistakes) {
									// treat the choice as correct
									this.mistakes = 0;
									this.applyCorrectMovement();
								}
							}
						}
					} else if (this.gamePhase === 3) {
						this.cardName = "";
						this.applyCorrectMovement();
					}
				}
			}
		},
		setCenter(isDice, value) {
			let src = this.getBoardPath() + "center/";
			if (isDice) {
				// show dice
				if (value === 0) {
					if (this.diceType === 1) src += "dice_numbers";
					else if (this.diceType === 2) src += "dice_dots";
					else if (this.diceType === 3) src += "dice_colours";
				} else {
					if (this.diceType === 3) {
						if (value === 1) src += "o";
						else if (value === 2) src += "g";
						else if (value === 3) src += "b";
						else if (value === 4) src += "p";
						else if (value === 5) src += "r";
						else if (value === 6) src += "y";
					} else {
						src += value;
						if (this.diceType === 2) src += "d";
					}
				}
			} else {
				//show cloud
				if (value > 0) src += "p";
				else src += "m";
				src += Math.abs(value);
			}
			this.center_src = src + ".png";
		},
		activateSelector(newPosition) {
			let pos = this.pos1;
			if (!this.firstPlayerTurn) pos = this.pos2;
			if (this.movementMode === 1) {
				this.ignoreInput = false;
				this.blue_blinking_allowed = true;
				this.activate_blue_rotation(
					newPosition,
					newPosition,
					newPosition,
					0
				);
			} else if (this.movementMode === 2) {
				this.blue_blinking_allowed = true;
				this.activate_blue_rotation(
					newPosition,
					newPosition,
					newPosition,
					0
				);
				window.setTimeout(() => {
					this.blue_blinking_allowed = false;
					this.ignoreInput = false;
				}, 3000);

				//if only selection key is used
				window.setTimeout(() => {
					if (this.autoMove === 1) {
						this.blue_blinking_allowed = true;
						this.activate_blue_rotation(
							pos + 1,
							newPosition,
							pos + 1,
							0
						);
					} else {
						//if navigation key is used
						this.blueIndex = pos + 1;
						this.blue_position_show = true;
					}
				}, 3200);
			} else if (this.movementMode === 3) {
				if (this.autoMove === 1) {
					this.blue_blinking_allowed = true;
					let max = pos + 6;
					let max_value = 15;
					if (this.boardSize === 2) max_value = 30;
					else if (this.boardSize === 3) max_value = 45;
					if (max > max_value) max = max_value;
					this.activate_blue_rotation(pos + 1, max, pos + 1, 0);
				} else {
					this.blueIndex = pos + 1;
					this.blue_position_show = true;
				}
			}
		},
		applyDiceRoll(newPosition, diceResult) {
			this.gamePhase = 2;
			this.mistakes = 0;
			this.newPosition = newPosition;
			this.setCenter(true, diceResult);
			if (this.gameMode === 2 && !this.firstPlayerTurn)
				this.applyCorrectMovement();
			//check this in pvp
			else this.activateSelector(newPosition);
		},
		applyCorrectMovement() {
			this.blue_blinking_allowed = false;
			window.setTimeout(() => {
				this.ignoreInput = true;
				this.blueIndex = this.newPosition;
				this.blue_position_show = true;
				if (this.firstPlayerTurn) {
					this.showPawn1 = false;
					this.pos1 = this.newPosition;
					window.setTimeout(() => {
						this.showPawn1 = true;
					}, 1000);
				} else {
					this.showPawn2 = false;
					this.pos2 = this.newPosition;
					window.setTimeout(() => {
						this.showPawn2 = true;
					}, 1000);
				}
				this.newPosition = -1;
				this.sendToBackend();
			}, 1000);
		},
		applyCardMovement(cardValue) {
			let pos = this.pos1;
			if (!this.firstPlayerTurn) pos = this.pos2;
			pos += cardValue;
			this.gamePhase = 3;
			this.newPosition = pos;
			this.setCenter(false, cardValue);
		},
		init() {
			// need to roll
			window.setTimeout(() => {
				this.showPawn1 = true;
				this.showPawn2 = true;
				if (this.gamePhase === 1) {
					this.setCenter(this.diceType, 0);
					this.rollAnimation = true;
				} else this.sendToBackend();
			}, 500);
		},
		sendToBackend() {
			let data = {
				player_id: this.playerId,
				game_id: this.gameId,
				first_player_turn: this.firstPlayerTurn,
				location_1: this.pos1,
				location_2: this.pos2,
				game_phase: this.gamePhase,
				dice_type: this.diceType,
				difficulty: this.difficulty,
				game_mode: this.gameMode,
				board_id: this.board,
			};
			//alert(JSON.stringify(data, null, "    "));
			let self = this;
			if (self.gamePhase === 1) {
				this.rollingAnimation = true;
				this.rollAnimation = false;
			}
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
						self.gameEnd = response.data.gameEnded;
						if (self.gameEnd !== 0) {
							window.setTimeout(() => {
								self.ignoreInput = false;
							}, 1000);
						} else {
							if (self.gamePhase === 1) {
								window.setTimeout(() => {
									self.applyDiceRoll(
										response.data.newPosition,
										response.data.diceResult
									);
									self.rollingAnimation = false;
								}, 1000);
							} else if (self.gamePhase === 2) {
								self.firstPlayerTurn =
									response.data.firstPlayerTurn;
								if (response.data.drawCard === 0) {
									self.setCenter(true, 0);
									self.rollAnimation = true;
									self.gamePhase = 1;
									if (self.firstPlayerTurn)
										self.ignoreInput = false;
									else if (self.gameMode === 2) {
										window.setTimeout(() => {
											self.sendToBackend();
										}, 1000);
									}
								} else {
									//draw a card
									let card =
										self.cards[response.data.drawCard];
									self.cardName = card["name"];
									self.applyCardMovement(card["value"]);
									self.ignoreInput = false;
								}
							} else if (self.gamePhase === 3) {
								self.firstPlayerTurn =
									response.data.firstPlayerTurn;
								self.setCenter(true, 0);
								self.rollAnimation = true;
								self.gamePhase = 1;
								if (self.firstPlayerTurn)
									self.ignoreInput = false;
								else if (self.gameMode === 2) {
									window.setTimeout(() => {
										self.sendToBackend();
									}, 1000);
								}
							}
						}
					}
				})
				.catch(function (error) {
					//console.log(error);
					alert(error);
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
		computeBlueSrc() {
			if (this.blueIndex === 0) return "";
			else
				return (
					this.getSizePath() +
					"blue_positions/" +
					this.blueIndex +
					".png"
				);
		},
		computeCardSrc() {
			if (this.cardName === "") return "";
			else return this.getBoardPath() + "cards/" + this.cardName + ".png";
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
	transition: opacity 1s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.fade_blue-enter-active,
.fade_blue-leave-active {
	transition: opacity 0.5s;
}

.fade_blue-enter, .fade_blue-leave-to /* .fade_blue-leave-active below version 2.1.8 */ {
	opacity: 0;
}
</style>
