<?php

namespace App\Policies;

use App\RentalOrder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RentalOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any rental orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the rental order.
     *
     * @param  \App\User  $user
     * @param  \App\RentalOrder  $rentalOrder
     * @return mixed
     */
    public function view(User $user, RentalOrder $rentalOrder)
    {
        $customer = Customer::where('id',$rentalOrder->customer_id)-first();
        return  $user->roles === "admin" || User::where('email',$customer->email)->first()->is($user);
    }

    /**
     * Determine whether the user can create rental orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->roles === 'customer';
    }

    /**
     * Determine whether the user can update the rental order.
     *
     * @param  \App\User  $user
     * @param  \App\RentalOrder  $rentalOrder
     * @return mixed
     */
    public function update(User $user, RentalOrder $rentalOrder)
    {
        return $user->roles === 'admin';
    }

    /**
     * Determine whether the user can delete the rental order.
     *
     * @param  \App\User  $user
     * @param  \App\RentalOrder  $rentalOrder
     * @return mixed
     */
    public function delete(User $user, RentalOrder $rentalOrder)
    {
        //
    }

    /**
     * Determine whether the user can restore the rental order.
     *
     * @param  \App\User  $user
     * @param  \App\RentalOrder  $rentalOrder
     * @return mixed
     */
    public function restore(User $user, RentalOrder $rentalOrder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the rental order.
     *
     * @param  \App\User  $user
     * @param  \App\RentalOrder  $rentalOrder
     * @return mixed
     */
    public function forceDelete(User $user, RentalOrder $rentalOrder)
    {
        //
    }
}
