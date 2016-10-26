<?php

namespace App\Http\Controllers;

namespace App\Models;

use App\Models\Departments as Departments;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;

class DepartmentsController extends Controller {

    public function index() {
        $data['departmentss'] = Departments::all();
        return view('departments/index', $data);
    }

    public function add() {
        return view('departments/add');
    }

    public function addPost() {
        $departments_data = array(
            'name' => Input::get('name'),
            'description' => Input::get('description'),
        );
        $departments_id = Departments::insert($departments_data);

        return redirect('departments')->with('message', 'Departments successfully added');
    }

    public function delete($id) {
        $departments = Departments::find($id);
        $departments->delete();
        return redirect('departments')->with('message', 'Departments deleted successfully.');
    }

    public function edit($id) {
        $data['departments'] = Departments::find($id);
        return view('departments/edit', $data);
    }

    public function editPost() {
        $id = Input::get('departments_id');
        $departments = Departments::find($id);

        $departments_data = array(
            'name' => Input::get('name'),
            'description' => Input::get('description'),
        );
        $departments_id = Departments::where('id', '=', $id)->update($departments_data);
        return redirect('departments')->with('message', 'Departments Updated successfully');
    }

    public function changeStatus($id) {
        $departments = Departments::find($id);
        $departments->status = !$departments->status;
        $departments->save();
        return redirect('departments')->with('message', 'Change departments status successfully');
    }

    public function view($id) {
        $data['departments'] = Departments::find($id);
        return view('departments/view', $data);
    }

}
