<?php
 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;
 
class User extends Eloquent implements UserInterface, RemindableInterface 
	{ 
	    
    	use UserTrait;
    	use RemindableTrait;
    	use HasRole; 
    	protected $table = 'users';
    	public $fillable = [	'username',
    							'email',
    							'password',
    							'first_name',
    							'last_name',
    							'remember_token',
    							'created_at',
    							'updated_at'
    							];


	}
