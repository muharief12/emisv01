<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FinanceType;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinanceTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FinanceType');
    }

    public function view(AuthUser $authUser, FinanceType $financeType): bool
    {
        return $authUser->can('View:FinanceType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FinanceType');
    }

    public function update(AuthUser $authUser, FinanceType $financeType): bool
    {
        return $authUser->can('Update:FinanceType');
    }

    public function delete(AuthUser $authUser, FinanceType $financeType): bool
    {
        return $authUser->can('Delete:FinanceType');
    }

    public function restore(AuthUser $authUser, FinanceType $financeType): bool
    {
        return $authUser->can('Restore:FinanceType');
    }

    public function forceDelete(AuthUser $authUser, FinanceType $financeType): bool
    {
        return $authUser->can('ForceDelete:FinanceType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FinanceType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FinanceType');
    }

    public function replicate(AuthUser $authUser, FinanceType $financeType): bool
    {
        return $authUser->can('Replicate:FinanceType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FinanceType');
    }

}