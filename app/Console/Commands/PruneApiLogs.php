<?php

namespace App\Console\Commands;

use App\Models\ApiRequestLog;
use Illuminate\Console\Command;

class PruneApiLogs extends Command
{
    protected $signature = 'api-logs:prune {--days=15 : Dias de retencion}';

    protected $description = 'Eliminar logs de la API mas viejos que N dias';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $deleted = ApiRequestLog::where('created_at', '<', now()->subDays($days))->delete();

        $this->info("Eliminados {$deleted} registros con mas de {$days} dias.");

        return Command::SUCCESS;
    }
}
