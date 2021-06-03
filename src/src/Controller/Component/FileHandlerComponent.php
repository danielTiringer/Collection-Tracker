<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;

class FileHandlerComponent extends Component
{
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
