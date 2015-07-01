<?php

class ParentescoRepresentantes extends \Eloquent {
	protected $fillable = ['id_parentesco','id_paciente','id_representante','representante_real'];
	protected $table = 'parentesco_representantes';
	public $timestamps = false;
	protected $primaryKey = 'id_representante';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePedriatrico','id_paciente','id_paciente');
		}
	public function Parentesco()	
		{
			return $this->belongsTo('Parentesco','id_parentesco','id_parentesco');
		}

	public static function guardarDatosParentescoRepresentante($input, $id_paciente, $id_representante)	
		{

			$existe_parentesco = self::where('id_representante','=',$id_representante)
										->where('id_paciente','=',$id_paciente)
											->pluck('id_parentesco_representante');
			if(!empty($existe_parentesco))
				{
					return 
				}


			$nuevo_parentesco = [
									'id_parentesco'			=>	$input['parentesco_representante'],
									'representante_real'	=>	$input['representante_legal'],
									'id_representante'		=>	$id_representante,
									'id_paciente'			=>	$$id_paciente
								];

		}
}