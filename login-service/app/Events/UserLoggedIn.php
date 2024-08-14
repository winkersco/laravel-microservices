<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UserLoggedIn
{
    use SerializesModels;

    public $user;
    public $loginAt;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param string $loginAt
     * @return void
     */
    public function __construct(User $user, string $loginAt)
    {
        $this->user = $user;
        $this->loginAt = $loginAt;
    }
}
