<?php

namespace Tests\Feature;

use App\Models\BloodStatus;
use App\Models\Diploma;
use App\Models\House;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** Set up roles and permissions before each test */
    protected function setUp(): void
    {
        parent::setUp();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
        foreach (['admin', 'headmaster', 'professor', 'student'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    /**
     * Test route access based on user roles using a data provider.
     *
     * @param  string  $method  HTTP method (get, post, put, delete)
     * @param  string  $routeName  Named route to test
     * @param  string|null  $role  User role (admin, headmaster, professor, student, guest)
     * @param  bool  $shouldAccess  Whether the user should have access
     */
    #[DataProvider('accessMatrix')]
    public function test_route_access_by_role(
        string $method,
        string $routeName,
        ?string $role,
        bool $shouldAccess
    ): void {
        if ($role !== 'guest') {
            $user = User::factory()->create();
            $user->assignRole($role);
            $this->actingAs($user);
        }

        $student = Student::factory()->create();

        $response = match ($method) {
            'post', 'put' => $this->{$method}(
                route($routeName, ['student' => $student]),
                [
                    'first_name' => 'Harry',
                    'last_name' => 'Potter',
                    'gender' => 'm',
                    'birthday' => '2000-01-01',
                    'house_id' => $student->house_id ?? House::factory()->create()->id,
                    'blood_status_id' => $student->blood_status_id ?? BloodStatus::factory()->create()->id,
                    'enrollment_date' => '2010-09-01',
                    'graduation_date' => '2017-06-30',
                    'diploma_id' => Diploma::factory()->create()->id,
                ]
            ),
            default => $this->{$method}(route($routeName, ['student' => $student]))
        };

        if ($shouldAccess) {
            if (in_array($method, ['post', 'put', 'delete'])) {
                $response->assertRedirect(route('students.index'));
            } else {
                $response->assertOk();
            }
        } else {
            $role === 'guest'
                ? $response->assertRedirect(route('login'))
                : $response->assertForbidden();
        }
    }

    /**
     * Data provider for route access tests.
     * Each entry: [HTTP method, route name, user role, should have access]
     * @return Generator
     */
    public static function accessMatrix(): Generator
    {
        yield 'Route students.index with method GET and role admin' => ['get', 'students.index', 'admin', true];
        yield 'Route students.index with method GET and role headmaster' => ['get', 'students.index', 'headmaster', true];
        yield 'Route students.index with method GET and role professor' => ['get', 'students.index', 'professor', true];
        yield 'Route students.index with method GET and role student' => ['get', 'students.index', 'student', false];
        yield 'Route students.index with method GET and role guest' => ['get', 'students.index', 'guest', false];

        yield 'Route students.remove with method GET and role admin' => ['get', 'students.remove', 'admin', true];
        yield 'Route students.remove with method GET and role headmaster' => ['get', 'students.remove', 'headmaster', true];
        yield 'Route students.remove with method GET and role professor' => ['get', 'students.remove', 'professor', true];
        yield 'Route students.remove with method GET and role student' => ['get', 'students.remove', 'student', false];
        yield 'Route students.remove with method GET and role guest' => ['get', 'students.remove', 'guest', false];

        yield 'Route students.edit with method GET and role admin' => ['get', 'students.edit', 'admin', true];
        yield 'Route students.edit with method GET and role headmaster' => ['get', 'students.edit', 'headmaster', true];
        yield 'Route students.edit with method GET and role professor' => ['get', 'students.edit', 'professor', true];
        yield 'Route students.edit with method GET and role student' => ['get', 'students.edit', 'student', false];
        yield 'Route students.edit with method GET and role guest' => ['get', 'students.edit', 'guest', false];

        yield 'Route students.exportPdf with method GET and role admin' => ['get', 'students.exportPdf', 'admin', true];
        yield 'Route students.exportPdf with method GET and role headmaster' => ['get', 'students.exportPdf', 'headmaster', true];
        yield 'Route students.exportPdf with method GET and role professor' => ['get', 'students.exportPdf', 'professor', true];
        yield 'Route students.exportPdf with method GET and role student' => ['get', 'students.exportPdf', 'student', false];
        yield 'Route students.exportPdf with method GET and role guest' => ['get', 'students.exportPdf', 'guest', false];

        yield 'Route students.update with method PUT and role admin' => ['put', 'students.update', 'admin', true];
        yield 'Route students.update with method PUT and role headmaster' => ['put', 'students.update', 'headmaster', true];
        yield 'Route students.update with method PUT and role professor' => ['put', 'students.update', 'professor', true];
        yield 'Route students.update with method PUT and role student' => ['put', 'students.update', 'student', false];
        yield 'Route students.update with method PUT and role guest' => ['put', 'students.update', 'guest', false];
    }

    /**
     * Helper method to authenticate as a headmaster user.
     */
    protected function actingAsHeadmaster(): StudentControllerTest
    {
        $user = User::factory()->create();
        $user->assignRole('headmaster');

        return $this->actingAs($user);
    }

    /**
     * Test that the index method returns the correct view with students.
     */
    #[DataProvider('allowedRoles')]
    public function test_index_shows_students(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        Student::factory()->count(3)->create();

        $response = $this->get(route('students.index'));

        $response->assertOk();
        $response->assertViewIs('students.index');
        $response->assertViewHas('students');
    }

    /**
     * Test that the add method returns the correct view with necessary data.
     */
    #[DataProvider('allowedRoles')]
    public function test_add_shows_form_with_data(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        House::factory()->create();
        BloodStatus::factory()->create();
        Diploma::factory()->create();

        $response = $this->get(route('students.add'));

        $response->assertOk();
        $response->assertViewIs('students.addit');
        $response->assertViewHasAll(['houses', 'bloodStatuses', 'diplomas']);
    }

    /**
     * Test that the store method validates input and creates a new student.
     */
    #[DataProvider('allowedRoles')]
    public function test_store_validates_and_creates_student(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $house = House::factory()->create();
        $blood = BloodStatus::factory()->create();
        $diploma = Diploma::factory()->create();

        $data = [
            'first_name' => 'Harry',
            'last_name' => 'Potter',
            'gender' => 'm',
            'birthday' => '2000-01-01',
            'house_id' => $house->id,
            'blood_status_id' => $blood->id,
            'enrollment_date' => '2010-09-01',
            'graduation_date' => '2017-06-30',
            'diploma_id' => $diploma->id,
        ];

        $response = $this->post(route('students.store'), $data);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'first_name' => 'Harry',
            'last_name' => 'Potter',
        ]);
    }

    /**
     * Test that the edit method returns the correct view with student data.
     */
    #[DataProvider('allowedRoles')]
    public function test_edit_shows_form_with_student_data(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $student = Student::factory()->create();

        $response = $this->get(route('students.edit', $student));

        $response->assertOk();
        $response->assertViewIs('students.addit');
        $response->assertViewHas('student', $student);
    }

    /**
     * Test that the update method validates input and updates the student.
     */
    #[DataProvider('allowedRoles')]
    public function test_update_modifies_student_and_redirects(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $house = House::factory()->create();
        $blood = BloodStatus::factory()->create();

        $student = Student::factory()->create();

        $response = $this->put(route('students.update', $student), [
            'first_name' => 'Hermione',
            'last_name' => 'Granger',
            'gender' => 'f',
            'birthday' => '1999-03-01',
            'house_id' => $house->id,
            'blood_status_id' => $blood->id,
            'enrollment_date' => '2009-09-01',
            'graduation_date' => '2016-06-30',
            'diploma_id' => null,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('students', ['first_name' => 'Hermione']);
    }

    /**
     * Test that the delete method removes the student and redirects.
     */
    #[DataProvider('allowedRoles')]
    public function test_delete_removes_student(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $student = Student::factory()->create();

        $response = $this->delete(route('students.delete', $student));
        $response->assertRedirect(route('students.index'));

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    /**
     * Test that the remove method shows the confirmation view.
     */
    #[DataProvider('allowedRoles')]
    public function test_remove_shows_confirmation_view(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $student = Student::factory()->create();

        $response = $this->get(route('students.remove', $student));
        $response->assertOk();
        $response->assertViewIs('students.remove');
    }

    /**
     * Test that the exportPdf method generates and returns a PDF response.
     */
    #[DataProvider('allowedRoles')]
    public function test_export_pdf_returns_pdf_response(string $role): void
    {
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $student = Student::factory()->create();

        Pdf::shouldReceive('loadView')
            ->once()
            ->withArgs(function ($view, $data) use ($student) {
                return $view === 'students.pdf' &&
                    isset($data['student']) &&
                    $data['student']->is($student);
            })
            ->andReturnSelf();

        Pdf::shouldReceive('stream')
            ->once()
            ->andReturn(response('PDF'));

        $response = $this->get(route('students.exportPdf', $student));
        $response->assertOk();
        $response->assertSee('PDF');
    }

    /**
     * Data provider for roles allowed to access student management routes.
     * Each entry: [role]
     * @return Generator
     */
    public static function allowedRoles(): Generator
    {
        yield 'admin role' => ['admin'];
        yield 'headmaster role' => ['headmaster'];
        yield 'professor role' => ['professor'];
    }
}
