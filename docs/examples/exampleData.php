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
            "publicPath" => "images/avatars", // Public path of all avatars.
            "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
            "height" => 100,
    ],
    2 => [  // Avatar's Unique ID
            "id" => 2, // Repeating id for convenience.
            "asset" => "boy-2", // Extensions .png, @2x.png and svg implied.
            "description" => "Φατσούλα αγοριού με μαύρα μαλιά", // For "alt".
            "publicPath" => "images/avatars", // Public path of all avatars.
            "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
            "height" => 100,
    ],
    3 => [  // Avatar's Unique ID
            "id" => 3, // Repeating id for convenience.
            "asset" => "girl-1", // Extensions .png, @2x.png and svg implied.
            "description" => "Φατσούλα κοριτσιού με μαύρα μαλιά", // For "alt".
            "publicPath" => "images/avatars", // Public path of all avatars.
            "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
            "height" => 100,
    ],
    4 => [  // Avatar's Unique ID
            "id" => 4, // Repeating id for convenience.
            "asset" => "girl-2", // Extensions .png, @2x.png and svg implied.
            "description" => "Φατσούλα κοριτσιού με ξανθά μαλιά", // For "alt".
            "publicPath" => "images/avatars", // Public path of all avatars.
            "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
            "height" => 100,
    ],
    5 => [  // Avatar's Unique ID
            "id" => 5, // Repeating id for convenience.
            "asset" => "dog", // Extensions .png, @2x.png and svg implied.
            "description" => "Φατσούλα σκύλου", // For "alt".
            "publicPath" => "images/avatars", // Public path of all avatars.
            "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
            "height" => 100,
    ],
    6 => [  // Avatar's Unique ID
            "id" => 6, // Repeating id for convenience.
            "asset" => "cat", // Extensions .png, @2x.png and svg implied.
            "description" => "Φατσούλα γατούλας", // For "alt".
            "publicPath" => "images/avatars", // Public path of all avatars.
            "width" => 100, // Dimensions for all avatars (100x100px/1:1 ratio).
            "height" => 100,
    ],

];
