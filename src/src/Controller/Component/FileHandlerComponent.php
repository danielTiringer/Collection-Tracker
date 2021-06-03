<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Cake\I18n\Time;

class FileHandlerComponent extends Component
{
    /**
     * Prefixes filename with timestamp
     *
     * @param string $fileName Name of the file we add to
     * @return string
     */
    public function addTimeStampToFileName(string $fileName): string
    {
        $currentDateTime = (new Time('now'))->format('YmdHis');

        return $currentDateTime . '_' . $fileName;
    }

    /**
     * Creates for folder for collections images
     *
     * @param string $path The filepath we want to create / check
     * @return void
     */
    public function createFolderIfNotExists(string $path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777);
        }
    }

    /**
     * Removes a file
     *
     * @param string $fileToRemove The file to be removed
     * @return bool
     */
    public function deleteFile(string $fileToRemove): bool
    {
        $file = new File($fileToRemove);

        return $file->delete();
    }
}
