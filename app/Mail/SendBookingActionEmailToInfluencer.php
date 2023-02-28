<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Account;
use App\Models\Campaign;

class SendBookingActionEmailToInfluencer extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    
    public $influencer;

    public $campaign;
    
    public $brand;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, Account $influencer, Campaign $campaign, Account $brand)
    {
        $this->booking = $booking;
        $this->influencer = $influencer;
        $this->campaign = $campaign;
        $this->brand = $brand;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '[B&I Booking] You have just received new notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: $this->getEmailTemplate(),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    /**
     * Get dynamic email template by booking status
     * 
     * @return mixed
     */
    private function getEmailTemplate()
    {
        $template = "";
        switch ($this->booking->status) {
            case Booking::STATUS_WAITING:
                $template = "email.influencer.bookingWaitingTemplate";
                break;
            case Booking::STATUS_CONFIRMED:
                $template = "email.influencer.bookingConfirmedTemplate";
                break;
            case Booking::STATUS_DOING:
                $template = "email.influencer.bookingInProgressTemplate";
                break;
            case Booking::STATUS_DONE:
                $template = "email.influencer.bookingDoneTemplate";
                break;
            case Booking::STATUS_CANCEL:
                $template = "email.influencer.bookingCancelTemplate";
                break;
            case Booking::STATUS_REJECT:
                $template = "email.influencer.bookingRejectTemplate";
                break;
            case Booking::STATUS_PAID:
                $template = "email.influencer.bookingPaidTemplate";
                break;
            default:
                $template;
          }

        return $template;
    }
}
