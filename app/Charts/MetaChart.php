<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class MetaChart extends BaseChart
{

    private function months()
    {
        $moths = [
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
            '11' => 'Novenbro',
            '12' => 'Dezembro'];
        return $moths;
    }

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $client = auth()->user();

        $labels = [];
        $datasets = [];
        $meta = [];

        foreach ($this->months() as $key => $month):
            $orders = $client->orders()->whereMonth('created_at', $key)->get();
            if ($orders->count()):
                $count = 0;
                foreach ($orders as $order):
                    if ($order->items):
                        foreach ($order->items as $item):
                            $count = intval(Calcular($count, $item->amount, '+'));
                        endforeach;
                    endif;
                endforeach;
                $datasets[] = $count;
                $labels[] = $month;
                $meta[] = $client->meta;
            endif;
        endforeach;
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Meta', $meta)
            ->dataset('Situação', $datasets);
    }
}
