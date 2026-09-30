<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */


    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^(03|05|07|08|09)[0-9]{8}$/'],
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Tên khách hàng không được để trống.',
            'customer_name.string' => 'Tên khách hàng phải là chuỗi.',
            'customer_name.max' => 'Tên khách hàng không được quá 255 ký tự.',

            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại k hợp lệ.',

            'total.required' => 'Tổng tiền không được để trống.',
            'total.numeric' => 'Tổng tiền phải là số.',
            'total.min' => 'Tổng tiền không được nhỏ hơn 0.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
