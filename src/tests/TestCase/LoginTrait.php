<?php
declare(strict_types=1);

namespace App\Test\TestCase;

use Cake\ORM\TableRegistry;

trait LoginTrait
{
    protected function login($userId = 1)
    {
        $user = TableRegistry::get('Users')->get($userId);
        $this->session([
            'Auth' => $user,
        ]);
    }
}
