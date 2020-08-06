<?php

namespace App\Policies;

use App\SuiveTe;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class SuiveTePolicy
{
    use HandlesAuthorization;


    public function before($user ,$ability)
    {
        if($user->is_admin)
        {
            return true;
        }
    }


    /**
     * Determine whether the user can view any suive tes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }


    /**
     * Determine whether the user can view the suive te.
     *
     * @param  \App\User  $user
     * @param  \App\SuiveTe  $suiveTe
     * @return mixed
     */
    public function view(User $user, SuiveTe $suiveTe)
    {
        //
    }


    /**
     * Determine whether the user can create suive tes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
       
    }

    /**
     * Determine whether the user can update the suive te.
     *
     * @param  \App\User  $user
     * @param  \App\SuiveTe  $suiveTe
     * @return mixed
     */
    public function update(User $user, SuiveTe $suiveTe)
    {
        if($user->TE_chipment)
            return true;
        else
            return $suiveTe->Tractionnaire == $user->id;
    }


    /**
     * Determine whether the user can delete the suive te.
     *
     * @param  \App\User  $user
     * @param  \App\SuiveTe  $suiveTe
     * @return mixed
     */
    public function delete(User $user, SuiveTe $suiveTe)
    {
        return false;
    }


    /**
     * Determine whether the user can restore the suive te.
     *
     * @param  \App\User  $user
     * @param  \App\SuiveTe  $suiveTe
     * @return mixed
     */
    public function restore(User $user, SuiveTe $suiveTe)
    {
        //
    }



    /**
     * Determine whether the user can permanently delete the suive te.
     *
     * @param  \App\User  $user
     * @param  \App\SuiveTe  $suiveTe
     * @return mixed
     */
    public function forceDelete(User $user, SuiveTe $suiveTe)
    {
        //
    }
}
