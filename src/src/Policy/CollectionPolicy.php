<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Collection;
use App\Model\Entity\User;
use Authorization\Policy\Result;
use Authorization\Policy\ResultInterface;

class CollectionPolicy
{
    /**
     * Checks if the user can add a collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return ResultInterface
     */
    public function canAdd(User $user, Collection $collection): ResultInterface
    {
        return new Result(true);
    }

    /**
     * Checks if the user can add a collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return ResultInterface
     */
    public function canEdit(User $user, Collection $collection): ResultInterface
    {
        return $this->isAuthor($user, $collection);
    }

    /**
     * Checks if the user can add a collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return ResultInterface
     */
    public function canDelete(User $user, Collection $collection): ResultInterface
    {
        return $this->isAuthor($user, $collection);
    }

    /**
     * Checks if the user is the author of the collection
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Collection $collection the collection model
     * @return ResultInterface
     */
    protected function isAuthor(User $user, Collection $collection): ResultInterface
    {
        $isAuthor = $collection->users_id == $user->getIdentifier();

        if (!$isAuthor) {
            return new Result(false, 'not-author');
        }

        return new Result(true);
    }
}
