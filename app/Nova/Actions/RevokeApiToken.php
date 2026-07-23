<?php

namespace App\Nova\Actions;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class RevokeApiToken extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Revocar token API';

    public $confirmText = '¿Seguro que quieres revocar todos los tokens de este usuario? Debera hacer login de nuevo para obtener un nuevo token.';

    public $confirmButtonText = 'Revocar';

    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $user = $model instanceof User ? $model : $model->user;

            if (! $user) {
                continue;
            }

            $user->tokens()->delete();
        }

        return Action::message('Token(s) revocados. El desarrollador debera hacer login de nuevo.');
    }

    public function fields(NovaRequest $request): array
    {
        return [];
    }
}
