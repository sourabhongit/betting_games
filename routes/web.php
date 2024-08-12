<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FrontendAuth;
use App\Http\Controllers\BetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\HeadAndTailLogController;
use App\Http\Controllers\Frontend\GuestController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DragonTigerBetController;
use App\Http\Controllers\DragonTigerLogController;
use App\Http\Controllers\WalletController as BackendWalletController;
use App\Http\Controllers\Frontend\WalletController as FrontendWalletController;

require __DIR__ . '/auth.php';

// Backend Routes
Route::group(['middleware' => ['auth']], function () {
    Route::post('user-config/update', [DashboardController::class, 'configUpdate'])->name('user.configUpdate');
    Route::post('user/change/password', [DashboardController::class, 'changePassword'])->name('user.changePassword');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

    Route::resource('user', UserController::class);
    Route::delete('user/{id}/force-delete', [UserController::class, 'forceDelete'])->name('user.forceDelete');
    Route::post('user/assign-role', [UserController::class, 'assignRole'])->name('user.assignrole');
    Route::post('user/revoke-role', [UserController::class, 'revokeRole'])->name('user.revokerole');

    // Role Routes
    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::patch('role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::post('role/fetchPermission', [RoleController::class, 'fetchPermission'])->name('role.fetchPermission');

    // Permission Routes
    Route::get('permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::patch('permission/{id}', [PermissionController::class, 'update'])->name('permission.update');

    // User Wallet
    Route::controller(BackendWalletController::class)->prefix('user/wallet/')->name('user.wallet.')->group(function () {
        Route::get('list', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{id}/transactions', 'walletTransactions')->name('transactions');
    });

    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');

    // head and tail game routes
    Route::controller(HeadAndTailLogController::class)->prefix('game/log/')->name('game.log.')->group(function () {
        Route::get('list', 'index')->name('index');
        Route::post('store', 'store')->name('store');
    });
    Route::get('head/tail/results', [BetController::class, 'index'])->name('head.tail.results.index');
    
    Route::post('head/tail/result/update', [BetController::class, 'ResultUpdate'])->name('head.tail.update.result');
    Route::get('running/head/tail/data/{id}', [BetController::class, 'HeadTailRunningGameData'])->name('head.tail.running.game.data');
    
    // Dragon tiger game routes
    Route::get('dragon/tiger/results', [DragonTigerBetController::class, 'index'])->name('dragon.tiger.results.index');
    Route::get('running/game/data/{id}', [DragonTigerBetController::class, 'RunningGameData'])->name('dragon.tiger.running.game.data');
    Route::controller(DragonTigerLogController::class)->prefix('dragon/tiger/log/')->name('dragon.tiger.log.')->group(function () {
        Route::get('list', 'index')->name('index');
        Route::post('store', 'store')->name('store');
    });
    Route::post('game/result/update', [DragonTigerBetController::class, 'ResultUpdate'])->name('dragon.tiger.update.result');
    Route::get('dragon/tiger/results', [DragonTigerBetController::class, 'index'])->name('dragon.tiger.results.index');

});

// Frontend Routes
Route::middleware([FrontendAuth::class])->group(function () {
    Route::get('home', [GuestController::class, 'home'])->name('home');
    Route::get('profile', [GuestController::class, 'profile'])->name('profile');
    Route::get('refer/and/earn', [GuestController::class, 'referAndEarn'])->name('refer.and.earn');
    Route::get('logout', [AuthController::class, 'destroy'])->name('user.logout');

    // Payment route
    Route::controller(FrontendWalletController::class)->group(function () {
        Route::get('wallet', 'wallet')->name('wallet');
        Route::get('add/amount', 'addAmount')->name('user.add.amount');
        Route::post('request/wallet/amount/store', 'walletAmountStore')->name('user.request.wallet.amount.store');
        Route::get('transaction/history', 'transactionHistory')->name('transaction.history');
    });

    // Head and tail game routes
    Route::get('play/head/tail/ms60000&m1', [GuestController::class, 'headAndTail'])->name('head.and.tail');
    Route::post('head/tail/place/bet', [BetController::class, 'PlaceBet'])->name('head.tail.place.bet');
    Route::post('game/log/result', [HeadAndTailLogController::class, 'HeadAndTailLogResult'])->name('game.log.result');
    Route::post('head/tail/wallet/update', [FrontendWalletController::class, 'HeadTailWalletUpdate'])->name('head.tail.wallet.update');
    
    // Dragon tiger game routes
    Route::get('play/dragon/tiger/ms60000&m1', [GuestController::class, 'DragonTigerPlay'])->name('dragon.tiger.play');
    Route::post('dragon/tiger/place/bet', [DragonTigerBetController::class, 'PlaceBet'])->name('dragon.tiger.place.bet');
    Route::post('dragon/tiger/log/result', [DragonTigerLogController::class, 'DragonTigerLogResult'])->name('dragon.tiger.log.result');
    Route::post('dragon/tiger/wallet/update', [FrontendWalletController::class, 'DragonTigerWalletUpdate'])->name('dragon.tiger.wallet.update');

});


// Redirect user on 404
Route::fallback(function () {
    $user = Auth::user();

    if ($user && $user->hasRole('admin')) {
        return redirect()->route('dashboard')->with('error', 'An error occurred. Please try again.');
    } elseif ($user && $user->hasRole('player')) {
        return redirect()->route('home')->with('error', 'An error occurred. Please try again.');
    }

    // Default fallback if user is not authenticated or does not have a recognized role
    return redirect()->route('user.login')->with('error', 'An error occurred. Please try again.');
});
