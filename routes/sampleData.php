<?php

$sampleAvatarTabIndex = 2;
$sampleAvatarData = array(
    0 => [
        "id" => "1",
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα αγοριού με καστανά μαλιά",
        "asset" => "boy-1",
        "selected" => null, // <button data-avatar-selected="false">
        "showLabel" => null,
    ],
    1 => [
        "id" => "2", // <button data-avatar-id="2">
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα", // displayed name e.g. Γιώργος
        "description" => "Φατσούλα αγοριού με μαύρα μαλιά", // alt-text
        "asset" => "boy-2",
        "selected" => true, // <button data-avatar-selected="1">
        "showLabel" => null,
    ],
    2 => [
        "id" => "3",
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα κοριτσιού με μαύρα μαλιά",
        "asset" => "girl-1",
        "selected" => null,
        "showLabel" => null,
    ],
    3 => [
        "id" => "4",
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα κοριτσιού με ξανθά μαλιά",
        "asset" => "girl-2",
        "selected" => null,
        "showLabel" => null,
    ],
    4 => [
        "id" => "5",
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα σκύλου",
        "asset" => "dog",
        "selected" => null,
        "showLabel" => null,
    ],
    5 => [
        "id" => "6",
        "tabindex" => $sampleAvatarTabIndex++,
        "label" => "Φατσούλα",
        "description" => "Φατσούλα γατούλας",
        "asset" => "cat",
        "selected" => null,
        "showLabel" => null,
    ],
);
