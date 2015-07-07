<?php
class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        #$this->call('PermisionsSeeder');
        #$this->call('RolesSeeder');
		#$this->call('UserSeeder');
		$this->call('UserTableSeeder');
        $this->command->info('Datos insertados!');
	}
}

class UserTableSeeder extends Seeder
{
  
    public function run()
    {
        DB::table('users')->delete();

		User::create(array(
			'username'		=>	'yescorihuela',
            'first_name'	=> 	'Yrvin',
            'last_name'     => 	'Escorihuela',            
            'email'    		=> 	'yescorihuela@hmiv.gob.ve',
            'password' 		=> 	Hash::make('123456'), //insert your password in here
        )); 
		        
        User::create(array(
            
            'username' 		=> 'rgiron',
            'first_name'    => 'Rosmely',
            'last_name'     => 'Girón',
            'email'    		=> 'rgiron@hmiv.gob.ve',
            'password' 		=> Hash::make('123456'), //insert your password in here
        ));

        User::create(array(
            
            'username' 		=> 'echirinos',
            'first_name'    => 'Ewlin',
            'last_name'     => 'Chirinos',
            'email'    		=> 'echirinos@hmiv.gob.ve',
            'password' 		=> Hash::make('123456'), //insert your password in here
        ));


		$director_general 			= new Role();
		$director_general->name 	= 'DIRECTOR_GENERAL';
		$director_general->save();

		$analista_is 				= new Role(); // la "is" es por informacion de salud
		$analista_is->name 			= 'ANALISTA_INFORMACION_SALUD';
		$analista_is->save();      

		$medico 					= new Role(); // la "is" es por informacion de salud
		$medico->name 				= 'MEDICOS';
		$medico->save();

		$enfermera 					= new Role(); // la "is" es por informacion de salud
		$enfermera->name 			= 'ENFERMERA';
		$enfermera->save();

/*****PERMISOS********/

		/*********************************PACIENTES***********************************/

		$nuevo_paciente 						= new Permission();
		$nuevo_paciente->name 					= 'nuevo_paciente';
		$nuevo_paciente->display_name 			= 'Nuevo Paciente';
		$nuevo_paciente->save();

		$busqueda_paciente 						= new Permission();
		$busqueda_paciente->name 				= 'busqueda_paciente';
		$busqueda_paciente->display_name		= 'Buscar Paciente';
		$busqueda_paciente->save();

		$modificacion_paciente 					= new Permission();
		$modificacion_paciente->name 			= 'modificacion_paciente';
		$modificacion_paciente->display_name 	= 'Modificar Paciente';
		$modificacion_paciente->save();


		$baja_paciente 							= new Permission();
		$baja_paciente->name 					= 'baja_paciente';
		$baja_paciente->display_name 			= 'Baja de Paciente';
		$baja_paciente->save();

		/*********************************PACIENTES***********************************/
	
		/*********************************MEDICOS***********************************/

		$nuevo_medico 						= new Permission();
		$nuevo_medico->name 				= 'nuevo_medico';
		$nuevo_medico->display_name 		= 'Nuevo Médico';
		$nuevo_medico->save();

		$busqueda_medico 					= new Permission();
		$busqueda_medico->name 				= 'busqueda_medico';
		$busqueda_medico->display_name 		= 'Buscar Médico';
		$busqueda_medico->save();

		$modificacion_medico 				= new Permission();
		$modificacion_medico->name 			= 'modificacion_medico';
		$modificacion_medico->display_name 	= 'Modificar Médico';
		$modificacion_medico->save();

		$baja_medico 						= new Permission();
		$baja_medico->name 					= 'baja_medico';
		$baja_medico->display_name 			= 'Baja Médico';
		$baja_medico->save();	




		/*********************************MEDICOS***********************************/


		/******************************HISTORIA MEDICA******************************/

		$creacion_historia 					= new Permission();
		$creacion_historia->name 			= 'creacion_historia';
		$creacion_historia->display_name 	= 'Creación Historia Médica';
		$creacion_historia->save();

		$busqueda_historia 					= new Permission();
		$busqueda_historia->name 			= 'busqueda_historia';
		$busqueda_historia->display_name 	= 'Buscar Historia';
		$busqueda_historia->save();

		$modificacion_historia 				= new Permission();
		$modificacion_historia->name 		= 'modificacion_historia';
		$modificacion_historia->display_name = 'Modificar Historia';
		$modificacion_historia->save();

		$cierre_historia 					= new Permission();
		$cierre_historia->name 				= 'cierre_historia';
		$cierre_historia->display_name 		= 'Cerrar Historia';
		$cierre_historia->save();

		/******************************HISTORIA MEDICA******************************/







/*****FIN PERMISOS********/


		//	analista_is
		$analista_is->attachPermission($nuevo_paciente);
		$analista_is->attachPermission($busqueda_paciente);
		$analista_is->attachPermission($modificacion_paciente);
		$analista_is->attachPermission($baja_paciente);
		
		$analista_is->attachPermission($nuevo_medico);
		$analista_is->attachPermission($busqueda_medico);
		$analista_is->attachPermission($modificacion_medico);
		$analista_is->attachPermission($baja_medico);

		$analista_is->attachPermission($creacion_historia);
		$analista_is->attachPermission($busqueda_historia);
		$analista_is->attachPermission($modificacion_historia);
		$analista_is->attachPermission($cierre_historia);


		// $admin->attachPermission($read);
		// $admin->attachPermission($edit);

		$analista_is_rol_1 = Role::where('name', '=', 'ANALISTA_INFORMACION_SALUD')->pluck('id');
		$analista_is_rol_2 = Role::where('name', '=', 'ANALISTA_INFORMACION_SALUD')->pluck('id');
		

	    // $user1 = User::where('username','=','yescorihuela')->first();
	    // $user1->roles()->attach($adminRole);

	    $analista_1 = User::where('username','=','rgiron')->first();
	    $analista_1->roles()->attach($analista_is_rol_1);
	    #$analista_1->attachRole($analista_is_rol_1);


	    $analista_2 = User::where('username','=','echirinos')->first();
	    $analista_2->roles()->attach($analista_is_rol_2);
	    #$analista_2->attachRole($analista_is_rol_2);
	    return 'Woohoo!';        



    }
}