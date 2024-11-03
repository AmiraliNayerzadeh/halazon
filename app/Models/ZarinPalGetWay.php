<?php

namespace App\Models;

use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;
use ZarinPal\Sdk\ClientBuilder;
use ZarinPal\Sdk\Endpoint\PaymentGateway\RequestTypes\RequestRequest;
use ZarinPal\Sdk\Options;
use ZarinPal\Sdk\ZarinPal;

class ZarinPalGetWay extends Model
{

    public function send($amount, $user, $payment)
    {
        $date = Jalalian::now()->format('Y/m/d');

        $data = [
            "merchant_id" => "8d46f358-b392-46a2-949c-a5f3575cd042",
            "amount" => $amount,
            "callback_url" => "http://example.com/verify",
            "metadata" => [
                "mobile" => $user->phone,
                "email" => null,
            ]
        ];


        $description = "این سفارش در تاریخ $date توسط {$user->name} {$user->family} ثبت گردیده است.";


        $clientBuilder = new ClientBuilder();

        $clientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => 'application/json',
        ]));

        $options = new Options([
            'client_builder' => $clientBuilder,
            'sandbox' => false, // Enable sandbox mode
            'merchant_id' => '8d46f358-b392-46a2-949c-a5f3575cd042',
        ]);

        $zarinpal = new ZarinPal($options);
        $paymentGateway = $zarinpal->paymentGateway();

        $request = new RequestRequest();
        $request->amount = $amount; //Minimum amount 10000 IRR
        $request->description = "این سفارش در تاریخ $date توسط {$user->name} {$user->family} ثبت گردیده است.";
        $request->callback_url = 'https://your-site.test/examples/verify.php';
        $request->mobile = "$user->phone"; // Optional
        $request->currency = 'IRT'; // Optional IRR Or IRT (default IRR)

        try {
            $response = $paymentGateway->request($request);

            $payment->update([
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


}
