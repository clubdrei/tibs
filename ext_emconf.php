<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "tibs".
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'TIBS',
    'description' => 'TYPO3 extension for TIBS',
    'category' => 'misc',
    'version' => '0.0.3',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearcacheonload' => 1,
    'author' => 'clubdrei.com Internetagentur OG',
    // http://insight.helhum.io/post/130876393595/how-to-configure-class-loading-for-extensions-in
    'autoload' => [
        'psr-4' => ['C3\\Tibs\\' => 'Classes'],
    ],
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-7.6.99',
        ],
        'conflicts' => [],
        'suggests' => [
            'image_autoresize' => '',
        ],
    ],
];
