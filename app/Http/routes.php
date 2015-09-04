<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'beforeFilter'], function () {
	//HOME ROUTE
	Route::get('/', 'HomeController@getIndex');
	/**
	 * ADMIN SECTION
	 */
	/** PUBLIC SECTION **/

	//NO ACL
	// Route::get('/admins',  ['as'=>'admins_index', 'uses' => 'AdminsController@getIndex']);
	Route::group(['prefix' => 'admins'], function () {
		Route::get('login', 'AdminsController@getLogin');
		Route::post('login', 'AdminsController@postLogin');
		Route::get('logout', 'AdminsController@getLogout');			
		// Route::get('roles',  ['as'=>'roles_index', 'uses' => 'RolesController@getIndex']);
		// Route::get('roles/add',  ['as'=>'roles_add', 'uses' => 'RolesController@getAdd']);
		// Route::post('roles/add',  ['uses' => 'RolesController@postAdd']);
		// Route::get('roles/edit/{id}',  ['as'=>'roles_edit', 'uses' => 'RolesController@getEdit']);
		// Route::post('roles/edit',  ['as'=>'roles_update','uses' => 'RolesController@postEdit']);
		// Route::get('roles/delete-data/{id}',  ['as'=>'roles_delete', 'uses' => 'RolesController@getDelete']);

		// Route::get('permissions',  ['as'=>'permissions_index', 'uses' => 'PermissionsController@getIndex']);
		// Route::get('permissions/add',  ['as'=>'permissions_add','uses' => 'PermissionsController@getAdd']);
		// Route::post('permissions/add',  ['uses' => 'PermissionsController@postAdd']);
		// Route::get('permissions/edit/{id}',  ['as'=>'permissions_edit','uses' => 'PermissionsController@getEdit']);
		// Route::post('permissions/edit',  ['uses' => 'PermissionsController@postEdit']);
		// Route::get('permissions/delete-data/{id}',  ['as'=>'permissions_delete','uses' => 'PermissionsController@getDelete']);

		// Route::get('permission-roles',  ['as'=>'permission_roles_index', 'uses' => 'PermissionRolesController@getIndex']);
		// Route::get('permission-roles/add',  ['as'=>'permission_roles_add', 'uses' => 'PermissionRolesController@getAdd']);
		// Route::post('permission-roles/add',  ['uses' => 'PermissionRolesController@postAdd']);
		// Route::get('permission-roles/edit/{id}',  ['as'=>'permission_roles_edit', 'uses' => 'PermissionRolesController@getEdit']);
		// Route::post('permission-roles/edit',  ['uses' => 'PermissionRolesController@postEdit']);
		// Route::get('permission-roles/delete-data/{id}',  ['as'=>'permission_roles_delete', 'uses' => 'PermissionRolesController@getDelete']);

		// Route::get('flags',  ['as'=>'flags_index', 'uses' => 'FlagsController@getIndex']);
		// Route::get('flags/view/{id}',  ['as'=>'flag_view', 'uses' => 'FlagsController@getView']);
		// Route::post('flags/view',  ['uses' => 'FlagsController@postView']);
		// Route::get('flags/approved',  ['as'=>'flags_app', 'uses' => 'FlagsController@getApproved']);
		// Route::get('flags/rejected',  ['as'=>'flags_rej', 'uses' => 'FlagsController@getRejected']);
		// Route::get('flags/re-flagged',  ['as'=>'flags_re', 'uses' => 'FlagsController@getReflagged']);
		// Route::get('flags/final-approved',  ['as'=>'flags_f_app', 'uses' => 'FlagsController@getFinalApproved']);
		// Route::get('flags/final-reject',  ['as'=>'flags_f_rej', 'uses' => 'FlagsController@getFinalRejected']);
		// Route::get('flags/banned',  ['as'=>'flags_banned', 'uses' => 'FlagsController@getBanned']);

		// Route::get('acl/view',  ['as' => 'acl_view','uses' => 'AdminsController@getViewAcl']);
		// Route::get('categories/view',  ['as'=>'category_view', 'uses' => 'AdminsController@getViewCategory']);
		// Route::get('categories/add',  ['as'=>'category_add', 'uses' => 'CategoriesController@getAdd']);
		// Route::post('categories/add',  ['uses' => 'CategoriesController@postAdd']);
		// Route::get('categories/edit',  ['as'=>'category_edit','uses' => 'CategoriesController@getEdit']);
		// Route::post('categories/edit',  ['uses' => 'CategoriesController@postEdit']);
		// Route::get('users/index',  ['as' => 'users_index','uses' => 'AdminsController@getUsersIndex']);
		// Route::get('users/add',  ['as' => 'users_add','uses' => 'AdminsController@getUsersAdd']);
		// Route::post('users/add',  ['uses' => 'AdminsController@postUsersAdd']);
		// Route::get('users/edit/{id}',  ['as' => 'users_edit','uses' => 'AdminsController@getUsersEdit']);
		// Route::post('users/edit',  ['uses' => 'AdminsController@postUsersEdit']);
	});


	/** ADMINS ACL GROUP **/
	Route::group(['middleware' => ['auth']], function(){
		Route::get('admins',  ['as'=>'admins_index', 'uses' => 'AdminsController@getIndex', 'middleware' => ['acl:admins']]);
			
		Route::group(['prefix' => 'admins'], function () {
			$prefix = 'admins';	
			Route::get('roles',  ['as'=>'roles_index', 'uses' => 'RolesController@getIndex', 'middleware' => ['acl:'.$prefix.'/roles']]);
			Route::get('roles/add',  ['as'=>'roles_add', 'uses' => 'RolesController@getAdd','middleware' => ['acl:'.$prefix.'/roles/add']]);
			Route::post('roles/add',  ['uses' => 'RolesController@postAdd', 'middleware' => ['acl:'.$prefix.'/roles/add']]);
			Route::get('roles/edit/{id}',  ['as'=>'roles_edit', 'uses' => 'RolesController@getEdit', 'middleware' => ['acl:'.$prefix.'/roles/edit/{id}'], function ($id) {}]);
			Route::post('roles/edit',  ['as'=>'roles_update','uses' => 'RolesController@postEdit', 'middleware' => ['acl:'.$prefix.'/roles/edit']]);
			Route::get('roles/delete-data/{id}',  ['as'=>'roles_delete', 'uses' => 'RolesController@getDelete', 'middleware' => ['acl:'.$prefix.'/roles/delete-data{id}'], function ($id) {}]);

			Route::get('permissions',  ['as'=>'permissions_index', 'uses' => 'PermissionsController@getIndex', 'middleware' => ['acl:'.$prefix.'/permissions']]);
			Route::get('permissions/add',  ['as'=>'permissions_add','uses' => 'PermissionsController@getAdd', 'middleware' => ['acl:'.$prefix.'/permissions/add']]);
			Route::post('permissions/add',  ['uses' => 'PermissionsController@postAdd', 'middleware' => ['acl:'.$prefix.'/permissions/add']]);
			Route::get('permissions/edit/{id}', ['as' => 'permissions_edit', 'uses' => 'PermissionsController@getEdit','middleware' => ['acl:'.$prefix.'/permissions/edit/{id}'], function ($id) {}]);
			Route::post('permissions/edit',  ['uses' => 'PermissionsController@postEdit', 'middleware' => ['acl:'.$prefix.'/permissions/edit']]);
			Route::get('permissions/delete-data/{id}',  ['as'=>'permissions_delete','uses' => 'PermissionsController@getDelete', 'middleware' => ['acl:'.$prefix.'/permissions/delete-data{id}'], function ($id) {}]);

			Route::get('permission-roles',  ['as'=>'permission_roles_index', 'uses' => 'PermissionRolesController@getIndex', 'middleware' => ['acl:'.$prefix.'/permission-roles']]);
			Route::get('permission-roles/add',  ['as'=>'permission_roles_add', 'uses' => 'PermissionRolesController@getAdd', 'middleware' => ['acl:'.$prefix.'/permission-roles/add']]);
			Route::post('permission-roles/add',  ['uses' => 'PermissionRolesController@postAdd', 'middleware' => ['acl:'.$prefix.'/permission-roles/add']]);
			Route::get('permission-roles/edit/{id}',  ['as'=>'permission_roles_edit', 'uses' => 'PermissionRolesController@getEdit', 'middleware' => ['acl:'.$prefix.'/permission-roles/edit/{id}'], function ($id) {}]);
			Route::post('permission-roles/edit',  ['uses' => 'PermissionRolesController@postEdit', 'middleware' => ['acl:'.$prefix.'/permission-roles/edit']]);
			Route::get('permission-roles/delete-data/{id}',  ['as'=>'permission_roles_delete', 'uses' => 'PermissionRolesController@getDelete', 'middleware' => ['acl:'.$prefix.'/permission-roles/delete-data/{id}'], function ($id) {}]);

			Route::get('flags',  ['as'=>'flags_index', 'uses' => 'FlagsController@getIndex', 'middleware' => ['acl:'.$prefix.'/flags']]);
			Route::get('flags/view/{id}',  ['as'=>'flag_view', 'uses' => 'FlagsController@getView', 'middleware' => ['acl:'.$prefix.'/flags/view/{id}'], function ($id) {}]);
			Route::post('flags/view',  ['uses' => 'FlagsController@postView', 'middleware' => ['acl:'.$prefix.'/flags/view']]);
			Route::get('flags/approved',  ['as'=>'flags_app', 'uses' => 'FlagsController@getApproved', 'middleware' => ['acl:'.$prefix.'/flags/approved']]);
			Route::get('flags/rejected',  ['as'=>'flags_rej', 'uses' => 'FlagsController@getRejected', 'middleware' => ['acl:'.$prefix.'/flags/rejected']]);
			Route::get('flags/re-flagged',  ['as'=>'flags_re', 'uses' => 'FlagsController@getReflagged', 'middleware' => ['acl:'.$prefix.'/flags/re-flagged']]);
			Route::get('flags/final-approved',  ['as'=>'flags_f_app', 'uses' => 'FlagsController@getFinalApproved', 'middleware' => ['acl:'.$prefix.'/flags/final-approved']]);
			Route::get('flags/final-reject',  ['as'=>'flags_f_rej', 'uses' => 'FlagsController@getFinalRejected', 'middleware' => ['acl:'.$prefix.'/flags/final-reject']]);
			Route::get('flags/banned',  ['as'=>'flags_banned', 'uses' => 'FlagsController@getBanned', 'middleware' => ['acl:'.$prefix.'/flags/banned']]);

			Route::get('acl/view',  ['as' => 'acl_view','uses' => 'AdminsController@getViewAcl', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::get('categories/view',  ['as'=>'category_view', 'uses' => 'AdminsController@getViewCategory', 'middleware' => ['acl:'.$prefix.'/categories/view']]);
			Route::get('categories/add',  ['as'=>'category_add', 'uses' => 'CategoriesController@getAdd', 'middleware' => ['acl:'.$prefix.'/categories/add']]);
			Route::post('categories/add',  ['uses' => 'CategoriesController@postAdd', 'middleware' => ['acl:'.$prefix.'/categories/add']]);
			Route::get('categories/edit',  ['as'=>'category_edit','uses' => 'CategoriesController@getEdit', 'middleware' => ['acl:'.$prefix.'/categories/edit']]);
			Route::post('categories/edit',  ['uses' => 'CategoriesController@postEdit', 'middleware' => ['acl:'.$prefix.'/categories/edit']]);

			Route::get('tasks',  ['as' => 'tasks_index','uses' => 'TasksController@getIndex', 'middleware' => ['acl:'.$prefix.'/tasks']]);
			Route::get('tasks/add',  ['as' => 'tasks_add','uses' => 'TasksController@getAdd', 'middleware' => ['acl:'.$prefix.'/tasks/add']]);
			Route::post('tasks/add',  ['uses' => 'TasksController@postAdd', 'middleware' => ['acl:'.$prefix.'/tasks/add']]);
			Route::get('tasks/edit/{id}',  ['as' => 'tasks_edit','uses' => 'TasksController@getEdit', 'middleware' => ['acl:'.$prefix.'/tasks/edit'], function ($id) {}]);
			Route::post('tasks/edit',  ['uses' => 'TasksController@postEdit', 'middleware' => ['acl:'.$prefix.'/tasks/edit']]);
			Route::post('tasks/remove',  ['uses' => 'TasksController@postRemove', 'middleware' => ['acl:'.$prefix.'/tasks/remove']]);
			Route::post('tasks/upload',  ['uses' => 'TasksController@postUpload', 'middleware' => ['acl:'.$prefix.'/tasks/upload']]);
			Route::get('tasks/view/{id}',  ['as' => 'tasks_view','uses' => 'TasksController@getView', 'middleware' => ['acl:'.$prefix.'/tasks/view'], function ($id) {}]);
			Route::post('tasks/view',  ['uses' => 'TasksController@postView', 'middleware' => ['acl:'.$prefix.'/tasks/view']]);
			Route::post('tasks/completed',  ['uses' => 'TasksController@postTaskCompleted', 'middleware' => ['acl:'.$prefix.'/tasks/completed']]);

			Route::get('users/index',  ['as' => 'users_index','uses' => 'AdminsController@getUsersIndex', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::get('users/add',  ['as' => 'users_add','uses' => 'AdminsController@getUsersAdd', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::post('users/add',  ['uses' => 'AdminsController@postUsersAdd', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::get('users/edit/{id}',  ['as' => 'users_edit','uses' => 'AdminsController@getUsersEdit', 'middleware' => ['acl:'.$prefix.'/acl/view'], function ($id) {}]);
			Route::post('users/edit',  ['uses' => 'AdminsController@postUsersEdit', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
		});
	});
	Route::post('users/return-users',  ['uses' => 'UsersController@postReturnUsers', 'middleware' => ['acl:admins/acl/view']]);

	//CATEGORY ROUTE
	Route::group(['prefix' => 'categories'], function () {
		Route::post('search-cat', ['uses'=>'CategoriesController@postCatSearch']);
	});

	// Route::post('/search','HomeController@postIndex');
	Route::get('search', ['as'=>'home_index','uses'=>'HomeController@postIndex']);
	Route::post('search', ['uses'=>'HomeController@postIndex']);

	//USER ROUTE
	Route::get('registration', ['as'=>'registration_view','uses'=>'UsersController@getRegistration']);
	Route::post('registration', ['uses'=>'UsersController@postRegistration']);
	
	Route::get('logout', ['uses'=>'UsersController@getLogout']);
	Route::group(['prefix' => 'users'], function () {
		Route::get('login', ['as'=>'users_login','uses'=>'UsersController@getLogin']);
		Route::post('login',['uses'=>'UsersController@postLogin']);
		Route::post('login-modal', ['uses'=>'UsersController@postLoginModal']);
		Route::get('profile/{username}',  ['as'=>'users_profile','uses' => 'UsersController@getProfile', function ($username) {}]);
		Route::post('profile',  ['as'=>'users_profile_post','uses' => 'UsersController@postProfile']);
		Route::post('user-auth', ['uses'=>'UsersController@postUserAuth']);
		Route::post('send-file', ['uses'=>'UsersController@postSendFile']);
		Route::post('validate', ['uses'=>'UsersController@postValidate']);
		Route::post('send-file-temp', ['uses'=>'UsersController@postSendFileTemp']);
	});	

	// Password reset link request routes...
	Route::group(['prefix' => 'password'], function () {
		Route::get('email', ['uses'=>'Auth\PasswordController@getEmail']);
		Route::post('email', ['uses'=>'Auth\PasswordController@postEmail']);
	});

	//PERMISSIONS ROUTE
	Route::group(['prefix' => 'permissions'], function () {
		Route::get('auto-update', ['uses'=>'PermissionsController@getAutoUpdate']);
	});

	//REMINDERS ROUTE
	Route::get('password-reset', ['uses'=>'RemindersController@getForgot']);

	//THREAD ROUTE 
	Route::group(['prefix' => 'threads'], function () {
		Route::get('view/{id}',  ['as'=>'thread_view','uses' => 'ThreadsController@getView', function ($id) {}]);
		Route::post('add',  ['uses' => 'ThreadsController@postAdd']);
		Route::post('search-query',  ['uses' => 'ThreadsController@postSearchQuery']);
		Route::post('retrieve-quotes',  ['uses' => 'ThreadsController@postRetrieveQuotes']);
		Route::post('post-answer', ['uses' => 'ThreadsController@postPostAnswer']);
		Route::post('post-quote', ['uses'=>'ThreadsController@postPostQuote']);
		Route::post('submit-flag', ['uses'=>'ThreadsController@postSubmitFlag']);
		Route::post('remove-flag', ['uses'=>'ThreadsController@postRemoveFlag']);
		Route::post('check-flag',['uses'=>'ThreadsController@postCheckFlag']);
		Route::post('submit-like', ['uses'=>'ThreadsController@postSubmitLike']);
		Route::post('submit-dislike', ['uses'=>'ThreadsController@postSubmitDislike']);
		Route::post('inpage-search', ['uses'=>'ThreadsController@postInpageSearch']);
		Route::post('set-setting', ['uses'=>'ThreadsController@postSetSetting']);
		Route::post('preview-message', ['uses'=>'ThreadsController@postPreviewMessage']);
		Route::post('preview-message', ['uses'=>'ThreadsController@postPreviewMessage']);
		Route::post('thread-form', ['uses'=>'ThreadsController@postSettingFrom']);
		Route::post('answer-notification', ['uses'=>'ThreadsController@postAnswerNotification']);
		
		
	});

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');

});
