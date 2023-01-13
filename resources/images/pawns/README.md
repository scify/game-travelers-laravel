# Notes on Pawns Images

Even though the characters are always the same, their images (appearance) differs based on the selected game board. For example, some characters on the island board are dressed in hawaiian shirts, while the same characters on the mountain board are wearing jackets.

Pawn images have been organized in sub-folders according to the board on which they belong to:

-   Folder [1](./1/) contains the images of the pawns for the 1st board of the game (the island).
-   Folder [2](./2/) will contain the images of the pawns for the 2nd board of the game (the mountain).

### 7 pawns, 14 images

All images should be in PNG format and they should be available in regular and @2x sizes (e.g. `pawn-dimitris.png` and `pawn-dimitris@2x.png`).

### Pawn filenames

The filenames should always be the same, regardless of the folder.

1. pawn-iasonas
2. pawn-myrto
3. pawn-katerina
4. pawn-dimitris
5. pawn vasilis
6. pawn-zoumpoulia
7. pawn-vrasidas

### Pawn order

Note that these are not in random order: Their ordered list number corresponts to the ID used on the back-end to determine the user's selection.

### Pawn usage

Currently, these images are not processed automatically and they have to manually be inserted on [gameSelectPawn.blade.php](../../views/gameSelectPawn.blade.php) as Buttons with the help of the [x-selectPawnButton](../../views/components/selectPawnButton.blade.php) component.