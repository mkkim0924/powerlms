<?php

namespace App\Policies;

use TeamTeaTime\Forum\Models\Thread;
use TeamTeaTime\Forum\Policies\ThreadPolicy as Base;

class ThreadPolicy extends Base
{
    public function view($user, Thread $thread): bool
    {
        return true;
    }

    public function deletePosts($user, Thread $thread): bool
    {
        return true;
    }

    public function restorePosts($user, Thread $thread): bool
    {
        return true;
    }

    public function rename($user, Thread $thread): bool
    {
        return $user->id === $thread->author_id || (($user->type == 1) && ($thread->category->author_id == auth()->user()->id));
    }

    public function reply($user, Thread $thread): bool
    {
        return ! $thread->locked;
    }

    public function delete($user, Thread $thread): bool
    {
        return $user->id === $thread->author_id || (($user->type == 1) && ($thread->category->author_id == auth()->user()->id));
    }

    public function restore($user, Thread $thread): bool
    {
        return $user->id === $thread->author_id || (($user->type == 1) && ($thread->category->author_id == auth()->user()->id));
    }
}
