<?php

namespace App\Observers;

use TeamTeaTime\Forum\Models\Category;

class ForumCategoryObserver
{
    public function created(Category $category)
    {
        $category->author_id = auth()->user()->id ?? 1;
        $category->save();
    }
}
