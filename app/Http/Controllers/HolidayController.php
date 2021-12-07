<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Holiday;
use PDF;

class HolidayController extends Controller
{
    //

    public function index()
    {
        $holiday = auth()->user()->holiday();
        return view('dashboard', compact('holiday'));
       // return view('dashboard');
    }
    // Generate PDF
    public function createPDF() {
        // retreive all records from db
        $data = auth()->user()->holiday();

        // share data to view
        view('pdf_view', compact('data'));
        $pdf = PDF::loadView('pdf_view');
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
    //
    public function getYear()
    {
    	return view('year');
    }
    //
    public static function getCountryCodeForIp()
    {   
        $ip = request()->ip();
        return Cache::remember("$ip", 60 * 5, function () use ($ip) {
            $response = Http::get("https://freegeoip.app/json/$ip");
            if ($response->status() !== 200) {
                return 'za';
            }
            $countryCode = $response->json('country_code');
            
          
            if (empty($countryCode)) {
                return 'za';
            }

            return $countryCode;
        });
    }

    public function fetch(Request $request ,Holiday $day){
        $query =$day::where('user_id', auth()->user()->id)->exists();
        if($query){
            $day::where('user_id', auth()->user()->id)->delete();
        }
        $this->validate($request, [
            'datetimepicker' => 'required|integer|between:2013,2050',
        ]);
        $year = $request->datetimepicker;
       
        $country = self::getCountryCodeForIp();
        $response = Http::get("https://kayaposoft.com/enrico/json/v2.0?action=getHolidaysForYear&year=$year&country=$country");
       
        $year_holidays = json_decode($response->body(),true);
    
        foreach($year_holidays as $holiday){
            $holidayName = $holiday['name'][0]['text'];
            if(array_key_exists( 'flags', $holiday)){
               $holidayName = $holiday['name'][0]['text']. ' Observed';
            }
            
            $flag ="";
            switch($holiday['date']['dayOfWeek']) {
                case('1'): $day_of_week ="Monday"; $flag="Long Weekend"; break;
                case('2'): $day_of_week ="Tuesday"; break;
                case('3'): $day_of_week ="Wednesday"; break;
                case('4'): $day_of_week ="Thursday"; break;
                case('5'): $day_of_week ="Friday"; $flag="Long Weekend"; break;
                case('6'): $day_of_week ="Saturday"; break;
                case('7'): $day_of_week ="Sunday"; $flag="Long Weekend"; break;
                default: $day_of_week ="day is non exitent";
            }
            //
            switch($holiday['date']['month']) {
                case('1'): $month ="January"; break;
                case('2'): $month ="February"; break;
                case('3'): $month ="March"; break;
                case('4'): $month ="April"; break;
                case('5'): $month ="May"; break;
                case('6'): $month ="June"; break;
                case('7'): $month ="July"; break;
                case('8'): $month ="August"; break;
                case('9'): $month ="September"; break;
                case('10'): $month ="October"; break;
                case('11'): $month ="November"; break;
                case('12'): $month ="December"; break;
                default: $day_of_week ="Month is non exitent";
            }
            //
            $day = new Holiday();
            $day->user_id = auth()->user()->id;
            $day->day = $holiday['date']["day"];
            $day->month = $month;
            $day->year = $holiday['date']['year'];
            $day->day_of_week = $day_of_week;
            $day->name = $holidayName;
            $day->flags = $flag;
            $day->save();
        }
        return redirect('/dashboard');

    }
}
