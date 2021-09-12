namespace App\Policy;

class CollectionsTablePolicy
{
    public function scopeIndex($user, $query)
    {
        return $query->where(['Collections.users_id' => $user->getIdentifier()]);
    }
}
