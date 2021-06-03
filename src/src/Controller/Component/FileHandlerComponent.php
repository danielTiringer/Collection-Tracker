<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Cake\Filesystem\Filesystem;
use Cake\I18n\Time;

class FileHandlerComponent extends Component
{
    /**
     * Prefixes filename with timestamp
     *
     * @param string $fileName
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
     * @param string $path
     * @return void
     */
    public function createFolderIfNotExists(string $path)
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->find($path)) {
            $fileSystem->mkdir($path, 0777);
        }
    }

    /**
     * Removes a file
     *
     * @param string $fileToRemove
     * @return bool
     */
    public function deleteFile(string $fileToRemove): bool
    {
        $file = new File($fileToRemove);
        return $file->delete();
    }
}
