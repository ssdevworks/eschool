<?php
class Teacher extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('subject_name',); 

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
		'subject' => 'required|integer',
		'qualification' => 'max:70',
		'experience' => 'max:30',
		'marital_status' => 'integer',
		'blood_group' => 'integer',
		);

		return $rules;
	}
	public function user() 
	{		
		return $this->hasOne('User', 'id', 'user_id');
	}

	public function subject() 
	{		
		return $this->hasOne('Subject', 'id', 'subject');
	}

	public function toSoA()
	{
		$gender = Config::get('sitevars.gender');
		$tmp = array();
		$tmp['id'] = $this->id;
		$tmp['fname'] = $this->fname;
		$tmp['lname'] = $this->lname;
		$tmp['gender'] = $gender[$this->gender];
		$tmp['mobile'] = $this->mobile;
		$tmp['email'] = $this->user()->first()->email;
		$tmp['subject'] = ucfirst($this->subject()->first()->subject_name);
		return $tmp;
	}

	public static function getTeacherList()
	{
		$teacherList = array();		
		$teachers = self::where('status', '=', 1)->get();
		foreach ($teachers as $teacher) {			
			$teacherList[] = $teacher->toSoA();
	    }

	    return $teacherList;
	}

}
