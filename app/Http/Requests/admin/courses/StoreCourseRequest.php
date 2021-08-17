<?php

namespace App\Http\Requests\admin\courses;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name'=> 'required|string|max:225|unique:courses,name',
            'detail'=> 'required|string|max:225',
            'classroom_id'=> 'required',
        ];
    }
}
