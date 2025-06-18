<?php

namespace App\Policies;

use App\Models\Api\Category\MainCategory;
use App\Models\Api\User\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('show_all_category');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MainCategory $category): bool
    {
        return $user->can('show_category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MainCategory $category): bool
    {
        return $user->can('update_category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MainCategory $category): bool
    {
        return $user->can('delete_category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MainCategory $category): bool
    {
        return $user->can('restore_category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MainCategory $category): bool
    {
        return $user->can('force_delete_category');
    }
}
