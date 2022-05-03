<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Chat;
use App\Models\ChatDetail;

class ChatData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apex:chats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apex Chats';

    /**
     * Create a new command instance.
     *
     * @return void
     */
 

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
                    CURLOPT_URL => 'https://api.apexchat.com/Services/ApexChatService.svc/chats',
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
                       
                        foreach ($result->data as $key => $chats) {
                            $createdOn = str_replace(array("/Date(",")/"), "", $chats->createdOn);
                            $pickedUpOn = str_replace(array("/Date(",")/"), "", $chats->pickedUpOn);
                            $endedOn = str_replace(array("/Date(",")/"), "", $chats->endedOn);

                      
                     
                            $chat= Chat::where('chatId',$chats->Id)->first();
                        
                           if(empty($chat)){
                    
                                $chatObj = new Chat;
                                $chatObj->created_at = date('Y-m-d H:i:s', ($createdOn/1000)); 
                                $chatObj->updated_at = date('Y-m-d H:i:s', ($createdOn/1000));
                                $chatObj->endedOn = date('Y-m-d H:i:s', ($endedOn/1000));
                                $chatObj->pickedUpOn = date('Y-m-d H:i:s', ($pickedUpOn/1000));
                                $chatObj->leadType = $chats->leadType;
                                $chatObj->chatId = $chats->Id;
                                $chatObj->companyKey = $chats->companyKey;
                                $chatObj->companyName = $chats->companyName;
                                $chatObj->referrer = $chats->referrer;
                                $chatObj->ipAddress = $chats->ipAddress;
                                $chatObj->location = $chats->location;

                                $chatObj->user_id = $user->user_id;
                                $chatObj->save();
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.apexchat.com/Services/ApexChatService.svc/chats/'.$chats->Id,
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
                                $results=json_decode($response); 
                            
                               if((isset($results->success)) && ($results->success == 1)){
                              
                                   foreach ($results->data->transcript as $key => $value) {
                                         
                                     ChatDetail::create([
                                             'chat_id' =>$chats->Id,
                                             'username' =>$value->participantDisplayName,
                                             'chat' =>$value->text,
                                     ]);
                                   }
                               }
                           }
                      
                        }

                       }
            }
            
        
        }
    }
}
