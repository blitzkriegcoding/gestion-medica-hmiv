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

	public static function validarDatosParentescoRepresentante($input)
		{
			$reglas_parentesco_representante = 	[
													'representante_legal'	=>	'required|in:1,2'
												];
			$errores_parentesco_representante = [
													'required'	=>	'Campo obligatorio',
													'in'		=>	'Seleccione un valor de la lista'
												];
			$validador_parentesco_representante = Validator::make($input, $reglas_parentesco_representante, $errores_parentesco_representante);
			if($validador_parentesco_representante->fails())
				{
						return 	[
									'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',
									'mensaje'			=>	$validador_parentesco_representante->messages(),
									'estilo'			=>	' alert alert-danger ',
									'error_mensajes'	=>	true,
								];
				}
		}

	public static function guardarDatosParentescoRepresentante($input, $id_paciente, $id_representante)	
		{
			$parentesco_real = '1';
			$parentesco_existe = self::where('id_representante','=',$id_representante)
										->where('id_paciente','=',$id_paciente)
											->pluck('id_parentesco_representante');

			$representante_actual = self::where('id_paciente','=',$id_paciente)
												->where('representante_real','=','1')
													->pluck('id_parentesco_representante');

			if(!$representante_actual)
				{
					$parentesco_real = '2';					
				}
			if(!empty($parentesco_existe))
				{
					return 	[
								'parentesco_existe'	=>	true
							];
				}
			$nuevo_parentesco = [
									'id_parentesco'			=>	$input['parentesco_representante'],
									'representante_real'	=>	$parentesco_real,
									'id_representante'		=>	$id_representante,
									'id_paciente'			=>	$id_paciente,									
								];
			self::create($nuevo_parentesco);
			return 	[
						'parentesco_existe'	=>	false
					];
		}

}