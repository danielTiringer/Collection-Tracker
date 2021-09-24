<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\Policy\Result;
use Authorization\Policy\ResultInterface;
use Cake\ORM\Query;

class CollectionsTablePolicy
{
    /**
     * Checks if the user can view the collection index
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \Cake\ORM\Query $query the query that's executed
     * @return \Authorization\Policy\ResultInterface
     */
    public function canIndex(User $user, Query $query): ResultInterface
    {
        return new Result(true);
    }

    /**
     * Scopes index queries to the current user's collections
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \Cake\ORM\Query $query the query that's executed
     * @return \Cake\ORM\Query
     */
    public function scopeIndex(User $user, Query $query): Query
    {
        return $query->where([
            'Collections.users_id' => $user->getIdentifier(),
        ]);
    }
}
