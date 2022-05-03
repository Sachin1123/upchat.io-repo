<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class LeadExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $date_range, $sites;

    public function __construct(String  $sites, String $date_range) {

        $this->date_range = $date_range;
        $this->sites =  $sites;
    }
    public function headings(): array {
        return [
            "Id","Lead_id","User_id","ChatId","Name","Domain","Email","CompanyName","LeadType","categoryId","leadStatus","companyId","companyKey","phone","username","reason","Invalid Reason","ipAddress","RejectReason","Deleted","Created","Updated"
        ];
    }
    public function collection()
    {
        $date_range=  $this->date_range;
        $sites=         $this->sites;
    
        
            $query =  Lead::select('*');

            if ($sites != 'all_lead') {
                $query->where('companyName', $sites);
            }

            if ($date_range) {
              
                $date_range= explode('-',$date_range);
                $start_date=$date_range[0];
                $end_date=$date_range[1];
                
                $start_date = date("Y-m-d", strtotime($start_date));
                $end_date = date("Y-m-d", strtotime($end_date));
                $StartDate = $start_date.' 00:00:00';
                $endDate = $end_date.' 23:59:59';
              
                $query->whereBetween('created_at', [$StartDate, $endDate]);
            }
           
            $result= $query->get();
            
            return $result;
    }
}
