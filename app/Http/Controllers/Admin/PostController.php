<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\PostForm;
use App\Http\Requests\PostStore;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends AbstractController
{

   protected $template = 'posts';

   protected $model = Post::class;

   protected $formClass = PostForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param PostStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStore $request)
    {
        return $this->save($request);
    }

    public function show($id)
    {
        if($this->model){

            $rows = $this->getModel()->findById($id);
            $rows->increment('views',1);
        }

        return parent::show($id);
    }

    public function all()
    {
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        $this->results['search'] = '';
        $this->results['status'] = '';

        if($this->model){
            $this->results['rows'] = $this->getSource()->orderBy("created_at", "DESC")->paginate(1000);
        }

        return view(sprintf('admin.%s.all', $this->template), $this->results);
    }
}
