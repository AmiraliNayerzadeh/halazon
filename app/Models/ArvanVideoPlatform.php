<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArvanVideoPlatform extends Model
{
    private $apiKey ;
    private $client ;
    private $channel_id ;
    private $profile_id ;

    public function __construct()
    {
        $this->apiKey = env('ARVAN_API_KEY', '2aa8e8c1-078a-539a-bf7e-31863580c223');
        $this->client = new Client() ;

//        $this->channel_id = "1494bb6d-3e2d-404d-8756-6825b4681b93";
        $this->channel_id = "b433773d-f9cc-4237-9e84-3b404675a60f";


//        $this->profile_id = "22eb27f1-f07e-461f-b568-f5dcef485461" ;
        $this->profile_id = "bdf8e31b-f757-414f-94ed-193056d6fdda" ;
    }

    public function store($videoPath, $videoName , $description)
    {
        $url = "https://napi.arvancloud.ir/vod/2.0/channels/{$this->channel_id}/videos";
        try {
            $response = $this->client->post($url, [
                'headers' => [
                    'Authorization' => 'Apikey ' . $this->apiKey,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'title' => $videoName,
                    'description' => $description,
                    'video_url' => $videoPath,
                    'file_id' => '',
                    'convert_mode' => 'auto',
                    'profile_id' => $this->profile_id,
                    'parallel_convert' => false,
                    'thumbnail_time' => 7,
                    'watermark_id' => '',
                    'watermark_area' => 'FIX_BOTTOM_RIGHT',

                ],
            ]);

            // نتیجه ارسال درخواست

            $result = json_decode($response->getBody(), true);
            return $result;

        } catch (\Exception $e) {
            return [
                'error' => 'Failed to upload video',
                'message' => $e->getMessage()
            ];
        }
    }


    public function getVideo($video_id)
    {
        $baseUrl = 'https://napi.arvancloud.ir/vod/2.0/videos/';
        $url = $baseUrl . $video_id;


        try {
            $response = $this->client->get($url, [
                'headers' => [
                    'Authorization' => 'Apikey ' . $this->apiKey,
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            return [
                'message' => 'Failed to fetch channel data.',
                'error' => $e->getMessage(),
            ];
        }
    }



    public function getChanel()
    {
        $baseUrl = 'https://napi.arvancloud.ir/vod/2.0/channels/';
        $url = $baseUrl . $this->channel_id . '/profiles';

        try {
            $response = $this->client->get($url, [
                'headers' => [
                    'Authorization' => 'Apikey ' . $this->apiKey,
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            return [
                'message' => 'Failed to fetch channel data.',
                'error' => $e->getMessage(),
            ];
        }
    }





}
