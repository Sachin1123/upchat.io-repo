<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Lead;

class LeadGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apex:lead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apex Lead';

 
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      
      $users=Company::where('status','=','Active')->where('apex_username','!=',null)->where('apex_company','!=',null)->where('apex_password','!=',null)->get();
      
        if(!empty($users)){
            foreach ($users as $user) {

                    $apex_company = $user->apex_company;
                    $apex_username = $user->apex_username;
                    $apex_password = $user->apex_password;
                
                    $params=array(
                    'apexchat-password: '.$apex_password,
                    'apexchat-username: '.$apex_username,
                    'apexchat-company: '.$apex_company,
                    'Content-Type: text/json'
                    ); 
                    
                 
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.apexchat.com/Services/ApexChatService.svc/leads',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER =>  $params,
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $result=json_decode($response);
             
                       if((isset($result->success)) && ($result->success == 1)){
                       
                        foreach ($result->data as $key => $leads) {
                            $newst = str_replace("/Date(", "", $leads->createdOn);
                            $newst = str_replace(")/", "", $newst);
                            $lead= Lead::where('leadId',$leads->id)->first();
                         
                           if(empty($lead)){
                           
                                $leadObj = new Lead;
                                $leadObj->created_at = date('Y-m-d H:i:s', ($newst/1000)); 
                                $leadObj->updated_at = date('Y-m-d H:i:s', ($newst/1000));
                                $leadObj->leadId = $leads->id;
                                $leadObj->domain = $leads->domain;
                                $leadObj->name = $leads->name;
                                $leadObj->leadType = $leads->leadType;
                                $leadObj->categoryId = $leads->categoryId;
                                $leadObj->chatId = $leads->chatId;
                                $leadObj->companyId = $leads->companyId;
                                $leadObj->companyKey = $leads->companyKey;
                                $leadObj->companyName = $leads->companyName;
                                $leadObj->email = $leads->email;
                                $leadObj->phone = $leads->phone;
                                $leadObj->username = $leads->username;
                                $leadObj->ipAddress = $leads->ipAddress;
                                $leadObj->leadStatus = 'valid';
                                $leadObj->user_id = $user->user_id;
                                $leadObj->reason = $leads->notes;
                                $leadObj->save();
                           }
                        }

                       }
            }
            
        
        }

    }
}
