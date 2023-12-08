<?php

use Illuminate\Models\DB;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

if (!function_exists('counter')) {
    /**
     * Counter class helper
     *
     * @return App\Models\Counter
     */
    function counter()
    {
        return new App\Models\Counter;
    }
}

// app/Helpers/settings.php

if (!function_exists('Settings')) {
    function Settings()
    {
        return new \App\Support\Settings(); // Adjust the namespace according to your settings class
    }
}


if (!function_exists('api')) {
    /**
     * Json response for API
     *
     * @param array $response
     * @param integer $code
     * @return App\Support\Counter
     */
    function api($response, $code = 200)
    {
        return response()->json($response, $code);
    }
}

//
//function moneyFormat($value, $currency, $code = true)
//{
//    $amount = number_format($value, $currency->decimal_place);
//
//    return $code ? $currency->code . ' ' . $amount : $amount;
//}

if (!function_exists('uploadFile')) {
    /**
     * Upload file to storage folder
     *
     * @param $file
     * @param $dir
     * @return string or null
     */
    function uploadFile($file, $dir = 'storage/app/uploads/')
    {
        $fileName = str_random(32) . '.' . $file->extension();

        if ($file->move(base_path($dir), $fileName)) {
            return $fileName;
        }

        return null;
    }
}
if (!function_exists('deleteFile')) {
    /**
     * Delete file from storage folder
     *
     * @param $file
     * @param $dir
     * @return string or null
     */
    function deleteFile($fileName, $dir = 'storage/app/uploads/')
    {
        return File::delete(base_path($dir) . $fileName);
    }
}

if (!function_exists('pdf')) {
    /**
     * PDF output helper
     *
     * @param string $file
     * @param array $model
     */
    function pdf($file, $model, $data = "", $unlimit = false)
    {
        if ($unlimit) {
            ini_set('pcre.backtrack_limit', "10000000");
        }
        if ($data) {
            $pdf = pdfRaw1($file, $model, $data);

            if (isset($data['title'])) {
                $file = $data['title'] . '.pdf';
            } else {
                if (isset($model['number'])) {
                    $file = $model['number'] . '.pdf';
                } else {
                    $file = 'report.pdf';
                }
            }
        } else {
            $pdf = pdfRaw($file, $model);
            if (isset($model->number)) {
                $file = $model->number . '-' . time() . '.pdf';
            } else {
                $file = mt_rand() . '-' . time() . '.pdf';
            }
        }

        if (request()->has('mode') && request()->mode == 'download') {
            return $pdf->Output($file, Destination::DOWNLOAD);
        }
//        dd($file);;
        return $pdf->Output($file, Destination::INLINE);
    }
}

function pdfRaw1($file, $model, $data)
{


    $options = settings()->getMany(['header', 'footer', 'uploaded_logo']);

    $options = array_filter($options, function ($key) {
        return !is_null($key);
    });
    $html = view($file, ['model' => $model, 'data' => $data, 'options' => $options]);
    $config_array = config('pdf');

    //Set Orientation for the following reports
    $dataf = array_filter($data, function ($key) {

        return !is_null($key);

    });

    if ($file == 'docs.unit_ledger' || $file == 'docs.inventory_report' || $file == 'docs.inventory_report_details' || $file == 'docs.inventory_report' || $file == 'docs.LeadList_report' || $file == 'docs.receiptList') {

        array_set($data, 'orientation', 'L');

    }
    // dd($file) ;

    $pdf = new Mpdf($data);
    $pdf->WriteHTML($html);

    return $pdf;
}

function pdfRaw($file, $model)
{
    $options = settings()->getMany(['header', 'footer', 'uploaded_logo']);
    $options = array_filter($options, function ($key) {
        return !is_null($key);
    });
    $html = view($file, ['model' => $model, 'options' => $options]);
    // dd($html);
    // dd($html);
    // $pdf = new Mpdf(config('pdf'));
    $pdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        // 'format' => 'A4'.($orientation == 'L' ? '-L' : ''),
        // 'orientation' => $orientation,
        // 'margin_left' => $margin_left,
        // 'margin_right' => $margin_right,
        'margin_top' => 35,
        'dpi' => '144',
        'page-size' => 'a4',
        'enable-javascript',
        'debug-javascript',
        'margin_bottom' => 20,
//        'margin_header' => ,
        'margin_footer' => 9,
    ]);

    $pdf->WriteHTML($html);

    return $pdf;
}

