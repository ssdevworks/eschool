<?php
class ClassRoom extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('class_name',); 

	public static function rules($classId = '') 
	{		
		$rules = array(			
		'class_name' => 'required|alphaNum|max:30|unique:class_rooms,class_name,' . $classId,		
		);

		return $rules;
	}

	public static function messages()
	{
		$messages = array(
    		'class_name.unique' => 'Already a class room exists with this name. Choose a different name',
		);

		return $messages;
	}

	public function teacher() 
	{		
		return $this->hasOne('Teacher', 'id', 'teacher_id');
	}
	public function student()
	{
		return $this->hasMany('Student', 'class_room_id', 'id');
	}

	public static function getClassRoomList() 
	{
		$classList = array();
		$classes = self::where('status', '=', 1)->get(array('id', 'class_name'));
		foreach ($classes as $class) {
			$classList[$class->id] = $class->class_name;
		}

		return $classList;
	}

	public static function getClassWiseStudents() 
	{
		$studentList = array();
		$classes = self::where('status', '=', 1)->get(array('id', 'class_name'));
		foreach ($classes as $class) {
			$students = $class->student()->get();				
			foreach ( $students as $student)
			$studentList[] = array(
				'class' => $class->class_name,
				'id' =>$student->id,
				'name' => $student->fname . ' ' . $student->lname
			);
		}
		return $studentList;
	}

	public static function getTeachersList()
	{		
		$teachers =  Teacher::select(DB::raw('concat (fname," ",lname) as full_name,id'))->lists('full_name', 'id');
		return $teachers;
	}

	public function toSoA()
	{		
		$tmp = array();
		$tmp['id'] = $this->id;
		$tmp['class_name'] = $this->class_name;
		$teacherName = $this->teacher()->first()->fname . ' ' . $this->teacher()->first()->lname;
		$tmp['teacher_name'] = $teacherName;
		return $tmp;
	}

	public static function getClassRoomsList()
	{
		$classRoomList = array();		
		$classRooms = self::where('status', '=', 1)->get();
		foreach ($classRooms as $classRoom) {			
			$classRoomList[] = $classRoom->toSoA();
	    }

	    return $classRoomList;
	}
}
