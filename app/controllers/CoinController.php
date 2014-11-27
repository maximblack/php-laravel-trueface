<?php

class CoinController extends BaseController {

    protected $layout = 'user.layout';

	public function pay($id)
	{

        $response = CustomResponse::find($id);

        if($response->paid)
            App::abort(401);

        $credits = Auth::user()->credits + Auth::user()->credits_referral;

        if($credits >= $response->price) {

            Auth::user()->credits -= $response->price;

            Auth::user()->save();

            $response->paid = 1;

            $response->save();

            return View::make('response.response-modal', array(
                'response' => $response,
                'success' => true,
            ));

        } else {

            return View::make('response.response-modal', array(
                'response' => $response,
                'success' => false,
            ));

        }

	}

    public function coins() {

        $merchant_id = 3991; // Идентификатор магазина в Pay2Pay
        $secret_key = '1gFFZsKJ5vYHSkxp5LX1'; // Секретный ключ
        $order_id = '00001'; // Номер заказа
        $amount = '1.00'; // Сумма заказа
        $currency = 'USD'; // Валюта заказа
        $desc = 'Заказ'; // Описание заказа
        $test_mode = 1; // Тестовый режим

        // Формируем xml
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
         <request>
         <version>1.2</version>
         <merchant_id>$merchant_id</merchant_id>
         <language>ru</language>
         <order_id>$order_id</order_id>
         <amount>$amount</amount>
         <currency>$currency</currency>
         <description>$desc</description>
         <test_mode>$test_mode</test_mode>
         </request>";

    // Вычисляем подпись
    $sign = md5($secret_key.$xml.$secret_key);
    // Кодируем данные в BASE64
    $xml_encode = base64_encode($xml);
    $sign_encode = base64_encode($sign);
    // Выводим форму инициализации платежа
    $form =  "<form action=\"https://merchant.pay2pay.com/?page=init\" method=\"post\">
     <input type=\"hidden\" name=\"xml\" value=\"$xml_encode\"/>
     <input type=\"hidden\" name=\"sign\" value=\"$sign_encode\"/>
     <input type=\"submit\"/>
     </form>";



        $this->layout->content = View::make('user.coins', array(
            'form' => $form,
        ));

    }

}