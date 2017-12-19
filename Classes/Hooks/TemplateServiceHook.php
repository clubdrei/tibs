<?php
namespace C3\Tibs\Hooks;

use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @author Christoph Bessei
 */
class TemplateServiceHook
{
    /**
     * Insert our TypoScript as the last static file.
     *
     * @param array $params
     * @param \TYPO3\CMS\Core\TypoScript\TemplateService $templateService
     */
    public function includeStaticTypoScriptSources(array $params, TemplateService $templateService)
    {
        if ($this->isRootSysTemplateEntry($params)) {
            // Append our TypoScript as the last include on the
            if (empty($params['row']['include_static_file'])) {
                // No entries so far
                $params['row']['include_static_file'] = 'EXT:tibs/Configuration/TypoScript/';
            } else {
                // Append to existing entries
                $staticFiles = GeneralUtility::trimExplode(',', $params['row']['include_static_file']);
                $staticFiles[] = 'EXT:tibs/Configuration/TypoScript/';
                $params['row']['include_static_file'] = implode(',', array_unique($staticFiles));
            }
        }
    }


    /**
     * Check if the current entry is the last/final sys_template entry.
     *
     * @param $params
     * @param $templateService
     * @return bool
     */
    protected function isRootSysTemplateEntry($params)
    {
        $templateId = $params['templateId'];
        if (GeneralUtility::isFirstPartOfStr($templateId, 'ext_')) {
            // Skip extension templates
            return false;
        }

        if (!empty($params['row']['root'])) {
            // Found root
            return true;
        }

        return false;
    }
}
