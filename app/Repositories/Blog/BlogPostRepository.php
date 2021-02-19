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
     * Получение категорий для select
     * @return mixed
     */
    public function GetForSelect(){
//        $columns = ['id', 'title'];
//
//        $result = $this
//            ->instanceModel()
//            ->select($columns)
//            ->toBase()
//            ->get();
//
//        return $result;
    }

    public function GetAllWithPagination($count = 20){
        $columns = [
            'id',
            'category_id',
            'user_id',
            'title',
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
}