<?php

namespace App\Policies\Store;

use App\OrderMaster;
use App\Staff;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param OrderMaster $orderMaster
     * @return mixed
     */
    public function view(User $user, OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if (auth()->user()->role == 'storeadmin') {
            return true;
        }

        if (auth()->user()->role == 'staff') {
            $staff = Staff::where('user_id', Auth::id())->first();

            foreach (explode(',', $staff->permissions) as $permissionExp) {
                if (strpos($permissionExp, '2') !== false && strpos($permissionExp, 'CREATE') !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param OrderMaster $orderMaster
     * @return mixed
     */
    public function update(User $user, OrderMaster $orderMaster)
    {
        //
        if (auth()->user()->role == 'storeadmin') {
            return true;
        }

        if (auth()->user()->role == 'staff') {
            $staff = Staff::where('user_id', Auth::id())->first();

            foreach (explode(',', $staff->permissions) as $permissionExp) {
                if (strpos($permissionExp, '2') !== false && strpos($permissionExp, 'UPDATE') !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param OrderMaster $orderMaster
     * @return mixed
     */
    public function delete(User $user, OrderMaster $orderMaster)
    {
        //
        if (auth()->user()->role == 'storeadmin') {
            return true;
        }

        if (auth()->user()->role == 'staff') {
            $staff = Staff::where('user_id', Auth::id())->first();

            foreach (explode(',', $staff->permissions) as $permissionExp) {
                if (strpos($permissionExp, '2') !== false && strpos($permissionExp, 'DELETE') !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param OrderMaster $orderMaster
     * @return mixed
     */
    public function restore(User $user, OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param OrderMaster $orderMaster
     * @return mixed
     */
    public function forceDelete(User $user, OrderMaster $orderMaster)
    {
        //
    }

    public function order(User $user)
    {
        //
        if(auth()->user()->role == 'storeadmin') {
            return true;
        }

        if(auth()->user()->role == 'staff') {
            $staff = Staff::where('user_id', Auth::id())->first();

            foreach (explode(',', $staff->permissions) as $permissionExp) {
                if (strpos($permissionExp, '2') !== false ) {
                    return true;
                }
            }
        }

        return false;
    }
}
