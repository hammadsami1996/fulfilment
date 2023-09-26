<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            //
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }


    function send_trax($id,$service="1")
{
    $ci =& get_instance();
    $ci->load->database();
    $output = 0;
    $order = get_data_of('orders', '*', " AND id=$id", 1);
    if ($order) {
        $url = "https://sonic.pk/api/shipment/book";
        $ch = curl_init();
        $options = array(
            'service_type_id' => $service,
            'pickup_address_id' => '',
            'information_display' => '1',
            'consignee_city_id' => get_specific_field("cities", "trax", $order->city),
            'consignee_name' => $order->name,
            'consignee_address' => $order->address,
            'consignee_phone_number_1' => $order->mobile,
            'consignee_email_address' => $order->email ? $order->email : get_store_info('email'),
            'order_id' => $order->rend_order_id,
            'item_product_type_id' => '22',
            'item_description' => empty($order->item_summary_mannual) ? $order->item_summary : $order->item_summary_mannual,
            'item_quantity' => $order->qty,
            'item_insurance' => '0',
            'item_price' => $order->net_total,
            'pickup_date' => date('Y-m-d'),
            'special_instructions' => !empty($order->instructions) ? $order->instructions : 'No',
            'estimated_weight' => '0.5',
            'shipping_mode_id' => '1',
            'amount' => $order->net_total,
            'payment_mode_id' => '1'

        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:' 
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($options));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json_feed = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($json_feed);
//        var_dump($result);
        if (isset($result->errors)) {
            $output = json_encode($result->errors);
        } elseif (isset($result->message) && $result->status == 1) {
            $output = $result->message;
        } else {
            $output = (string)$result->tracking_number;
      
        }
    }

    return $output;
}
    function send_tcs_envio($id, $services = "O")
    {
        $ouput = 0;

        $order = get_data_of('orders', '*', " AND id=$id", 1);
        if ($order) {

            $remarkstcs = !empty($order->instructions) ? $order->instructions : 'Please Deliver Urgently';
            $mobile = '0' . ltrim(preg_replace('/\D+/', '', $order->mobile), 0);
            $city = get_specific_field("cities", "tcs", $order->city);
            $codamount = $order->total + $order->shipping_charges - ($order->discount + $order->redeem_amount + $order->coupons_discount + $order->advance);

            if ($order->item_summary) $details = $order->item_summary; else $details = "Record Not found";

            try {

                $apiurl = 'http://webapp.tcscourier.com/CODAPI/Service1.asmx?WSDL';
                $client = new SoapClient($apiurl, array("trace" => 1, "exception" => 0));

                $tcsuname = TCS_envio_USER;
                $tcspass = TCS_envio_PASS;
                $code = TCS_envio_CODE;
                $resultQuick = $client->InsertData(
                    array(
                        'userName' => $tcsuname,
                        'password' => $tcspass,
                        'costCenterCode' => $code,
                        'consigneeName' => $order->name,
                        'consigneeAddress' => $order->address,
                        'consigneeMobNo' => $mobile,
                        'consigneeEmail' => $order->email,
                        'originCityName' => "KARACHI",
                        'destinationCityName' => $city,
                        'pieces' => "1",
                        'weight' => "0.5",
                        'codAmount' => $codamount,
                        'custRefNo' => $id,
                        'productDetails' => $details,
                        'fragile' => "NO",
                        'services' => $services,
                        'remarks' => $remarkstcs,
                        'insuranceValue' => "0"
                    )
                );
                return $resultQuick->InsertDataResult;

            } catch (Exception $e) {
                $ouput = $e;
            }
        }
//        var_dump($ouput);
//        die();
        return $ouput;
    }
