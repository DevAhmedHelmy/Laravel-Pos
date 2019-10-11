<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Storage;
class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->search)
        // {
        //   $users = User::where('first_name','like','%' . $request->search .'%')
        //                 ->orWhere('last_name','like','%' . $request->search .'%')
        //                 ->get();
        // }else {
        //   $users = $this->user->getAll();
        // }
        // 
        if($request->search)
        {
          $users = User::whereRoleIs('admin')->where(function($q) use ($request)
          {
            return $q->when($request->search , function($query) use ($request)
            {
              return $query->where('first_name','like','%' . $request->search .'%')
                       ->orWhere('last_name','like','%' . $request->search .'%');
            });
          })->latest()->paginate(2);
        }else{
          $users = $this->user->getAll();
        }
        
        
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $user)
    {
        $user->persist();
        session()->flash('message', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function show(User $user)
    {
      $user = $this->user->show($user);
      return view('admin.users.show',compact('user'));
    }

    public function edit($id)
    {
      $user = $this->user->edit($id);
      return view('admin.users.edit',compact('user'));
    }
    public function update(EditUserRequest $user,$id)
    {
        $user->persist($id);
        session()->flash('message', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    }
    public function destroy(User $user)
    {
      if ($user->image != 'default.png') {

        Storage::disk('public_upload')->delete('/users/' . $user->image);

    }//end of if
      // $this->user->destroy($id);
      $user->delete();
      session()->flash('message', __('site.deleted_successfully'));
      return redirect()->route('dashboard.users.index');
    }

    
}
