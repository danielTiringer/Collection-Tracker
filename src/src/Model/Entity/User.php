<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\IdentityInterface as AuthenticationIdentity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authorization\AuthorizationServiceInterface;
use Authorization\IdentityInterface as AuthorizationIdentity;
use Authorization\Policy\ResultInterface;
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
class User extends Entity implements AuthenticationIdentity, AuthorizationIdentity
{
    /**
     * Authorization Service
     *
     * @var \Authorization\AuthorizationServiceInterface
     */
    protected $authorization;

    /**
     * Check whether the current identity can perform an action.
     *
     * @param string $action The action/operation being performed.
     * @param mixed $resource The resource being operated on.
     * @return bool
     */
    public function can($action, $resource): bool
    {
        return $this->authorization->can($this, $action, $resource);
    }

    /**
     * Check whether the current identity can perform an action.
     *
     * @param string $action The action/operation being performed.
     * @param mixed $resource The resource being operated on.
     * @return \Authorization\Policy\ResultInterface
     */
    public function canResult($action, $resource): ResultInterface
    {
        return $this->authorization->canResult($this, $action, $resource);
    }

    /**
     * Apply authorization scope conditions/restrictions.
     *
     * @param string $action The action/operation being performed.
     * @param mixed $resource The resource being operated on.
     * @return mixed The modified resource.
     */
    public function applyScope($action, $resource)
    {
        return $this->authorization->applyScope($this, $action, $resource);
    }

    /**
     * Get the decorated identity
     *
     * If the decorated identity implements `getOriginalData()`
     * that method should be invoked to expose the original data.
     *
     * @return array|\ArrayAccess
     */
    public function getOriginalData()
    {
        return $this;
    }

    /**
     * Setter to be used by the middleware.
     *
     * @param \Authorization\AuthorizationServiceInterface $service The authorization service interface
     * @return array|\ArrayAccess
     */
    public function setAuthorization(AuthorizationServiceInterface $service)
    {
        $this->authorization = $service;

        return $this;
    }

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
