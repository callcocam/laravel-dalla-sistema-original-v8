<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */
namespace App\Suports\Common;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

trait Eloquent
{
    protected $showTitle = Options::DEFAULT_TITLE;

    protected $showColumnOrder = Options::DEFAULT_COLUMN_ODER_DIRECTION;

    protected $showStatusColumn = Options::DEFAULT_COLUMN_STATUS;

    protected $showDateColumn = Options::DEFAULT_COLUMN_DATE;

    protected $showOrderDirection = Options::DEFAULT_ORDER_DESC;

    protected $showEndpoint = '';

    protected $showEndpointBack = '';

    protected $showStatusItems = [
        ['value'=>'','text'=>"all"],
        ['value'=>'published','text'=>"published"],
        ['value'=>'draft','text'=>"draft"],
        ['value'=>'deleted','text'=>"deleted"],
    ];
    protected $showSortOptions = [
        ['value'=>'ASC','text'=>"Ascending"],
        ['value'=>'DESC','text'=>"Descending"]
    ];

    protected $showItems = [6,12,24,48,95];

    protected $showSearch  = Options::DEFAULT_INITIAL_SHOW_SEARCH;

    protected $showDownloadCSV  = Options::DEFAULT_INITIAL_DOWNLOAD_CSV;

    protected $showDownloadPDF  = Options::DEFAULT_INITIAL_DOWNLOAD_PDF;

    protected $showDownloadPRINT  = Options::DEFAULT_INITIAL_DOWNLOAD_PRINT;

    protected $showDownloadZIP  = Options::DEFAULT_INITIAL_DOWNLOAD_ZIP;

    protected $showStatus  = Options::DEFAULT_INITIAL_STATUS;

    protected $showItemPerPage = 12;

    /**
     * @var Builder
     */
    protected $queryBuilder;

    protected function order()
    {
        $column = request()->get('column',$this->showColumnOrder);

        $order = request()->get('sort',$this->showOrderDirection);

        $this->queryBuilder->orderBy($column, $order);
    }

    protected function initQuery($headers)
    {



        if ($this->showStatusColumn) {

            if (request()->get($this->showStatusColumn, false)) {
                $this->queryBuilder->where([$this->showStatusColumn => request()->get($this->showStatusColumn)]);
            }
        }


        if (request()->has('start') && request()->has('end')) {
            $this->queryBuilder->whereBetween($this->showDateColumn, [
                date_carbom_format(request()->get('start'))->format('Y-m-d 00:00:00'),
                date_carbom_format(request()->get('end'))->format('Y-m-d 23:59:59')
            ]);
        }


        if (request()->has('year'))
            $this->queryBuilder->whereYear($this->showDateColumn, '=', request()->get('year'));
        if (request()->has('month'))
            $this->queryBuilder->whereMonth($this->showDateColumn, '=', request()->get('month'));
        if (request()->has('day'))
            $this->queryBuilder->whereDay($this->showDateColumn, '=', request()->get('day'));
        if (request()->has('date'))
            $this->queryBuilder->whereDate($this->showDateColumn, '=', request()->get('date'));
        if (request()->has('number'))
            $this->queryBuilder->where('number', '=', request()->get('number'));

        $Searchs = [];

        if ($headers) :

            foreach ($headers as $values) :

                if (isset($values['value'])) :

                    if (isset($values['alias']) && $values['alias']) :

                        $Searchs[] = $values['value'];

                    endif;
                endif;

            endforeach;

        endif;

        $anyKeyword = request()->get('search', null);

        if ($Searchs && !is_null($anyKeyword)) :

            $Search = implode(",", $Searchs);

            if ($anyKeyword) :

                $this->queryBuilder->where(app('db')->raw("CONCAT_WS(' ', {$Search})"), "like", "%{$anyKeyword}%");

            endif;

        endif;
    }

    public function getData($columns = ["*"])
    {

        $headers = $this->initTable();

        $this->queryBuilder = $this->getQuery();

        $this->queryBuilder->select($columns);

        $this->order();

        $this->initQuery($headers);

        $rows = $this->queryBuilder->paginate(request()->get('limit',$this->showItemPerPage));

        $rows->each(function ($result) {

            $result->append('avatar');
            $result->append('created_mm_dd_yyyy');
            $result->append('avatar_filename');

        });

        Log::debug($this->queryBuilder->toSql());
        //Log::debug("Params: page -> {$this->getParams()->page}, search -> {$this->getParams()->search}, limit -> {$this->getParams()->limit}, between -> {$this->getParams()->between}, status -> {$this->getParams()->status}");
        // $resource = $this->tables->getResource();


        return [
            'query'=>$this->getQueryParams(),
            'rows'=>$rows->items(),
            'items'=>$rows->items(),
            "firstPageUrl"=>null,
            "lastPageUrl"=>$rows->nextPageUrl(),
            "nextPageUrl"=> $rows->nextPageUrl(),
            "path"=> $rows->path(),
            "prevPageUrl"=> $rows->previousPageUrl(),
            'headers'=>$headers,
            'options'=>[
                'currentPage' => $rows->currentPage(),
                "from"=> $rows->firstItem(),
                "lastPage"=> $rows->lastPage(),
                "perPage"=> $rows->perPage(),
                "to"=> $rows->lastItem(),
                "total"=> $rows->total(),
                "itemPerPage"=> $this->showItemPerPage,
                "showStatusColumn"=> $this->showStatusColumn,
                "showDateColumn"=> $this->showDateColumn,
                "showTitle"=> $this->showTitle,
                "showSortOptions"=> $this->showSortOptions,
                "showOrderDirection"=> $this->showOrderDirection,
                "showEndpoint"=> $this->showEndpoint,
                "showEndpointBack"=> $this->showEndpointBack,
                "showStatusItems"=> $this->showStatusItems,
                "showItems"=> $this->showItems,
                "showSearch"=> $this->showSearch,
                "showStatus"=> $this->showStatus,
                "showDownloadCSV"=> $this->showDownloadCSV,
                "showDownloadPDF"=> $this->showDownloadPDF,
                "showDownloadPRINT"=> $this->showDownloadPRINT,
                "showDownloadZIP"=> $this->showDownloadZIP,
            ]
        ];
    }

    protected function getQueryParams(){

        $query = array_merge([
            'column'=> $this->showColumnOrder,
            'limit'=> $this->showItemPerPage,
            'page'=> 1,
            'search'=> null,
            'sort'=> $this->showOrderDirection,
            'status'=> $this->showStatus,
        ], request()->all());

        foreach ($query as $key =>$value) {

            if(is_numeric($value)){
                $query[$key] = (int)$value;
            }
        }
        return $query;
    }

}
