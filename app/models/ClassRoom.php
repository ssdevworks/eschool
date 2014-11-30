<?php
class ClassRoom extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('class_name',); 


	public function teacher() 
	{		
		return $this->hasOne('Teacher', 'id', 'teacher_id');
	}
	public function student()
	{
		return $this->hasMany('Student', 'class_room_id', 'id');
	}

	public static function getClassRoomList() {
		$classList = array();
		$classes = self::where('status', '=', 1)->get(array('id', 'class_name'));
		foreach ($classes as $class) {
			$classList[$class->id] = $class->class_name;
		}

		return $classList;
	}
}
