<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quote;
use App\Notifications\QuoteSent;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-email {quote_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar cotización por email para pruebas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $quoteId = $this->argument('quote_id') ?: Quote::first()->id;

        $quote = Quote::find($quoteId);

        if (!$quote) {
            $this->error('Cotización no encontrada');
            return 1;
        }

        $this->info("Enviando cotización ID: {$quote->id} a: {$quote->client->email}");

        try {
            $quote->client->notify(new QuoteSent($quote));
            $quote->update(['status' => 'enviado']); // Cambiar a español
            $this->info('✅ Email enviado correctamente');
        } catch (\Throwable $e) {
            $this->error('❌ Error al enviar email: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
