<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Element;
use App\Model\Entity\User;
use Authorization\Policy\Result;
use Authorization\Policy\ResultInterface;

class ElementPolicy
{
    /**
     * Checks if the user can add a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return \Authorization\Policy\ResultInterface
     */
    public function canAdd(User $user, Element $element): ResultInterface
    {
        return $this->isAuthor($user, $element);
    }

    /**
     * Checks if the user can view a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return \Authorization\Policy\ResultInterface
     */
    public function canView(User $user, Element $element): ResultInterface
    {
        return $this->isAuthor($user, $element);
    }

    /**
     * Checks if the user can add a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return \Authorization\Policy\ResultInterface
     */
    public function canEdit(User $user, Element $element): ResultInterface
    {
        return $this->isAuthor($user, $element);
    }

    /**
     * Checks if the user can add a element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return \Authorization\Policy\ResultInterface
     */
    public function canDelete(User $user, Element $element): ResultInterface
    {
        return $this->isAuthor($user, $element);
    }

    /**
     * Checks if the user is the author of the element
     *
     * @param \App\Model\Entity\User $user the user in question
     * @param \App\Model\Entity\Element $element the element model
     * @return \Authorization\Policy\ResultInterface
     */
    protected function isAuthor(User $user, Element $element): ResultInterface
    {
        $isAuthor = $element->collection->user_id == $user->getIdentifier();

        if (!$isAuthor) {
            return new Result(false, __('Only its author can manipulate this element.'));
        }

        return new Result(true);
    }
}
