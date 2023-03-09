<?php

namespace App\Http\Requests;

use App\Models\Bed;
use Illuminate\Foundation\Http\FormRequest;

class CreateBedRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'bed_type' => 'required|integer|in:' . implode(',', array_keys(Bed::$bedTypes)),
            'notes' => 'nullable|string|max:255',
            'department_id' => 'required|integer|exists:doctor_departments,id,deleted_at,NULL',
            'charge' => 'nullable|integer',
        ];
    }

    /**
     * Change display default attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Tên giường bệnh',
            'bed_type' => 'Loại giường bệnh',
            'notes' => 'Lưu ý',
            'department_id' => 'Phòng ban',
            'charge' => 'Giá',
        ];
    }

    /**
     * change display default messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => sprintf(trans('messages.MsgErr001'), ':attribute'),
            'max' => sprintf(trans('messages.MsgErr004'), '255', ':attribute'),
            'in' => trans('messages.MsgErr013'),
            'exists' => trans('messages.MsgErr013'),
            'integer' => sprintf(trans('messages.MsgErr007'), ':attribute'),
        ];
    }
}
