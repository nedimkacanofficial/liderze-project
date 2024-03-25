<?php

include(DB . "./database.php");
$DB = new AdminDB();
$settings = $DB->dataList('settings', 'WHERE id = ?', [1], ' ORDER BY id ASC', 1);
if ($settings) {
    $id = $settings[0]["id"];
    $title = $settings[0]["title"];
    $description = $settings[0]["description"];
    $seo_key = $settings[0]["seo_key"];
    $url = $settings[0]["url"];
}
