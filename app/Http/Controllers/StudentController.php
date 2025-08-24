<?php

namespace App\Http\Controllers;

use App\Models\BloodStatus;
use App\Models\Diploma;
use App\Models\House;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return View
     */
    public function index(): View
    {
        $students = Student::orderBy('last_name')->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return View
     */
    public function add(): View
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

    /**
     * Store a newly created student in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateStudentData($request, null);

        $data['first_name'] = Str::of($data['first_name'])->trim()->value();
        $data['last_name'] = Str::of($data['last_name'])->trim()->value();

        Student::create($data);

        return redirect()
            ->route('students.index')
            ->with('success', __('students.success.student_added'));
    }

    /**
     * Remove the specified student from storage.
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function delete(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', __('students.success.student_deleted'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param Student $student
     * @return View
     */
    public function edit(Student $student): View
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

    /**
     * Update the specified student in storage.
     *
     * @param Request $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $data = $this->validateStudentData($request, $student->id);

        $data['first_name'] = trim($data['first_name']);
        $data['last_name'] = trim($data['last_name']);
        $data['diploma_id'] = $data['diploma_id'] ?: null;

        $student->update($data);

        return redirect()
            ->route('students.index', request()->only('search', 'page', 'sort', 'dir'))
            ->with('success', __('students.success.student_updated'));
    }

    /**
     * Show the confirmation page for removing a student.
     *
     * @param Student $student
     * @return View
     */
    public function remove(Student $student): View
    {
        return view('students.remove', compact('student'));
    }

    /**
     * Export the student file as a PDF.
     *
     * @param Student $student
     * @return Response
     */
    public function exportPdf(Student $student): Response
    {
        $pdf = Pdf::loadView('students.pdf', compact('student'));

        return $pdf->stream();
    }

    /**
     * Validate the student data from the request.
     *
     * @param Request $request
     * @param int|null $ignoreId
     * @return array
     */
    private function validateStudentData(Request $request, ?int $ignoreId = null): array
    {
        $first = mb_strtolower(trim($request->input('first_name', '')));

        return $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => [
                'required', 'string', 'max:255',
                Rule::unique('students', 'last_name')
                    ->ignore($ignoreId)
                    ->where(fn ($q) => $q->whereRaw('LOWER(TRIM(first_name)) = ?', [$first])),
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
