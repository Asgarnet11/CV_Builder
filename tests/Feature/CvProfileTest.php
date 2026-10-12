<?php

namespace Tests\Feature;

use App\Models\CvProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CvProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AC-02: Unauthenticated user cannot access cv-profile edit page.
     */
    public function test_guest_is_redirected_to_login_when_accessing_cv_profile_page(): void
    {
        $response = $this->get('/cv-profile');

        $response->assertRedirect('/login');
    }

    /**
     * AC-02: Unauthenticated user cannot perform PUT on cv-profile endpoint.
     */
    public function test_guest_is_redirected_to_login_when_updating_cv_profile(): void
    {
        $response = $this->put('/cv-profile', [
            'full_name' => 'Budi Santoso',
        ]);

        $response->assertRedirect('/login');
    }

    /**
     * AC-03: Validation requires full_name.
     */
    public function test_validation_requires_full_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/cv-profile', [
            'full_name' => '',
        ]);

        $response->assertSessionHasErrors('full_name');
    }

    /**
     * AC-03: Validation rejects non-image photo files (e.g., pdf or docx).
     */
    public function test_validation_rejects_non_image_photo_files(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $fakePdf = UploadedFile::fake()->create('document.pdf', 500, 'application/pdf');

        $response = $this->actingAs($user)->put('/cv-profile', [
            'full_name' => 'Budi Santoso',
            'photo' => $fakePdf,
        ]);

        $response->assertSessionHasErrors('photo');
    }

    /**
     * AC-03: Validation rejects photos exceeding 2048 KB (2 MB).
     */
    public function test_validation_rejects_photo_exceeding_2mb(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $largePhoto = UploadedFile::fake()->image('profile_huge.jpg')->size(3000);

        $response = $this->actingAs($user)->put('/cv-profile', [
            'full_name' => 'Budi Santoso',
            'photo' => $largePhoto,
        ]);

        $response->assertSessionHasErrors('photo');
    }

    /**
     * AC-04: Uploading new photo deletes the old photo from storage disk.
     */
    public function test_uploading_new_photo_deletes_previous_photo_from_disk(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $photo1 = UploadedFile::fake()->image('photo1.jpg');
        $this->actingAs($user)->put('/cv-profile', [
            'full_name' => 'Budi Santoso',
            'photo' => $photo1,
        ]);

        $profile = CvProfile::where('user_id', $user->id)->firstOrFail();
        $this->assertNotNull($profile->photo);
        $firstPath = $profile->photo;
        Storage::disk('public')->assertExists($firstPath);

        // Upload photo 2
        $photo2 = UploadedFile::fake()->image('photo2.png');
        $this->actingAs($user)->put('/cv-profile', [
            'full_name' => 'Budi Santoso',
            'photo' => $photo2,
        ]);

        $profile->refresh();
        $secondPath = $profile->photo;
        $this->assertNotEquals($firstPath, $secondPath);
        Storage::disk('public')->assertMissing($firstPath);
        Storage::disk('public')->assertExists($secondPath);
    }

    /**
     * AC-05: Mechanism upsert: first submission creates record, second updates existing record without duplicate.
     */
    public function test_upsert_mechanism_creates_new_record_then_updates_without_duplication(): void
    {
        $user = User::factory()->create();

        // 1st submission
        $response1 = $this->actingAs($user)->put('/cv-profile', [
            'full_name' => 'Budi Santoso',
            'headline' => 'Junior Web Developer',
            'phone' => '+6281234567890',
            'email_cv' => 'budi@example.com',
            'address' => 'Jakarta Selatan',
            'summary' => 'Antusias belajar Laravel.',
            'linkedin_url' => 'https://linkedin.com/in/budisantoso',
            'portfolio_url' => 'https://budisantoso.dev',
        ]);

        $response1->assertRedirect(route('cv-profile.edit'));
        $response1->assertSessionHas('status', 'Biodata CV berhasil disimpan!');

        $this->assertDatabaseCount('cv_profiles', 1);
        $this->assertDatabaseHas('cv_profiles', [
            'user_id' => $user->id,
            'full_name' => 'Budi Santoso',
            'headline' => 'Junior Web Developer',
            'email_cv' => 'budi@example.com',
        ]);

        $initialId = CvProfile::where('user_id', $user->id)->value('id');

        // 2nd submission (update)
        $response2 = $this->actingAs($user)->put('/cv-profile', [
            'full_name' => 'Budi Santoso, S.Kom.',
            'headline' => 'Mid-Level Full Stack Developer',
            'phone' => '+6289999999999',
            'email_cv' => 'budi.pro@example.com',
            'address' => 'Bandung, Jawa Barat',
            'summary' => 'Berpengalaman 2 tahun.',
            'linkedin_url' => 'https://linkedin.com/in/budisantoso-updated',
            'portfolio_url' => 'https://portfolio.budisantoso.dev',
        ]);

        $response2->assertRedirect(route('cv-profile.edit'));
        $this->assertDatabaseCount('cv_profiles', 1);

        $updatedProfile = CvProfile::where('user_id', $user->id)->first();
        $this->assertEquals($initialId, $updatedProfile->id);
        $this->assertEquals('Budi Santoso, S.Kom.', $updatedProfile->full_name);
        $this->assertEquals('Mid-Level Full Stack Developer', $updatedProfile->headline);
        $this->assertEquals('budi.pro@example.com', $updatedProfile->email_cv);
    }

    /**
     * FR-04.2 & UI: Form displays fallback to user name and email when no CV profile exists yet.
     */
    public function test_edit_page_displays_fallback_name_and_email_for_new_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Ahmad Dahlan',
            'email' => 'ahmad@example.com',
        ]);

        $response = $this->actingAs($user)->get('/cv-profile');

        $response->assertStatus(200);
        $response->assertSee('Ahmad Dahlan');
        $response->assertSee('ahmad@example.com');
        $response->assertSee('No Photo');
    }
}
