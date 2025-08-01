<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatParticipantController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\InterestPlaceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouteCommentController;
use App\Http\Controllers\RouteRatingController;
use App\Http\Controllers\SavedTravelRouteController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TravelRouteController;
use App\Http\Controllers\UserChallengeController;
use App\Http\Controllers\UserCustomPlaceController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthController::class, 'login']);

//Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResources([
    'roles'             => RoleController::class,
    'users'             => UserController::class,
    'profiles'          => ProfileController::class,
    'personalizations'  => PersonalizationController::class,
    'statistics'        => StatisticController::class,
    'media'             => MediaController::class,
    'announcements'     => AnnouncementController::class,
    'rewards'           => RewardController::class,
    'challenges'        => ChallengeController::class,
    'user_challenges'   => UserChallengeController::class,
    'travel_routes'     => TravelRouteController::class,
    'route_ratings'     => RouteRatingController::class,
    'route_comments'    => RouteCommentController::class,
    'saved_travel_routes' => SavedTravelRouteController::class,
    'interest_places'   => InterestPlaceController::class,
    'user_custom_places' => UserCustomPlaceController::class,
    'configurations'    => ConfigurationController::class,
    'chats'             => ChatController::class,
    'messages'          => MessageController::class,
    'chat_participants' => ChatParticipantController::class,
    'followers'         => FollowerController::class,
]);
});




// Route::prefix('v1')->group(function () {
//     // Alias /v1/me y compatibilidad (puedes dejar /me fuera si quieres un redirect global)
//     Route::middleware('auth:sanctum')->group(function () {
//         Route::get('/me', fn(Request $r) => $r->user())->name('me'); // “yo”
//         Route::get('/user', fn(Request $r) => $r->user())->name('user.self'); // equivalente explícito

//         // Singletons del usuario autenticado
//         Route::get('/user/profile', [ProfileController::class, 'showSelf'])->name('user.profile.show');
//         Route::put('/user/profile', [ProfileController::class, 'updateSelf'])->name('user.profile.update');

//         Route::get('/user/personalization', [PersonalizationController::class, 'showSelf'])->name('user.personalization.show');
//         Route::put('/user/personalization', [PersonalizationController::class, 'updateSelf'])->name('user.personalization.update');

//         Route::get('/user/statistics', [StatisticController::class, 'showSelf'])->name('user.statistics.show');

//         // Recursos generales protegidos
//         Route::apiResources([
//             'roles'                  => RoleController::class,
//             'users'                  => UserController::class,
//             'announcements'          => AnnouncementController::class,
//             'rewards'                => RewardController::class,
//             'challenges'             => ChallengeController::class,
//             'travel-routes'          => TravelRouteController::class,
//             'route-ratings'          => RouteRatingController::class,
//             'route-comments'         => RouteCommentController::class,
//             'saved-travel-routes'    => SavedTravelRouteController::class,
//             'interest-places'        => InterestPlaceController::class,
//             'user-custom-places'     => UserCustomPlaceController::class,
//             'chats'                  => ChatController::class,
//             'messages'               => MessageController::class,
//             'chat-participants'      => ChatParticipantController::class,
//             'followers'              => FollowerController::class,
//         ]);

//         // Relaciones anidadas: los desafíos de un usuario
//         Route::apiResource('users.challenges', UserChallengeController::class)->shallow();
//     });
// });
