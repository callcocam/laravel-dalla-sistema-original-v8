<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

use App\Models\Admin\Item;
use Illuminate\Support\Facades\DB;

if (!function_exists('___')) {
    /**
     * Translate the given message.
     *
     * @param string|null $key
     * @param array $replace
     * @param string|null $locale
     * @return string|array|null
     */
    function ___($key = null, $replace = [], $locale = null)
    {
        $fileSystem = new \Illuminate\Filesystem\Filesystem();

        if (!$fileSystem->exists(resource_path(sprintf("lang/%s.json", config('app.locale'))))) {
            $fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))), json_encode(["Welcome" => "Bem Vindo"]));
        }
        $source = json_decode($fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))), true);

        if (!\Illuminate\Support\Arr::exists($source, $key)) {
            $fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))), json_encode(\Illuminate\Support\Arr::add($source, $key, $key)));

        }

        if (is_null($key)) {
            return $key;
        }

        return trans($key, $replace, $locale);
    }
}
if (!function_exists('attrs')) {
    function attrs($label, $attrs = [], $type = 'text')
    {

        $defaults = array_merge([
            'type' => isset($attrs['type']) ? $attrs['type'] : $type,
            'class' => 'form-control',
            'id' => isset($attrs['id']) ? $attrs['id'] : $attrs['name'],
            'placeholder' => isset($attrs['placeholder']) ? __($attrs['placeholder']) : __($label),
        ], $attrs);

        $attr = [];

        foreach ($defaults as $key => $default) {
            $attr[] = sprintf('%s="%s"', $key, $default);
        }

        return implode(PHP_EOL, $attr);
    }
}

if (!function_exists('get_tenant_id')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function get_tenant_id($tenant = 'company_id')
    {
        $tenantId = \App\Tenant\Facades\Tenant::getTenantId($tenant);
        return $tenantId;
    }
}

if (!function_exists('month_name')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function month_name($month)
    {
        $months = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Máio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];
        return $months[str_pad($month, 2, '0', STR_PAD_LEFT)];
    }
}
if (!function_exists('get_tenant')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function get_tenant()
    {
        $tenant = \App\Models\Admin\Company::find(get_tenant_id());
        //$tenant->append('pontos');
        return $tenant;
    }
}


if (!function_exists('set_form_value')) {
    /**
     * Get the configuration path.
     *
     * @param $value
     * @param null $parent
     * @return string
     */
    function set_form_value($value, $parent = null)
    {
        if ($value) {
            if (is_string($value)) {
                return $value;
            }

            if (isset($value->{$parent})) {
                return $value->{$parent};
            }
        }

        return null;
    }
}

if (!function_exists('check_status')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function check_status($status, $options = [
        'published' => "success", 'draft' => "warning", 'deleted' => "danger"
    ])
    {
        if (isset($options[$status]))
            return $options[$status];


        return "info";
    }
}


if (!function_exists('get_tag_color')) {
    /**
     * Get the configuration path.
     *
     * @param array $options
     * @return string
     */
    function get_tag_color($options = [
        '1' => "success", '2' => "warning", '3' => "danger", '4' => "primary", '5' => "info"
    ])
    {
        $status = rand(1, 5);

        if (isset($options[$status]))
            return $options[$status];


        return "info";
    }
}


if (!function_exists('check_status_text')) {

    //Aguardando processamento;
//Não aceito;
//Em faturamento;
//Separando estoque / em carregamento;
//Em trânsito;
//Completo;
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function check_status_text($status, $options = [
        'published' => "Publicado", 'draft' => "Rascunho", 'deleted' => "Deletado"
    ])
    {
        if (isset($options[$status]))
            return $options[$status];


        return "Rascunho";
    }
}

if (!function_exists('order_status')) {

    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function order_status()
    {

        return  ['not-accepted' => "Não aceito",
                'open' => "Aguardando processamento",
                'in_billing' => "Em faturamento",
                'preparing' => "Separando estoque / em carregamento",
                'transit' => "Em faturamento",
                'completed' => "Completo"];
    }
}
if (!function_exists('order_status_color')) {

    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function order_status_color()
    {

        return  ['not-accepted'=>'danger','open'=>'primary','preparing'=>'info','in_billing'=>'dark','transit'=>'warning','completed'=>'success'];
    }
}

