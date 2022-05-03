<?php

namespace App\Http\Requests\Admin\ServiceTicket;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceTicketRequest extends FormRequest
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
            'email'=>'required|email',
            'ticket_number'=>'required',
            'status'=>'required',

        ];
    }
}
