<?php

namespace App\Repositories\Blog;

use App\Models\BlogPost as Model;
use App\Repositories\CoreRepository;


class BlogPostRepository extends CoreRepository {

    /**
     * Отправляем модель, для создания объекта
     * @return mixed|string
     */
    protected function getModel()
    {
        return Model::class;
    }

    /**
     * Получение модели для редактирования
     * @param $id
     * @return mixed
     */
    public function GetEdit($id){
        return $this->instanceModel()->find($id);
    }

    /**
     * Получение модели для просмотра
     * @param $slug
     * @return mixed
     */
    public function GetShow($slug){
        return $this->instanceModel()->where('slug', $slug)->first();
    }

    public function GetAllWithPagination($count = 20){
        $columns = [
            'id',
            'category_id',
            'user_id',
            'title',
            'slug',
            'is_published',
            'published_at',
        ];

        $result = $this
            ->instanceModel()
            ->with('category:id,title')
            ->with('user:id,name')
            ->orderBy('id', 'desc')
            ->paginate($count, $columns);

        return $result;
    }
    public function GetNextPost($currentPost){
        $result = $this
            ->instanceModel()
            ->where('id', '>', $currentPost->id)
            ->first();
        return $result;
    }
}