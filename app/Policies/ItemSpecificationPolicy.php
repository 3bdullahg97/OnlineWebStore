<?php

namespace App\Policies;

use App\User;
use App\ItemSpecification;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemSpecificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any item specifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the item specification.
     *
     * @param  \App\User  $user
     * @param  \App\ItemSpecification  $itemSpecification
     * @return mixed
     */
    public function view(User $user, ItemSpecification $itemSpecification)
    {
        return true;
    }

    /**
     * Determine whether the user can create item specifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can update the item specification.
     *
     * @param  \App\User  $user
     * @param  \App\ItemSpecification  $itemSpecification
     * @return mixed
     */
    public function update(User $user, ItemSpecification $itemSpecification)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the item specification.
     *
     * @param  \App\User  $user
     * @param  \App\ItemSpecification  $itemSpecification
     * @return mixed
     */
    public function delete(User $user, ItemSpecification $itemSpecification)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the item specification.
     *
     * @param  \App\User  $user
     * @param  \App\ItemSpecification  $itemSpecification
     * @return mixed
     */
    public function restore(User $user, ItemSpecification $itemSpecification)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the item specification.
     *
     * @param  \App\User  $user
     * @param  \App\ItemSpecification  $itemSpecification
     * @return mixed
     */
    public function forceDelete(User $user, ItemSpecification $itemSpecification)
    {
        return $user->id === 1;
    }
}
