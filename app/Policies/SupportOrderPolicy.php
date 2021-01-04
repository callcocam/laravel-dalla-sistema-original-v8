<?php

namespace App\Policies;

use App\Models\Admin\SupportOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupportOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  SupportOrder  $supportOrder
     * @return mixed
     */
    public function view(User $user, SupportOrder $supportOrder)
    {
        return $user->id == $supportOrder->client_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  SupportOrder  $supportOrder
     * @return mixed
     */
    public function update(User $user, SupportOrder $supportOrder)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  SupportOrder  $supportOrder
     * @return mixed
     */
    public function delete(User $user, SupportOrder $supportOrder)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  SupportOrder  $supportOrder
     * @return mixed
     */
    public function restore(User $user, SupportOrder $supportOrder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  SupportOrder  $supportOrder
     * @return mixed
     */
    public function forceDelete(User $user, SupportOrder $supportOrder)
    {
        //
    }


    /**
     * Determine whether the user can view the order.
     *
     * @param \App\User $user
     * @param SupportOrder $order
     * @return mixed
     */
    public function status(User $user,SupportOrder $order)
    {
        return !in_array($order->status, ['completed']);
    }
}
