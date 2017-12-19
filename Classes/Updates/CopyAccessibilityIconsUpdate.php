<?php
/**
 * @author Christoph Bessei
 * @version
 */

namespace C3\Tibs\Updates;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Install\Updates\AbstractUpdate;

class CopyAccessibilityIconsUpdate extends AbstractUpdate
{
    protected static $files = [
        'setup.txt',
        'pageTSConfig.txt',
        'locallang.xml',
        'img/download.gif',
        'img/external_link.gif',
        'img/external_link_new_window.gif',
        'img/internal_link.gif',
        'img/internal_link_new_window.gif',
        'img/mail.gif',
    ];

    protected $title = 'EXT:tibs Copy accessibility icons to rtehtmlarea for backward compatibility';

    /**
     * Checks whether updates are required.
     *
     * @param string &$description The description for the update
     * @return bool Whether an update is required (TRUE) or not (FALSE)
     */
    public function checkForUpdate(&$description)
    {
        foreach (static::$files as $file) {
            if (!file_exists(PATH_typo3 . 'sysext/rtehtmlarea/res/accessibilityicons/' . $file)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Performs the accordant updates.
     *
     * @param array &$dbQueries Queries done in this update
     * @param mixed &$customMessages Custom messages
     * @return bool Whether everything went smoothly or not
     */
    public function performUpdate(array &$dbQueries, &$customMessages)
    {
        $typo3AccessibilityIconsDir = PATH_typo3 . 'sysext/rtehtmlarea/res/accessibilityicons/';
        $accessibilityIconsDir = ExtensionManagementUtility::extPath(
            'tibs',
            '/Resources/Private/Legacy/accessibilityicons/'
        );

        if (!is_dir($typo3AccessibilityIconsDir . 'img/')) {
            mkdir($typo3AccessibilityIconsDir . 'img/');
        }

        foreach (static::$files as $file) {
            copy($accessibilityIconsDir . $file, $typo3AccessibilityIconsDir . $file);
        }

        return true;
    }
}
