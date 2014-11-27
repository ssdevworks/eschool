<?php
class Subject extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('subject_name',); 

	public function teacher()
    {
        return $this->belongsTo('Teacher', 'id', 'subject');
    }

	public static function getSubjectList() {
		$subjList = array();
		$subjects = self::where('status', '=', 1)->orderBy('subject_name', 'asc')->get(array('id', 'subject_name'));
		foreach ($subjects as $subject) {
			$subjList[$subject->id] = $subject->subject_name;
		}

		return $subjList;
	}
}
