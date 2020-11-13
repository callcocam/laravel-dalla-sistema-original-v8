<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\Core\FormBuilder;
use App\Http\Controllers\Controller;
use App\Models\Admin\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

abstract class AbstractController extends Controller
{

    protected $template = 'dashboard';
    protected $route = '';
    protected $perPage = 12;
    protected $order = "id";
    protected $direction = "ASC";
    protected $classSearch;
    protected $search = 'name';
    protected $searchId = 'id';
    protected $appends = [];
    /**
     * @var FormBuilder
     */
    protected $formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
           $this->formBuilder = $formBuilder;
    }


    public function index(){

        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        $this->results['search'] = '';
        $this->results['status'] = '';

        if($this->model){

            if(request('search')){

                $this->results['search'] = request('search');

                $term = request('search');

                $search = $this->search;

                if($this->classSearch){

                    $id = $this->classSearch::query()->where( app('db')->raw("CONCAT_WS(' ', {$search})"),"like", "%{$term}%")->select(['id'])->get();

                    if($id->count())
                        $this->getSource()->whereIn($this->searchId, $id->toArray());
                }
                else{

                    $this->getSource()->where( app('db')->raw("CONCAT_WS(' ', {$search})"),"like", "%{$term}%");
                }
            }

            if(request('status')){
                $this->results['status'] = request('status');
                $this->getSource()->where('status',request('status'));

            }
            $this->results['rows'] = $this->getSource()->orderBy($this->order, $this->direction)->paginate($this->perPage);
        }

        return view(sprintf('admin.%s.index', $this->template), $this->results);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = null;

        if($this->formClass){

            $form = $this->formBuilder->create($this->formClass,
                [
                    'method' => 'POST',
                    'url' => route(sprintf("admin.%s.store", $this->template))
                ]);

        }

        $this->results['form'] = $form;

        $this->results['user'] = Auth::user();

        $this->results['tenant'] = get_tenant();

        return view(sprintf('admin.%s.create', $this->template), $this->results);
    }

    /**
     * @return array
     */
    public function getAppends(): array
    {
        if($this->appends){

            foreach ($this->appends as $append) {

                $this->results['rows']->append($append);
            }
        }
        return $this->appends;
    }


    protected function save($request){

        // It will automatically use current request, get the rules, and do the validation

        $this->getModel()->saveBy($request->all());

        if($this->getModel()->getResultLastId()){

            if($this->event){
                $this->setEvent($this->getModel()->findById($this->getModel()->getResultLastId()));
            }

            if(empty($this->route)){

                notify()->success($this->getModel()->getMessage());

                if($this->getModel()->getResultLastId()){
                    return redirect()->route(sprintf("admin.%s.edit", $this->template), $this->getModel()->getResultLastId())->with('success', $this->getModel()->getMessage());
                }
                return back()->with('success', $this->getModel()->getMessage());
            }
            return redirect()->route(sprintf($this->route, $this->getModel()->getResultLastId()))->with('success', $this->getModel()->getMessage());
        }
        notify()->error($this->getModel()->getMessage());

        return back()->withErrors($this->getModel()->getMessage())->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->results['user'] = Auth::user();

        $this->results['tenant'] = get_tenant();

        if($this->model){

            $this->results['rows'] = $this->getModel()->findById($id);
        }

        if(!$this->results['rows']){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return redirect()->route(sprintf("admin.%s.index", $this->template))->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        $this->getAppends();

        return view(sprintf('admin.%s.show', $this->template), $this->results);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {

        $this->results['user'] = Auth::user();

        $this->results['tenant'] = get_tenant();

        if($this->model){

            $this->results['rows'] = $this->getModel()->findById($id);
        }

        if(!$this->results['rows']){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return redirect()->route(sprintf("admin.%s.index", $this->template))->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML(view(sprintf('admin.%s.print', $this->template), $this->results));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->results['user'] = Auth::user();

        $this->results['tenant'] = get_tenant();

        if(!$this->model){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        $rows = $this->getModel()->findById($id);

        if(!$rows){
            notify()->error(__("O modelo não foi informado, se o problema persistir contate o administardor!!!!"));

            return back()->withErrors(__("O modelo não foi informado, se o problema persistir contate o administardor!!!!"));
        }
        $form = null;
        if($this->formClass){

            $form = $this->formBuilder->create($this->formClass, [
                'model'=>$rows,

            ]);
            $form->setFormOption('model',$rows);
            $form->setFormOption('method','POST');
            $form->setFormOption('url',route(sprintf("admin.%s.store", $this->template)));

        }

        //dd($rows->submenus());
        $this->results['rows'] = $rows;
        $this->results['form'] = $form;

        return view(sprintf('admin.%s.edit', $this->template), $this->results);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();

        return view(sprintf('admin.%s.update', $this->template), $this->results);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->model){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        $model = $this->getModel()->findById($id);

        if(!$model){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return redirect()->route(sprintf("admin.%s.index", $this->template))->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        if($this->getModel()->deleteBy($model)){

            if(empty($this->route)){

                notify()->success($this->getModel()->getMessage());

                return back()->with('success', $this->getModel()->getMessage());

            }

            return redirect()->route($this->route)->with('success', $this->getModel()->getMessage());

        }

        notify()->error($this->getModel()->getMessage());

        return back()->withErrors($this->getModel()->getMessage());
    }

    public function removeFile($id){

        $this->model = File::class;

        $model = $this->getModel()->findById($id);

        if(!$model){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!");

            return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!");

        }
        if($this->getModel()->deleteBy($model)){


            return back()->with('success', $this->getModel()->getMessage());

        }

        notify()->error($this->getModel()->getMessage());

        return back()->withErrors($this->getModel()->getMessage());


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $tags = $this->getSource()->where( app('db')->raw("CONCAT_WS(' ', name)"),"like", "%{$term}%")->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return response()->json($formatted_tags);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($request)
    {

        return Validator::make($request->all(), $this->getRules($request->all()))->validate();
    }

}
