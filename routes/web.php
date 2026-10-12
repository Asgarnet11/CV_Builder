<?php

use App\Http\Controllers\AiAssistantController;
use App\Http\Controllers\CvPreviewController;
use App\Http\Controllers\CvProfileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicCvController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public CV Route
Route::get('/cv/{slug}', [PublicCvController::class, 'show'])->name('public.cv');

Route::middleware('auth')->group(function () {
    Route::get('/cv-profile', [CvProfileController::class, 'edit'])->name('cv-profile.edit');
    Route::put('/cv-profile', [CvProfileController::class, 'update'])->name('cv-profile.update');
    Route::post('/cv-profile/photo', [CvProfileController::class, 'updatePhoto'])->name('cv-profile.update-photo');

    Route::get('/cv-preview', [CvPreviewController::class, 'show'])->name('cv-preview.show');
    Route::get('/cv-preview/download', [CvPreviewController::class, 'downloadPdf'])->name('cv-preview.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/education/reorder', [EducationController::class, 'reorder'])->name('education.reorder');
    Route::resource('education', EducationController::class)->except(['show']);

    Route::post('/experience/reorder', [ExperienceController::class, 'reorder'])->name('experience.reorder');
    Route::resource('experience', ExperienceController::class)->except(['show']);

    Route::post('/skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');
    Route::resource('skills', SkillController::class)->except(['show']);

    Route::post('/ai/generate-summary', [AiAssistantController::class, 'generateSummary'])->name('ai.generate-summary');
    Route::post('/ai/generate-bullet-points', [AiAssistantController::class, 'generateBulletPoints'])->name('ai.generate-bullet-points');
});

require __DIR__.'/auth.php';
