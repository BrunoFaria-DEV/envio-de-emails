<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Mail\MailtrapMail;

use App\Models\Shipping;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new subscription emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $shippings = Shipping::where([['status', 'C'], ['shipping_type', 'S']])->get();

        foreach ($shippings as $key => $shipping) {
            $shippingDate = Carbon::parse($shipping->shipping_date);
            $currentDate = Carbon::now();

            if ($shippingDate->lessThanOrEqualTo($currentDate) ) {
                Log::info(['shipping_date' => $shippingDate, 'laravel_date' => $currentDate]);

                $shipping->status == 'I'; //IN PROGRESS
                $shipping->save();

                foreach ($shipping->shippingEmails()->get() as $key => $shippingEmail) {
                    try{
                        Mail::to($shippingEmail->email)->send(new MailtrapMail($shipping, $shippingEmail));

                        $shippingEmail->status = "S";

                        $shippingEmail->save();
                    }catch(\Exception $e){
                        $shippingEmail->status = "F";
                        $shippingEmail->error = $e->getMessage();

                        $shippingEmail->save();
                    }
                }

                if ( count($shipping->shippingEmails->where('status', 'F')) >= 1 ) {
                    $shipping->status = 'F';
                    $shipping->save();
                }else {
                    $shipping->status = 'S';
                    $shipping->save();
                }
            }
        }
    }
}
