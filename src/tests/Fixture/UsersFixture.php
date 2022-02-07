<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\Auth\DefaultPasswordHasher;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    public $connection = 'test';

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $hasher = new DefaultPasswordHasher();
        $this->records = [
            [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => $hasher->hash('password'),
                'created' => '2021-05-02 10:39:39',
                'modified' => '2021-05-02 10:39:39',
            ],
            [
                'id' => 2,
                'name' => 'Other User',
                'email' => 'other@example.com',
                'password' => $hasher->hash('password'),
                'created' => '2021-05-03 10:39:39',
                'modified' => '2021-05-03 10:39:39',
            ],
        ];
        parent::init();
    }
}
