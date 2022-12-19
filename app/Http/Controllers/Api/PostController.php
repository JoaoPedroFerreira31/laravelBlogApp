<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use \Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::latest()->get();

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

    // /**
    //  * @param \App\Http\Requests\GameUpdateRequest $request
    //  * @param \App\Models\Game $game
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(GameUpdateRequest $request, Game $game)
    // {
    //     $this->authorize('update', $game);

    //     $validated = $request->validated();

    //     $game->update($validated);
    //     SyncGameEvent::dispatchAfterResponse($game);

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

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @param \App\Models\Game $game
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request, Game $game)
    // {
    //     $this->authorize('delete', $game);

    //     $game->delete();

    //     return response()->noContent();
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
