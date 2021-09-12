<?php
namespace App\Policy;

use App\Model\Entity\Collection;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;

class CollectionPolicy
{
    public function canUpdate(IdentityInterface $user, Collection $collection)
    {
        if ($user->id == $collection->users_id) {
            return new Result(true);
        }

        return new Result(false, 'not-owner');
    }
}
