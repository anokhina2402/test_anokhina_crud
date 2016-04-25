<?php namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class EmployeeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$employees = Employee::all();

		return json_encode(array('data' => $employees));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->createOrUpdate();
	}


	function createOrUpdate($id = 0)
	{
		$data = json_decode($_POST['data'], true);
		$rules = array(
			'fio'       => 'unique:employees,fio' . ($id ? ",$id" : ''),
		);
		$validator = Validator::make($data, $rules);


		// process validate
		if ($validator->fails()) {
			return json_encode(array('post_result' => 'error_'.($id?'edit':'add'), 'errors' => $validator->errors()->all(), 'data' => $data));
		} else {
			if ($id)
				$employee = Employee::find($id);
			else
				$employee = new Employee();
			$employee->fio = $data['fio'];
			$employee->phone = $data['phone'];
			$employee->email = $data['email'];
			$employee->sex = $data['sex'];
			$employee->birthday = $data['birthday'];
			$employee->save();

			return json_encode(array('post_result' => 'success_'.($id?'edit':'add'), 'data' => array('id' => $employee->id)));
		}

	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$employee = Employee::find($id);

		// show the view and pass the nerd to it
		return json_encode(array('data' => $employee));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employee = Employee::find($id);
		return json_encode(array('data' => $employee));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return $this->createOrUpdate($id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$employee = Employee::find($id);
		$employee->delete();

		// redirect
		return json_encode(array('post_result' => 'success_delete', 'data' => array('id' => $id)));
	}

}
