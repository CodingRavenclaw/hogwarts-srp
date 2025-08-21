<?php

namespace App\Http\Controllers;

use App\Models\BloodStatus;
use App\Models\House;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
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

        return view('students.add', [
            'houses' => $houses,
            'bloodStatuses' => $bloodStatuses,
        ]);
    }

    public function store(Request $request)
    {
        // 1) Validierung
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255',
                // Kombi-Unique: prüfe, ob es mit demselben first_name bereits einen last_name gibt
                Rule::unique('students', 'last_name')->where(function ($q) use ($request) {
                    // case-/space-insensitiv prüfen
                    $q->whereRaw('LOWER(TRIM(first_name)) = ?', [mb_strtolower(trim($request->input('first_name')))]);
                }),
            ],
            'gender' => ['required', 'in:f,m'],
            'birthday' => ['required', 'date', 'before:today'],
            'house_id' => ['required', 'exists:houses,id'],
            'blood_status_id' => ['required', 'exists:blood_statuses,id'],
            'enrollment_date' => ['required', 'date', 'after_or_equal:birthday'],
            'graduation_date' => ['nullable', 'date', 'after:enrollment_date'],
        ], [
            // optionale, nette Fehlermeldung für den Doppelname-Fall:
            'last_name.unique' => __('students.errors.full_name_exists'), // z.B. "Ein Schüler mit diesem vollen Namen existiert bereits."
        ]);

        // 2) sanfte Normalisierung (Trimmen, ggf. Groß-/Kleinschreibung vereinheitlichen)
        $data['first_name'] = Str::of($data['first_name'])->trim()->value();
        $data['last_name'] = Str::of($data['last_name'])->trim()->value();

        try {
            // 3) Persistieren
            Student::create($data);

        } catch (QueryException $e) {
            // Falls ein UNIQUE-Index (s.u.) greift und ein Race-Condition-Treffer kommt:
            if ($e->getCode() === '23000') {
                return back()
                    ->withErrors(['last_name' => __('students.errors.full_name_exists')])
                    ->withInput();
            }
            throw $e;
        }

        return redirect()
            ->route('students.index')
            ->with('success', __('students.success.student_added'));
    }

    public function exportPdf(Student $student)
    {
        $pdf = Pdf::loadView('students.pdf', compact('student'));

        return $pdf->stream();
    }
}
