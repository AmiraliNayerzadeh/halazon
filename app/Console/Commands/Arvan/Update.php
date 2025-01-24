<?php

namespace App\Console\Commands\Arvan;

use App\Models\ArvanVideoPlatform;
use App\Models\Headline;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arvan:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Update Aravan Field in HeadLine Table ';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $headlines = Headline::where('is_move_video', 1)
            ->whereNull('arvan_video_url')
            ->where('updated_at', '<=', Carbon::now()->subMinutes(5))
            ->get();

        foreach ($headlines as $head) {
            try {
                $platform = new ArvanVideoPlatform();

                $data = $platform->getVideo($head->arvan_video_id);


                if ($data['data']['play_ready'] == 1) {

                    $video_url = $data['data']['video_url'];
                    $video_player = $data['data']['player_url'];

                    $head->update([
                        'arvan_video_url' => $video_url,
                        'arvan_video_player' => $video_player
                    ]);

                    $this->info("Video Headline $head->id Was Updated successful");

                } else {
                    $this->error("Error! Video Headline $head->id Still Dont Ready Fpr play in Arvan VOD ... ! ");
                }


            } catch (\Exception $exception) {
                $this->error("Error! Video Headline $head->id Dosent Uodated Data | Exseption: " . $exception->getMessage());
            }
        }

    }
}
