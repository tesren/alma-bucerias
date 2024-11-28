<?php

namespace App\Nova;

use App\Nova\Unit;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ChangeTextCoordinates;
use Laravel\Nova\Http\Requests\NovaRequest;

class Shape extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Shape::class;


    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Polígono');
    }

    public static function label()
    {
        return __('Polígonos');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Unidad', 'unit', Unit::class)->withoutTrashed()->rules('required')->sortable()->searchable(),

            Select::make('Tipo de forma', 'form_type')->options([
                'polygon' => 'Polígono',
                'rect' => 'Rectángulo',
            ])->displayUsingLabels(),

            Text::make('Puntos', 'points')->help('Puntos del polígono')
            ->dependsOn(
                ['form_type'],
                function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->form_type == 'polygon') {
                        $field->show()->rules(['required']);
                    }
                    else{
                        $field->hide();
                    }
                }
            ),

            Number::make('Rect X', 'rect_x')->help('Posición en X del rectángulo')
            ->dependsOn(
                ['form_type'],
                function (Number $field, NovaRequest $request, FormData $formData) {
                    if ($formData->form_type == 'rect') {
                        $field->show()->rules(['required']);
                    }
                    else{
                        $field->hide();
                    }
                }
            ),

            Number::make('Rect Y', 'rect_y')->help('Posición en Y del rectángulo')
            ->dependsOn(
                ['form_type'],
                function (Number $field, NovaRequest $request, FormData $formData) {
                    if ($formData->form_type == 'rect') {
                        $field->show()->rules(['required']);
                    }
                    else{
                        $field->hide();
                    }
                }
            ),

            Number::make('Ancho', 'width')->help('Ancho del rectángulo')
            ->dependsOn(
                ['form_type'],
                function (Number $field, NovaRequest $request, FormData $formData) {
                    if ($formData->form_type == 'rect') {
                        $field->show()->rules(['required']);
                    }
                    else{
                        $field->hide();
                    }
                }
            ),

            Number::make('Alto', 'height')->help('Alto del rectángulo')
            ->dependsOn(
                ['form_type'],
                function (Number $field, NovaRequest $request, FormData $formData) {
                    if ($formData->form_type == 'rect') {
                        $field->show()->rules(['required']);
                    }
                    else{
                        $field->hide();
                    }
                }
            ),


            Number::make('Texto X', 'text_x')->min(0)->step(0.1)->help('Posición en X del texto del polígono'),
            Number::make('Texto Y', 'text_y')->min(0)->step(0.1)->help('Posición en Y del texto del polígono'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            new ChangeTextCoordinates,
        ];
    }
}
