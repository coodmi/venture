<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
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
use App\Http\Controllers\Admin\SettingsController as AdminSettings;
use App\Http\Controllers\Admin\MembershipController as AdminMembership;
use App\Http\Controllers\Admin\InvestorProfileController as AdminInvestorProfile;
use App\Http\Controllers\Admin\SeekerProfileController as AdminSeekerProfile;

use App\Http\Controllers\StartupController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\InvestorPageController;
use App\Http\Controllers\MembershipController;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/investment', [InvestmentController::class, 'index'])->name('investment.index');
Route::get('/investment/{opportunity:slug}', [InvestmentController::class, 'show'])->name('investment.show');
Route::get('/investors', [InvestorPageController::class, 'index'])->name('investors.index');
Route::get('/investors/{id}', [InvestorPageController::class, 'show'])->name('investors.show');
Route::get('/startups', [StartupController::class, 'index'])->name('startups.index');
Route::get('/startups/{opportunity:slug}', [StartupController::class, 'show'])->name('startups.show');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/demo/{slug}', [EventController::class, 'demo'])->name('events.demo');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register')->middleware('auth');

// News & Media
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/notices', [NewsController::class, 'notices'])->name('notices.index');

// Membership
Route::get('/membership/plans', [MembershipController::class, 'plans'])->name('membership.plans');
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

    // Investor Profiles
    Route::get('/investors', [AdminInvestorProfile::class, 'index'])->name('investors.index');
    Route::get('/investors/{investor}/edit', [AdminInvestorProfile::class, 'edit'])->name('investors.edit');
    Route::put('/investors/{investor}', [AdminInvestorProfile::class, 'update'])->name('investors.update');

    // Seeker / Startup Profiles
    Route::get('/startups-profiles', [AdminSeekerProfile::class, 'index'])->name('startups-profiles.index');
    Route::get('/startups-profiles/{startup}/edit', [AdminSeekerProfile::class, 'edit'])->name('startups-profiles.edit');
    Route::put('/startups-profiles/{startup}', [AdminSeekerProfile::class, 'update'])->name('startups-profiles.update');

    // Opportunities
    Route::get('/opportunities', [AdminOpportunity::class, 'index'])->name('opportunities.index');
    Route::get('/opportunities/create', [AdminOpportunity::class, 'create'])->name('opportunities.create');
    Route::post('/opportunities', [AdminOpportunity::class, 'store'])->name('opportunities.store');
    Route::get('/opportunities/{opportunity}/edit', [AdminOpportunity::class, 'edit'])->name('opportunities.edit');
    Route::put('/opportunities/{opportunity}', [AdminOpportunity::class, 'update'])->name('opportunities.update');
    Route::delete('/opportunities/{opportunity}', [AdminOpportunity::class, 'destroy'])->name('opportunities.destroy');
    Route::get('/opportunities/{opportunity}', [AdminOpportunity::class, 'show'])->name('opportunities.show');
    Route::patch('/opportunities/{opportunity}/status', [AdminOpportunity::class, 'updateStatus'])->name('opportunities.status');
    Route::patch('/opportunities/{opportunity}/featured', [AdminOpportunity::class, 'toggleFeatured'])->name('opportunities.featured');
    Route::patch('/opportunities/{opportunity}/hot-deal', [AdminOpportunity::class, 'toggleHotDeal'])->name('opportunities.hot-deal');

    // Memberships
    Route::get('/memberships', [AdminMembership::class, 'index'])->name('memberships.index');
    Route::get('/memberships/plans', [AdminMembership::class, 'plans'])->name('memberships.plans');
    Route::get('/memberships/{membership}', [AdminMembership::class, 'show'])->name('memberships.show');
    Route::patch('/memberships/{membership}/status', [AdminMembership::class, 'updateStatus'])->name('memberships.status');

    // News & Media
    Route::resource('/news', AdminNews::class);

    // Events
    Route::resource('/events', AdminEvent::class);
    Route::get('/events/{event}/registrations', [AdminEvent::class, 'registrations'])->name('events.registrations');

    // Settings
    Route::get('/settings', [AdminSettings::class, 'general'])->name('settings.general');
    Route::post('/settings', [AdminSettings::class, 'updateGeneral'])->name('settings.update');
    Route::get('/settings/header', [AdminSettings::class, 'header'])->name('settings.header');
    Route::post('/settings/header', [AdminSettings::class, 'updateHeader'])->name('settings.header.update');
    Route::get('/settings/hero', [AdminSettings::class, 'heroSlider'])->name('settings.hero');
    Route::post('/settings/hero', [AdminSettings::class, 'updateHeroSlider'])->name('settings.hero.update');
    Route::get('/settings/stats', [AdminSettings::class, 'stats'])->name('settings.stats');
    Route::post('/settings/stats', [AdminSettings::class, 'updateStats'])->name('settings.stats.update');
    Route::get('/settings/testimonials', [AdminSettings::class, 'testimonials'])->name('settings.testimonials');
    Route::post('/settings/testimonials', [AdminSettings::class, 'storeTestimonial'])->name('settings.testimonials.store');
    Route::get('/settings/about', [AdminSettings::class, 'about'])->name('settings.about');
    Route::post('/settings/about', [AdminSettings::class, 'updateAbout'])->name('settings.about.update');
    Route::get('/settings/startups-page', [AdminSettings::class, 'startupsPage'])->name('settings.startups');
    Route::post('/settings/startups-page', [AdminSettings::class, 'updateStartupsPage'])->name('settings.startups.update');

    // Startup Management
    Route::resource('/startups', \App\Http\Controllers\Admin\StartupController::class);
    Route::patch('/startups/{startup}/featured', [\App\Http\Controllers\Admin\StartupController::class, 'toggleFeatured'])->name('startups.featured');
    Route::patch('/startups/{startup}/hot-deal', [\App\Http\Controllers\Admin\StartupController::class, 'toggleHotDeal'])->name('startups.hot-deal');
    Route::post('/startups/bulk-publish', [\App\Http\Controllers\Admin\StartupController::class, 'bulkPublish'])->name('startups.bulk-publish');
    Route::post('/startups/bulk-unpublish', [\App\Http\Controllers\Admin\StartupController::class, 'bulkUnpublish'])->name('startups.bulk-unpublish');
    Route::delete('/startups/{startup}/logo', [\App\Http\Controllers\Admin\StartupController::class, 'deleteLogo'])->name('startups.delete-logo');
    Route::delete('/startups/{startup}/cover', [\App\Http\Controllers\Admin\StartupController::class, 'deleteCoverImage'])->name('startups.delete-cover');

    // Startup Categories
    Route::resource('/startup-categories', \App\Http\Controllers\Admin\StartupCategoryController::class);
});
