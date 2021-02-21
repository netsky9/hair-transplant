<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'description'
    ];

    public function parentCategory(){
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Аксессор для определения родительской категории
     * @return string
     */
    public function getParentTitleAttribute(){
        return empty($this->parentCategory->title) ? ' - ' : $this->parentCategory->title;
    }
}
