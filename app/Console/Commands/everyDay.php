<?php
namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Carbon\Carbon;
class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:update';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Added succussfully';
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

        $check = DB::table("moon_dates")
            ->orderByDesc('created_at')
            ->first();


        if (!empty($check)) {
            if ($check->value == 0) {
                $i = 0;
            } else {
                
                $i = $check->value;

            }
            $date3 = date('d-m-Y', strtotime("0 days"));
            $date = date('d-m-Y', strtotime($i . "days"));

        } else {
            $i = 0;
            $date3 = date('d-m-Y', strtotime("0 days"));
            $date = date('d-m-Y', strtotime("0 days"));
        }

        $client = new Client();
        $res = $client->request('GET', 'https://api.aladhan.com/v1/gToH?date=' . $date);
        $arabicdate = $res->getBody();
        $date1 = explode(',', $arabicdate);
        $date2 = explode(':', $date1[2]);
        echo $date2[3];
        $data = array("english_date" => $date3, "arabic_date" => $date2[3], "value" => $i, "created_at" => Carbon::now(), "updated_at" => now());
        DB::table('moon_dates')->insert($data);
    }
}
