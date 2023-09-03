<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('shulian1@cse.msu.edu');
    $site->setRoot('/~shulian1/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=shulian1',
        'shulian1',       // Database user
        'Shulianghao123',     // Database password
        'test8_');            // Table prefix
};

