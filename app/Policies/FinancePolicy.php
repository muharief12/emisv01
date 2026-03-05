<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Finance;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Finance');
    }

    public function view(AuthUser $authUser, Finance $finance): bool
    {
        return $authUser->can('View:Finance');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Finance');
    }

    public function update(AuthUser $authUser, Finance $finance): bool
    {
        return $authUser->can('Update:Finance');
    }

    public function delete(AuthUser $authUser, Finance $finance): bool
    {
        return $authUser->can('Delete:Finance');
    }

    public function restore(AuthUser $authUser, Finance $finance): bool
    {
        return $authUser->can('Restore:Finance');
    }

    public function forceDelete(AuthUser $authUser, Finance $finance): bool
    {
        return $authUser->can('ForceDelete:Finance');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Finance');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Finance');
    }

    public function replicate(AuthUser $authUser, Finance $finance): bool
    {
        return $authUser->can('Replicate:Finance');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Finance');
    }

}