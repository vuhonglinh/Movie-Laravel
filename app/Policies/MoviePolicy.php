<?php

namespace App\Policies;


use Illuminate\Auth\Access\Response;
use Modules\Customers\src\Models\Customer;
use Modules\Movies\src\Models\Movie;
use Modules\Users\src\Models\User;

class MoviePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Customer $customer, Movie $movie): bool
    {
        $orders = $customer->orders->where('status', true);
        if ($orders) {
            $array = [];
            foreach ($orders as $order) {
                $data = json_decode($order->packages->powers);
                $array = array_merge($array, $data);
            }
            if (in_array($movie->quality, $array)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Customer $customer, Movie $movie): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Customer $customer, Movie $movie): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Movie $movie): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Movie $movie): bool
    {
        //
    }
}
