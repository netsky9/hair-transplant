<?php

namespace App\Repositories\Blog;

use App\Models\BlogCategory as Model;
use App\Repositories\CoreRepository;

class BlogCategoryRepository extends CoreRepository {

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
        $columns = ['id', 'title'];

        $result = $this
            ->instanceModel()
            ->select($columns)
            ->toBase()
            ->get();

        return $result;
    }

    public function GetAllWithPagination($count = 10){
        $columns = ['id', 'parent_id', 'title'];

        $result = $this
            ->instanceModel()
            ->paginate($count, $columns);

        return $result;
    }
}