<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Notifications\InvoiceGenerated;

class TestInvoiceEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-invoice-email {invoice_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar factura por email para pruebas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invoiceId = $this->argument('invoice_id') ?: Invoice::first()->id ?? null;

        if (!$invoiceId) {
            $this->error('No hay facturas disponibles. Crea una primero.');
            return 1;
        }

        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            $this->error('Factura no encontrada');
            return 1;
        }

        $this->info("Enviando factura ID: {$invoice->id} a: {$invoice->client->email}");

        try {
            $invoice->client->notify(new InvoiceGenerated($invoice));
            $this->info('✅ Email de factura enviado correctamente');
        } catch (\Throwable $e) {
            $this->error('❌ Error al enviar email: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
