<?php
namespace App\Http\Controllers;

use Config;
use Timetable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Timetable\Api\Error\ResponseContainsErrors;
use Illuminate\Support\Facades\Log;
use Timetable\Api\Type\Order;

class WidgetController extends Controller
{
    private $client;
    
    public function __construct() {
        $this->client = new Timetable\Api\Client(Config::get('medicina.url'), Config::get('medicina.accessToken'));
    }
   
    public function index()
    {
        //echo $myJSON;
        return view('widget.index');
    }
    
    public function getBranch(){

        $query = (new Timetable\Api\Query\BranchesQuery())->wantFields('id', 'code', ['description' => ['name']]);
        $timetables = $this->client->query($query);
        $myJSON = json_encode($timetables);

        echo $myJSON;
    }
    
     public function getSpecialties(){

        $query = (new Timetable\Api\Query\SpecialtiesQuery())->wantFields('id', 'code', 'name');
        $timetables = $this->client->query($query);
        $myJSON = json_encode($timetables);

        echo $myJSON;
    }
    
    public function getDataTime(Request $request){
  
        $input = $request->all();
        $speciality[0] = (int)$request->input('speciality');
        $worker[0] = (int)$request->input('worker');
        $branches[0]=(int)$request->input('branches');
        $start=$request->input('start');
        $end=$request->input('end');
        $newformatMin =  Carbon::createFromFormat('Y-m-d', $start);//date('Y-m-d', strtotime($_GET['start']));//date("d.m.Y", strtotime("last Monday")) 
        $newformatMax =  Carbon::createFromFormat('Y-m-d', $end);//date('Y-m-d', strtotime($_GET['end']));//date("d.m.Y", strtotime("Sunday"));  
 
        if ($worker[0] === 0) {
            $query1 = (new Timetable\Api\Query\TimetablesQuery())
                    ->dateMin(Carbon::createFromFormat('Y-m-d', '2018-04-03'))
                    ->dateMax(Carbon::createFromFormat('Y-m-d', '2018-04-10'))
//                    ->dateMin($newformatMin)
//                    ->dateMax($newformatMax)
                    ->specialties($speciality)
                    ->branches($branches);
                    //->wantFields('id', 'start_time')
                    //->wantFields(['room' => ['number', 'floor', 'name']])
                    //->wantFields(['worker' => ['surname', 'name', 'patronymic']]);
        } else {
            $query1 = (new Timetable\Api\Query\TimetablesQuery())
//                    ->dateMin(Carbon::createFromFormat('Y-m-d', '2018-03-22'))
//                    ->dateMax(Carbon::createFromFormat('Y-m-d', '2018-03-23'))
                    ->dateMin($newformatMin)
                    ->dateMax($newformatMax)
                    ->workers($worker)//$worker
                    ->branches($branches);
                    //->wantFields('id', 'start_time');
                    //->wantFields(['room' => ['number', 'floor', 'name']])
                    //->wantFields(['worker' => ['surname', 'name', 'patronymic']]);
      }
      try {
          $timetables = $this->client->query($query1);
      } catch (ResponseContainsErrors $e) {
          Log::warning(print_r($e->getErrors(), true));
          return;
      }
      $Calendar=array();
//      print_r($timetables);
      foreach($timetables as $val){
        $start=(array)$val->start_time;
        $end=(array)$val->end_time;
        $Calendar[]=array(
          "id"    =>$val->id,
          "title" =>date('H:i', strtotime($start['date'])), 
          "time" =>date('H:i', strtotime($start['date'])),
          "start" =>date('Y-m-d H:i', strtotime($start['date'])),
          "allDay" => true 
        //  "end"   =>date('Y-m-d H:i', strtotime($end['date']))
        );
    }
    
    $myJSON = json_encode($Calendar);  
    echo $myJSON;
          
  }
    
    
    public function getWorker(Request $request){
        $input = $request->all();
        $speciality = $request->input('speciality');
        $branches[0]=(int)$request->input('branches');
        $result = substr($speciality, 1, -1);
        $idSpec = (explode(",", $result));
        foreach ($idSpec AS $index => $value){
            $arrSpec[$index] = (int)$value;   
        }
        
        $query = (new Timetable\Api\Query\WorkersQuery())
        ->branches($branches)
        ->specialties($arrSpec);
        
        $timetables = $this->client->query($query);
        $myJSON = json_encode($timetables);
        echo $myJSON;
    }
    
    public function addClint(Request $request){
        $input = $request->all();

        $mutation = (new Timetable\Api\Mutation\CreateOrderWithCustomerMutation())
        ->timetableId((int)$input['timetableId'])
        ->customer((new Timetable\Api\Type\Input\OrderCustomerInput())
            ->surname($input['surname']) 
            ->name($input['name'])
            ->patronymic($input['patronymic'])
            ->email($input['email'])
            ->phone('+' . $input['phone'])
            ->birthDate(Carbon::today()->subYears(18))
            ->sex('male')
        );
      
        try {
            /* @var $order Order */
            $order = $this->client->mutation($mutation);
        } catch (ResponseContainsErrors $e) {
            Log::warning(print_r($e->getErrors(), true));
            return;
        }
        echo $order->id;
        //$myJSON = json_encode($timetables);
        //echo $myJSON;
        //Object of class Timetable\\Api\\Type\\Order could not be converted to string
        //echo $timetables;
    }
}


?>