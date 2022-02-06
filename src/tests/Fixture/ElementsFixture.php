<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ElementsFixture
 */
class ElementsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'collection_id' => 1,
                'source' => 'Lorem ipsum dolor sit amet',
                'metadata' => 'Lorem ipsum dolor sit amet',
                'created' => '2021-06-03 20:31:26',
                'modified' => '2021-06-03 20:31:26',
            ],
            [
                'id' => 2,
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'collection_id' => 3,
                'source' => 'Lorem ipsum dolor sit amet',
                'metadata' => 'Lorem ipsum dolor sit amet',
                'created' => '2021-06-03 20:31:26',
                'modified' => '2021-06-03 20:31:26',
            ],
        ];
        parent::init();
    }
}
