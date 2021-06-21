<?php

use App\Models\Ref\UserLevel;
use Illuminate\Database\Seeder;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// insert level administrator
        //$check = UserLevel::where('id', '=', 1)->first();
        //if($check == null){
        	UserLevel::create(['id' => 1, 'nama'	=> 'administrator']);
        //}

    	// insert level karyawan
        //$check = UserLevel::where('id', '=', 2)->first();
        //if(count($check)<=0){
        	UserLevel::create(['id' => 2, 'nama'	=> 'karyawan']);
        //}

        //$check = UserLevel::where('id', '=', 3)->first();
        //if(count($check)<=0){
            UserLevel::create(['id' => 3, 'nama'    => 'member']);
        //}

        
        $u_obj = app('App\Repositories\Contracts\Mst\UserRepoInterface');
        $data = ['nama'   => 'admin',
                'email' => 'admin@gmail.com',
                'password'  => 'rahasia',
                'ref_user_level_id' => 1
                ];
        $u_obj->create($data);


    }
}
