<?php

namespace App\Http\Requests\Clinics\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClinicUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',
            'excerpt' => 'required|min:10|max:500',
            'text' => 'required|min:10|max:100000',
            'work_time' => 'max:40',
            'phone' => 'max:20',
            'email' => 'email:rfc,dns',
            'address' => 'max:200',
            'latitude' => 'max:15',
            'longitude' => 'max:15',
        ];
    }
}
