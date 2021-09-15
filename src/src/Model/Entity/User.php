<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\IdentityInterface as AuthenticationIdentity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class User extends Entity implements AuthenticationIdentity
{
    /**
     * Authentication\IdentityInterface method
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->id;
    }

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
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Automatically hash passwords when they are changed.
     *
     * @param string $password The new password
     * @return string
     */
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($password);
    }
}
