<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Livewire\Frontend\About;
use App\Livewire\Frontend\CampaignShow;
use App\Livewire\Frontend\Campaigns;
use App\Livewire\Frontend\Contact;
use App\Livewire\Frontend\EventShow;
use App\Livewire\Frontend\Events;
use App\Livewire\Frontend\Gallery;
use App\Livewire\Frontend\GetInvolved;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\MotherShow;
use App\Livewire\Frontend\Mothers;
use App\Livewire\Frontend\ProgramShow;
use App\Livewire\Frontend\Programs;
use App\Livewire\Frontend\Team;
use App\Livewire\Frontend\Testimonials;
use App\Livewire\Frontend\TestimonyShow;
use App\Livewire\Frontend\UpdateShow;
use App\Livewire\Frontend\Updates;
use App\Livewire\Frontend\Videos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', Home::class)->name('home');
Route::get('/about-us', About::class)->name('backgroundDetails');
Route::get('/team', Team::class)->name('team');
Route::get('/our-programs', Programs::class)->name('showPrograms');
Route::get('/programs/{slug}', ProgramShow::class)->name('project');
Route::get('/campaigns', Campaigns::class)->name('campaigns');
Route::get('/campaigns/{slug}', CampaignShow::class)->name('campaign');
Route::get('/upcoming-events', Events::class)->name('upcomingEvents');
Route::get('/upcoming-events/{slug}', EventShow::class)->name('event');
Route::get('/Messages', function () {
    return redirect()->route('redirects');
})->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->name('Messages');
Route::get('/Gallery', Gallery::class)->name('gallery');
Route::get('/videos', Videos::class)->name('videos');
Route::get('/contacts', Contact::class)->name('contacts');
Route::get('/testimonials', Testimonials::class)->name('testimonials');
Route::get('/testimonials/{id}', TestimonyShow::class)->name('testimony');
Route::get('/mothers', Mothers::class)->name('mothers');
Route::get('/mothers/{slug}', MotherShow::class)->name('mother');
Route::get('/updates', Updates::class)->name('posts');
Route::get('/updates/{slug}', UpdateShow::class)->name('postSingle');
Route::get('/get-involved', GetInvolved::class)->name('getInvolved');

// Users Action
Route::get('/donate',[App\Http\Controllers\HomeController::class,'donate'])->name('donate');
Route::post('/saveDonation',[App\Http\Controllers\HomeController::class,'saveDonation'])->name('saveDonation');
Route::post('/mailDonation/{id}',[App\Http\Controllers\HomeController::class,'mailDonation'])->name('mailDonation');
Route::get('/deleteDonation/{id}',[App\Http\Controllers\HomeController::class,'deleteDonation'])->name('deleteDonation');

// Users Action
Route::get('/getMembers',[App\Http\Controllers\HomeController::class,'members'])->name('members');
Route::post('/saveMember',[App\Http\Controllers\HomeController::class,'saveMember'])->name('saveMember');
Route::post('/editMember/{id}',[App\Http\Controllers\HomeController::class,'editMember'])->name('editMember');
Route::get('/deleteMember/{id}',[App\Http\Controllers\HomeController::class,'deleteMember'])->name('deleteMember');

Route::get('/Volunteer',[App\Http\Controllers\HomeController::class,'volunteer'])->name('volunteer');
Route::get('/saveVol',[App\Http\Controllers\HomeController::class,'saveVol'])->name('saveVol');
Route::get('/deleteVol',[App\Http\Controllers\HomeController::class,'deleteVol'])->name('deleteVol');

Route::post('/sendMessage',[App\Http\Controllers\HomeController::class,'sendMessage'])->name('sendMessage');
Route::post('/resetGoalRaised/{id}',[App\Http\Controllers\CampainsController::class,'resetGoalRaised'])->name('resetGoalRaised');

// Route::get('/member',[App\Http\Controllers\HomeController::class,'member'])->name('member');

