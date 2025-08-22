<?php

namespace App\Http\Controllers;

use App\Models\BloodStatus;
use App\Models\Diploma;
use App\Models\House;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('last_name')->paginate(10);

        return view('students.index', compact('students'));
    }

    public function add()
    {
        $houses = House::all();
        $bloodStatuses = BloodStatus::all();
        $diplomas = Diploma::all();

        return view('students.addit', [
            'student' => null,
            'houses' => $houses,
            'bloodStatuses' => $bloodStatuses,
            'diplomas' => $diplomas,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateStudentData($request);

        $data['first_name'] = Str::of($data['first_name'])->trim()->value();
        $data['last_name'] = Str::of($data['last_name'])->trim()->value();

        Student::create($data);

        return redirect()
            ->route('students.index')
            ->with('success', __('students.success.student_added'));
    }

    public function delete(int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', __('students.success.student_deleted'));
    }

    public function edit(Student $student)
    {
        $houses = House::all();
        $bloodStatuses = BloodStatus::all();
        $diplomas = Diploma::all();

        return view('students.addit', [
            'student' => $student,
            'houses' => $houses,
            'bloodStatuses' => $bloodStatuses,
            'diplomas' => $diplomas,
        ]);
    }

    public function remove(Student $student)
    {
        return view('students.remove', compact('student'));
    }

    public function exportPdf(Student $student)
    {
        $pdf = Pdf::loadView('students.pdf', compact('student'));

        return $pdf->stream();
    }

    private function validateStudentData(Request $request)
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255',
                Rule::unique('students', 'last_name')->where(function ($q) use ($request) {
                    $q->whereRaw('LOWER(TRIM(first_name)) = ?', [mb_strtolower(trim($request->input('first_name')))]);
                }),
            ],
            'gender' => ['required', 'in:f,m'],
            'birthday' => ['required', 'date', 'before:today'],
            'house_id' => ['required', 'exists:houses,id'],
            'blood_status_id' => ['required', 'exists:blood_statuses,id'],
            'enrollment_date' => ['required', 'date', 'after_or_equal:birthday'],
            'graduation_date' => ['nullable', 'date', 'after:enrollment_date'],
            'diploma_id' => ['nullable', 'exists:diplomas,id'],
        ], [
            'last_name.unique' => __('students.errors.full_name_exists'),
        ]);
    }
}
