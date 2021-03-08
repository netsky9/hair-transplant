<?php

namespace App\Observers\Clinics;

use App\Models\Clinic;
use Illuminate\Support\Str;

class ClinicObserver
{
    /**
     * Логика полей при создании и изменении полей
     * @param \App\Models\Clinic $clinic
     */
    public function saving(Clinic $clinic){

        /**
         * Добавляем слаг, если поле пустое
         */
        if(empty($clinic->slug))
            $clinic->slug = Str::slug($clinic->title);

    }

    /**
     * Handle the BlogCategory "created" event.
     *
     * @param  \App\Models\Clinic $clinic
     * @return void
     */
    public function created(Clinic $clinic)
    {
        //
    }

    /**
     * Handle the BlogCategory "updated" event.
     *
     * @param  \App\Models\Clinic $clinic
     * @return void
     */
    public function updated(Clinic $clinic)
    {
        //
    }

    /**
     * Handle the BlogCategory "deleted" event.
     *
     * @param  \App\Models\Clinic $clinic
     * @return void
     */
    public function deleted(Clinic $clinic)
    {
        //
    }

    /**
     * Handle the BlogCategory "restored" event.
     *
     * @param  \App\Models\Clinic $clinic
     * @return void
     */
    public function restored(Clinic $clinic)
    {
        //
    }

    /**
     * Handle the BlogCategory "force deleted" event.
     *
     * @param  \App\Models\Clinic $clinic
     * @return void
     */
    public function forceDeleted(Clinic $clinic)
    {
        //
    }
}
