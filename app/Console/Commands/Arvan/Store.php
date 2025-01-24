<?php

namespace App\Console\Commands\Arvan;

use App\Models\ArvanVideoPlatform;
use App\Models\Headline;
use Illuminate\Console\Command;

class Store extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arvan:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Send Offline Video Course To ArvanCloud Video Platform With Execute API ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $headlines= Headline::where('video' , '!=' , null)->where('is_move_video' , 0)->get() ;

        foreach ($headlines as $head) {
            try {
                $platform = new ArvanVideoPlatform();

                $file_name = str_replace(' ' , '-' , $head->title).'-'.$head->id;

                $course = $head->course ;

                $description = "This Video Related to Course ID: $course->id Name: $course->title And Headline ID is: $head->id ";

                $videoResult = $platform->store($head->video, $file_name ,  $description);

                if (isset($videoResult['error'])) {
                    return response()->json($videoResult, 500);
                } else {
                    $head->update([
                        'is_move_video' => 1 ,
                        'arvan_video_id'=> $videoResult['data']['id']
                    ]);

                    $this->info("Video Headline $head->id Was Send To ArvanCloud successful");

                }
            } catch (\Exception $exception) {
                $this->error("Error! Video Headline $head->id Dosent Move To ArvanCloud | Exseption: ". $exception->getMessage());
            }
        }
    }
}
