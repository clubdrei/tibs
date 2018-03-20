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

        /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
        $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class
        );

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('image_autoresize')) {
            // FileMetadata extends FileUpload of image_autoresize
            // Avoid class not found exception, if image_autoresize doesn't exist
            $signalSlotDispatcher->connect(
                \TYPO3\CMS\Core\Resource\ResourceStorage::class,
                \TYPO3\CMS\Core\Resource\ResourceStorageInterface::SIGNAL_PreFileAdd,
                \C3\Tibs\Slots\FileMetadata::class,
                'removeMetadata'
            );
        }
        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('mediace')) {
            // Override MultimediaContentObject for better video support
            $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects']['MULTIMEDIA'] = \C3\Tibs\ContentObject\MultimediaContentObject::class;
        }

    }
);
