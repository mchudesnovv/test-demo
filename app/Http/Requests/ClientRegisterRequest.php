<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'address1' => ['required', 'string'],
            'address2' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'zipCode' => ['required', 'regex:/\b\d{5}\b/'],
            'phoneNo1' => ['required', 'string', 'max:20'],
            'phoneNo2' => ['present', 'string', 'max:20'],
            'user' => ['sometimes'],
            'user.firstName' => ['required', 'string', 'max:50'],
            'user.lastName' => ['required', 'string', 'max:50'],
            'user.email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'user.password' => ['required', 'string', 'max:256'],
            'user.passwordConfirmation' => ['required', 'string', 'max:256'],
            'user.phone' => ['required', 'string', 'max:20'],
            'user.profile_uri' => ['sometimes', 'string', 'max:255'],
        ];
    }

    public function validationData(): array
    {
        return $this->all();
    }
}