Route::middleware('admin:admin')->group(function(){
    Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('loginForm');
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');

});

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('admin/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');

    Route::get('/redirects', \App\Livewire\Admin\Dashboard::class)->name('redirects');
    Route::get('/webMessages', \App\Livewire\Admin\Dashboard::class)->name('webMessages');

    Route::get('/setting', \App\Livewire\Admin\Settings::class)->name('settings');
    Route::post('/saveSetting/{id}', [App\Http\Controllers\HomeController::class, 'saveSetting'])->name('saveSetting');

    Route::get('/page-headers', \App\Livewire\Admin\PageHeaders::class)->name('pageHeaders');
    Route::post('/page-headers', [App\Http\Controllers\PageHeaderController::class, 'update'])->name('updatePageHeaders');

    Route::get('/about', \App\Livewire\Admin\About::class)->name('about');
    Route::post('/saveAbout/{id}', [App\Http\Controllers\HomeController::class, 'saveAbout'])->name('saveAbout');

    Route::get('/aboutUs', \App\Livewire\Admin\Background::class)->name('background');
    Route::post('/saveBackg', [App\Http\Controllers\BackgroundController::class, 'saveBackg'])->name('saveBackg');

    Route::get('/homePage', [App\Http\Controllers\BackgroundController::class, 'homePage'])->name('homePage');
    Route::post('/saveHom', [App\Http\Controllers\BackgroundController::class, 'saveHom'])->name('saveHom');

    // Programs (legacy CRUD)
    Route::get('/progras', [App\Http\Controllers\ProgramController::class, 'index'])->name('programs');
    Route::post('/saveProgram', [App\Http\Controllers\ProgramController::class, 'store'])->name('saveProgram');
    Route::get('/editProgram/{id}', [App\Http\Controllers\ProgramController::class, 'edit'])->name('editProgram');
    Route::post('/updateProgram/{id}', [App\Http\Controllers\ProgramController::class, 'update'])->name('updateProgram');
    Route::get('/destroyProgram/{id}', [App\Http\Controllers\ProgramController::class, 'destroy'])->name('destroyProgram');

    // Activities / Projects
    Route::get('/get-projects', \App\Livewire\Admin\Projects::class)->name('getProjects');
    Route::post('/saveProject', [App\Http\Controllers\ProjectsController::class, 'store'])->name('saveProject');
    Route::get('/editProject/{id}', \App\Livewire\Admin\ProjectEdit::class)->name('editProject');
    Route::post('/updateProject/{id}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('updateProject');
    Route::get('/destroyProject/{id}', [App\Http\Controllers\ProjectsController::class, 'destroy'])->name('destroyProject');
    Route::post('/addProjectImage', [App\Http\Controllers\ProjectsController::class, 'addProjectImage'])->name('addProjectImage');
    Route::get('/deleteProjectImage/{id}', [App\Http\Controllers\ProjectsController::class, 'deleteProjectImage'])->name('deleteProjectImage');

    // Gallery
    Route::get('/images', \App\Livewire\Admin\Gallery::class)->name('images');
    Route::post('/saveGallery', [App\Http\Controllers\GalleryController::class, 'store'])->name('saveGallery');
    Route::get('/editGallery/{id}', \App\Livewire\Admin\GalleryEdit::class)->name('editGallery');
    Route::post('/updateGallery/{id}', [App\Http\Controllers\GalleryController::class, 'update'])->name('updateGallery');
    Route::get('/destroyGallery/{id}', [App\Http\Controllers\GalleryController::class, 'destroy'])->name('destroyGallery');

    // Slides
    Route::get('/slides', \App\Livewire\Admin\Slides::class)->name('slides');
    Route::post('/saveSlide', [App\Http\Controllers\SlidesController::class, 'store'])->name('saveSlide');
    Route::get('/editSlide/{id}', \App\Livewire\Admin\SlideEdit::class)->name('editSlide');
    Route::post('/updateSlide/{id}', [App\Http\Controllers\SlidesController::class, 'update'])->name('updateSlide');
    Route::get('/destroySlide/{id}', [App\Http\Controllers\SlidesController::class, 'destroy'])->name('destroySlide');

    // Events
    Route::get('/events', \App\Livewire\Admin\Events::class)->name('events');
    Route::post('/saveEvent', [App\Http\Controllers\EventController::class, 'store'])->name('saveEvent');
    Route::get('/editEvent/{id}', \App\Livewire\Admin\EventEdit::class)->name('editEvent');
    Route::post('/updateEvent/{id}', [App\Http\Controllers\EventController::class, 'update'])->name('updateEvent');
    Route::get('/destroyEvent/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->name('destroyEvent');

    // Team
    Route::get('/staff', \App\Livewire\Admin\Staff::class)->name('staff');
    Route::post('/saveStaff', [App\Http\Controllers\StaffController::class, 'store'])->name('saveStaff');
    Route::get('/editStaff/{id}', \App\Livewire\Admin\StaffEdit::class)->name('editStaff');
    Route::post('/updateStaff/{id}', [App\Http\Controllers\StaffController::class, 'update'])->name('updateStaff');
    Route::get('/destroyStaff/{id}', [App\Http\Controllers\StaffController::class, 'destroy'])->name('destroyStaff');

    // Testimonies
    Route::get('/getTestimonials', \App\Livewire\Admin\Testimonials::class)->name('getTestimonials');
    Route::post('/saveTestimony', [App\Http\Controllers\TestimoniesController::class, 'store'])->name('saveTestimony');
    Route::get('/editTestimony/{id}', \App\Livewire\Admin\TestimonyEdit::class)->name('editTestimony');
    Route::post('/updateTestimony/{id}', [App\Http\Controllers\TestimoniesController::class, 'update'])->name('updateTestimony');
    Route::get('/destroyTestimony/{id}', [App\Http\Controllers\TestimoniesController::class, 'destroy'])->name('destroyTestimony');

    // Partners
    Route::get('/partner', \App\Livewire\Admin\Partners::class)->name('partner');
    Route::post('/savePartner', [App\Http\Controllers\PartnersController::class, 'store'])->name('savePartner');
    Route::get('/editPartner/{id}', \App\Livewire\Admin\PartnerEdit::class)->name('editPartner');
    Route::post('/updatePartner/{id}', [App\Http\Controllers\PartnersController::class, 'update'])->name('updatePartner');
    Route::get('/destroyPartner/{id}', [App\Http\Controllers\PartnersController::class, 'destroy'])->name('destroyPartner');

    // Mothers
    Route::get('/admin-mothers', \App\Livewire\Admin\Mothers::class)->name('mothersAdmin');
    Route::post('/saveMother', [App\Http\Controllers\MothersController::class, 'store'])->name('saveMother');
    Route::get('/editMother/{id}', \App\Livewire\Admin\MotherEdit::class)->name('editMother');
    Route::post('/updateMother/{id}', [App\Http\Controllers\MothersController::class, 'update'])->name('updateMother');
    Route::get('/destroyMother/{id}', [App\Http\Controllers\MothersController::class, 'destroy'])->name('destroyMother');

    // Videos
    Route::get('/admin-videos', \App\Livewire\Admin\Videos::class)->name('videosAdmin');
    Route::post('/saveVideo', [App\Http\Controllers\VideosController::class, 'store'])->name('saveVideo');
    Route::get('/editVideo/{id}', \App\Livewire\Admin\VideoEdit::class)->name('editVideo');
    Route::post('/updateVideo/{id}', [App\Http\Controllers\VideosController::class, 'update'])->name('updateVideo');
    Route::get('/destroyVideo/{id}', [App\Http\Controllers\VideosController::class, 'destroy'])->name('destroyVideo');

    // Campaigns
    Route::get('/get-campaigns', \App\Livewire\Admin\Campaigns::class)->name('campainCrud');
    Route::post('/saveCampaign', [App\Http\Controllers\CampainsController::class, 'store'])->name('saveCampain');
    Route::get('/editCampaign/{id}', \App\Livewire\Admin\CampaignEdit::class)->name('editCampain');
    Route::post('/updateCampaign/{id}', [App\Http\Controllers\CampainsController::class, 'update'])->name('updateCampain');
    Route::post('/updateRaised/{id}', [App\Http\Controllers\CampainsController::class, 'updateRaised'])->name('updateRaised');
    Route::get('/deleteCampaign/{id}', [App\Http\Controllers\CampainsController::class, 'destroy'])->name('deleteCampain');

    // Updates / News
    Route::get('/blogs', \App\Livewire\Admin\News::class)->name('blog.index');
    Route::post('/saveBlog', [App\Http\Controllers\NewsController::class, 'store'])->name('saveBlog');
    Route::get('/blog/{id}', \App\Livewire\Admin\NewsEdit::class)->name('editBlog');
    Route::post('/updateBlog/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('updateBlog');
    Route::get('/deleteBlog/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('deleteBlog');
    Route::get('/blogs/{blog}/publish', [App\Http\Controllers\NewsController::class, 'publish'])->name('publishBlog');

    Route::get('/AllMembers', [App\Http\Controllers\MembersController::class, 'AllMembers'])->name('AllMembers');
    Route::get('/saveMemb', [App\Http\Controllers\MembersController::class, 'saveMemb'])->name('saveMemb');

    // Emails
    Route::get('/messageReply/{id}', \App\Livewire\Admin\MessageReply::class)->name('messageReply');
    Route::post('/sendReply', [App\Http\Controllers\HomeController::class, 'sendReply'])->name('sendReply');
});


