<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use \Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::latest()->with('followers', 'followings', 'pendingRequests')->get();

        return new UserCollection($users);
    }

    /**
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, User $user)
    {
        $user->load(
            'posts',
            'posts.comments',
            'posts.comments.user',
            'followers',
            'followings',
            'pendingRequests'
        )->loadCount('followers', 'followings', 'pendingRequests', 'posts');

        $user->posts->loadCount('comments');

        return new UserResource($user);
    }

    /**
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        logger($request);

        $validated = $request->validated();
        $user->update($validated);
        return new UserResource($user);
    }

    /**
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function toggleFollowUser(Request $request, User $user)
    {
        Auth::user()->toggleFollow($user);

        return response()->noContent();
    }

    /**
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function AcceptPendingRequest(Request $request, User $user)
    {
        Auth::user()->acceptFollowRequestFrom($user);

        return new UserResource(Auth::user());
    }

    /**
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function RejectPendingRequest(Request $request, User $user)
    {
        Auth::user()->rejectFollowRequestFrom($user);

        return new UserResource(Auth::user());
    }

    /**
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function removeFromFollowers(Request $request, User $user)
    {
        Auth::user()->removeFollower($user);

        return new UserResource(Auth::user());
    }
    // /**
    //  * @param \App\Http\Requests\StoreUserRequest $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreUserRequest $request)
    // {
    //     $validated = $request->validated();

    //     $post = Post::create($validated);

    //     return new PostResource($post);
    // }

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @param \App\Models\Post $post
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request, Post $post)
    // {
    //     if($post->author === Auth::user()->id) {

    //         $post->delete();

    //         return response()->noContent();

    //     } else {
    //         return abort(403, 'You are not allowed to delete this post');
    //     }
    // }


    // public function update_game_formation(Request $request ,Game $game) {

    //     $this->authorize('update', $game);

    //     $rules = [
    //         'formation_png' => ['required|string'],
    //         'formation_json' => ['required|json']
    //     ];

    //     $request->validate([$rules]);

    //     $game->update([
    //         'formation_png' => $request->get('formation_png'),
    //         'formation_json' => $request->get('formation_json')
    //     ]);

    //     return new GameResource($game);
    // }

    // public function import(Request $request)
    // {
    //     $this->authorize('create', Game::class);

    //     $request->validate([
    //         'file' => ['required','mimes:csv,xls,xlsx,xlsm','max:2048'],
    //     ]);

    //     if ($request->hasfile('file')) {
    //         $nameSave = Str::uuid()->getHex();
    //         $extension = $request->file('file')->extension();
    //         $filenametostore = $nameSave.'.'.$extension;
    //         $folder = 'public/'.Auth::user()->club_id.'/import-files';

    //         $request->file('file')->storeAs('public/'.Auth::user()->club_id.'/import-files', $filenametostore);
    //         ImportExcelDataJob::dispatch($folder, $filenametostore, 'games', Auth::user()->club_id, Auth::user());
    //     }

    //     return response()->noContent();
    // }

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function game_attendances(Request $request, Game $game)
    // {
    //     $this->authorize('view-any', Game::class);

    //     return new GameAttendanceCollection(GameAttendance::where('game_id', $game->id)->with('game','player:id,name,short_name,photo')->get());
    // }

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function game_statistics(Request $request, Game $game)
    // {
    //     return new GameStatisticCollection(GameStatistic::where('game_id', $game->id)->with('statistic')->get());
    // }

}
