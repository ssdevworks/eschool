<?php
class Parents extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	
	protected $table = 'parents';

	public static function rules($parentId = '', $userId = '') 
	{		
		$rules = array(			
		'fname' => 'required|alphaNum|max:30',
		'lname' => 'required|alphaNum|max:30',
		'email'    => 'required|email|unique:users,email,' . $userId, 
		'mobile' => 'required|digits:10|unique:parents,mobile,' . $parentId,
		'student_id' => 'required|integer|unique:parents,student_id,' . $parentId,
		'relation' => 'required|integer',
		);

		return $rules;
	}

	public static function messages()
	{
		$messages = array(
    		'student_id.unique' => 'Selected student name is already mapped with another parent',
		);

		return $messages;
	}

	public function student() 
	{		
		return $this->hasOne('Student', 'id', 'student_id');
	}

	public function user() 
	{		
		return $this->hasOne('User', 'id', 'user_id');
	}

	public function toSoA()
	{		
		$relation = Config::get('sitevars.relation_ship');
		$tmp = array();
		$tmp['id'] = $this->id;
		$tmp['fname'] = ucfirst($this->fname);
		$tmp['lname'] = ucfirst($this->lname);
		$tmp['mobile'] = $this->mobile;
		$tmp['relation'] = $relation[$this->relation];
		$tmp['email'] = $this->user()->first()->email;
		$studentName = $this->student()->first()->fname . ' ' . $this->student()->first()->lname;
		$className = $this->student()->first()->classroom()->first()->class_name;
		$tmp['student'] = $studentName;
		$tmp['class_name'] = $className;
		return $tmp;
	}

	public static function getParentsList()
	{
		$parentsList = array();		
		$parents = self::where('status', '=', 1)->get();
		foreach ($parents as $parent) {			
			$parentsList[] = $parent->toSoA();
	    }

	    return $parentsList;
	}


	
}
