<?php
/**
 * This file contains an array of sample data used on various views.
 *
 * @var array $sampleAvatarData The avatar data array.
 *
 * @var array $sampleAvatarData[] An avatar data element.
 * @var int $sampleAvatarData[]['id'] The ID of the avatar.
 * @var int $sampleAvatarData[]['tabindex'] The tab index of the avatar.
 * @var string $sampleAvatarData[]['label'] The label of the avatar.
 * @var string $sampleAvatarData[]['description'] The description of the avatar.
 * @var string $sampleAvatarData[]['asset'] The avatar asset's filename.
 * @var null $sampleAvatarData[]['selected'] The selected state of the avatar.
 * @var null $sampleAvatarData[]['showLabel'] The show label state of the avatar.
 *
 * This array should combine the actual avatar data, with some parameters which
 * are unique for each form. For example, on new profile forms, the first avatar
 * should have the tabindex of 2, as the first input element is the player's
 * name. Furthermore, selected and showLabel could also vary depending on the
 * situation.
 *
 * The asset is the file's name without its extension. For example: "boy-1".
 * The template will automatically append extensions .png, @2x.png and .svg.
 *
 * Please read the comments on the component for more instructions:
 * @see resources/views/components/profileNewAvatar.blade.php
 */
$sampleAvatarTabIndex = 2; // assumming its usage on the newProfileStep1 form.
$sampleAvatarData = array(
    0 => [
        "id" => 1,
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα", // displayed name e.g. Γιώργος
        "description" => "Φατσούλα αγοριού με καστανά μαλιά", // alt-text
        "asset" => "boy-1",
        "selected" => null, // <button data-avatar-selected="false">
        "showLabel" => null, // ah yes, templates like null...
    ],
    1 => [
        "id" => 2, // <button data-avatar-id="2">
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα αγοριού με μαύρα μαλιά",
        "asset" => "boy-2",
        "selected" => true, // <button data-avatar-selected="1"> not utilizedyet
        "showLabel" => null,
    ],
    2 => [
        "id" => 3,
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα κοριτσιού με μαύρα μαλιά",
        "asset" => "girl-1",
        "selected" => null,
        "showLabel" => null,
    ],
    3 => [
        "id" => 4,
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα κοριτσιού με ξανθά μαλιά",
        "asset" => "girl-2",
        "selected" => null,
        "showLabel" => null,
    ],
    4 => [
        "id" => 5,
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα σκύλου",
        "asset" => "dog",
        "selected" => null,
        "showLabel" => null,
    ],
    5 => [
        "id" => 6,
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα γατούλας",
        "asset" => "cat",
        "selected" => null,
        "showLabel" => null,
    ],
);
// Αυτό παραμένει Under Contstruction μέχρι να δούμε στα mock-ups τι
// άλλο θα μπορούσε δυνητικά να περιέχει το τελικό class. Για εμένα αυτή
// τη στιγμή είναι χρήσιμο για να δοκιμάζω τα states των avatar buttons και
// να γράψω μερικές γραμμές JavaScript ώστε τα πλήκτρα να καθορίζουν την
// τιμή σε checkbox και να αλλάζουν τα states τους.
// EOF.
