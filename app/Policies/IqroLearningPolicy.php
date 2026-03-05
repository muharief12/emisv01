<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\IqroLearning;
use Illuminate\Auth\Access\HandlesAuthorization;

class IqroLearningPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:IqroLearning');
    }

    public function view(AuthUser $authUser, IqroLearning $iqroLearning): bool
    {
        return $authUser->can('View:IqroLearning');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:IqroLearning');
    }

    public function update(AuthUser $authUser, IqroLearning $iqroLearning): bool
    {
        return $authUser->can('Update:IqroLearning');
    }

    public function delete(AuthUser $authUser, IqroLearning $iqroLearning): bool
    {
        return $authUser->can('Delete:IqroLearning');
    }

    public function restore(AuthUser $authUser, IqroLearning $iqroLearning): bool
    {
        return $authUser->can('Restore:IqroLearning');
    }

    public function forceDelete(AuthUser $authUser, IqroLearning $iqroLearning): bool
    {
        return $authUser->can('ForceDelete:IqroLearning');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:IqroLearning');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:IqroLearning');
    }

    public function replicate(AuthUser $authUser, IqroLearning $iqroLearning): bool
    {
        return $authUser->can('Replicate:IqroLearning');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:IqroLearning');
    }

}