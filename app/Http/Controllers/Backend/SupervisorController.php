<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SupervisorController extends Controller
{
    public function index()
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['manage_supervisors','show_supervisors'])){
            return redirect('admin/index');
        }

        // search by this query
        //1-keyword
        //2-status
        //3-sort_by
        //4-order_by
        //5-limit_by

        $supervisors = User::whereHas('roles',function ($q){
            $q->where('name','supervisor');
        })->when(\request()->keyword !=null, function ($q){
            $q->search(\request()->keyword);
        })
            ->when(\request()->status !=null, function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10 );

        return view('backend.supervisors.index', compact('supervisors'));
    }

    public function create()
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_supervisors'])){
            return redirect('admin/index');
        }

        $permissions = Permission::get(['id','display_name']);

        return view('backend.supervisors.create',compact('permissions'));
    }

    public function store(SupervisorRequest  $request)
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_supervisors'])){
            return redirect('admin/index');
        }

        $input['first_name']    = $request->first_name;
        $input['last_name']     = $request->last_name;
        $input['username']      = $request->username;
        $input['email']         = $request->email;
        $input['mobile']        = $request->mobile;
        $input['status']        = $request->status;
        $input['password']      = bcrypt($request->password);

        //Upload image
        if ($image = $request->file('user_image')){
            $file_name  = Str::slug($request->username).'.'.$image->getClientOriginalExtension();
            $path       = public_path('assets/users/'.$file_name);
            Image::make($image->getRealPath())->resize(500,null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);
            $input['user_image'] = $file_name;
        }
        $supervisor = User::create($input);
        $supervisor->markEmailAsVerified();
        //add role
        $supervisor->attachRole(Role::whereName('supervisor')->first()->id);
        //add permission
        if(isset($request->permissions) && $request->permissions > 0 ){
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message'   =>'Created Successfully',
            'alert-type'=>'success'
        ]);
    }

    public function show(User $supervisor)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['display_supervisors'])){
            return redirect('admin/index');
        }

        return view('backend.supervisors.show',compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_supervisors'])){
            return redirect('admin/index');
        }
        $permissions = Permission::get(['id','display_name']);
        $userPermission = UserPermissions::whereUserId($supervisor->id)->pluck('permission_id')->toArray();
        return view('backend.supervisors.edit' ,compact('supervisor','permissions','userPermission'));
    }

    public function update(SupervisorRequest $request, User $supervisor)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_supervisors'])){
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['status'] = $request->status;
        if(trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }

        //Upload image
        if ($image = $request->file('user_image')){
            if($supervisor->user_image  != null && File::exists('assets/users/'.$supervisor->user_image)){
                unlink('assets/users/'.$supervisor->user_image);
            }
            $file_name  = Str::slug($request->username).'.'.$image->getClientOriginalExtension();
            $path       = public_path('assets/users/'.$file_name);
            Image::make($image->getRealPath())->resize(500,null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);
            $input['user_image'] = $file_name;
        }

        $supervisor->update($input);

        //update permission
        if(isset($request->permissions) && $request->permissions > 0 ){
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message'   =>'Updated Successfully',
            'alert-type'=>'success'
        ]);
    }

    public function destroy(User $supervisor)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_supervisors'])){
            return redirect('admin/index');
        }

        if ($supervisor->user_image != null){
            if(File::exists('assets/users/'.$supervisor->user_image)){
                unlink('assets/users/'.$supervisor->user_image);
            }

        }
        $supervisor->delete();

        return redirect()->route('admin.supervisors.index')->with([
            'message'   =>'Deleted Successfully',
            'alert-type'=>'success'
        ]);
    }

    public function remove_image(Request $request)
    {
//        dd($request->all());
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_supervisors'])){
            return redirect('admin/index');
        }
        $supervisor = User::findOrFail($request->supervisor_id);

        if(File::exists('assets/users/'.$supervisor->user_image)){
            unlink('assets/users/'.$supervisor->user_image);
        }
        $supervisor->user_image = null;
        $supervisor->save();

        return true;
    }
}