function send_postex($id)
{
    $output = 0;
    $order = get_data_of('orders', '*', " AND id=$id", 1);
    if ($order) {
        $codamount = $order->total + $order->shipping_charges - ($order->discount + $order->redeem_amount + $order->coupons_discount + $order->advance);
        $mobile = '0' . ltrim(preg_replace('/\D+/', '', $order->mobile), 0);
        $remarks = "Handle With Care - Please Call Before Delivery / B.O id: " . $order->confirmed_by . " - " . $order->instructions;
        $url = "https://www.day2daycourier.com/software/api/shipment/book";
        $data = array(
            "orderRefNumber" => $id,
            "invoicePayment" => $codamount,
            "orderDetail" => $order->item_summary,
            "customerName" => $order->name,
            "customerPhone" => $mobile,
            "deliveryAddress" => $order->address,
            "transactionNotes" => $remarks,
            "cityName" => get_specific_field("cities", "postex", $order->city),
            "invoiceDivision" => 0.5,
            "items" => intval($order->qty)
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.postex.pk/services/integration/api/order/v1/create-order',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'token: ',
                "Content-Type:application/json"
            ),
            CURLOPT_POSTFIELDS => json_encode($data)
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        if (isset($result) && !empty($result->dist->trackingNumber)) {
            $output = $result->dist->trackingNumber;
        } else {
            $output = $result->dist->orderStatus;
        }
    }
    return $output;
}
function send_call_courier($id,$ServiceTypeId=7)
{
    $output = 0;
    $order = get_data_of('orders', '*', " AND id=$id", 1);
    if ($order){
        $remarks = "Handle With Care - Please Call Before Delivery / B.O id: " . $order->confirmed_by . " - " . $order->instructions;
        $codamount = $order->total + $order->shipping_charges - ($order->discount + $order->redeem_amount + $order->coupons_discount + $order->advance);
        $city = get_specific_field("cities", "call_courier", $order->city);
        $array = [
            'loginId'=>	'',
            'ConsigneeName'=>	$order->name,
            'ConsigneeRefNo'=>	$order->id,
            'ConsigneeCellNo'=>	$order->mobile,
            'Address'=>	$order->address,
            'Origin'=>	get_specific_field("cities", "title", $order->city),
            'DestCityId'=>	$city,
            'ServiceTypeId'=> $ServiceTypeId,
            'Pcs'=>$order->qty,
            'Weight'=>	0.5,
            'Description'=>	$order->item_summary,
            'SelOrigin'=>	'Domestic',
            'CodAmount'=>	$codamount,
            'SpecialHandling'=>	'False',
            'MyBoxId'=>	1,
            'Holiday'=>	'False',
            'remarks'=>	$remarks,
            'ShipperName'=>	strtoupper(get_store_info('title')),
            'ShipperCellNo'=>	'',
            'ShipperArea'=>	0,
            'ShipperCity'=>	2,
            'ShipperAddress'=>	"",
            'ShipperLandLineNo'=>	'',
            'ShipperEmail'=>	''
        ];
        $url = "http://cod.callcourier.com.pk/api/CallCourier/SaveBooking?".http_build_query($array);


        $ch = curl_init();
        $timeout = 0; // 100; // set to zero for no timeout
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        $file_contents = curl_exec ( $ch );
        curl_close ( $ch );
$result = json_decode($file_contents);

        if ($result->Response) {
            if(!is_null((string)$result->CNNO)){
            $output = (string)$result->CNNO;
            }else{
                $output = (string)$result->Response;
            }
        }
    }
    return $output;
}
function send_mnp($id,$service="overnight")
    {
        $output = "";
        $order = get_data_of('orders', '*', " AND id=$id", 1);
        if ($order) {
            $data = array(
                'username' => MNP_USERNAME,
                'password' => MNP_PASSWORD,
                'AccountNo' => MNP_ACCOUNT_NO,
                'consigneeName' => $order->name,
                'consigneeAddress' => $order->address,
                'consigneeMobNo' => $order->mobile,
                'consigneeEmail' => $order->email,
                'originCityName' => "Karachi",
                'destinationCityName' => get_specific_field('cities', 'mnp', $order->city),
                'pieces' => $order->qty,
                'weight' => "0.5",
                'codAmount' => $order->net_total,
                'custRefNo' => !empty($order->rend_order_id) ? $order->rend_order_id: $order->id,
                'productDetails' => $order->item_summary,
                'fragile' => "",
                'service' =>$service,
                'remarks' => !empty($order->instructions) ? $order->instructions : "Handle With Care Please Call Before Delivery",
                'insuranceValue' => "",
                'locationID' => 37311,
                'InsertType' => 0,
                'ReturnLocation' => 37311,
                'subAccountId' => 0,
            );
//            $url = "http://mraabta.mulphico.pk/mnpconsignments/pushtomnp.asmx/InsertData";
//            //http://mraabta.mulphico.pk/mnpconsignments/pushtomnp.asmx/InsertData
//            return mnp_curl_http_post($url, $data);

                        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://mnpcourier.com/mycodapi/api/Booking/InsertBookingData',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            var_dump($response);
//            var_dump(json_encode($data));
            $responseArray = json_decode($response, true);
//var_dump($responseArray);
            if ($responseArray && isset($responseArray[0]['orderReferenceId']) && !empty($responseArray[0]['orderReferenceId'])) {
                $orderReferenceId = $responseArray[0]['orderReferenceId'];
                $output = $orderReferenceId;
            }else{
                $message = $responseArray[0]['message'];
                $output = $message;
            }
        }
//        var_dump($output);
            return $output;
    }
}

