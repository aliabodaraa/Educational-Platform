<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'email' => 'required|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username,'.$user->id,
            'department_id' => 'required',//without  it i cant make any change on it
            'studing_year' => 'required',//without  it i cant make any change on it
        ];
    }
}
