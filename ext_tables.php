<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/**
 * Do not pollute global namespace
 * @var $_EXTKEY string
 */
call_user_func(
    function () use ($_EXTKEY) {
        $typo3ConfVars = &$GLOBALS['TYPO3_CONF_VARS'];
        $scOptions = &$typo3ConfVars['SC_OPTIONS'];
    }
);
