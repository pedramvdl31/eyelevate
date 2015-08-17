<?php
namespace App\Http\Controllers;

use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Admin;
use App\Role;
use App\Permission;
use App\PermissionRole;

class PermissionsController extends Controller
{
    public function __construct() {

        // // Define layout
        $this->layout = 'layouts.admins';
        $this_user = User::find(Auth::user()->id);
        $this_username = $this_user->username;

        //PROFILE IMAGE
        $this_user_profile_image = Job::imageValidator($this_user->profile_image);

        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);

    }
    public function getAdd()
    {               
    	$saved_permissions = Permission::all();
        $all_routes = Permission::PrepareAllRouteForSelect();
        return view('permissions.add')
	        ->with('layout',$this->layout)
	        ->with('all_routes',$all_routes)
            ->with('permissions',$saved_permissions);
    }
    
    public function postAdd()
    {   

	    $validator = Validator::make(Input::all(), Admin::$add_permission);
        if ($validator->passes()) {
        	$title = Input::get('permission-title');
        	$slug = Input::get('permission-slug');
        	$description = Input::get('permission-description');

        	$permissions = new Permission;
        	$permissions->permission_title = $title;
        	$permissions->permission_slug = $slug;
        	$permissions->permission_description = $description;

        	if ($permissions->save()) {
                $all_routes = Permission::PrepareAllRouteForSelect();
               	return view('permissions.add')
	                ->with('layout',$this->layout)
	                ->with('all_routes',$all_routes)
	                ->with('message_feedback','Successfully Added');
        	}
        }
        else {
            // validation has failed, display error messages    
            return Redirect::back()
                ->with('message', 'The following errors occurred')
                ->with('alert_type','alert-danger')
                ->withErrors($validator)
                ->withInput();  
        } 
    }
        public function getAutoUpdate()
    {   
        $saved_permissions = Permission::all();
        $all_routes = Permission::PrepareAllRouteForSelect();

        foreach ($all_routes as $key => $value) {
            if ($value != 'Select Permission') {
                $permissions = new Permission;
                $permissions->permission_title = $value;
                $permissions->permission_slug = $value;
                $permissions->permission_description = $value.' route';
                $permissions->save();
            }
        }
        Flash::success('Successfully Updated Permissions list');
        return Redirect::back();
    }


}
