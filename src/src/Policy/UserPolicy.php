<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Authorization\Policy\ResultInterface;

class UserPolicy
{
    /**
     * Checks if the user can edit the profile
     *
     * @param \App\Model\Entity\User $identity The user in question
     * @param \App\Model\Entity\User $user The user in question
     * @return \Authorization\Policy\ResultInterface
     */
    public function canEdit(IdentityInterface $identity, User $user): ResultInterface
    {
        return $this->isLoggedInUser($identity, $user);
    }

    /**
     * Checks if the user can edit the profile
     *
     * @param \App\Model\Entity\User $identity The user in question
     * @param \App\Model\Entity\User $user The user in question
     * @return \Authorization\Policy\ResultInterface
     */
    public function canUpdatePassword(IdentityInterface $identity, User $user): ResultInterface
    {
        return $this->isLoggedInUser($identity, $user);
    }

    /**
     * Checks if the user can delete the profile
     *
     * @param \App\Model\Entity\User $identity The user in question
     * @param \App\Model\Entity\User $user The user in question
     * @return \Authorization\Policy\ResultInterface
     */
    public function canDelete(IdentityInterface $identity, User $user): ResultInterface
    {
        return $this->isLoggedInUser($identity, $user);
    }

    /**
     * Checks if the user to be manipulated is the user logged in
     *
     * @param \App\Model\Entity\User $identity The user in question
     * @param \App\Model\Entity\User $user The user in question
     * @return \Authorization\Policy\ResultInterface
     */
    private function isLoggedInUser(IdentityInterface $identity, User $user): ResultInterface
    {
        return new Result($user->id === $identity->id);
    }
}
