<?php
namespace App\Http\Controllers;

use Config;
use Timetable;
use Illuminate\Http\Request;



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
       $speciality = $request->input('speciality');
       $start = $request->input('start');
       $end = $request->input('end');

$result = substr($speciality, 1, -1);
$idSpec = (explode(",", $result));
foreach ($idSpec AS $index => $value){
    $arrSpec[$index] = (int)$value;   
}
$branches[0]=3;
//str.match(/(object)\[(.*)\]/);
//print_r($branches);
 if(empty($worker)){
  $newformatMin = date('Y-m-d', strtotime($_GET['start']));//date("d.m.Y", strtotime("last Monday")) 
  //echo $newformatMin.' '.$_GET['start'];
    $newformatMax = date('Y-m-d', strtotime($_GET['end']));//date("d.m.Y", strtotime("Sunday"));  
    $query1 = (new Timetable\Api\Query\TimetablesQuery())
        ->dateMin($newformatMin)
        ->dateMax($newformatMax)
        ->specialties($arrSpec)
        ->branches($branches);
        
       /*         'ids' => '[Int]',
        'workers' => '[Int]',
        'specialties' => '[Int]',
        'dateMin' => 'Date',
        'dateMax' => 'Date',
        'startTimeMin' => 'Time',
        'endTimeMax' => 'Time',
        'startDateTimeMin' => 'DateTime',
        'endDateTimeMax' => 'DateTime',
        'includeWithoutTime' => 'Boolean',
        'includeBusy' => 'Boolean',
        'branches' => '[Int]',*/
        
  }else{
 
    $newformatMin = date('Y-m-d', strtotime($_GET['start']));//date("d.m.Y", strtotime("last Monday"))
    $newformatMax = date('Y-m-d', strtotime($_GET['end']));//date("d.m.Y", strtotime("Sunday"));  
    $query1 = (new Timetable\Api\Query\TimetablesQuery())
        ->dateMin($newformatMin)
        ->dateMax($newformatMax)
        ->workers($worker)
        ->specialties($arrSpec);
  }      
$timetables = $this->client->query($query1);
$Calendar=array();

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


//print_r($timetables);
//var_dump($arrSpec);
$myJSON = json_encode($Calendar);

echo $myJSON;
       
       
    }
     public function getWorker(){
   
    }
 
}


?>