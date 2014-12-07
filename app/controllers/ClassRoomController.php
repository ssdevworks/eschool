<?php

class ClassRoomController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$teachers = ClassRoom::getTeachersList();
		$response = array (
			'teachers' => $teachers
		);

		return Response::json($response);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
		$response  = array('success' => true, 'error_code' => 0, 'message' => '');	
		$validator = Validator::make(Input::all(), ClassRoom::rules(), ClassRoom::messages());

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {
			
			$classRoom = new ClassRoom;
			$classRoom->class_name = ucfirst(Input::get('class_name'));
			$classRoom->teacher_id = Input::get('teacher_id');
			$classRoom->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Class Room added successfully');
	    }

	    return Response::json($response);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$classRoom = ClassRoom::find($id);
		$classRoomDetails = $classRoom->toSoA();
		$response = array (
			'classroom' => $classRoomDetails
		);
		
		return Response::json($response);
	}

	public function listView()
	{
		$classRooms = ClassRoom::getClassRoomsList();
		return Response::json(array('classrooms' =>$classRooms));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$teachers = ClassRoom::getTeachersList();
		$classRoom = ClassRoom::find($id);
		$response = array (
			'teachers' => $teachers,
			'classroom' => $classRoom
		);
		
		return Response::json($response);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$response  = array('success' => true, 'error_code' => 0, 'message' => '');	
		$classRoom = ClassRoom::find($id);			
		$validator = Validator::make(Input::all(), ClassRoom::rules($classRoom->id), ClassRoom::messages());

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {

			$classRoom->class_name = ucfirst(Input::get('class_name'));
			$classRoom->teacher_id = Input::get('teacher_id');
			$classRoom->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Class Room updated successfully');
		}

		return Response::json($response);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
