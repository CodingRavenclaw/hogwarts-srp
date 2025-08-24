<?php

namespace App\Livewire;

use App\Models\BloodStatus;
use App\Models\Diploma;
use App\Models\House;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StudentsTable extends Component
{
    use WithPagination;

    #[Url(as: 'search', except: '')]
    public $search = '';

    #[Url(as: 'sort', except: 'id')]
    public string $sortField = 'id';

    #[Url(as: 'dir', except: 'asc')]
    public string $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap';

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $students = Student::query()
            ->with(['house', 'bloodStatus', 'diploma'])
            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%");
                });
            })
            ->when(in_array($this->sortField, [
                'id', 'first_name', 'last_name', 'gender', 'birthday',
                'enrollment_date', 'graduation_date',
            ]), function ($q) {
                $q->orderBy($this->sortField, $this->sortDirection);
            })
            ->when($this->sortField === 'house', function ($q) {
                $q->orderBy(
                    House::select('name')
                        ->whereColumn('houses.id', 'students.house_id'),
                    $this->sortDirection
                );
            })
            ->when($this->sortField === 'blood_status', function ($q) {
                $q->orderBy(
                    BloodStatus::select('short_name')
                        ->whereColumn('blood_statuses.id', 'students.blood_status_id'),
                    $this->sortDirection
                );
            })
            ->when($this->sortField === 'diploma', function ($q) {
                $q->orderBy(
                    Diploma::select('short_name')
                        ->whereColumn('diplomas.id', 'students.diploma_id'),
                    $this->sortDirection
                );
            })
            ->paginate(10);

        return view('livewire.students-table', ['students' => $students]);
    }
}
