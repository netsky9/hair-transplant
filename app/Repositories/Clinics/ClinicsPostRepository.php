<?php

namespace App\Repositories\Clinics;

use App\Models\Clinic as Model;
use App\Repositories\CoreRepository;

class ClinicsPostRepository extends CoreRepository {

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
     * Получение записей с постраничной навигацией
     * @param int $count
     * @return mixed
     */
    public function GetAllWithPagination($count = 20){
        $columns = [
            'id',
            'user_id',
            'title',
            'updated_at',
        ];

        $result = $this
            ->instanceModel()
            ->with('user:id,name')
            ->paginate($count, $columns);

        return $result;
    }
}