<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\Core\FormBuilder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Validator;

class TradutorController extends AbstractController
{

    protected $template = 'translate';
    /**
     * @var Filesystem
     */
    private $fileSystem;

    public function __construct(FormBuilder $formBuilder, Filesystem $fileSystem)
    {
        parent::__construct($formBuilder);
        $this->fileSystem = $fileSystem;
    }

    public function index()
    {
        $sources = json_decode($this->fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))),true);

        if(request()->getMethod() == "POST"){

            Validator::make(request()->all(), [
                'key'=>['required', 'max:190'],
                'value'=>['required', 'max:190'],
            ])->validate();

            $key = request()->get("key");

            $value = request()->get("value");

            if(\Illuminate\Support\Arr::exists($sources,$key)){
                $sources[$key] = $value;
                $this->fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))),json_encode($sources));
                notify()->success(sprintf("Tradução [ %s ] atualizada com sucesso!!", $key));
                return back()->withInput()->with('success', sprintf("Tradução [ %s ] atualizada com sucesso!!", $key));
            }
            else{
                $this->fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))),json_encode(\Illuminate\Support\Arr::add($sources,$key,$value)));
                notify()->success(sprintf("Tradução [ %s ] gerada com sucesso!!", $key));
                return back()->withInput()->with('success', sprintf("Tradução [ %s ] gerada com sucesso!!", $key));
            }

            notify()->error(sprintf("erro ao tentar traduzir [ %s ]!!", $key));
            return back()->withInput()->withErrors(sprintf("erro ao tentar traduzir [ %s ]!!", $key));
        }
        $this->results['rows'] = $sources;

        return parent::index();
    }
}
