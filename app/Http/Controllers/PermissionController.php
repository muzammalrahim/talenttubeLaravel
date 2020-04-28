<?php

namespace App\Http\Controllers;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function Permission()
    {
    	// $dev_permission = Permission::where('slug','create-user')->first();
        // $manager_permission = Permission::where('slug', 'create-jobs')->first();

        // $createUser = new Permission();
		// $createUser->slug = 'create-user';
		// $createUser->name = 'Create User';
        // $createUser->save();

        // $createJobs = new Permission();
		// $createJobs->slug = 'create-job';
		// $createJobs->name = 'Create Job';
        // $createJobs->save();



		// //RoleTableSeeder.php
		// $dev_role = new Role();
		// $dev_role->slug = 'admin';
		// $dev_role->name = 'Administrator';
		// $dev_role->save();
		// $dev_role->permissions()->attach($createUser);

		// $manager_role = new Role();
		// $manager_role->slug = 'employer';
		// $manager_role->name = 'Employer';
		// $manager_role->save();
		// $manager_role->permissions()->attach($createJobs);



		return redirect()->back();
    }
}
