<?php

namespace App\Repositories;

abstract class CoreRepository{

    /**
     * Класс абстрактной модели
     * Используем для создание объекта
     * @var mixed
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    function __construct(){
        $this->model = $this->getModel();
    }

    /**
     * @return mixed
     */
    protected abstract function getModel();

    /**
     * Создаем объект модели, которую сюда передали через getModel()
     * @return mixed
     */
    function instanceModel(){
        return new $this->model;
    }
}