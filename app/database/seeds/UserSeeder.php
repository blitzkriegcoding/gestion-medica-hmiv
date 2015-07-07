<?php
    class UserSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        $user = User::create(array(                
                'username'      => 'Administrador',
                'first_name'    => 'Yrvin',
                'last_name'     => 'Escorihuela',
                'email'         => 'administrador@hmiv.gob.ve',
                'password'      => Hash::make('123456'),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime      
        ));
        $role = Role::where('username', '=', 'Administrador')->get()->first();
        $user->attachRole( $role );
    }
 
}