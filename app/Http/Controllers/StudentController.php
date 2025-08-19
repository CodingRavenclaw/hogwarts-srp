<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('last_name')->paginate(10);
        return view('students.index', compact('students'));
    }
}
