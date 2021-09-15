<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Collection;
use App\Model\Entity\User;

class CollectionPolicy
{
    /**
     * Checks if the user can add a collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    public function canAdd(User $user, Collection $collection): bool
    {
        return true;
    }

    /**
     * Checks if the user can add a collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    public function canEdit(User $user, Collection $collection): bool
    {
        return $this->isAuthor($user, $collection);
    }

    /**
     * Checks if the user can add a collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    public function canDelete(User $user, Collection $collection): bool
    {
        return $this->isAuthor($user, $collection);
    }

    /**
     * Checks if the user is the author of the collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return bool
     */
    protected function isAuthor(User $user, Collection $collection): bool
    {
        return $collection->users_id == $user->getIdentifier();
    }
}
