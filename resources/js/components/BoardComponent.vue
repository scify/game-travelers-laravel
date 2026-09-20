<template>
    <div class="w-100 h-100 p-0 m-0">
        <Transition name="fade-init">
            <div
                v-if="gameEnd === 0"
                class="w-100 h-100 p-0 m-0"
                :style="{
                    backgroundImage: computeBackgroundSrc,
                }"
            >
                <Transition name="fade">
                    <img
                        v-if="computeCardSrc.length > 0"
                        :src="computeCardSrc"
                        alt=""
                        style="
                            z-index: 10;
                            position: absolute;
                            display: block;
                            left: calc(50% - 344px / 2);
                            top: calc(50% - 482px / 2);
                        "
                    />
                </Transition>
                <div v-if="gameEnd === 0">
                    <img
                        v-if="blueIndex !== 0"
                        :src="getStartSrc()"
                        alt=""
                        style="z-index: 4; position: absolute; display: block"
                    />
                    <img
                        :src="getGoalSrc()"
                        alt=""
                        style="z-index: 4; position: absolute; display: block"
                    />
                    <img
                        v-if="getExtrasSrc().length > 0"
                        :src="getExtrasSrc()"
                        alt=""
                        style="z-index: 4; position: absolute; display: block"
                    />
                    <!-- Mouse only, by design: an alt and nothing else. No role, no tabindex, no key handler. -->
                    <img
                        :src="computeInfoSrc"
                        :style="computeInfoStyle"
                        alt="Πλήκτρα ελέγχου"
                        @mouseenter="showInfoLabel()"
                        @mouseleave="hideInfoLabel()"
                        @click="switcherModal()"
                    />
                    <Transition name="fade-blue">
                        <img
                            v-if="blue_position_show"
                            :src="computeBlueSrc"
                            alt=""
                            style="z-index: 2; position: absolute; display: block"
                        />
                    </Transition>
                    <Transition name="fade">
                        <img
                            v-if="showPawn1"
                            :src="computePawn1Src"
                            alt=""
                            style="z-index: 5; position: absolute; display: block"
                        />
                    </Transition>
                    <div v-if="gameMode > 1">
                        <Transition name="fade">
                            <img
                                v-if="showPawn2"
                                :src="computePawn2Src"
                                alt=""
                                style="z-index: 5; position: absolute; display: block"
                            />
                        </Transition>
                    </div>
                    <img
                        :src="computeLeftSrc"
                        alt=""
                        style="z-index: 5; position: absolute; display: block"
                    />
                    <div v-if="gameMode > 1">
                        <img
                            :src="computeRightSrc"
                            alt=""
                            style="z-index: 5; position: absolute; display: block"
                        />
                    </div>
                    <Transition name="fade">
                        <img
                            v-if="center_src.length > 0"
                            :class="{
                                shake: rollingAnimation,
                                'move-up-down': rollAnimation,
                            }"
                            :src="center_src"
                            alt=""
                            style="z-index: 5; position: absolute; display: block"
                        />
                    </Transition>
                </div>
            </div>
        </Transition>
        <Transition name="fade-init">
            <div
                v-if="showWin"
                class="w-100 h-100 p-0 m-0"
                :style="{
                    backgroundImage: computeBackgroundSrc,
                }"
            >
                <Transition name="fade-init">
                    <img
                        v-if="winFrame > 0"
                        :src="winFrame1"
                        alt=""
                        style="z-index: 2; position: absolute; display: block"
                    />
                </Transition>
                <Transition name="slide-fade">
                    <img
                        v-if="winFrame > 1"
                        :src="winFrame2"
                        alt=""
                        style="z-index: 2; position: absolute; display: block"
                    />
                </Transition>
                <Transition name="bounce">
                    <img
                        v-if="winFrame > 2"
                        :src="winFrame3"
                        alt=""
                        style="z-index: 2; position: absolute; display: block"
                    />
                </Transition>
            </div>
        </Transition>
        <Transition name="fade-loose">
            <div
                v-if="showLoose"
                class="w-100 h-100 p-0 m-0"
                :style="{
                    backgroundImage: computeBackgroundSrc,
                }"
            ></div>
        </Transition>
        <BoardDebugStrip
            v-if="debugTools"
            :tools="debugTools"
            :last-event="debugLastEvent"
        />
    </div>
