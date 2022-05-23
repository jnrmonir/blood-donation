<?php

use App\Models\Post;
use App\Models\User;
use App\Http\Livewire\Blog;
use App\Models\BloodRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Livewire\Chat\Chat;
use App\Http\Livewire\BloodDonar;

use App\Http\Livewire\SingleBlog;
use App\Http\Livewire\Admin\AllCity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Livewire\Admin\AllPosts;
use App\Http\Livewire\Admin\AllRoles;
use App\Http\Livewire\Admin\AllUsers;
use App\Http\Livewire\RequestedBlood;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AllStates;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\RequestForBlood;
use App\Http\Livewire\Admin\AllComment;
use App\Http\Livewire\Admin\AllCountry;
use App\Http\Livewire\Admin\AllReports;
use App\Http\Livewire\SingleBloodDonar;
use App\Http\Livewire\Admin\AllCategory;
use App\Http\Livewire\Admin\AllFeedback;
use Stevebauman\Location\Facades\Location;
use App\Http\Livewire\Auth\AllNotification;
use App\Http\Livewire\SingleRequestedBlood;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\backend\UserController;
use App\Http\Livewire\Auth\PeopleRequestedBloodToYou;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Livewire\Admin\RequestedBlood as AllRequestedBlood;
use App\Http\Livewire\Auth\RequestedBlood as AuthRequestedBlood;
use App\Models\Chat as ModelsChat;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function () {
    //  dd(BloodRequest::with(['bloodGroup','fromUser'])->where('to_user_id',Auth::id())->latest()->paginate(10));
    //  $requestedBloods = BloodRequest::with(['bloodGroup','fromUser'])->latest()->paginate(5);
    //  $bloodDonars = User::with(['profile','bloodGroup'])->bloodDonar()->whereHas('profile')->whereHas('bloodRequestAgreement')->latest()->paginate(5);
     $posts = Post::latest()->paginate(8);
     return view('welcome',compact('posts'));
 })->name('home');

 Route::get('chat/{slug?}',Chat::class)->name('chat');

// frontend requested blood route
Route::get('/request-for-blood',RequestForBlood::class)->name('request_for_blood');

// frontend requested blood route
Route::get('/requested-bloods',RequestedBlood::class)->name('requested_blood');
Route::get('/requested-blood/{slug?}',SingleRequestedBlood::class)->name('single_requested_blood');


// frontend blood donar route
Route::get('/blood-donars',BloodDonar::class)->name('blood_donar');
Route::get('/blood-donar/{slug?}',SingleBloodDonar::class)->name('blood_donar_profile');

// frontend blog route
Route::get('/blogs',Blog::class)->name('blog');
Route::get('/blog/{slug?}',SingleBlog::class)->name('single_blog');


Route::middleware(['auth:sanctum'])->get('/profile', function () {
     $user = User::find(Auth::id());
     $total_blood_requests = $user->bloodRequests()->paginate(2);
     $total_blood_donations = $user->bloodRequestAgreement()->where('approved',1)->where('status',1)->get();
     $total_blood_donate_requests = $user->bloodRequestAgreement()->get();
     $total_blood_donate_agreements =  $user->bloodRequestAgreement()->where('approved',1)->where('status',0)->get();
     $peopleRequestedBloods = BloodRequest::with(['fromUser','bloodGroup'])->where('to_user_id',Auth::id())->paginate(6);

     return view('dashboard',compact('user','total_blood_requests','total_blood_donations','total_blood_donate_requests','total_blood_donate_agreements','peopleRequestedBloods'));
 })->name('profile');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboared');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// authenticate user relatied route
Route::middleware(['auth:sanctum'])->get('/user/{slug?}/requested-blood',AuthRequestedBlood::class)->name('auth.requested_blood');
Route::middleware(['auth:sanctum'])->get('/user/{slug?}/people-requested-blood-to-you',PeopleRequestedBloodToYou::class)->name('auth.people_requested_blood_to_you');
Route::middleware(['auth:sanctum'])->get('/user/{slug?}/notifications',AllNotification::class)->name('auth.notifications');


// frontend site inforamtion related route
Route::get('/about-us',function(){
    return view('frontend.about');
})->name('about_us');

Route::get('/support-us',function(){
    return view('frontend.support');
})->name('support');

Route::get('/contact-us',function(){
    return view('frontend.contact-us');
})->name('contact_us');

Route::get('/terms-&-conditions',function(){
    return view('frontend.terms');
})->name('terms');

Route::get('/privacy-&-policy',function(){
    return view('frontend.privacy');
})->name('privacy');


// data passing navigation with view composer
View::composer('navigation-menu', function ($view) {
    $user_notifications = Notification::where('user_id',Auth::id())->where('status',0)->latest()->paginate(8);
    $user_messages = ModelsChat::select('id','to_id','from_id','body','updated_at')->where('to_id',Auth::id())->where('seen',0)->with('fromUser')->latest()->get()->unique('from_id');
    // dd($user_messages);
    return $view->with(['user_notifications' => $user_notifications,'user_messages' => $user_messages]);
});



// admin all of route route
Route::group(['prefix' => 'admin','as' => 'admin.', 'middleware' => ['auth:sanctum', 'verified','admin']], function()
{
        Route::get('/dashboard',Dashboard::class)->name('dashboard');
        Route::get('/all-users',AllUsers::class)->name('all_users');
        Route::get('/all-category',AllCategory::class)->name('all_category');
        Route::get('/all-requested-blood',AllRequestedBlood::class)->name('all_requested_blood');
        Route::get('/all-posts',AllPosts::class)->name('all_posts');
        Route::get('/all-reports',AllReports::class)->name('all_reports');
        Route::get('/all-feedbacks',AllFeedback::class)->name('all_feedback');
        Route::get('/all-comments',AllComment::class)->name('all_comments');
        Route::get('/all-country',AllCountry::class)->name('all_country');
        Route::get('/all-states',AllStates::class)->name('all_states');
        Route::get('/all-city',AllCity::class)->name('all_city');


});

Route::get('sitemap.xml',function(Request $r){
        $posts = Post::latest()->get();
        $bloodDonars = User::where('role_id',2)->get();
        $requestedBloods = BloodRequest::latest()->get();

        return response()->view('sitemap', compact('posts','bloodDonars','requestedBloods'))
          ->header('Content-Type', 'text/xml');
})->name('sitemap');



