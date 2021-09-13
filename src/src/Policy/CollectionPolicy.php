<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Collection;
use Authorization\IdentityInterface;

class CollectionPolicy
{
    /**
     * Checks if the user can add a collection
     *
     * @param \Authorization\IdentityInterface $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Collection $collection): bool
    {
        return true;
    }

    /**
     * Checks if the user can add a collection
     *
     * @param \Authorization\IdentityInterface $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Collection $collection): bool
    {
        return $this->isAuthor($user, $collection);
    }

    /**
     * Checks if the user can add a collection
     *
     * @param \Authorization\IdentityInterface $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Collection $collection): bool
    {
        return $this->isAuthor($user, $collection);
    }

    /**
     * Checks if the user is the author of the collection
     *
     * @param \Authorization\IdentityInterface $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    protected function isAuthor(IdentityInterface $user, Collection $collection): bool
    {
        return $collection->users_id === $user->id;
    }
}
