<?php
/**
* This file contains arrays of sample data used on various views.
* Please note that this file is actually used during Development via require
* on ../../routes/web.php and therefore it should not be moved or deleted.
*/

/**
* Avatar Data array, which can easily be converted to a Eloquent\Model.
*
* You can simply move the `exampleDataAvatarModel.php` as `Avatar.php` on
* `/app/Models` and do whatever is necessary to use it in this App. Note that
* the provided example fully describes all the data values of this array and
* in addition provides some handy methods to use it in your App.
*
* @example exampleDataAvatarModel Example Avatar Model for Laravel.
*/
$avatars = [
    1 => [  // Avatar's Unique ID
        "id" => 1, // Repeating id for convenience.
        "asset" => "boy-1", // Extensions .png, @2x.png and svg implied.
        "description" => "Φατσούλα αγοριού με καστανά μαλιά", // For "alt".
        "public_path" => "images/avatars", // Public path of all avatars.
        "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
        "height" => 100,
    ],
    2 => [  // Avatar's Unique ID
        "id" => 2, // Repeating id for convenience.
        "asset" => "boy-2", // Extensions .png, @2x.png and svg implied.
        "description" => "Φατσούλα αγοριού με μαύρα μαλιά", // For "alt".
        "public_path" => "images/avatars", // Public path of all avatars.
        "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
        "height" => 100,
    ],
    3 => [  // Avatar's Unique ID
        "id" => 3, // Repeating id for convenience.
        "asset" => "girl-1", // Extensions .png, @2x.png and svg implied.
        "description" => "Φατσούλα κοριτσιού με μαύρα μαλιά", // For "alt".
        "public_path" => "images/avatars", // Public path of all avatars.
        "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
        "height" => 100,
    ],
    4 => [  // Avatar's Unique ID
        "id" => 4, // Repeating id for convenience.
        "asset" => "girl-2", // Extensions .png, @2x.png and svg implied.
        "description" => "Φατσούλα κοριτσιού με ξανθά μαλιά", // For "alt".
        "public_path" => "images/avatars", // Public path of all avatars.
        "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
        "height" => 100,
    ],
    5 => [  // Avatar's Unique ID
        "id" => 5, // Repeating id for convenience.
        "asset" => "dog", // Extensions .png, @2x.png and svg implied.
        "description" => "Φατσούλα σκύλου", // For "alt".
        "public_path" => "images/avatars", // Public path of all avatars.
        "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
        "height" => 100,
    ],
    6 => [  // Avatar's Unique ID
        "id" => 6, // Repeating id for convenience.
        "asset" => "cat", // Extensions .png, @2x.png and svg implied.
        "description" => "Φατσούλα γατούλας", // For "alt".
        "public_path" => "images/avatars", // Public path of all avatars.
        "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
        "height" => 100,
    ],

];

$players = [
    1 => [ // Player's Unique ID
        "id" => 1,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 5, // Attached Avatar ID
        "name" => "Κώστας Παπ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    5 => [ // Player's Unique ID
        "id" => 5,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 3, // Attached Avatar ID
        "name" => "Νίκη Καραγ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    12 => [ // Player's Unique ID
        "id" => 12,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 1, // Attached Avatar ID
        "name" => "Μανώλης Βλασ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    23 => [ // Player's Unique ID
        "id" => 23,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 4, // Attached Avatar ID
        "name" => "Μαρία Παπ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    32 => [ // Player's Unique ID
        "id" => 32,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 6, // Attached Avatar ID
        "name" => "Γιάννης Μαρ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    45 => [ // Player's Unique ID
        "id" => 45,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 1, // Attached Avatar ID
        "name" => "Λεωνίδας Κ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    77 => [ // Player's Unique ID
        "id" => 77,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 1, // Attached Avatar ID
        "name" => "Μάριος Δημ.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
    88 => [ // Player's Unique ID
        "id" => 88,  // Repeating ID for convenience
        "user_id" => 1, // Attached User ID // Not used on templates
        "avatar_id" => 4, // Attached Avatar ID
        "name" => "Ντίνα Αντων.", // Example name.
        "settings" => [], // Settings // Not used on templates doesn't have to be an array it could be various config options.
    ],
];

/**
 * Add the attached avatar to each player via a callback.
 *
 * @param [array] $player
 * @param [array] $avatars Not needed if the Avatar model is implemented.
 *   The same-old-good-avatar-array, we've already used in other occassions.
 * @return array
 */
function addAvatarToPlayer($player, $avatars) {
    // @var App\Models\Avatar[] $avatars An array of Avatar Model objects.
    // $avatars = Avatar::getAllAvatars();
    $avatar_id = $player["avatar_id"];
    $avatar = $avatars[$avatar_id];
    return array_merge($player, ["avatar" => $avatar]);
}

// This won't work in here as we can't use `global $avatars` in the cb function:
//   $players_with_avatars = array_map("addAvatarToPlayer", $players);
// So until we have our Avatar and Profile model, let's use this monstrosity:
$players_with_avatars = array_map(function($players) use ($avatars) {
    return addAvatarToPlayer($players, $avatars);
}, $players);
// I am pretty sure that there has to be a better way.
// We shouldn't really add comments after the code though.
// Ok, so stop adding them then!
// No.
// Why?
// Because.
