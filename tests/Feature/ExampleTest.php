<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/students')->assertRedirect(route('login'));
    }

    public function test_regular_users_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('students.create'))
            ->assertForbidden();
    }

    public function test_admin_can_access_student_creation_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('students.create'))
            ->assertOk();
    }

    public function test_admin_can_manage_departments_and_students_are_unassigned_when_one_is_deleted(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.departments.create'))
            ->assertOk();

        $this->post(route('admin.departments.store'), [
            'name' => 'Computer Science',
            'code' => 'cs',
        ])->assertRedirect(route('admin.departments.index'));

        $department = Department::firstOrFail();
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'Computer Science',
            'code' => 'CS',
        ]);

        $this->put(route('admin.departments.update', $department), [
            'name' => 'School of Computing',
            'code' => 'SC',
        ])->assertRedirect(route('admin.departments.index'));

        $unassignedStudent = Student::create([
            'name' => 'Unassigned Student',
            'age' => 19,
            'cnic' => '2222222222222',
            'email' => 'unassigned.student@example.test',
            'phone' => '03002222222',
        ]);

        $this->get(route('admin.departments.enroll', $department))
            ->assertOk()
            ->assertSee('Unassigned Student');

        $this->post(route('admin.departments.enroll.store', $department), [
            'student_ids' => [$unassignedStudent->id],
        ])->assertRedirect(route('admin.departments.index'));

        $this->assertSame($department->id, $unassignedStudent->fresh()->department_id);

        $student = Student::create([
            'name' => 'Department Student',
            'age' => 20,
            'cnic' => '1111111111111',
            'email' => 'department.student@example.test',
            'phone' => '03001111111',
            'department_id' => $department->id,
        ]);

        $this->delete(route('admin.departments.destroy', $department))
            ->assertRedirect(route('admin.departments.index'));

        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
        $this->assertNull($student->fresh()->department_id);
    }

    public function test_registration_requires_an_unclaimed_pre_authorized_student_email(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Unapproved Student',
            'email' => 'not-approved@example.test',
            'password' => 'Password1',
            'password_confirmation' => 'Password1',
        ])->assertSessionHasErrors('email');

        $student = Student::create([
            'name' => 'Approved Student',
            'age' => 20,
            'cnic' => '1234567890123',
            'email' => 'approved@example.test',
            'phone' => '03001234567',
        ]);

        $this->post(route('register.store'), [
            'name' => 'Approved Student',
            'email' => 'approved@example.test',
            'password' => 'Password1',
            'password_confirmation' => 'Password1',
        ])->assertRedirect(route('user.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'approved@example.test',
            'student_id' => $student->id,
        ]);
    }

    public function test_student_can_only_reach_their_own_profile_route(): void
    {
        $department = Department::create(['name' => 'Business Administration', 'code' => 'BBA']);
        $student = Student::create([
            'name' => 'Student One',
            'age' => 20,
            'cnic' => '1234567890123',
            'email' => 'student@example.test',
            'phone' => '03001234567',
            'department_id' => $department->id,
        ]);
        $user = User::factory()->create(['role' => 'user', 'student_id' => $student->id]);

        $this->actingAs($user)->get(route('profile.show'))
            ->assertOk()
            ->assertSee('Business Administration');
        $this->actingAs($user)->get(route('user.dashboard'))
            ->assertOk()
            ->assertSee('Business Administration');
        $this->actingAs($user)->get(route('students.index'))->assertForbidden();

        $this->actingAs($user)->put(route('profile.update'), [
            'name' => $student->name,
            'age' => $student->age,
            'cnic' => $student->cnic,
            'phone' => $student->phone,
            'address' => 'Updated address',
            'department_id' => null,
        ])->assertRedirect(route('profile.show'));

        $this->assertSame($department->id, $student->fresh()->department_id);
    }

    public function test_admin_can_update_own_basic_details_but_cannot_submit_a_role_change(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->put(route('admin.users.update', $admin), [
            'name' => 'Updated Admin',
            'email' => $admin->email,
        ])->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'name' => 'Updated Admin',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)->put(route('admin.users.update', $admin), [
            'name' => 'Updated Admin',
            'email' => $admin->email,
            'role' => 'user',
        ])->assertSessionHasErrors('role');
    }

    public function test_regular_user_cannot_download_student_pdf_documents(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $student = Student::create([
            'name' => 'Protected Student',
            'age' => 20,
            'cnic' => '9876543210123',
            'email' => 'protected@example.test',
            'phone' => '03007654321',
            'pdf_file' => 'students/protected.pdf',
        ]);

        $this->actingAs($user)
            ->get(route('students.document', $student))
            ->assertForbidden();
    }

    public function test_student_can_upload_and_download_only_their_own_pdf_document(): void
    {
        Storage::fake();
        $student = Student::create([
            'name' => 'Document Owner',
            'age' => 20,
            'cnic' => '5555555555555',
            'email' => 'owner@example.test',
            'phone' => '03005555555',
        ]);
        $user = User::factory()->create(['role' => 'user', 'student_id' => $student->id]);

        $this->actingAs($user)->post(route('profile.document.update'), [
            'pdf_file' => UploadedFile::fake()->create('my-document.pdf', 100, 'application/pdf'),
        ])->assertSessionHas('success');

        $student->refresh();
        Storage::assertExists($student->pdf_file);
        $this->actingAs($user)->get(route('profile.document'))->assertOk();
    }

    public function test_student_can_download_their_own_profile_picture(): void
    {
        Storage::fake();
        Storage::put('students/my-photo.png', 'image data');
        $student = Student::create([
            'name' => 'Picture Owner',
            'age' => 20,
            'cnic' => '4444444444444',
            'email' => 'picture@example.test',
            'phone' => '03004444444',
            'profile_picture' => 'students/my-photo.png',
        ]);
        $user = User::factory()->create(['role' => 'user', 'student_id' => $student->id]);

        $this->actingAs($user)
            ->get(route('profile.picture.download'))
            ->assertOk();
    }
}
