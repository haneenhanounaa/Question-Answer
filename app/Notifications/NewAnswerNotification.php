<?php

namespace App\Notifications;

use App\Models\Question;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAnswerNotification extends Notification
{
    use Queueable;

    protected $question;
    protected $user;


    /**
     * Create a new notification instance.
     */
    public function __construct(Question $question,User $user)
    {
        $this->question = $question;
        $this->user=$user;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels=['database','broadcast'];

//        if(in_array('mail',$notifiable->notification_options)){
//            $channels[] ='mail';
//        }
//        if(in_array('sms',$notifiable->notification_options)){
//           // $channels[] ='nexmo';
//        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail(object $notifiable): MailMessage
//    {
//        $message= new MailMessage;
//        $message->subject(__('New Answer'))
//                    ->from('haneen@example.com','Notifications')
//                    ->greeting(__("Hello :name,",[
//                        'name'=>$notifiable->name
//                    ]))
//                    ->line(__(':user add answer to your question ":question"',[
//                            'user'=>$this->user->name,
//                            'question'=>$this->question->title,
//                        ]))
//                    ->action('View Answer', url(route('questions.show',$this->question->id)))
//                    ->line(__('Thank  you for using our application!'));
//
//        return $message;
//    }

    public function toDatabase($notifiable){

        return[
            'title'=>__('New Answer'),
            'body'=>__(':user add answer to your question ":question"',
                [
                'user'=>$this->user->name,
                'question'=>$this->question->title,
            ]),
            'image'=>'',
            'url'=>route('questions.show',$this->question->id)
        ];

    }

    public function toBroadcast($notifiable){

        return[
            'title'=>__('New Answer'),
            'body'=>__(':user add answer to your question ":question"',
                [
                    'user'=>$this->user->name,
                    'question'=>$this->question->title,
                ]),
            'image'=>'',
            'url'=>route('questions.show',$this->question->id)
        ];
    }

    /**
     *  Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
