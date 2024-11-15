<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Metrics\Table;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Http\Requests\NovaRequest;

class MyClients extends Table
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $clients = User::where('agent_id', auth()->user()->id )->latest()->limit(5)->get();
        
        if( count($clients) > 0 ){
            $metricRows = [];

            foreach ($clients as $client) {
    
    
                $subtitle = $client->email.__(' | Actualizado el día: ').$client->updated_at;
    
                $metricRows[] = MetricTableRow::make()
                    ->icon('user')
                    ->title($client->name)
                    ->subtitle($subtitle)
                    ->actions(function () use ($client) {
                        return [
                            MenuItem::externalLink('Ver', '/nova/resources/users/'.$client->id ),
                        ];
                    });
            }
        }else{

            $metricRows = [
                MetricTableRow::make()
                    ->icon('exclamation')
                    ->iconClass('text-yellow-500')
                    ->title(__('Aún no tienes clientes registrados'))
                    ->subtitle(__('Pronto podrás ver aquí a tus clientes')),
            ];

        }
        

        return $metricRows;
    }

    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return __('Mis Clientes');
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }
}
