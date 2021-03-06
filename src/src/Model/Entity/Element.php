<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Element Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $collection_id
 * @property string|null $source
 * @property string|null $image
 * @property string|null $metadata
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Collection $collection
 */
class Element extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'collection_id' => true,
        'source' => true,
        'image' => true,
        'metadata' => true,
        'created' => true,
        'modified' => true,
        'collection' => true,
    ];
}
