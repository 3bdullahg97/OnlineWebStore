<?php

namespace App\Policies;

use App\User;
use App\ItemImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any item images.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the item image.
     *
     * @param  \App\User  $user
     * @param  \App\ItemImage  $itemImage
     * @return mixed
     */
    public function view(User $user, ItemImage $itemImage)
    {
        return true;
    }

    /**
     * Determine whether the user can create item images.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can update the item image.
     *
     * @param  \App\User  $user
     * @param  \App\ItemImage  $itemImage
     * @return mixed
     */
    public function update(User $user, ItemImage $itemImage)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the item image.
     *
     * @param  \App\User  $user
     * @param  \App\ItemImage  $itemImage
     * @return mixed
     */
    public function delete(User $user, ItemImage $itemImage)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the item image.
     *
     * @param  \App\User  $user
     * @param  \App\ItemImage  $itemImage
     * @return mixed
     */
    public function restore(User $user, ItemImage $itemImage)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the item image.
     *
     * @param  \App\User  $user
     * @param  \App\ItemImage  $itemImage
     * @return mixed
     */
    public function forceDelete(User $user, ItemImage $itemImage)
    {
        return $user->id === 1;
    }
}
