<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Job;
use App\RoleUser;
use App\User;
class Task extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
    * get TaskTypes
    * @return array
    **/
    static public function getTaskTypes() {
    	return [
    		''	=> 'Select Task Type',
    		'1' => 'Critical Bugs',
    		'2' => 'System Related',
    		'3' => 'Style / UX Related',
    		'4' => 'Improvement',
    		'5' => 'Other'
    	];
    }
    /**
    * prepareTaskTypesForView
    * @param $status - status id
    * @return array
    **/
    static private function prepareStatusForView($status) {

    	switch($status) {
    		case '1': // New task
    			$view = '<span class="label label-danger">New Task</span>';
    		break;
    		case '2': // In Progress
    			$view = '<span class="label label-info">In Progress</span>';
    		break;
    		case '3':
    			$view = '<span class="label label-default">Completed</span>';
    		break;
    	}
    	return $view;
    }
    /**
    * get TaskByType
    * @param $assigned_id
    * @return array
    **/
    static public function getTasksByType($assigned_id) {
    	$tasks = [];

    	// My To DO Tasks

    	$tasks['todo'] = Task::where('assigned_id','=',$assigned_id)
    						->where('status','=',1)
    						->orderBy('id', 'desc')
    						->get();
    	$tasks['critical'] = Task::where('type','=',1)
    						->where('status','=',1)
    						->orderBy('id', 'desc')
    						->get();
    	$tasks['system'] = Task::where('type','=',2)
    						->where('status','=',1)
    						->orderBy('id', 'desc')
    						->get();
    	$tasks['style'] = Task::where('type','=',3)
    						->where('status','=',1)
    						->orderBy('id', 'desc')
    						->get();
    	$tasks['completed'] = Task::where('status','=',2)
    						->orderBy('id', 'desc')
    						->get();

    	// Update array with correct content

    	if(isset($tasks)) {
    		foreach($tasks as $key => $value) {
    			foreach($tasks[$key] as $tkey => $tvalue) {

	    			if(isset($tasks[$key][$tkey]['title'])) {
	    				$desired_string_count = 5;
	    				$tasks[$key][$tkey]['title'] = Job::replaceLongTextWithElipses($desired_string_count, $tvalue->title, '...');
	    			}    			
	    			if(isset($tasks[$key][$tkey]['description'])) {
	    				$desired_string_count = 7;
	    				$tasks[$key][$tkey]['description'] = Job::replaceLongTextWithElipses($desired_string_count, $tvalue->description, '...');
	    			}

	    			if(isset($tasks[$key][$tkey]['created_by'])) {
	    				$users = User::find($tvalue->created_by);
	    				$tasks[$key][$tkey]['created_username'] = $users->username;
	    			}
	    			if(isset($tasks[$key][$tkey]['assigned_id'])) {
	    				$users = User::find($tvalue->assigned_id);
	    				$tasks[$key][$tkey]['assigned_username'] = $users->username;
	    			}

	    			if(isset($tasks[$key][$tkey]['status'])) {
	    				$tasks[$key][$tkey]['status'] = Task::prepareStatusForView($tvalue->status);
	    			}
	    			if(isset($tasks[$key][$tkey]['created_at'])) {
	    				$tasks[$key][$tkey]['created_date'] = date('n/d/Y g:ia',strtotime($tvalue->created_at));
	    			}
    			}
    			
    		}
    	}


    	return $tasks;
    }
}