<template>
	<div class="w-100 h-100 p-0 m-0">
		<Transition name="fade_init">
			<div
				v-if="this.gameEnd === 0"
				class="w-100 h-100 p-0 m-0"
				v-bind:style="{
					backgroundImage: this.computeBackgroundSrc,
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
					<img
						v-if="this.blueIndex !== 0"
						v-bind:src="this.getStartSrc()"
						style="z-index: 4; position: absolute; display: block"
					/>
					<img
						v-bind:src="this.getGoalSrc()"
						style="z-index: 4; position: absolute; display: block"
					/>
					<img
						v-if="getExtrasSrc().length > 0"
						v-bind:src="this.getExtrasSrc()"
						style="z-index: 4; position: absolute; display: block"
					/>
					<Transition name="fade">
						<img
							@mouseover="infoState = 1"
							@mouseleave="infoState = 0"
							v-on:click="showPopUp = true"
							v-bind:src="this.computeInfoSrc"
							style="
								z-index: 50;
								position: absolute;
								display: block;
								left: calc(50% - 500px);
								top: calc(50% - 340px);
							"
						/>
					</Transition>
					<Transition name="fade">
						<img
							v-if="this.showPopUp"
							v-on:click="showPopUp = false"
							src="/images/boards/info/pop_up.png"
							style="
								z-index: 100;
								position: absolute;
								display: block;
							"
						/>
					</Transition>
					<Transition name="fade_blue">
						<img
							v-if="this.blue_position_show"
							v-bind:src="this.computeBlueSrc"
							style="
								z-index: 2;
								position: absolute;
								display: block;
							"
						/>
					</Transition>
					<Transition name="fade">
						<img
							v-if="this.showPawn1"
							v-bind:src="this.computePawn1Src"
							style="
								z-index: 5;
								position: absolute;
								display: block;
							"
						/>
					</Transition>
					<div v-if="this.gameMode > 1">
						<Transition name="fade">
							<img
								v-if="this.showPawn2"
								v-bind:src="this.computePawn2Src"
								style="
									z-index: 5;
									position: absolute;
									display: block;
								"
							/>
						</Transition>
					</div>
					<img
						v-bind:src="this.computeLeftSrc"
						style="z-index: 5; position: absolute; display: block"
					/>
					<div v-if="this.gameMode > 1">
						<img
							v-bind:src="this.computeRightSrc"
							style="
								z-index: 5;
								position: absolute;
								display: block;
							"
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
							style="
								z-index: 5;
								position: absolute;
								display: block;
							"
						/>
					</Transition>
				</div>
			</div>
		</Transition>
		<Transition name="fade_init">
			<div
				v-if="this.showWin"
				class="w-100 h-100 p-0 m-0"
				v-bind:style="{
					backgroundImage: this.computeBackgroundSrc,
				}"
			>
				<Transition name="fade_init">
					<img
						v-if="this.winFrame > 0"
						v-bind:src="this.winFrame1"
						style="z-index: 2; position: absolute; display: block"
					/>
				</Transition>
				<Transition name="slide-fade">
					<img
						v-if="this.winFrame > 1"
						v-bind:src="this.winFrame2"
						style="z-index: 2; position: absolute; display: block"
					/>
				</Transition>
				<Transition name="bounce">
					<img
						v-if="this.winFrame > 2"
						v-bind:src="this.winFrame3"
						style="z-index: 2; position: absolute; display: block"
					/>
				</Transition>
			</div>
		</Transition>
		<Transition name="fade_loose">
			<div
				v-if="this.showLoose"
				class="w-100 h-100 p-0 m-0"
				v-bind:style="{
					backgroundImage: this.computeBackgroundSrc,
				}"
			></div>
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
		this.init();
	},
	props: {
		backendUrl: String,
		boardUrl: String,
		updateVolumesUrl: String,
		continueUrl: String,
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
			musicVolume: this.playerData["music_volume"],
			soundVolume: this.playerData["sound_volume"],
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
			blueIndex: -1,
			blue_position_show: false,
			blue_blinking_allowed: false,
			rollAnimation: false,
			rollingAnimation: false,
			showPawn1: false,
			showPawn2: false,
			gameEnd: -100,
			mistakes: 0,
			cardName: "",
			latestCardValue: 0,
			stepSoundSwitch: true,
			tutorialYouKnowHowToPlayFlag: 0,
			music: null,
			showWin: false,
			showLoose: false,
			winFrame: 0,
			winFrame1: "",
			winFrame2: "",
			winFrame3: "",
			infoState: 0,
			showPopUp: false,
			showNumbers: true,
		};
	},
	methods: {
		init() {
			if (this.diceType === 3) this.showNumbers = false;
			// need to roll
			this.winFrame1 = this.getBoardPath() + "/win/1.png";
			this.winFrame2 = this.getBoardPath() + "/win/2.png";
			this.winFrame3 = this.getBoardPath() + "/win/3.png";
			window.setTimeout(() => {
				this.gameEnd = 0;
				if (this.board === 1)
					this.music = window.music(
						"music.great_ideas",
						this.musicVolume
					);
				else if (this.board === 2)
					this.music = window.music(
						"music.in_the_land_of_make_believe",
						this.musicVolume
					);
				else if (this.board === 3)
					this.music = window.music(
						"music.movin_on",
						this.musicVolume
					);

				this.showPawn1 = true;
				this.showPawn2 = true;
				if (this.gamePhase === 1) {
					this.setCenter(this.diceType, 0);
					this.rollAnimation = true;

					if (this.firstPlayerTurn) {
						if (this.pos1 === 0) window.sound("sounds.game.start");
						else window.sound(this.getOurTurnSound());
					} else {
						let self = this;
						window.sound(this.getOtherTurnSound(), function () {
							self.sendToBackend();
						});
					}
				} else {
					this.ignoreInput = true;
					this.sendToBackend();
				}
			}, 500);
		},
		updateVolumes() {
			let data = {
				player_id: this.playerId,
				music_volume: this.musicVolume,
			};
			axios
				.post(this.updateVolumesUrl, data, {
					headers: {
						Accept: "application/json",
					},
				})
				.then(function () {})
				.catch(function (error) {
					alert(error);
				});
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
			let self = this;
			if (self.gamePhase === 1) {
				this.rollingAnimation = true;
				window.sound("sounds.game.dice", null, true);
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
							self.music.pause();
							if (self.gameEnd === 1) {
								let sound = window.sound("sounds.game.win");
								sound.volume = 0.2;
								window.sound("sounds.game.win_[1-8]");
								window.setTimeout(() => {
									self.winFrame = 1;
								}, 1500);
								window.setTimeout(() => {
									self.winFrame = 2;
								}, 2000);
								window.setTimeout(() => {
									self.winFrame = 3;
								}, 2500);
							} else {
								let sound = window.sound("sounds.game.defeat");
								sound.volume = 0.2;
								window.sound("sounds.game.defeat_[1-3]");
							}
							window.setTimeout(() => {
								if (self.gameEnd === 1) self.showWin = true;
								else self.showLoose = true;
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

									if (self.firstPlayerTurn) {
										if (self.tutorial && self.pos1 === 4)
											window.sound(
												"sounds.tutorial.bravo_roll_again",
												function () {
													self.ignoreInput = false;
												}
											);
										else
											window.sound(
												self.getOurTurnSound(),
												function () {
													self.ignoreInput = false;
												}
											);
									} else
										window.sound(
											self.getOtherTurnSound(),
											function () {
												if (self.gameMode === 2)
													window.setTimeout(() => {
														self.sendToBackend();
													}, 1000);
											}
										);
								} else {
									//draw a card
									let card =
										self.cards[response.data.drawCard];
									self.cardName = card["name"];
									self.latestCardValue = card["value"];
									self.playCardSound();
								}
							} else if (self.gamePhase === 3) {
								self.firstPlayerTurn =
									response.data.firstPlayerTurn;
								self.setCenter(true, 0);
								self.rollAnimation = true;
								self.gamePhase = 1;
								if (self.firstPlayerTurn)
									window.sound(
										self.getOurTurnSound(),
										function () {
											self.ignoreInput = false;
										}
									);
								else if (self.gameMode === 2) {
									window.sound(
										self.getOtherTurnSound(),
										function () {
											self.sendToBackend();
										}
									);
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
		key_press(e) {
			let self = this;
			let key = e.key;
			if (key === "e" || key === "E" || key === "ε" || key === "Ε") {
				if (this.gameEnd === 0) window.location.href = this.continueUrl;
				else if (this.gameEnd !== -100)
					window.location.href = this.boardUrl;
			} else if (key === "-" || key === "_") this.decreaseMusic();
			else if (key === "=" || key === "+") this.increaseMusic();
			else if (key === "n" || key === "N" || key === "ν" || key === "Ν")
				if (self.showNumbers) self.showNumbers = false;
				else self.showNumbers = true;
			else if (self.showPopUp == true) self.showPopUp = false;
			else if (!this.ignoreInput) {
				console.log("Key pressed and NOT ignored:\t(" + e.key + ")");
				if (key === " ") key = "Space";
				let isSelect = false;
				let isNavigate = false;
				if (this.selectKey === key) isSelect = true;
				else if (this.autoMove === 2 && this.navigateKey === key) {
					if (this.movementMode === 1) isSelect = true;
					else isNavigate = true;
				}
				console.log(
					"isSelect:\t" +
						isSelect +
						"\tisNavigate:\t" +
						isNavigate +
						"\tgamePhase:\t" +
						this.gamePhase +
						"\tfirstPlayerTurn\t" +
						this.firstPlayerTurn +
						"\tpos1\t" +
						this.pos1 +
						"\tpos2\t" +
						this.pos2 +
						"\tboardId\t" +
						this.board +
						"\tboardSize\t" +
						this.boardSize +
						"\tlatestCardValue\t" +
						this.latestCardValue +
						"\tnewPosition\t" +
						this.newPosition +
						"\tautoMove\t" +
						this.autoMove +
						"\tmovementMode\t" +
						this.movementMode +
						"\tgameMode\t" +
						this.gameMode
				);
				if (isSelect || isNavigate) {
					if (this.gameEnd === 1 || this.gameEnd === -1)
						window.location.href = this.boardUrl;
					else if (this.gamePhase === 1) {
						this.ignoreInput = true;
						this.sendToBackend();
					} else if (this.gamePhase === 2) {
						if (isNavigate) {
							window.sound("fx.select");
							let initialPos = this.pos1;
							if (!this.firstPlayerTurn) initialPos = this.pos2;
							this.blue_position_show = false;
							let nextBlue = this.blueIndex + 1;

							if (
								(this.movementMode === 3 &&
									(nextBlue > this.getMaxBoardPosition() ||
										nextBlue > initialPos + 6)) ||
								(this.movementMode === 2 &&
									nextBlue > this.newPosition)
							)
								nextBlue = initialPos;

							this.blueIndex = nextBlue;
							this.blue_position_show = true;
						} else if (isSelect) {
							if (this.newPosition === this.blueIndex) {
								this.blue_blinking_allowed = false;
								this.ignoreInput = true;
								window.sound(
									"sounds.game.clapping",
									function () {
										window.sound(self.getRewardSound());
										self.applyCorrectMovement();
									},
									true
								);
							} else {
								this.ignoreInput = true;
								this.mistakes += 1;
								if (this.mistakes === this.maxMistakes) {
									this.blue_blinking_allowed = false;
									// treat the choice as correct
									window.sound(
										"sounds.game.help_[1-4]",
										function () {
											self.mistakes = 0;
											self.applyCorrectMovement();
										}
									);
								} else {
									window.sound(
										"sounds.game.try_again_[1-6]",
										null,
										true
									);
									window.setTimeout(function () {
										self.ignoreInput = false;
									}, 600);
								}
							}
						}
					} else if (this.gamePhase === 3) {
						this.resolvePhase3();
					}
				}
			} else {
				console.log("Key pressed and IGNORED:\t(" + e.key + ")");
			}
		},
		playStepSound() {
			if (this.stepSoundSwitch) {
				window.sound("sounds.game.footstep1");
				this.stepSoundSwitch = false;
			} else {
				window.sound("sounds.game.footstep2");
				this.stepSoundSwitch = true;
			}
		},
		getBoardPath() {
			return "/images/boards/board_" + this.board + "/";
		},
		getSizePath() {
			return this.getBoardPath() + "size_" + this.boardSize + "/";
		},
		getWinSrc() {
			return this.getBoardPath() + "win/background.png";
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
				this.blueIndex = -1;
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
			this.ignoreInput = false;
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
				this.ignoreInput = true;
				this.blue_blinking_allowed = true;
				this.activate_blue_rotation(
					newPosition,
					newPosition,
					newPosition,
					0
				);
				window.setTimeout(() => {
					this.blue_blinking_allowed = false;
				}, 3000);

				//if only selection key is used
				window.setTimeout(() => {
					if (this.autoMove === 1) {
						this.blue_blinking_allowed = true;
						this.blueIndex = pos + 1;
						this.ignoreInput = false;
						this.activate_blue_rotation(pos, newPosition, pos, 0);
					} else {
						//if navigation key is used
						this.blueIndex = pos;
						this.blue_position_show = true;
						this.ignoreInput = false;
					}
				}, 3200);
			} else if (this.movementMode === 3) {
				if (this.autoMove === 1) {
					this.blue_blinking_allowed = true;
					let max = pos + 6;
					let max_value = this.getMaxBoardPosition();
					if (max > max_value) max = max_value;
					this.activate_blue_rotation(pos, max, pos, 0);
				} else {
					this.blueIndex = pos;
					this.blue_position_show = true;
				}
				this.ignoreInput = false;
			}
		},
		applyDiceRoll(newPosition, diceResult) {
			let self = this;
			this.gamePhase = 2;
			this.mistakes = 0;
			this.newPosition = newPosition;
			this.setCenter(true, diceResult);
			if (this.gameMode === 2 && !this.firstPlayerTurn)
				this.applyCorrectMovement();
			//check this in pvp
			else {
				if (
					this.tutorial &&
					this.firstPlayerTurn &&
					this.tutorialYouKnowHowToPlayFlag === 0
				) {
					if (this.pos1 === 0) {
						let sound_forward = "sounds.tutorial.Pink_Move_Forward";
						if (self.diceType !== 3)
							sound_forward = "sounds.tutorial.Pawn_4_forward";
						window.sound(sound_forward, function () {
							if (self.movementMode === 3) {
								self.blueIndex = 4;
								self.blue_position_show = true;
							} else self.activateSelector(newPosition);
							let we_should_go_here_sound =
								"sounds.tutorial.Here_we_go_Pink";
							if (self.diceType !== 3)
								we_should_go_here_sound =
									"sounds.tutorial.We_Should_Go_Here";
							window.sound(we_should_go_here_sound, function () {
								if (self.movementMode > 1)
									window.sound(
										"sounds.tutorial.Choose_this_Pawn_goes_there",
										function () {
											if (self.movementMode === 3) {
												self.blue_position_show = false;
												self.blueIndex = -1;
												self.activateSelector(
													newPosition
												);
											}
										}
									);
							});
						});
					} else if (this.pos1 === 4) {
						if (self.movementMode === 3) {
							let sound_to_play =
								"sounds.tutorial.Yellow_Choose_Position";
							if (self.diceType !== 3)
								sound_to_play =
									"sounds.tutorial.Roll_2_You_Choose_Now";
							window.sound(sound_to_play, function () {
								self.activateSelector(newPosition);
							});
						} else {
							window.sound(
								"sounds.tutorial.We_Should_Go_Here",
								function () {
									if (self.movementMode > 1) {
										window.sound(
											"sounds.tutorial.Choose_this_Pawn_goes_there"
										);
									}
								}
							);
							self.activateSelector(newPosition);
						}
					} else this.activateSelector(newPosition);
				} else this.activateSelector(newPosition);
			}
		},
		applyCorrectMovement() {
			let newPosition = this.newPosition;
			this.newPosition = -1;
			this.ignoreInput = true;
			this.blueIndex = newPosition;
			this.blue_position_show = true;
			let current = this.pos2;
			if (this.firstPlayerTurn) current = this.pos1;
			this.activate_movement_rotation(newPosition, current);
		},

		activate_movement_rotation(end, current) {
			this.ignoreInput = true;
			let self = this;
			if (this.firstPlayerTurn) {
				this.showPawn1 = false;
				if (end > current) this.pos1 = current + 1;
				else this.pos1 = current - 1;
				window.setTimeout(() => {
					this.showPawn1 = true;
					this.playStepSound();
				}, 500);
				window.setTimeout(() => {
					if (this.pos1 !== end)
						this.activate_movement_rotation(end, this.pos1);
					else {
						if (this.tutorial && this.firstPlayerTurn) {
							if (
								this.pos1 === 9 &&
								this.tutorialYouKnowHowToPlayFlag === 0
							)
								window.sound(
									"sounds.tutorial.Aha_Lets_see",
									function () {
										self.tutorialYouKnowHowToPlayFlag += 1;
										self.sendToBackend();
									}
								);
							else if (this.tutorialYouKnowHowToPlayFlag === 1) {
								window.sound(
									"sounds.tutorial.Now_you_know_how_to_play",
									function () {
										self.tutorialYouKnowHowToPlayFlag += 1;
										self.sendToBackend();
									}
								);
							} else this.sendToBackend();
						} else this.sendToBackend();
					}
				}, 1000);
			} else {
				this.showPawn2 = false;
				if (end > current) this.pos2 = current + 1;
				else this.pos2 = current - 1;
				window.setTimeout(() => {
					this.showPawn2 = true;
					this.playStepSound();
				}, 500);
				window.setTimeout(() => {
					if (this.pos2 !== end)
						this.activate_movement_rotation(end, this.pos2);
					else this.sendToBackend();
				}, 1000);
			}
		},
		resolvePhase3() {
			let self = this;
			this.ignoreInput = true;
			this.blue_blinking_allowed = false;
			this.cardName = "";
			let sound = "sounds.cards.";
			if (!this.firstPlayerTurn) sound += "opponent_";
			if (this.latestCardValue > 0)
				window.sound(
					sound + "F" + this.latestCardValue + this.getPawnSex(),
					function () {
						self.latestCardValue = 0;
						self.applyCorrectMovement();
					}
				);
			else
				window.sound(
					sound +
						"B" +
						Math.abs(this.latestCardValue) +
						this.getPawnSex(),
					function () {
						self.latestCardValue = 0;
						self.applyCorrectMovement();
					}
				);
		},
		applyCardMovement() {
			let pos = this.pos1;
			if (!this.firstPlayerTurn) pos = this.pos2;
			pos += this.latestCardValue;
			this.gamePhase = 3;
			this.newPosition = pos;
			this.setCenter(false, this.latestCardValue);
			if (this.firstPlayerTurn) {
				this.ignoreInput = false;
			} else {
				this.resolvePhase3();
			}
		},
		getPawnSex() {
			if (this.firstPlayerTurn) {
				if (this.pawn1 === 2 || this.pawn1 === 3 || this.pawn1 === 6)
					return "_g";
				else return "_b";
			} else {
				if (this.pawn2 === 2 || this.pawn2 === 3 || this.pawn2 === 6)
					return "_g";
				else return "_b";
			}
		},
		playCardSound() {
			let self = this;
			window.sound(
				"sounds.cards." +
					this.cardName +
					"_" +
					this.board +
					this.getPawnSex(),
				function () {
					self.applyCardMovement();
				}
			);
		},
		increaseMusic() {
			this.musicVolume += 0.1;
			if (this.musicVolume > 1) this.musicVolume = 1.0;
			this.music.volume = this.musicVolume;
			this.updateVolumes();
		},
		decreaseMusic() {
			this.musicVolume -= 0.1;
			if (this.musicVolume <= 0) this.musicVolume = 0;
			this.music.volume = this.musicVolume;
			this.updateVolumes();
		},
		getStartSrc() {
			return this.getBoardPath() + "start.png";
		},
		getGoalSrc() {
			return this.getBoardPath() + "goal.png";
		},
		getExtrasSrc() {
			if (this.board === 2) return this.getBoardPath() + "extras.png";
			else if (this.board === 3) {
				if (this.boardSize === 3) return "";
				else return this.getBoardPath() + "extras.png";
			} else return "";
		},
		getMaxBoardPosition() {
			let max_value = 15;
			if (this.boardSize === 2) max_value = 30;
			else if (this.boardSize === 3) max_value = 45;
			return max_value;
		},
		getRewardSound() {
			return "sounds.game.reward_[1-11]";
		},
		getOurTurnSound() {
			if (this.gameMode === 1) return "sounds.game.our_turn_solo_[1-5]";
			else return "sounds.game.our_turn_[1-6]";
		},
		getOtherTurnSound() {
			return "sounds.game.other_turn_[1-8]";
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
			if (this.blueIndex === -1) return "";
			else if (this.blueIndex === 0)
				return this.getSizePath() + "blue_positions/0.png";
			else if (this.showNumbers)
				return (
					this.getSizePath() +
					"blue_positions/" +
					this.blueIndex +
					".png"
				);
			else
				return (
					this.getSizePath() +
					"blue_positions/" +
					this.blueIndex +
					"_colour.png"
				);
		},
		computeCardSrc() {
			if (this.cardName === "") return "";
			else return this.getBoardPath() + "cards/" + this.cardName + ".png";
		},
		computeBackgroundSrc() {
			switch (this.gameEnd) {
				case 1:
					return "url('" + this.getWinSrc() + "')";
				case -1:
					return "url('" + this.getLoseSrc() + "')";
				default:
					if (this.showNumbers)
						return "url('" + this.getSizePath() + "board.png')";
					else
						return (
							"url('" + this.getSizePath() + "board_colour.png')"
						);
			}
		},
		computeInfoSrc() {
			let path = "/images/boards/info/";
			switch (this.infoState) {
				case 0:
					return path + "default_state.png";
				case 1:
					return path + "hover_state.png";
				default:
					return path + "default_state.png";
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
	transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
	opacity: 0;
}

.fade_blue-enter-active,
.fade_blue-leave-active {
	transition: opacity 0.5s;
}

.fade_blue-enter,
.fade_blue-leave-to {
	opacity: 0;
}

.fade_loose-enter-active,
.fade_loose-leave-active {
	transition: opacity 3s;
}

.fade_loose-enter,
.fade_loose-leave-to {
	opacity: 0;
}

.fade_init-enter-active,
.fade_init-leave-active {
	transition: opacity 1s;
}

.fade_init-enter,
.fade_init-leave-to {
	opacity: 0;
}

.bounce-enter-active {
	animation: bounce-in 1s;
}

.bounce-leave-active {
	animation: bounce-in 1s reverse;
}

@keyframes bounce-in {
	0% {
		transform: scale(0);
	}
	50% {
		transform: scale(1.5);
	}
	100% {
		transform: scale(1);
	}
}

.slide-fade-enter-active {
	transition: all 1s ease;
}

.slide-fade-leave-active {
	transition: all 1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter,
.slide-fade-leave-to {
	transform: translateY(200px);
	opacity: 0;
}
</style>
