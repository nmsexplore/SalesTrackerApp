<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $user = User::find($this->user);

        switch ($this->method()){
            case 'POST':{
                $data = $this->all();

                $rulesData= [
                    'fullname' => 'required|max:255',
                    'username' => 'required|max:255|unique:users',
                    'department' => 'required',
                    'role' => 'required',
                    'reportsto' => 'required',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'contact' => 'required|min:10|unique:users',
                ];

                if (isset($data['role']) && $data['role']==4)
                {
                    $rulesData['warehouse_id']='required';
                }

                return $rulesData;
            }

            case 'PATCH': {
               $rulesData=[
                   'password' => 'required|min:6|confirmed',
                   ];
                return $rulesData;
            }
            case 'PUT':
                {

                    $data = $this->all();
                    $rulesData= [
                        'fullname' => 'required|max:255',
                        'username' => 'required|max:255',
                        'department' => 'required',
                        'role' => 'required',
                        'reportsto' => 'required',
                        'email' => 'required|email|unique:users,email,'.$user->id,
                        'contact' => 'required|min:10',
                    ];
                    if (isset($data['role']) && $data['role']==4)
                    {
                        $rulesData['warehouse_id']='required';
                    }
                    return $rulesData;
                }

            default:break;
        }
    }
}
