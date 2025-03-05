<?php

namespace App\Policies;

use App\Models\RequestService;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RequestServicePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }
    public function create(User $user)
    {
        return !$user->isAdmin();
    }
    public function view(User $user, RequestService $requestService)
    {
        return $user->id === $requestService->user_id || $user->isAdmin();
    }
    public function update(User $user, RequestService $requestService)
    {
        return $user->id === $requestService->user_id || $user->isAdmin();
    }

    public function delete(User $user, RequestService $requestService)
    {
        return $user->id === $requestService->user_id || $user->isAdmin();
    }
}
