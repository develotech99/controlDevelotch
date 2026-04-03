<?php

namespace App\Notifications;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteSent extends Notification
{
    use Queueable;

    protected Quote $quote;

    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url('/quotes/' . $this->quote->id);

        return (new MailMessage)
            ->subject('Nueva Cotización Enviada - DEVELOTECH GLOBAL')
            ->greeting('Hola ' . ($notifiable->name ?? 'Cliente') . '!')
            ->line('Se ha enviado una nueva cotización para tu revisión.')
            ->line('Referencia: ' . $this->quote->reference)
            ->line('Total: Q' . number_format($this->quote->total, 2))
            ->action('Ver Cotización', $url)
            ->line('Gracias por confiar en DEVELOTECH GLOBAL.');
    }

    public function toArray($notifiable): array
    {
        return [
            'quote_id' => $this->quote->id,
            'reference' => $this->quote->reference,
            'total' => $this->quote->total,
            'message' => 'Cotización enviada: ' . $this->quote->reference,
        ];
    }
}