if (!function_exists('date_carbom_format')) {

    function date_carbom_format($date, $format = "d/m/Y H:i:s")
    {

        $date = explode(" ", str_replace(["-", "/", ":"], " ", $date));

        if (!isset($date[0])) {
            $date[0] = null;
        }
        if (!isset($date[1])) {
            $date[1] = null;
        }
        if (!isset($date[2])) {
            $date[2] = null;
        }
        if (!isset($date[3])) {
            $date[3] = null;
        }
        if (!isset($date[4])) {
            $date[4] = null;
        }
        if (!isset($date[5])) {
            $date[5] = null;
        }
        list($y, $m, $d, $h, $i, $s) = $date;

        //$carbon = \Carbon\Carbon::now();
        $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->locale('pt');
        if (strlen($date[0]) == 4) {
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDateTimeLocalString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDayDateTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDateString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDateString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullTimeString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDatetimeString().PHP_EOL;
            return $carbon->create($y, $m, $d, $h, $i, $s);
        }
        if ($y && $m && $d) {
            return $carbon->create($d, $m, $y, $h, $i, $s);
        }
        return $carbon->create(null, null, null, null, null, null);
    }
}


if (!function_exists('get_tags')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function get_tags($values)
    {

        if ($values) {

            $tags = [];

            foreach ($values as $value) {

                $tags[] = $value->tag_name;
            }

            return trim(implode(",", $tags));
        }

        return "";
    }
}


if (!function_exists('form_w')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function form_w($post)
    {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $post); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
}


if (!function_exists('form_read')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function form_read($post)
    {
        if (is_numeric($post)):
            return @number_format($post, 2, ",", ".");
        endif;
        return $post;
    }
}

if (!function_exists('Calcular')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function Calcular($v1, $v2, $op)
    {
        try {
            $v1 = str_replace(".", "", $v1);
            $v1 = str_replace(",", ".", $v1);
            $v2 = str_replace(".", "", $v2);
            $v2 = str_replace(",", ".", $v2);
            switch ($op) {
                case "+":
                    $r = $v1 + $v2;
                    break;
                case "-":
                    $r = $v1 - $v2;
                    break;
                case "*":
                    $r = $v1 * $v2;
                    break;
                case "%":
                    $bs = $v1 / 100;
                    $j = $v2 * $bs;
                    $r = $v1 + $j;
                    break;
                case "/":
                    @$r = @$v1 / $v2;
                    break;
                case "tj":
                    $bs = $v1 / 100;
                    $j = $v2 * $bs;
                    $r = $j;
                    break;
                default :
                    $r = $v1;
                    break;
            }
            $ret = @number_format($r, 2, ",", ".");
            return $ret;
        } catch (Exception $exception) {
            return sprintf("%s - Valor 01: %s, Valor 02: %s, Operação: %s", $exception->getMessage(), $v1, $v2, $op);
        }

    }
}


if (!function_exists('progress')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function progress($v1, $v2)
    {

        $base = Calcular($v1, $v2, "-");
        $base = Calcular($base, 100, "*");
        $current = Calcular($base, $v1, "/");

        return form_w(Calcular(100, $current, "-"));

    }
}


if (!function_exists('progressIn')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function progressIn($v1, $v2, $val)
    {


        return intval(progress($v1, $v2)) > $val;

    }
}

if (!function_exists('progressOut')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function progressOut($v1, $v2, $val)
    {


        return intval(progress($v1, $v2)) < $val;

    }
}

if (!function_exists('calc_score')) {
    /**
     * Get the configuration path.
     *
     * @param $client
     * @param $product
     * @return integer
     */
    function calc_score($client)
    {

        $user = \App\Models\Admin\Client::find($client);
        if($user){
            $orders = $user->support_orders()->pluck('id');
            if ($orders):
                //pega todos os items das ordems relacionada ao client
                $sum = \App\Models\Admin\SupportOrderItem::query()->whereIn('support_order_id', array_values($orders->toArray()))->select(DB::raw('sum( total ) as result'))
                    ->first();
                return $user->score()?$user->score()->amount - $sum->result:0;
            endif;
        }
        return 0;

    }
}

if (!function_exists('calc_score_ok')) {
    /**
     * Get the configuration path.
     *
     * @param $client
     * @param $product
     * @return boolean
     */
    function calc_score_ok($client, $product)
    {


        return calc_score($client, $product) < $product->price;

    }
}

if (!function_exists('current_ponts')) {
    /**
     * Get the configuration path.
     *
     * @param $client
     * @param $product
     * @return boolean
     */
    function current_ponts(){

        return calc_score(auth()->id());
    }
}
