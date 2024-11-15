<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the text for the create resource button.
     *
     * @return string|null
     */
    public static function createButtonLabel()
    {
        return __('Crear Nuevo');
    }

    /**
     * Get the text for the update resource button.
     *
     * @return string|null
     */
    public static function updateButtonLabel()
    {
        return __('Guardar Cambios');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Usuario');
    }

    public static function label()
    {
        return __('Usuarios');
    }


    /**
     * Build an "index" query for the given resource.
     * 
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $user = $request->user();

        //Al admin se le muestran todos los registros, a los demás solo los suyos
        if( $user->role == 'admin' or $user->role == 'superadmin' ){
            return $query;
        }
        else{
            return $query->where('agent_id', $request->user()->id)->orWhere('id', $request->user()->id);
        }
    }


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

            Gravatar::make()->maxWidth(50),

            Text::make(__('Nombre Completo'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->showWhenPeeking(),

            Email::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->showWhenPeeking(),

            Number::make(__('Teléfono'), 'phone')->hideFromIndex()->nullable()->min(0),

            Select::make(__('Lenguaje'), 'lang')->options([
                'es' => __('Español'),
                'en' => __('Inglés'),
            ])->displayUsingLabels()->sortable()/* ->default('es') */->rules('required'),

            Country::make(__('País'), 'country_code')->hideFromIndex()->searchable()->nullable()->default('MX'),

            Text::make(__('Contraseña'), 'password')
                ->onlyOnForms()->hideWhenUpdating()->help('La contraseña se genera automaticament, NO CAMBIAR')
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults())
                ->dependsOn(
                    ['name', 'email', 'lang'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->name != '' and $formData->email != '' and $formData->lang != '') {
                            $field->show();

                            //primeras 3 letras del nombre
                            $generatedPass = substr($formData->name, 0, 3);

                            //gion bajo y primeras 2 letras del correo
                            $generatedPass .= '_'.substr($formData->email, 0, 2);

                            //lenguage en mayusculas y año actual
                            $generatedPass .= strtoupper($formData->lang).date('Y');

                            //simbolo en caso de que no haya pais
                            $generatedPass .= '&';
                            
                            $field->default($generatedPass);
                        }
                        else{
                            $field->hide();
                        }
                    }
                ),

            Password::make(__('Contraseña'), 'password')
                ->onlyOnForms()->hideWhenCreating()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Select::make(__('Rol'), 'role')->options([
                'client' => __('Cliente'),
                'agent' => __('Asesor Inmobiliario'),
                'admin' => __('Administrador del sistema'),
                'superadmin' => __('Super Admin'),
            ])->displayUsingLabels()->filterable()->sortable(),

            //Asesor
            BelongsTo::make(__('Asesor'), 'agent', 'App\Nova\User')->exceptOnForms()->sortable()->filterable()->searchable(),

            Select::make(__('Asesor'), 'agent_id')->options(function(){

                $agents = User::where('role', 'agent')->get();
                $agentsArray = [];

                foreach($agents as $agent){
                    $agentsArray[$agent->id] = $agent->name;
                }

                return $agentsArray;

            })->displayUsingLabels()->onlyOnForms()->nullable()->searchable()
            ->dependsOn(
                ['role'],
                function (Select $field, NovaRequest $request, FormData $formData) {
                    if ($formData->role == 'client') {
                        $field->show();
                        $field->rules('required');
                    }
                    else{
                        $field->hide();
                    }
                }
            ),

            Textarea::make(__('Notas'), 'notes')->maxlength(5000)->enforceMaxlength()->nullable()
            ->dependsOn(
                ['role'],
                function (Textarea $field, NovaRequest $request, FormData $formData) {
                    if ($formData->role == 'client') {
                        $field->show();
                    }
                    else{
                        $field->hide();
                    }
                }
            ),

            BelongsToMany::make(__('Unidades Guardadas'), 'savedUnits', Unit::class)->hideFromDetail(fn () => $this->savedUnits->isEmpty()),

            HasMany::make(__('Mensajes'), 'messages', PrivateMessage::class)->hideFromDetail(fn () => $this->messages->isEmpty()),

            HasMany::make(__('Actividad'), 'sessions', Session::class)->hideFromDetail(fn () => $this->sessions->isEmpty()),

            HasMany::make(__('Datos de acceso enviados'), 'emails', 'App\Nova\Email')->hideFromDetail(fn () => $this->emails->isEmpty()),

            HasMany::make(__('Clientes'), 'clients', User::class)->hideFromDetail(fn () => $this->clients->isEmpty()),

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
            new Actions\SendLoginData,
            new Actions\ChangeUserLang,
        ];
    }
}
