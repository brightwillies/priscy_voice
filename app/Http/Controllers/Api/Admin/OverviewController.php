<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Leader;
use App\Models\News;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendSms($to, $message)
    {
        $body = $message;
        $to = $to;
        $from = '18332265402';

        $data = array('body' => $body, 'to' => $to, 'from' => $from);

        $newArray[] = $data;

        $myBody['messages'] = $newArray;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://rest.clicksend.com/v3/sms/send',

            [
                'auth' => ['pcgebenezerbronx@gmail.com', '3101Eastchester#'],
                'form_params' => $myBody,
            ]
        );
        $response = $response->getBody()->getContents();
        //  return $response;

    }

    public function stats()
    {

        $records = [];
        $news = News::count();
        $executives = Leader::count();
        $complains = Complaint::count();

        $data = array(
            'news' => $news,
            'executives' => $executives,
            'complains' => $complains,
        );
        return $this->successResponse('', $data);
    }

}
