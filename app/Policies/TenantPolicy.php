<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(admin $admin, Tenant $tenant)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admin $admin, Tenant $tenant)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admin $admin, Tenant $tenant)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admin $admin, Tenant $tenant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admin $admin, Tenant $tenant)
    {
        //
    }
}
