<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the blog post before "creating" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        //
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }


    /**
     * @param \App\Models\BlogPost $blogPost
     * handle the blog post before 'updating' event.
     */
    public function updating(BlogPost $blogPost)
    {
//        $test[] =$blogPost->isDirty();
//        $test[] =$blogPost->isDirty('is_published');
//        $test[] =$blogPost->isDirty('user_id');
//        $test[] =$blogPost->getAttribute('is_published');
//        $test[] =$blogPost->is_published;
//        $test[] =$blogPost->getOriginal('is_published');
//
//        dd ($test);

        $this->setPublishedAt ($blogPost);
        $this->setSlug($blogPost);
    }

    protected function setPublishedAt(BlogPost $blogPost)
    {
        if(empty($blogPost->published_at) && $blogPost->is_published){
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * @param BlogPost $blogPost
     *
     * If field 'slug' empty, insert them converted title
     */

    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Install value for field Content-Html absolute with field content_raw
     * @param BlogPost $blogPost
     *
     */
    protected  function setHtml(BlogPost $blogPost)
     {
        if($blogPost->isDirty('content_raw')){
            //burda markdown generaciya olmalidir ->html
            $blogPost->content_html = $blogPost->content_raw;
        }
     }

    /**
     * @param BlogPost $blogPost
     * If is not insert user_id, isert default value
     */
     protected function setUser(BlogPost $blogPost)
     {
         $blogPost->user_id = auth()->id ?? BlogPost::UNKNOWN_USER;
     }

    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleting" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleting(BlogPost $blogPost)
    {
        //

    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //

    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * checking the post published
     *
     * @param BlogPost $blogPost
     */


}
