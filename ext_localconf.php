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

        if (TYPO3_MODE === 'BE') {
            $updates = &$scOptions['ext/install']['update'];
            $updates['c3_tibs_copy_accessibility_icons'] = \C3\Tibs\Updates\CopyAccessibilityIconsUpdate::class;
        }

        $scOptions['t3lib/class.t3lib_tstemplate.php']['includeStaticTypoScriptSources'][] =
            \C3\Tibs\Hooks\TemplateServiceHook::class . '->includeStaticTypoScriptSources';
    }
);
