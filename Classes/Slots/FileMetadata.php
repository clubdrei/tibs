<?php

namespace C3\Tibs\Slots;

use Causal\ImageAutoresize\Slots\FileUpload;

/**
 * @author Christoph Bessei
 *
 * Extend FileUpload to get access to FileUpload::$metadata
 */
class FileMetadata extends FileUpload
{
    public function removeMetadata(&$targetFileName, \TYPO3\CMS\Core\Resource\Folder $folder, $sourceFile)
    {
        if (!empty(static::$metadata['ImageDescription'])) {
            static::$metadata['ImageDescription'] = null;
        }
    }
}
