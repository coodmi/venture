<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Investor\DashboardController as InvestorDashboard;
use App\Http\Controllers\Investor\ProfileController as InvestorProfile;
use App\Http\Controllers\Investor\OpportunityController as InvestorOpportunity;
use App\Http\Controllers\Seeker\DashboardController as SeekerDashboard;
use App\Http\Controllers\Seeker\ProfileController as SeekerProfile;
use App\Http\Controllers\Seeker\OpportunityController as SeekerOpportunity;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\OpportunityController as AdminOpportunity;
use App\Http\Controllers\Admin\NewsController as AdminNews;
use App\Http\Controllers\Admin\EventController as AdminEvent;
use App\Http\Controllers\Admin\MembershipController as AdminMembership;
use App\Http\Controllers\Admin\SettingsController as AdminSettings;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/demo/{slug}', [EventController::class, 'demo'])->name('events.demo');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

// News & Media
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/notices', [NewsController::class, 'notices'])->name('notices.index');

// Membership
Route::get('/membership', [MembershipController::class, 'plans'])->name('membership.plans');
Route::middleware('auth')->group(function () {
    Route::get('/membership/apply/{plan:slug}', [MembershipController::class, 'apply'])->name('membership.apply');
    Route::post('/membership/apply/{plan:slug}', [MembershipController::class, 'store'])->name('membership.store');
    Route::get('/membership/status', [MembershipController::class, 'status'])->name('membership.status');
});

// ─── Auth Routes ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register/investor', [RegisterController::class, 'showInvestorForm'])->name('register.investor');
    Route::post('/register/investor', [RegisterController::class, 'registerInvestor']);
    Route::get('/register/seeker', [RegisterController::class, 'showSeekerForm'])->name('register.seeker');
    Route::post('/register/seeker', [RegisterController::class, 'registerSeeker']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Investor Routes ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:investor'])->prefix('investor')->name('investor.')->group(function () {
    Route::get('/dashboard', [InvestorDashboard::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [InvestorProfile::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [InvestorProfile::class, 'update'])->name('profile.update');
    Route::get('/opportunities', [InvestorOpportunity::class, 'index'])->name('opportunities.index');
    Route::get('/opportunities/{opportunity:slug}', [InvestorOpportunity::class, 'show'])->name('opportunities.show');
    Route::post('/opportunities/{opportunity}/action', [InvestorOpportunity::class, 'action'])->name('opportunities.action');
});

// ─── Seeker Routes ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerDashboard::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [SeekerProfile::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [SeekerProfile::class, 'update'])->name('profile.update');
    Route::resource('/opportunities', SeekerOpportunity::class);
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminUser::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUser::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/status', [AdminUser::class, 'updateStatus'])->name('users.status');

    // Opportunities
    Route::get('/opportunities', [AdminOpportunity::class, 'index'])->name('opportunities.index');
    Route::get('/opportunities/{opportunity}', [AdminOpportunity::class, 'show'])->name('opportunities.show');
    Route::patch('/opportunities/{opportunity}/status', [AdminOpportunity::class, 'updateStatus'])->name('opportunities.status');
    Route::patch('/opportunities/{opportunity}/featured', [AdminOpportunity::class, 'toggleFeatured'])->name('opportunities.featured');
    Route::patch('/opportunities/{opportunity}/hot-deal', [AdminOpportunity::class, 'toggleHotDeal'])->name('opportunities.hot-deal');

    // News & Media
    Route::resource('/news', AdminNews::class);

    // Events
    Route::resource('/events', AdminEvent::class);
    Route::get('/events/{event}/registrations', [AdminEvent::class, 'registrations'])->name('events.registrations');

    // Memberships
    Route::get('/memberships', [AdminMembership::class, 'index'])->name('memberships.index');
    Route::get('/memberships/plans', [AdminMembership::class, 'plans'])->name('memberships.plans');
    Route::get('/memberships/{membership}', [AdminMembership::class, 'show'])->name('memberships.show');
    Route::patch('/memberships/{membership}/status', [AdminMembership::class, 'updateStatus'])->name('memberships.status');

    // Settings
    Route::get('/settings', [AdminSettings::class, 'general'])->name('settings.general');
    Route::post('/settings', [AdminSettings::class, 'updateGeneral'])->name('settings.update');
    Route::get('/settings/header', [AdminSettings::class, 'header'])->name('settings.header');
    Route::post('/settings/header', [AdminSettings::class, 'updateHeader'])->name('settings.header.update');
    Route::get('/settings/stats', [AdminSettings::class, 'stats'])->name('settings.stats');
    Route::post('/settings/stats', [AdminSettings::class, 'updateStats'])->name('settings.stats.update');
    Route::get('/settings/testimonials', [AdminSettings::class, 'testimonials'])->name('settings.testimonials');
    Route::post('/settings/testimonials', [AdminSettings::class, 'storeTestimonial'])->name('settings.testimonials.store');
    Route::get('/settings/about', [AdminSettings::class, 'about'])->name('settings.about');
    Route::post('/settings/about', [AdminSettings::class, 'updateAbout'])->name('settings.about.update');
});
