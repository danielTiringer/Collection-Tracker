<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddImageToCollections extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('collections');
        $table->addColumn('image_file', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'goal',
        ]);
        $table->update();
    }
}
