<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Events\SomeEvent;
class CreateUserRequest extends FormRequest
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
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required|email',
            'image'  => 'image',
            'password' => 'required|confirmed'
        ];
    }
    
    public function persist()
    {
        // $user = User::create([
        //     'first_name'  => request('first_name'),
        //     'last_name'   => request('last_name'),
        //     'email'       => request('email'),
        //     'password'    => bcrypt(request('password'))
        // ]);
        // return $user;
        $fileName = null;
        if (request()->hasFile('image'))
        {
          $file = request()->file('image');
          $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
          $file->move(public_path('image/upload/users/'), $fileName);
        }
        $user = new User();
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->image = $fileName;
        $user->save();

        // event(new SomeEvent($user));
        $user->attachRole('admin');
        $user->syncPermissions(request('permissions'));
        

    }
}