</template>

<script>
import axios from 'axios';
import { Modal } from 'bootstrap';
import { markRaw } from 'vue';
import { music, sound } from '@/lib/audio.js';
import { createDebugTools, emit, enabled as debugEnabled, log } from '@/lib/debug.js';
import { storedKey } from '@/lib/keys.js';
import BoardDebugStrip from '@/components/BoardDebugStrip.vue';

export default {
    components: { BoardDebugStrip },
    props: {
        backendUrl: { type: String, required: true },
        boardUrl: { type: String, required: true },
        updateVolumesUrl: { type: String, required: true },
        continueUrl: { type: String, required: true },
        playerId: { type: Number, required: true },
        gameId: { type: Number, required: true },
        debugStateUrl: { type: String, default: null },
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
            musicVolume: this.playerData['music_volume'],
            soundVolume: this.playerData['sound_volume'],
            playerName: this.playerData['name'],
            avatarId: this.playerData['avatar_id'],
            autoMove: this.playerData['auto'],
            selectKey: this.playerData['select_key'],
            navigateKey: this.playerData['navigate_key'],
            maxMistakes: this.playerData['help_after_x_mistakes'],
            scanningSpeed: this.playerData['scanning_speed'],
            diceType: this.playerData['dice_type'],
            boardSize: this.gameData['board_size'],
            difficulty: this.playerData['difficulty'],
            movementMode: this.playerData['movement_mode'],
            board: this.gameData['board'],
            gameMode: this.gameData['mode'],
            pawn1: this.gameData['pawn1'],
            pawn2: this.gameData['pawn2'],
            tutorial: this.gameData['tutorial'],
            pos1: this.gameData['pos1'],
            pos2: this.gameData['pos2'],
            newPosition: -1,
            firstPlayerTurn: this.gameData['firstPlayerTurn'],
            gamePhase: this.gameData['game_phase'], // 1 roll, 2 move, 3 draw
            center_src: '',
            blueIndex: -1,
            blue_position_show: false,
            blue_blinking_allowed: false,
            rollAnimation: false,
            rollingAnimation: false,
            showPawn1: false,
            showPawn2: false,
            gameEnd: -100,
            mistakes: 0,
            cardName: '',
            latestCardValue: 0,
            stepSoundSwitch: true,
            tutorialYouKnowHowToPlayFlag: 0,
            music: null,
            showWin: false,
            showLoose: false,
            winFrame: 0,
            winFrame1: '',
            winFrame2: '',
            winFrame3: '',
            infoState: 0,
            infoHoverTimer: null,
            showNumbers: true,
            debug: debugEnabled(),
            debugTools: null,
            debugLastEvent: '',
        };
    },
    computed: {
        computePawn1Src() {
            return this.getSizePath() + 'pieces/' + this.pawn1 + '/' + this.pos1 + '.png';
        },
        computePawn2Src() {
            return this.getSizePath() + 'pieces/' + this.pawn2 + '/' + this.pos2 + 'b.png';
        },
        computeLeftSrc() {
            if (this.firstPlayerTurn) {
                return this.getBoardPath() + 'left/' + this.pawn1 + 'a.png';
            } else {
                return this.getBoardPath() + 'left/' + this.pawn1 + '.png';
            }
        },
        computeRightSrc() {
            if (this.firstPlayerTurn) {
                return this.getBoardPath() + 'right/' + this.pawn2 + '.png';
            } else {
                return this.getBoardPath() + 'right/' + this.pawn2 + 'a.png';
            }
        },
        computeBlueSrc() {
            if (this.blueIndex === -1) {
                return '';
            } else if (this.blueIndex === 0) {
                return this.getSizePath() + 'blue_positions/0.png';
            } else if (this.showNumbers) {
                return this.getSizePath() + 'blue_positions/' + this.blueIndex + '.png';
            } else {
                return this.getSizePath() + 'blue_positions/' + this.blueIndex + '_colour.png';
            }
        },
        computeCardSrc() {
            if (this.cardName === '') {
                return '';
            } else {
                return this.getBoardPath() + 'cards/' + this.cardName + '.png';
            }
        },
        computeBackgroundSrc() {
            switch (this.gameEnd) {
                case 1:
                    return "url('" + this.getWinSrc() + "')";
                case -1:
                    return "url('" + this.getLoseSrc() + "')";
                default:
                    if (this.showNumbers) {
                        return "url('" + this.getSizePath() + "board.png')";
                    } else {
                        return "url('" + this.getSizePath() + "board_colour.png')";
                    }
            }
        },
        computeInfoSrc() {
            const path = '/images/boards/info/';
            switch (this.infoState) {
                case 0:
                    return path + 'default_state.png';
                case 1:
                    return path + 'hover_state.png';
                default:
                    return path + 'default_state.png';
            }
        },
        computeInfoStyle() {
            // The hover artwork sits inside a padded canvas, 9px from its left
            // edge and 6px from its top; the other states have no padding.
            // Subtracting the padding keeps every state on the same corner.
            const padding = this.infoState === 1 ? { left: 9, top: 6 } : { left: 0, top: 0 };

            return {
                zIndex: 50,
                position: 'absolute',
                display: 'block',
                left: `calc(50% - ${500 + padding.left}px)`,
                top: `calc(50% - ${340 + padding.top}px)`,
            };
        },
    },
    mounted() {
        log('Component mounted.');
        // Keydown, because keypress never fires for a named key such as ArrowRight.
        window.addEventListener('keydown', (e) => {
            this.handleKeyDown(e);
        });
        if (this.debug) {
            this.debugTools = markRaw(
                createDebugTools({
                    state: () => this.debugSnapshot(),
                    keys: () => ({ select: this.selectKey, navigate: this.navigateKey }),
                    setVolumes: (muted) => this.setDebugVolumes(muted),
                    stateUrl: this.debugStateUrl,
                }),
            );
            window.travelersDebug = this.debugTools;
        }
        this.init();
    },
    methods: {
        init() {
            if (this.diceType === 3) {
                this.showNumbers = false;
            }
            // need to roll
            this.winFrame1 = this.getBoardPath() + '/win/1.png';
            this.winFrame2 = this.getBoardPath() + '/win/2.png';
            this.winFrame3 = this.getBoardPath() + '/win/3.png';
            window.setTimeout(() => {
                this.gameEnd = 0;
                if (this.board === 1) {
                    this.music = music('music.great_ideas', this.musicVolume);
                } else if (this.board === 2) {
                    this.music = music('music.in_the_land_of_make_believe', this.musicVolume);
                } else if (this.board === 3) {
                    this.music = music('music.movin_on', this.musicVolume);
                }

                this.showPawn1 = true;
                this.showPawn2 = true;
                if (this.gamePhase === 1) {
                    this.setCenter(this.diceType, 0);
                    this.rollAnimation = true;

                    if (this.firstPlayerTurn) {
                        if (this.pos1 === 0) {
                            sound('sounds.game.start');
                        } else {
                            sound(this.getOurTurnSound());
                        }
                    } else {
                        sound(this.getOtherTurnSound(), () => {
                            this.sendToBackend();
                        });
                    }
                } else {
                    this.ignoreInput = true;
                    this.sendToBackend();
                }
            }, 500);
        },
        // The label waits a moment before it appears, so a pointer crossing the
        // board on its way somewhere else does not flash it.
        showInfoLabel() {
            window.clearTimeout(this.infoHoverTimer);
            this.infoHoverTimer = window.setTimeout(() => {
                this.infoState = 1;
            }, 100);
        },
        hideInfoLabel() {
            window.clearTimeout(this.infoHoverTimer);
            this.infoState = 0;
        },
        switcherModal() {
            const switcherModalEl = document.getElementById('switcherModal');
            const bsSwitcherModal = Modal.getOrCreateInstance(switcherModalEl, {
                keyboard: true,
                focus: true,
                backdrop: true,
            });
            sound('fx.modal');
            bsSwitcherModal.show();
            return false;
        },
        updateVolumes() {
            const data = {
                player_id: this.playerId,
                music_volume: this.musicVolume,
            };
            axios
                .post(this.updateVolumesUrl, data, {
                    headers: {
                        Accept: 'application/json',
                    },
                })
                .catch((error) => {
                    console.error('Saving the music volume failed:', error);
                });
        },
        sendToBackend() {
            const data = {
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
            if (this.gamePhase === 1) {
                this.rollingAnimation = true;
                sound('sounds.game.dice', null, true);
                this.rollAnimation = false;
            }
            axios
                .post(this.backendUrl, data, {
                    headers: {
                        Accept: 'application/json',
                    },
                })
                .then((response) => {
                    if (response.status > 300) {
                        log(response);
                    } else {
                        this.gameEnd = response.data.gameEnded;
                        if (this.gameEnd !== 0) {
                            this.debugEmit('ended', this.gameEnd);
                            this.music.pause();
                            if (this.gameEnd === 1) {
                                const endingSound = sound('sounds.game.win');
                                endingSound.volume = 0.2;
                                sound('sounds.game.win_[1-8]');
                                window.setTimeout(() => {
                                    this.winFrame = 1;
                                }, 1500);
                                window.setTimeout(() => {
                                    this.winFrame = 2;
                                }, 2000);
                                window.setTimeout(() => {
                                    this.winFrame = 3;
                                }, 2500);
                            } else {
                                const endingSound = sound('sounds.game.defeat');
                                endingSound.volume = 0.2;
                                sound('sounds.game.defeat_[1-3]');
                            }
                            window.setTimeout(() => {
                                if (this.gameEnd === 1) {
                                    this.showWin = true;
                                } else {
                                    this.showLoose = true;
                                }
                                this.ignoreInput = false;
                            }, 1000);
                        } else if (this.gamePhase === 1) {
                            window.setTimeout(() => {
                                this.applyDiceRoll(response.data.newPosition, response.data.diceResult);
                                this.rollingAnimation = false;
                            }, 1000);
                        } else if (this.gamePhase === 2) {
                            this.firstPlayerTurn = response.data.firstPlayerTurn;
                            if (response.data.drawCard === 0) {
                                this.setCenter(true, 0);
                                this.rollAnimation = true;
                                this.gamePhase = 1;
                                this.debugEmit('phase', 1);

                                if (this.firstPlayerTurn) {
                                    if (this.tutorial && this.pos1 === 4) {
                                        sound('sounds.tutorial.bravo_roll_again', () => {
                                            this.ignoreInput = false;
                                        });
                                    } else {
                                        sound(this.getOurTurnSound(), () => {
                                            this.ignoreInput = false;
                                        });
                                    }
                                } else {
                                    sound(this.getOtherTurnSound(), () => {
                                        if (this.gameMode === 2) {
                                            window.setTimeout(() => {
                                                this.sendToBackend();
                                            }, 1000);
                                        }
                                    });
                                }
                            } else {
                                //draw a card
                                const card = this.cards[response.data.drawCard];
                                this.cardName = card['name'];
                                this.latestCardValue = card['value'];
                                this.debugEmit('card', { name: card['name'], value: card['value'] });
                                this.playCardSound();
                            }
                        } else if (this.gamePhase === 3) {
                            this.firstPlayerTurn = response.data.firstPlayerTurn;
                            this.setCenter(true, 0);
                            this.rollAnimation = true;
                            this.gamePhase = 1;
                            this.debugEmit('phase', 1);
                            if (this.firstPlayerTurn) {
                                sound(this.getOurTurnSound(), () => {
                                    this.ignoreInput = false;
                                });
                            } else if (this.gameMode === 2) {
                                sound(this.getOtherTurnSound(), () => {
                                    this.sendToBackend();
                                });
                            }
                        }
                    }
                })
                .catch((error) => {
                    //console.log(error);
                    alert(error);
                });
        },
        handleKeyDown(e) {
            const key = e.key;
            if (key === 'e' || key === 'E' || key === 'ε' || key === 'Ε') {
                if (this.gameEnd === 0) {
                    window.location.href = this.continueUrl;
                } else if (this.gameEnd !== -100) {
                    window.location.href = this.boardUrl;
                }
            } else if (key === '-' || key === '_') {
                this.decreaseMusic();
            } else if (key === '=' || key === '+') {
                this.increaseMusic();
            } else if (key === 'n' || key === 'N' || key === 'ν' || key === 'Ν') {
                if (this.showNumbers) {
                    this.showNumbers = false;
                } else {
                    this.showNumbers = true;
                }
            } else {
                const pressedKey = storedKey(e);
                let isSelect = false;
                let isNavigate = false;
                if (this.selectKey === pressedKey) {
                    isSelect = true;
                } else if (this.autoMove === 2 && this.navigateKey === pressedKey) {
                    if (this.movementMode === 1) {
                        isSelect = true;
                    } else {
                        isNavigate = true;
                    }
                }
                // The board claims the key only while nothing else holds the
                // focus, so a press never scrolls the page and a focused
                // control keeps its own behaviour.
                if ((isSelect || isNavigate) && e.target === document.body) {
                    e.preventDefault();
                }
                if (this.ignoreInput) {
                    log('Key pressed and IGNORED:\t(' + pressedKey + ')');
                    this.debugEmit('input', { key: pressedKey, ignored: true });

                    return;
                }
                log('Key pressed and NOT ignored:\t(' + pressedKey + ')');
                this.debugEmit('input', { key: pressedKey, isSelect, isNavigate });
                log(
                    'isSelect:\t' +
                        isSelect +
                        '\tisNavigate:\t' +
                        isNavigate +
                        '\tgamePhase:\t' +
                        this.gamePhase +
                        '\tfirstPlayerTurn\t' +
                        this.firstPlayerTurn +
                        '\tpos1\t' +
                        this.pos1 +
                        '\tpos2\t' +
                        this.pos2 +
                        '\tboardId\t' +
                        this.board +
                        '\tboardSize\t' +
                        this.boardSize +
                        '\tlatestCardValue\t' +
                        this.latestCardValue +
                        '\tnewPosition\t' +
                        this.newPosition +
                        '\tautoMove\t' +
                        this.autoMove +
                        '\tmovementMode\t' +
                        this.movementMode +
                        '\tgameMode\t' +
                        this.gameMode,
                );
                if (isSelect || isNavigate) {
                    if (this.gameEnd === 1 || this.gameEnd === -1) {
                        window.location.href = this.boardUrl;
                    } else if (this.gamePhase === 1) {
                        this.ignoreInput = true;
                        this.sendToBackend();
                    } else if (this.gamePhase === 2) {
                        if (isNavigate) {
                            sound('fx.select');
                            let initialPos = this.pos1;
                            if (!this.firstPlayerTurn) {
                                initialPos = this.pos2;
                            }
                            this.blue_position_show = false;
                            let nextBlue = this.blueIndex + 1;

                            if (
                                (this.movementMode === 3 &&
                                    (nextBlue > this.getMaxBoardPosition() || nextBlue > initialPos + 6)) ||
                                (this.movementMode === 2 && nextBlue > this.newPosition)
                            ) {
                                nextBlue = initialPos;
                            }

                            this.blueIndex = nextBlue;
                            this.blue_position_show = true;
                        } else if (isSelect) {
                            if (this.newPosition === this.blueIndex) {
                                this.blue_blinking_allowed = false;
                                this.ignoreInput = true;
                                sound(
                                    'sounds.game.clapping',
                                    () => {
                                        sound(this.getRewardSound());
                                        this.applyCorrectMovement();
                                    },
                                    true,
                                );
                            } else {
                                this.ignoreInput = true;
                                this.mistakes += 1;
                                if (this.mistakes === this.maxMistakes) {
                                    this.blue_blinking_allowed = false;
                                    // treat the choice as correct
                                    sound('sounds.game.help_[1-4]', () => {
                                        this.mistakes = 0;
                                        this.applyCorrectMovement();
                                    });
                                } else {
                                    sound('sounds.game.try_again_[1-6]', null, true);
                                    window.setTimeout(() => {
                                        this.ignoreInput = false;
                                    }, 600);
                                }
                            }
                        }
                    } else if (this.gamePhase === 3) {
                        this.resolvePhase3();
                    }
                }
            }
        },
        playStepSound() {
            if (this.stepSoundSwitch) {
                sound('sounds.game.footstep1');
                this.stepSoundSwitch = false;
            } else {
                sound('sounds.game.footstep2');
                this.stepSoundSwitch = true;
            }
        },
        getBoardPath() {
            return '/images/boards/board_' + this.board + '/';
        },
        getSizePath() {
            return this.getBoardPath() + 'size_' + this.boardSize + '/';
        },
        getWinSrc() {
            return this.getBoardPath() + 'win/background.png';
        },
        getLoseSrc() {
            return this.getBoardPath() + 'lose.png';
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
                        if (next_current > end) {
                            next_current = start;
                        }
                        this.activate_blue_rotation(start, end, next_current, nextSecond);
                    } else {
                        this.activate_blue_rotation(start, end, current, nextSecond);
                    }
                }, 1000);
            } else {
                this.blue_position_show = false;
                this.blueIndex = -1;
            }
        },
        setCenter(isDice, value) {
            let src = this.getBoardPath() + 'center/';
            if (isDice) {
                // show dice
                if (value === 0) {
                    if (this.diceType === 1) {
                        src += 'dice_numbers';
                    } else if (this.diceType === 2) {
                        src += 'dice_dots';
                    } else if (this.diceType === 3) {
                        src += 'dice_colours';
                    }
                } else if (this.diceType === 3) {
                    if (value === 1) {
                        src += 'o';
                    } else if (value === 2) {
                        src += 'g';
                    } else if (value === 3) {
                        src += 'b';
                    } else if (value === 4) {
                        src += 'p';
                    } else if (value === 5) {
                        src += 'r';
                    } else if (value === 6) {
                        src += 'y';
                    }
                } else {
                    src += value;
                    if (this.diceType === 2) {
                        src += 'd';
                    }
                }
            } else {
                //show cloud
                if (value > 0) {
                    src += 'p';
                } else {
                    src += 'm';
                }
                src += Math.abs(value);
            }
            this.center_src = src + '.png';
        },
        activateSelector(newPosition) {
            this.debugEmit('selector', { target: newPosition });
            this.ignoreInput = false;
            let pos = this.pos1;
            if (!this.firstPlayerTurn) {
                pos = this.pos2;
            }
            if (this.movementMode === 1) {
                this.ignoreInput = false;
                this.blue_blinking_allowed = true;
                this.activate_blue_rotation(newPosition, newPosition, newPosition, 0);
            } else if (this.movementMode === 2) {
                this.ignoreInput = true;
                this.blue_blinking_allowed = true;
                this.activate_blue_rotation(newPosition, newPosition, newPosition, 0);
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
                    const max_value = this.getMaxBoardPosition();
                    if (max > max_value) {
                        max = max_value;
                    }
                    this.activate_blue_rotation(pos, max, pos, 0);
                } else {
                    this.blueIndex = pos;
                    this.blue_position_show = true;
                }
                this.ignoreInput = false;
            }
        },
        applyDiceRoll(newPosition, diceResult) {
            this.gamePhase = 2;
            this.mistakes = 0;
            this.newPosition = newPosition;
            this.setCenter(true, diceResult);
            this.debugEmit('rolled', { newPosition, diceResult });
            if (this.gameMode === 2 && !this.firstPlayerTurn) {
                this.applyCorrectMovement();
            }
            //check this in pvp
            else if (this.tutorial && this.firstPlayerTurn && this.tutorialYouKnowHowToPlayFlag === 0) {
                if (this.pos1 === 0) {
                    let sound_forward = 'sounds.tutorial.Pink_Move_Forward';
                    if (this.diceType !== 3) {
                        sound_forward = 'sounds.tutorial.Pawn_4_forward';
                    }
                    sound(sound_forward, () => {
                        if (this.movementMode === 3) {
                            this.blueIndex = 4;
                            this.blue_position_show = true;
                        } else {
                            this.activateSelector(newPosition);
                        }
                        let we_should_go_here_sound = 'sounds.tutorial.Here_we_go_Pink';
                        if (this.diceType !== 3) {
                            we_should_go_here_sound = 'sounds.tutorial.We_Should_Go_Here';
                        }
                        sound(we_should_go_here_sound, () => {
                            if (this.movementMode > 1) {
                                sound('sounds.tutorial.Choose_this_Pawn_goes_there', () => {
                                    if (this.movementMode === 3) {
                                        this.blue_position_show = false;
                                        this.blueIndex = -1;
                                        this.activateSelector(newPosition);
                                    }
                                });
                            }
                        });
                    });
                } else if (this.pos1 === 4) {
                    if (this.movementMode === 3) {
                        let sound_to_play = 'sounds.tutorial.Yellow_Choose_Position';
                        if (this.diceType !== 3) {
                            sound_to_play = 'sounds.tutorial.Roll_2_You_Choose_Now';
                        }
                        sound(sound_to_play, () => {
                            this.activateSelector(newPosition);
                        });
                    } else {
                        sound('sounds.tutorial.We_Should_Go_Here', () => {
                            if (this.movementMode > 1) {
                                sound('sounds.tutorial.Choose_this_Pawn_goes_there');
                            }
                        });
                        this.activateSelector(newPosition);
                    }
                } else {
                    this.activateSelector(newPosition);
                }
            } else {
                this.activateSelector(newPosition);
            }
        },
        applyCorrectMovement() {
            const newPosition = this.newPosition;
            this.newPosition = -1;
            this.ignoreInput = true;
            this.blueIndex = newPosition;
            this.blue_position_show = true;
            let current = this.pos2;
            if (this.firstPlayerTurn) {
                current = this.pos1;
            }
            this.activate_movement_rotation(newPosition, current);
        },

        activate_movement_rotation(end, current) {
            this.ignoreInput = true;
            if (this.firstPlayerTurn) {
                this.showPawn1 = false;
                if (end > current) {
                    this.pos1 = current + 1;
                } else {
                    this.pos1 = current - 1;
                }
                window.setTimeout(() => {
                    this.showPawn1 = true;
                    this.playStepSound();
                }, 500);
                window.setTimeout(() => {
                    if (this.pos1 !== end) {
                        this.activate_movement_rotation(end, this.pos1);
                    } else {
                        this.debugEmit('moved', { position: this.pos1 });
                        if (this.tutorial && this.firstPlayerTurn) {
                            if (this.pos1 === 9 && this.tutorialYouKnowHowToPlayFlag === 0) {
                                sound('sounds.tutorial.Aha_Lets_see', () => {
                                    this.tutorialYouKnowHowToPlayFlag += 1;
                                    this.sendToBackend();
                                });
                            } else if (this.tutorialYouKnowHowToPlayFlag === 1) {
                                sound('sounds.tutorial.Now_you_know_how_to_play', () => {
                                    this.tutorialYouKnowHowToPlayFlag += 1;
                                    this.sendToBackend();
                                });
                            } else {
                                this.sendToBackend();
                            }
                        } else {
                            this.sendToBackend();
                        }
                    }
                }, 1000);
            } else {
                this.showPawn2 = false;
                if (end > current) {
                    this.pos2 = current + 1;
                } else {
                    this.pos2 = current - 1;
                }
                window.setTimeout(() => {
                    this.showPawn2 = true;
                    this.playStepSound();
                }, 500);
                window.setTimeout(() => {
                    if (this.pos2 !== end) {
                        this.activate_movement_rotation(end, this.pos2);
                    } else {
                        this.debugEmit('moved', { position: this.pos2 });
                        this.sendToBackend();
                    }
                }, 1000);
            }
        },
        resolvePhase3() {
            this.ignoreInput = true;
            this.blue_blinking_allowed = false;
            this.cardName = '';
            let cardSound = 'sounds.cards.';
            if (!this.firstPlayerTurn) {
                cardSound += 'opponent_';
            }
            if (this.latestCardValue > 0) {
                sound(cardSound + 'F' + this.latestCardValue + this.getPawnSex(), () => {
                    this.latestCardValue = 0;
                    this.applyCorrectMovement();
                });
            } else {
                sound(cardSound + 'B' + Math.abs(this.latestCardValue) + this.getPawnSex(), () => {
                    this.latestCardValue = 0;
                    this.applyCorrectMovement();
                });
            }
        },
        applyCardMovement() {
            let pos = this.pos1;
            if (!this.firstPlayerTurn) {
                pos = this.pos2;
            }
            pos += this.latestCardValue;
            this.gamePhase = 3;
            this.newPosition = pos;
            this.debugEmit('phase', 3);
            this.setCenter(false, this.latestCardValue);
            if (this.firstPlayerTurn) {
                this.ignoreInput = false;
            } else {
                this.resolvePhase3();
            }
        },
        getPawnSex() {
            if (this.firstPlayerTurn) {
                if (this.pawn1 === 2 || this.pawn1 === 3 || this.pawn1 === 6) {
                    return '_g';
                } else {
                    return '_b';
                }
            } else if (this.pawn2 === 2 || this.pawn2 === 3 || this.pawn2 === 6) {
                return '_g';
            } else {
                return '_b';
            }
        },
        playCardSound() {
            sound('sounds.cards.' + this.cardName + '_' + this.board + this.getPawnSex(), () => {
                this.applyCardMovement();
            });
        },
        increaseMusic() {
            this.musicVolume += 0.1;
            if (this.musicVolume > 1) {
                this.musicVolume = 1.0;
            }
            this.music.volume = this.musicVolume;
            this.updateVolumes();
        },
        decreaseMusic() {
            this.musicVolume -= 0.1;
            if (this.musicVolume <= 0) {
                this.musicVolume = 0;
            }
            this.music.volume = this.musicVolume;
            this.updateVolumes();
        },
        getStartSrc() {
            return this.getBoardPath() + 'start.png';
        },
        getGoalSrc() {
            return this.getBoardPath() + 'goal.png';
        },
        getExtrasSrc() {
            if (this.board === 2) {
                return this.getBoardPath() + 'extras.png';
            } else if (this.board === 3) {
                if (this.boardSize === 3) {
                    return '';
                } else {
                    return this.getBoardPath() + 'extras.png';
                }
            } else {
                return '';
            }
        },
        getMaxBoardPosition() {
            let max_value = 15;
            if (this.boardSize === 2) {
                max_value = 30;
            } else if (this.boardSize === 3) {
                max_value = 45;
            }
            return max_value;
        },
        getRewardSound() {
            return 'sounds.game.reward_[1-11]';
        },
        getOurTurnSound() {
            if (this.gameMode === 1) {
                return 'sounds.game.our_turn_solo_[1-5]';
            } else {
                return 'sounds.game.our_turn_[1-6]';
            }
        },
        getOtherTurnSound() {
            return 'sounds.game.other_turn_[1-8]';
        },
        // Debug mode, see resources/js/debug.js: the board publishes its progress and a snapshot of its state.
        debugEmit(event, payload) {
            if (!this.debug) {
                return;
            }
            this.debugLastEvent = event + ' ' + JSON.stringify(payload ?? null);
            emit(event, payload);
        },
        debugSnapshot() {
            return {
                gamePhase: this.gamePhase,
                firstPlayerTurn: this.firstPlayerTurn,
                pos1: this.pos1,
                pos2: this.pos2,
                newPosition: this.newPosition,
                blueIndex: this.blueIndex,
                blueShown: this.blue_position_show,
                ignoreInput: this.ignoreInput,
                mistakes: this.mistakes,
                cardName: this.cardName,
                latestCardValue: this.latestCardValue,
                gameEnd: this.gameEnd,
                showWin: this.showWin,
                showLoose: this.showLoose,
                board: this.board,
                boardSize: this.boardSize,
                gameMode: this.gameMode,
                diceType: this.diceType,
                movementMode: this.movementMode,
                autoMove: this.autoMove,
                selectKey: this.selectKey,
                navigateKey: this.navigateKey,
                scanningSpeed: this.scanningSpeed,
                tutorial: this.tutorial,
            };
        },
        setDebugVolumes(muted) {
            if (window.Laravel.playerAudio) {
                window.Laravel.playerAudio.playerSoundVolume = muted ? 0 : this.soundVolume;
            }
            if (this.music) {
                this.music.volume = muted ? 0 : this.musicVolume;
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

.move-up-down {
    animation: move-up-down 1s linear infinite;
}

@keyframes move-up-down {
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

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-blue-enter-active,
.fade-blue-leave-active {
    transition: opacity 0.5s;
}

.fade-blue-enter-from,
.fade-blue-leave-to {
    opacity: 0;
}

.fade-loose-enter-active,
.fade-loose-leave-active {
    transition: opacity 3s;
}

.fade-loose-enter-from,
.fade-loose-leave-to {
    opacity: 0;
}

.fade-init-enter-active,
.fade-init-leave-active {
    transition: opacity 1s;
}

.fade-init-enter-from,
.fade-init-leave-to {
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

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(200px);
    opacity: 0;
}
</style>
