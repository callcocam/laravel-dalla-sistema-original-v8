<?php

namespace App\Policies;

use App\Models\Admin\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orders.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param \App\Models\User $user
     * @param Order $order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        if($user->hasAnyRole('pedidos')){
            return true;
        }
        return $user->id == $order->client_id;
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param \App\User $user
     * @param Order $order
     * @return mixed
     */
    public function status(User $user,Order $order)
    {

        if($user->hasAnyRole('pedidos')){
            return !in_array($order->status, ['completed']);
        }
        return $order->status == 'not-accepted';
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        dd($user);
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param \App\User $user
     * @param Order $order
     * @return mixed
     */
    public function update(User $user, Order $order)
    {
        if($user->hasAnyRole('pedidos')){
            return true;
        }

        return $user->id == $order->client_id;
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param \App\Models\User $user
     * @param Order $order
     * @return mixed
     */
    public function delete(User $user, Order $order)
    {
        if($user->hasAnyRole('pedidos')){
            return true;
        }
        return $user->id == $order->client_id;
    }

    /**
     * Determine whether the user can restore the order.
     *
     * @param \App\User $user
     * @param Order $order
     * @return mixed
     */
    public function restore(User $user, Order $order)
    {
        if($user->hasAnyRole('pedidos')){
            return true;
        }
        return $user->id == $order->client_id;
    }

    /**
     * Determine whether the user can permanently delete the order.
     *
     * @param \App\Models\User $user
     * @param Order $order
     * @return mixed
     */
    public function forceDelete(User $user, Order $order)
    {
        if($user->hasAnyRole('pedidos')){
            return true;
        }
        return $user->id == $order->client_id;
    }
}
