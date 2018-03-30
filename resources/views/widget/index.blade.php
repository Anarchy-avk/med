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
                             <div class="col-md-12 box-calendar">
                               <h3>Свободные талоны</h3>
                               <div id="calendar"></div>
  
                               
                             </div>
                          </div>  
                 </div>
                 
            <div class="step2">
               <div class="row">
                   <div class="col-md-12">
                      <h3>Подтверждения записи</h3>
                         <div class="row">
                             <div class="col-md-6">
                                  <label class="info_title">Адрес:</label>
                             </div>
                             <div class="col-md-6">
                               <div class="address item_result"> </div>
                             </div>
                        </div>  
                        <div class="row">
                             <div class="col-md-6">
                                  <label class="info_title" >Специальность:</label>
                             </div>
                             <div class="col-md-6">
                               <div id="specialityText" class="spec item_result"> </div>
                             </div>
                        </div> 
                        <div class="row">
                             <div class="col-md-6">
                                  <label class="info_title">Дата и время:</label>
                             </div>
                             <div class="col-md-6">
                               <div class="date-time item_result"> </div>
                             </div>
                        </div>  
                       
                       <div class="row">
                         <div class="col-md-12">
                             <div class="block-pacient">
                                  <div class="title-header" >
                                     <div id="dateTimeText"></div>
                                      <h3>Введите данные пациента </h3>
                                      <div id="patientText"></div>
                                  </div>
                                  
                                  <div id="patient" style="display: none;">
                                    <div id="time"></div>
                                  </div>
                                  <meta name="_token" content="{{ csrf_token() }}" />        
                                 <form id="customer" id="sign-up" action="/client" method="post">
                                  <div class="row ">
                                     <div class="col-md-12">
                                         <div class="form-group">
                                            <label for="surname" class="label_client">Фамилия</label>
                                            <input placeholder=" " name="surname" id="surname" type="text" class="form-control">
                                            
                                         </div>
                                         <div class="form-group">
                                            <label for="name" class="label_client">Имя</label>
                                            <input placeholder="" name="name" id="name" type="text" class="form-control">
                                           
                                         </div>
                                         <div class="form-group">
                                            <label for="patronymic" class="label_client">Отчество</label>
                                            <input placeholder="" name="patronymic" id="patronymic" type="text" class="form-control">
                                            
                                         </div>
                     
                                         <div class="form-group">
                                            <label for="email" class="label_client">Почта</label>
                                            <input placeholder="" name="email" id="email" type="text" class="form-control">
                                            
                                         </div>
                                         <div class="form-group">
                                           
                                            <label for="phone" class="label_client">Телефон</label>
                                            <input placeholder="" name="phone" id="phone" type="text" class="form-control">
                                            
                                         </div>
                                        <input type="hidden" name="timetableId" id="timetableId" value="" />
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                </div>  
                                    <div id="confirm">
                                     <div style="width: 100%;    text-align: center;"><br><div class="btn btn-success" style="width: 100%;" id="send_form" >Получить талон</div></div>
                                   </div>     
                               </form> 
                                
                           </div>     

                        </div>    
                      </div>  
                   </div>
               </div>       
            </div>
          </div>
        </div>
    </body>
</html>
