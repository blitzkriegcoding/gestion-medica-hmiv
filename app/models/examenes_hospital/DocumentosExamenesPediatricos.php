<?php

class DocumentosExamenesPediatricos extends \Eloquent {
	protected $fillable = ['id_examen','ruta_documento'];
	public $timestamps 	= false;
	public $table 		= 'documentos_examenes_medicos';
	public $primaryKey	= 'id_documento_examen';

	public function ExamenesPediatricos()
		{
			return $this->belongsTo('ExamenesPediatricos','id_examen','id_examen');
		}

}