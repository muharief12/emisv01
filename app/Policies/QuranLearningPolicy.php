<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\QuranLearning;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuranLearningPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:QuranLearning');
    }

    public function view(AuthUser $authUser, QuranLearning $quranLearning): bool
    {
        return $authUser->can('View:QuranLearning');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:QuranLearning');
    }

    public function update(AuthUser $authUser, QuranLearning $quranLearning): bool
    {
        return $authUser->can('Update:QuranLearning');
    }

    public function delete(AuthUser $authUser, QuranLearning $quranLearning): bool
    {
        return $authUser->can('Delete:QuranLearning');
    }

    public function restore(AuthUser $authUser, QuranLearning $quranLearning): bool
    {
        return $authUser->can('Restore:QuranLearning');
    }

    public function forceDelete(AuthUser $authUser, QuranLearning $quranLearning): bool
    {
        return $authUser->can('ForceDelete:QuranLearning');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:QuranLearning');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:QuranLearning');
    }

    public function replicate(AuthUser $authUser, QuranLearning $quranLearning): bool
    {
        return $authUser->can('Replicate:QuranLearning');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:QuranLearning');
    }

}