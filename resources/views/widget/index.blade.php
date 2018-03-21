<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>widget</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" href="/css/fullcalendar.css">
        <link rel="stylesheet" href="/css/fullcalendar.print.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/fullcalendar/moment.min.js"></script>
        <script src="/js/fullcalendar/fullcalendar.js"></script>
        <script src="/js/fullcalendar/locale-all.js"></script> 
        <script src="/js/main.js"></script>
    </head>
    <body>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 block-center">
              <h1>Онлайн-запись</h1>
                  <div class="step1">      
                          <p class="sub-h1">2 простых шага</p>
                     <div class="line-obect">    
                          <div class="row">
                           <div class="col-md-2">
                            <span class="step_title">Шаг - 1</span>
                           </div>
                           <div  class="col-md-10">
                               <select id="med_obeject" style="display: block;">
                                 <option disabled selected value> -- Выберите медицинский центр -- </option>
                               </select>
                           </div>
                          </div>
                       </div>     
                          <div class="row">
                            <div class="col-md-2">
                              <span class="step_title">Шаг - 2</span>
                            </div>
                            <div class="col-md-5">
                                    <select id="speciality" style="display: block;">
                                        <option disabled selected value> -- Выберите специальность -- </option>
                                    </select>
                            </div>  
                            <div class="col-md-5">
                               <select id="worker" style="display: block;">
                                    <option disabled selected value> -- Выберите врача  -- </option>
                                </select>
                             </div>   
                          </div>  
                          
                          <div class="row">
                             <div class="col s12 box-calendar">
                               <h3>Свободные талоны</h3>
                               <div id="calendar"></div>
  
                               
                             </div>
                          </div>  
                 </div>    
            </div>
          </div>
        </div>
    </body>
</html>
