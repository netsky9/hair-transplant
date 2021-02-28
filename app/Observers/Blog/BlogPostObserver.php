<?php

namespace App\Observers\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogPostObserver
{

    /**
     * Логика полей при создании и изменении полей
     * @param BlogPost $blogPost
     */
    public function saving(BlogPost $blogPost){

        $blogPost->is_published = ($blogPost->is_published === "on") ? 1 : 0;

        if(empty($blogPost->published_at) && $blogPost->is_published)
            $blogPost->published_at = Carbon::now();

        /**
         * Добавляем слаг, если поле пустое
         */
        if(empty($blogPost->slug))
            $blogPost->slug = Str::slug($blogPost->title);
    }

    /**
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost)
    {
        /**
         * Публикуем по умолчанию
         */
        $blogPost->is_published = 1;
        $blogPost->published_at = Carbon::now();

        /**
         * Пользователь по умолчанию
         */
        if(empty($blogPost->user_id))
            $blogPost->user_id = 1;

        /**
         * Пока дублируем контент
         */
        if(empty($blogPost->content_html))
            $blogPost->content_html = $blogPost->content_raw;
    }


    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
