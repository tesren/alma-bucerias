<?php

namespace App\Nova;

use App\Nova\Actions\RevokeApiToken;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ApiRequestLog extends Resource
{
    public static $model = \App\Models\ApiRequestLog::class;

    public static $title = 'path';

    public static $search = ['path', 'ip_address'];

    public static $perPageViaRelationship = 10;

    public static function label()
    {
        return 'API Logs';
    }

    public static function singularLabel()
    {
        return 'API Log';
    }

    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    public function authorizedToUpdate(Request $request): bool
    {
        return false;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Usuario', 'user', User::class)->nullable(),
            Text::make('Metodo', 'method')->asHtml()->displayUsing(fn ($value) => match ($value) {
                'GET' => '<span style="background:#DCFCE7;color:#15803D;font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;">GET</span>',
                'POST' => '<span style="background:#ECFDF9;color:#0A7A6F;font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;">POST</span>',
                default => "<span style='font-size:10px;font-weight:700;'>{$value}</span>",
            })->sortable(),
            Text::make('Endpoint', 'path')->sortable(),
            Text::make('Query', 'query_string')->nullable()->onlyOnDetail(),
            Text::make('Status', 'status_code')->asHtml()->displayUsing(function ($value) {
                [$bg, $color] = match (true) {
                    $value >= 500 => ['#FEE2E2', '#B91C1C'],
                    $value >= 400 => ['#FEF3C7', '#92400E'],
                    default => ['#DCFCE7', '#15803D'],
                };

                return "<span style='background:{$bg};color:{$color};font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;font-family:monospace'>{$value}</span>";
            })->sortable(),
            Text::make('IP', 'ip_address')->sortable(),
            Number::make('Tiempo (ms)', 'response_time_ms')->sortable()->onlyOnDetail(),
            Text::make('User Agent', 'user_agent')->onlyOnDetail(),
            DateTime::make('Fecha', 'created_at')->sortable(),
        ];
    }

    public function actions(NovaRequest $request): array
    {
        return [new RevokeApiToken];
    }
}
