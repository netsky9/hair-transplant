<?php

namespace App\Repositories\Clinics;

use App\Models\Clinic as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\DB;

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

        $miniatures = $this->GetAllMiniatures();

        $resultMerge = $this->MergeItemWithMiniature($result, $miniatures);

        return $resultMerge;
    }

    /**
     * Получаем все миниатюры одним запросом
     * @return \Illuminate\Support\Collection
     */
    public function GetAllMiniatures(){
        $result = DB::table('media')->where('collection_name', 'miniature')->get();

        return $result;
    }

    /**
     * Объединение миниатюр и постов
     * @param $items
     * @param $miniatures
     * @return mixed
     */
    public function MergeItemWithMiniature($items, $miniatures){
        foreach ($miniatures as $miniature){
            foreach ($items as $key => $item){
                if($item->id == $miniature->model_id){
                    $miniature->path = "/storage/media/{$miniature->id}/conversions/{$miniature->name}-thumb.jpg";
                    $items[$key]->miniature = $miniature;
                }
            }
        }
        return $items;
    }
}