<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Element;
use App\Model\Entity\User;

class ElementPolicy
{
    /**
     * Checks if the user can add a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return bool
     */
    public function canAdd(User $user, Element $element): bool
    {
        return true;
    }

    /**
     * Checks if the user can add a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return bool
     */
    public function canEdit(User $user, Element $element): bool
    {
        return $this->isAuthor($user, $element);
    }

    /**
     * Checks if the user can add a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return bool
     */
    public function canDelete(User $user, Element $element): bool
    {
        return $this->isAuthor($user, $element);
    }

    /**
     * Checks if the user is the author of the element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return bool
     */
    protected function isAuthor(User $user, Element $element): bool
    {
        return $element->collection->users_id == $user->getIdentifier();
    }
}
