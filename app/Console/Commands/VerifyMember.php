<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use HTMLDomParser;
use App\User;
use Illuminate\Support\Facades\Mail;
use  App\Mail\UnverifiedMember;

class VerifyMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to verify CA members.';

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
     * @return mixed
     */
    public function handle()
    {
        try{
            $user = User::whereNotNull('member_id')
                            ->where('user_type','0')
                            ->where('service_type','1')
                            ->where('member_id_status','Unverified')
                            ->first();
            
            
                
            $memberId = $user->member_id;
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://112.133.194.254/locm.asp",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "VTI-GROUP=0&mrn=".$memberId."&B1=Submit",
              CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                $user->member_id_status="Verification Error";
                $user->save();
                Mail::to($user->email)->send(new UnverifiedMember($user));
            }else{

            $memberInfo = [];
            $tables = HTMLDomParser::str_get_html($response)->find('form[name=FrontPage_Form1] table');
            if(count($tables) > 0){
                $table = $tables[0];
                    foreach($table->find('tr') as $tr) {
                        $tds = $tr->find('td');
                        for($i =0 ; $i < count($tds ); $i=$i+2){
                            $index = trim(strip_tags(str_replace('&nbsp;','',$tds[$i]->plaintext)));
                            $value = isset($tds[$i+1]) ? trim(strip_tags(str_replace('&nbsp;','',$tds[$i+1]->plaintext))) : null;
                            $memberInfo[strtolower($index)]=$value;   
                        }
                    }
                }
            }

            if(isset($memberInfo['status']) && strtolower($memberInfo['status']) == 'active'){
                $user->member_id_status="Verified";
                $user->save();
            }else{
                $user->member_id_status="Verification Failed";
                $user->save();
                Mail::to($user->email)->send(new UnverifiedMember($user));
            }
            
         }catch(\Exception $e){
            echo $e->getMessage();
         }  
    }
}
