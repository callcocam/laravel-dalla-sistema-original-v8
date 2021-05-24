<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\DownloadForm;
use App\Http\Requests\DownloadStore;
use App\Models\Admin\Download;

class DownloadController extends AbstractController
{

   protected $template = 'downloads';

   protected $model = Download::class;

   protected $formClass = DownloadForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param DownloadStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(DownloadStore $request)
    {
        return $this->save($request);
    }

    public function download($id)
    {
        if($this->model){

            $rows = $this->getModel()->findById($id);
            $rows->increment('views',1);


            return response()->download(storage_path(sprintf("app/public/%s", str_replace('storage/', '', $rows->cover))));
        }

        return back()->withErrors("Arquivo ou imagem não encontrado");
    }
}
