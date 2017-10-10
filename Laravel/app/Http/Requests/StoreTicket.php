<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicket extends FormRequest
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
        $this->sanitize();

        return [
            'street_address' => 'required|string|max:512',
            'postal_code' => 'required|alpha_num|max:10',
            'city' => 'required|string|max:256',
            'country' => 'required|string|max:256',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'amount' => 'required|numeric',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['comment'] = filter_var($input['comment'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}
