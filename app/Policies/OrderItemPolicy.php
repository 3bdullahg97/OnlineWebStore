<?php

namespace App\Policies;

use App\User;
use App\OrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any order items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can view the order item.
     *
     * @param  \App\User  $user
     * @param  \App\OrderItem  $orderItem
     * @return mixed
     */
    public function view(User $user, OrderItem $orderItem)
    {
        return $user->id === $orderItem->order->user->id ||  $user->id === 1;
    }

    /**
     * Determine whether the user can create order items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can update the order item.
     *
     * @param  \App\User  $user
     * @param  \App\OrderItem  $orderItem
     * @return mixed
     */
    public function update(User $user, OrderItem $orderItem)
    {
        return ($user->id === $orderItem->order->user->id) ||  $user->id === 1;
    }

    /**
     * Determine whether the user can delete the order item.
     *
     * @param  \App\User  $user
     * @param  \App\OrderItem  $orderItem
     * @return mixed
     */
    public function delete(User $user, OrderItem $orderItem)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the order item.
     *
     * @param  \App\User  $user
     * @param  \App\OrderItem  $orderItem
     * @return mixed
     */
    public function restore(User $user, OrderItem $orderItem)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the order item.
     *
     * @param  \App\User  $user
     * @param  \App\OrderItem  $orderItem
     * @return mixed
     */
    public function forceDelete(User $user, OrderItem $orderItem)
    {
        return $user->id === 1;
    }
}
