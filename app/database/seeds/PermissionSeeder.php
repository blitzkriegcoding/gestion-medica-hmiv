<?php
	class PermissionSeeder extends Seeder {
 
    public function run()
    {
          $permissions = [
            'assemble_blocks' => 'Assemble blocks',
            'dream_big' => 'Dream BIG!'
          ];

          // And the permissions
          $roles = [
            'Average construction worker' => ['assemble_blocks'],
            'Master Builder' => ['assemble_blocks', 'dream_big']
          ];

        
    }
    
}