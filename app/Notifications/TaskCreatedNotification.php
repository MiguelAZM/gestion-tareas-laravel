<?php
namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskCreatedNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva tarea creada')
            ->greeting('Hola ' . $notifiable->name)
            ->line('Se ha creado una nueva tarea.')
            ->line('Titulo: ' . $this->task->title)
            ->line('Fecha de vencimiento: ' . $this->task->expiration_date)
            ->line('Gracias por usar nuestra aplicacion.');
    }
}
