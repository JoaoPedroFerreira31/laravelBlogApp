<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use \Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        $posts = Post::latest()->with('comments', 'comments.user')->get();

        return new PostCollection($posts);
    }

    /**
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create($validated);

        return new PostResource($post);
    }

    /**
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        if($post->author === Auth::user()->id) {

            $validated = $request->validated();

            $post->update($validated);

            return new PostResource($post);

        } else {
            return abort(403, 'You are not allowed to edit this post');
        }
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function userFriendsPosts()
    {
        $user = Auth::user();
        $user->load('followings');
        $friendsID = $user->followings->pluck('id');
        // logger($friendsID);
        $posts = Post::whereIn('author', $friendsID)->with('comments', 'comments.user')->get();

        return new PostCollection($posts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if($post->author === Auth::user()->id) {

            $post->delete();

            return response()->noContent();

        } else {
            return abort(403, 'You are not allowed to delete this post');
        }
    }

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @param \App\Models\Game $game
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Request $request, Game $game)
    // {
    //     $this->authorize('view', $game);

    //     $game->load(
    //         'team:id,name,acronym,league_id,formation_id',
    //         'team.players:id,name,short_name,photo',
    //         //'team.players.latestStatus',
    //         'team.league.leagueType',
    //         'team.formation',
    //         'team.statistics',
    //         'team.pitches:id,name',
    //         'opponent:id,name,acronym,logo',
    //         'opponent.pitches:id,name',
    //         'pitch:id,name',
    //         'season:id,name,acronym',
    //         'gameFiles',
    //         'finalResult',
    //         'gameAttendances',
    //         'gameAttendances.game',
    //         'gameAttendances.player:id,name,short_name,photo',
    //         'gameStatistics',
    //         'gameStatistics.statistic:id,name,short_name,image',
    //         'gameStatistics.player:id,name,short_name,photo',
    //     )->loadCount('gameFiles', 'gameAttendances');

    //     $game->gameAttendances->each->append('playerName');
    //     $game->append('teamName');

    //     return new GameResource($game);
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
