<?php

namespace App\Models;

use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;
use ZarinPal\Sdk\ClientBuilder;
use ZarinPal\Sdk\Endpoint\PaymentGateway\RequestTypes\RequestRequest;
use ZarinPal\Sdk\Endpoint\PaymentGateway\RequestTypes\VerifyRequest;
use ZarinPal\Sdk\HttpClient\Exception\ResponseException;
use ZarinPal\Sdk\Options;
use ZarinPal\Sdk\ZarinPal;

class ZarinPalGetWay extends Model
{
    protected $order ;
    protected $totalPrice;
    protected $user;
    protected $payment;
    protected $merchant ='8d46f358-b392-46a2-949c-a5f3575cd042' ;

    protected $callback ;

    public function __construct($order = null, $totalPrice = null, $user = null, $payment = null)
    {
        $this->order = $order ;
        $this->totalPrice = $totalPrice;
        $this->user = $user;
        $this->payment = $payment;
        $this->callback = $order ? route('order.status', $order) : null;
    }


    public function send()
    {
        $date = Jalalian::now()->format('Y/m/d');

        $data = [
            "merchant_id" => $this->merchant,
            "amount" => $this->totalPrice,
            "callback_url" => $this->callback,
            "metadata" => [
                "mobile" => $this->user->phone,
                "email" => null,
            ]
        ];


        $description = "این سفارش در تاریخ $date توسط {$this->user->name} {$this->user->family} ثبت گردیده است.";


        $clientBuilder = new ClientBuilder();

        $clientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => 'application/json',
        ]));

        $options = new Options([
            'client_builder' => $clientBuilder,
            'sandbox' => false, // Enable sandbox mode
            'merchant_id' => $this->merchant,
        ]);

        $zarinpal = new ZarinPal($options);
        $paymentGateway = $zarinpal->paymentGateway();

        $request = new RequestRequest();
        $request->amount = $this->totalPrice; //Minimum amount 10000 IRR
        $request->description = "این سفارش در تاریخ $date توسط {$this->user->name} {$this->user->family} ثبت گردیده است.";
        $request->callback_url = $this->callback;
        $request->mobile = $this->user->phone; // Optional
        $request->currency = 'IRT'; // Optional IRR Or IRT (default IRR)

        try {
            $response = $paymentGateway->request($request);

            $this->payment->update([
                'fee' => $response->fee,
                'code' => $response->code,
                'message' => $response->message,
            ]);


            $url = $paymentGateway->getRedirectUrl($response->authority); // create full url Payment
            header('Location:' . $url);

        } catch (ResponseException $e) {
            var_dump($e->getErrorDetails());
            dd($e->getErrorDetails()) ;
        } catch (\Exception $e) {
            dd($e->getMessage());
            echo 'Payment Error: ' . $e->getMessage();
        }


    }



    public function verify($order)
    {
        $clientBuilder = new ClientBuilder();
        $clientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => 'application/json',
        ]));

        $options = new Options([
            'client_builder' => $clientBuilder,
            'sandbox' => false,
            'merchant_id' => $this->merchant,
        ]);

        $zarinpal = new ZarinPal($options);
        $paymentGateway = $zarinpal->paymentGateway();

        $authority = filter_input(INPUT_GET, 'Authority', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_GET, 'Status', FILTER_SANITIZE_STRING);

        if ($status === 'OK') {

            $amount = $order->total;

            if ($amount) {
                $verifyRequest = new VerifyRequest();
                $verifyRequest->authority = $authority;
                $verifyRequest->amount = $amount;

                try {
                    $response = $paymentGateway->verify($verifyRequest);

                    if ($response->code === 100) {
                        echo "Payment Verified: \n";
                        echo "Reference ID: " . $response->ref_id . "\n";
                        echo "Card PAN: " . $response->card_pan . "\n";
                        echo "Fee: " . $response->fee . "\n";

                        $order->update(['status' => 'پرداخت شده']);

                    } else if ($response->code === 101) {
                        echo "Payment already verified: \n";
                    } else {
                        echo "Transaction failed with code: " . $response->code;
                        $order->update(['status' => 'نیاز به بررسی']);

                    }

                    $payment = $order->payments()->latest()->first();

                    $payment->update([
                        'code'  => $response->code ,
                        'card_number'  => $response->card_pan ,
                        'traceNumber'  => $response->ref_id,
                    ]);

                } catch (ResponseException $e) {
                    echo 'Payment Verification Failed: ' . $e->getErrorDetails();
                } catch (\Exception $e) {
                    echo 'Payment Error: ' . $e->getMessage();
                }
            } else {
                echo 'No Matching Transaction Found For This Authority Code.';
            }
        } else {
            echo 'Transaction was cancelled or failed.';
            $order->update(['status' => 'انصراف از پرداخت']);

        }
    }



}
