<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\PermissionForm;
use App\Helpers\LoadRouterHelper;
use App\Http\Requests\PermisionStore;
use App\Suports\Shinobi\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends AbstractController
{

   protected $template = 'permissions';

   protected $model = Permission::class;

  protected $formClass = PermissionForm::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param PermisionStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermisionStore $request)
    {
        return $this->save($request);
    }

    public function generate_prermissions(){


        $permmisions = LoadRouterHelper::make();
        $newsPermissions = [];
        if($permmisions){

            foreach ($permmisions as $permmision){
                  if(!$this->getModel()->findBy(['name'=>$permmision])->first()){
                      $data = explode(".", $permmision);
                      $group = last($data);
                      $this->getModel()->saveBy(
                          [
                              'name'=>$permmision,
                              'slug'=>$permmision,
                              'groups'=>$group,
                              'description'=>Str::title($permmision),
                              'status'=>'published',
                              'created_at'=>now()->format('Y-m-d'),
                              'updated_at'=>now()->format('Y-m-d')
                          ]
                      );
                      $newsPermissions[] = $permmision;
                  }
            }
        }
        dd($newsPermissions);
    }
}
