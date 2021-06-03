<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Cake\Filesystem\Filesystem;

class FileHandlerComponent extends Component
{
    /**
     * Creates for folder for collections images
     *
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
