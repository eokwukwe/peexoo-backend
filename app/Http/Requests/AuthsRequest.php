<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthsRequest extends FormRequest
{
    private const LOGIN_PATH = 'login';
    private const REGISTER_PATH = 'register';

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
        $path = preg_replace('/api\//', '', $this->path());

        $rules = [];

        switch ($path) {
            case self::LOGIN_PATH:
                $rules = [
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ];
                break;
            
            case self::REGISTER_PATH:
                $rules = [
                    'name' => ['required'],
                    'email' => ['required', 'email', 'unique:App\Models\User'],
                    'password' => ['required', 'min:8', 'confirmed'],
                ];
                break;

            default:
                break;
        }

        return $rules;
    }
}
