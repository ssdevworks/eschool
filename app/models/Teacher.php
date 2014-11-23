<?php
class Teacher extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('subject_name',); 

	public static $rules = array(			
		'fname' => 'required|alphaNum|max:30',
		'lname' => 'required|alphaNum|max:30',
		'gender' => 'required|integer',
		'dob' => 'required|date',
		'email'    => 'required|email|unique:users', 
		'mobile' => 'required|digits:10',
		'doj' => 'required|date',
		'subject' => 'required|integer',
		'qualification' => 'max:70',
		'experience' => 'max:30',
		'marital_status' => 'integer',
		'blood_group' => 'integer',
	);

	public function user() 
	{		
		return $this->hasOne('User', 'id', 'user_id');
	}

}
