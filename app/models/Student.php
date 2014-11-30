<?php
class Student extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('class_name',); 


	public static function rules($teacherId = '', $userId = '') 
	{		
		$rules = array(			
		'fname' => 'required|alphaNum|max:30',
		'lname' => 'required|alphaNum|max:30',
		'gender' => 'required|integer',
		'dob' => 'required|date',
		'email'    => 'required|email|unique:users,email,' . $userId, 
		'mobile' => 'required|digits:10|unique:teachers,mobile,' . $teacherId,
		'doj' => 'required|date',
		'class_room_id' => 'required|integer',
		'native' => 'max:70',
		'blood_group' => 'integer',
		);

		return $rules;
	}

	public function classRoom() 
	{		
		return $this->belongsTo('ClassRoom', 'class_room_id', 'id');
	}

	public function user() 
	{		
		return $this->hasOne('User', 'id', 'user_id');
	}
	public function toSoA()
	{
		$gender = Config::get('sitevars.gender');
		$tmp = array();
		$tmp['id'] = $this->id;
		$tmp['fname'] = ucfirst($this->fname);
		$tmp['lname'] = ucfirst($this->lname);
		$tmp['gender'] = $gender[$this->gender];
		$tmp['mobile'] = $this->mobile;
		$tmp['email'] = $this->user()->first()->email;
		$tmp['class_name'] = ucfirst($this->classroom()->first()->class_name);
		return $tmp;
	}

	public static function getStudentsList()
	{
		$studentsList = array();		
		$students = self::where('status', '=', 1)->get();
		foreach ($students as $student) {			
			$studentsList[] = $student->toSoA();
	    }

	    return $studentsList;
	}

}
