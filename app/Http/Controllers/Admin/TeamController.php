<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TeamListExport;
use App\Http\Controllers\Controller;
use App\User;
use Carbon;
use Excel;
use Storage;
use Zipper;

class TeamController extends Controller
{
    /**
     * Create a new controller instance and set middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is.verify');
        $this->middleware('is.admin');
    }

    /**
     * render team list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamlist()
    {
        $users = User::role('participant')->whereVerify(true)->get();

        return view('admin.teamlist')->with([
            'users' => $users,
        ]);
    }

    /**
     * render team list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        return Excel::download(new TeamListExport(), 'TeamList_'.\Carbon\Carbon::now()->toDateTimeString().'.xlsx');
    }

    /**
     * document download.
     *
     * @return
     */
    public function documentDownload()
    {
        $users = User::role('participant')->whereVerify(true)->get();
        $directorys = $users->map(function ($e) {
            $data = null;
            $files = Storage::allFiles($e->id);
            if (collect($files)->count() > 0) {
                $data = $files;
            }

            return collect(['data'=>$data, 'id'=>$e->id, 'name'=>$e->name]);
        });
        $zip = Zipper::make(storage_path().'/app/document.zip');
        foreach ($directorys as $item) {
            if ($item['data'] != null) {
                $zip->folder($item['id'].'_'.$item['name']);
                foreach ($item['data'] as $file) {
                    $zip->add(storage_path().'/app/'.$file);
                }
            }
        }
        $zip->close();
        if (Storage::exists('document.zip')) {
            return Storage::download('document.zip', 'document_'.Carbon::now()->toDateTimeString().'.zip');
        } else {
            return back();
        }
    }
}
