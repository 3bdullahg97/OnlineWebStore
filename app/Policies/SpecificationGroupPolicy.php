<?php

namespace App\Policies;

use App\User;
use App\SpecificationGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecificationGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any specification groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the specification group.
     *
     * @param  \App\User  $user
     * @param  \App\SpecificationGroup  $specificationGroup
     * @return mixed
     */
    public function view(User $user, SpecificationGroup $specificationGroup)
    {
        return true;
    }

    /**
     * Determine whether the user can create specification groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can update the specification group.
     *
     * @param  \App\User  $user
     * @param  \App\SpecificationGroup  $specificationGroup
     * @return mixed
     */
    public function update(User $user, SpecificationGroup $specificationGroup)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the specification group.
     *
     * @param  \App\User  $user
     * @param  \App\SpecificationGroup  $specificationGroup
     * @return mixed
     */
    public function delete(User $user, SpecificationGroup $specificationGroup)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the specification group.
     *
     * @param  \App\User  $user
     * @param  \App\SpecificationGroup  $specificationGroup
     * @return mixed
     */
    public function restore(User $user, SpecificationGroup $specificationGroup)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the specification group.
     *
     * @param  \App\User  $user
     * @param  \App\SpecificationGroup  $specificationGroup
     * @return mixed
     */
    public function forceDelete(User $user, SpecificationGroup $specificationGroup)
    {
        return $user->id === 1;
    }
}
