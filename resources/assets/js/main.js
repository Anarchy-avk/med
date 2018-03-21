$(document).ready(function () {
 var med_obeject='';
    $.get("/branch", function (data, status) {
       var obj = $.parseJSON(data);
       select = document.getElementById('med_obeject');
       for (var i = 0; i < obj.length; i++) {
         var opt = document.createElement('option');
         if(obj[i].code.length>0){
             opt.value = obj[i].id;
             opt.innerHTML = obj[i].description.name;
             select.appendChild(opt);
         }
      }
  }); 
  
  
            $.get("/specialties", function (data, status) {
                var obj = $.parseJSON(data);
                select = document.getElementById('speciality');
                for (var i = 0; i < obj.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = obj[i].id;
                    opt.innerHTML = obj[i].name;
                    select.appendChild(opt);
                }
            //    document.getElementById('spinner').className = "preloader-wrapper small inactive";
             
                               var calendar=$('#calendar').fullCalendar({
                                      header: {
                                        left: 'prev,next',
                                        center: 'title',
                                        right: 'basicWeek'
                                      },
                                        columnHeader:true,
                                        columnHeaderFormat:'D ddd',
                                      defaultView: 'basicWeek',
                                  //    contentHeight: 400,
                                      
                                     // navLinks: true, // can click day/week names to navigate views
                                     // editable: true,
                                      locale: 'ru',
                                       viewRender: function(view, element) {
                                           
                                         console.log(view.intervalStart.format());
                                           console.log(view.intervalEnd.format());
                                            speciality=document.getElementById('speciality').value;
                                            getDataTime(speciality,view.intervalStart.format(),view.intervalEnd.format());                   
                   
                                       },
                                        eventClick: function(calEvent, jsEvent, view) {
                                           
                                             worker=$('#worker option:selected').val();
                                             med_obeject=$('#med_obeject option:selected').val();
                                             console.log("----------");
                                             console.log(calEvent);console.log(jsEvent);console.log(view);
                                             if(med_obeject.length!=0){
                                                       
                                                 $('.step1').hide();
                                                 $('.step2 .address').text($('#med_obeject option:selected').text());
                                                 $('.step2 .spec').text($('#speciality option:selected').text());
                                                 $('.step2 .date-time').text(calEvent.start._i);
                                                  $('.step2').show();
                                                  // $('.block-pacient').show();
                                                   $('input[name=timetableId]').val(calEvent.id);
                                                  document.getElementById('dob').value=calEvent.start._i;
                                                  document.getElementById('specialityText').innerHTML=$('#speciality option:selected').text();
                                                 //  checkdatetime(calEvent.id, calEvent.start._i);
                                                /*  $.get("gettime.php?token=" + document.getElementById('token').value + "&worker=" + worker + "&date=" + calEvent.start._i, function (data, status) {
                                                    var obj = $.parseJSON(data);
                                                    for (var i = 0; i < obj.length; i++) {
                                                        var timestamp = new Date(obj[i].start_time['date']);
                                                        var hours = timestamp.getHours();
                                                        var minutes = timestamp.getMinutes();
                                                        if (minutes == 0) {
                                                            minutes = '00';
                                                        }
                                                        var r = $('<input type="button" class="btn" style="width: 70px; margin: 2px; padding: 2px;" onclick="checkdatetime(' + obj[i].id + ')"  value="' + hours + ':' + minutes + '" id="' + obj[i].id + '"/>');
                                                        $("#time").append(r);
                                
                                                    }
                                                    if (obj.length == 0) {
                                                        r = $('<p> По вашему запросу данных не найдено.</p>');
                                                        $("#time").append(r);
                                                    }
                                                   
                                                }); */
                                              }else{
                                                alert("Выберите мед. центр!");
                                              }  
                                           //alert('Event: ' + calEvent.id);
                                           /*  alert('Event: ' + calEvent.title);
                                            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                                            alert('View: ' + view.name);*/
                                            // change the border color just for fun
                                            //$(this).css('border-color', 'red');
                                        
                                          },
                                          
                                    });
              
                    function getMonday(d) {
                      d = new Date(d);
                      var day = d.getDay(),
                          diff = d.getDate() - day + (day == 0 ? -6:1); // adjust when day is sunday
                      return new Date(d.setDate(diff));
                    }      
                                    
                 $("#speciality").change(function () {
                     //$('.block-pacient').hide();
                     speciality=document.getElementById('speciality').value;
                     var date = new Date();
                        var d = date.getDate();
                        var m = date.getMonth();
                        var y = new Date(date.getFullYear());
                        start=getMonday(date);  console.log(date);
                        end=new Date(date.setDate(start.getDate()+6));

                          mm_start=start.getMonth()+1;
                          mm_end=end.getMonth()+1;
                 
                        getDataTime(speciality,start.getFullYear()+"-"+mm_start+"-"+start.getDate(),end.getFullYear()+"-"+mm_end+"-"+end.getDate())                    
             
                 });
                 
               function getDataTime(speciality,start,end){
                    $.get("datatime?speciality=" + speciality + "&start="+start+"&end=" + end, function (data, status) {
                        obj = $.parseJSON(data);
                       
                        var obj = $.parseJSON(data);
                        calendar.fullCalendar( 'removeEvents');
                        calendar.fullCalendar('addEventSource', obj);
                        
                        var select = document.getElementById('worker');
                        $('#worker').empty();
                        opt = document.createElement('option');
                        opt.innerHTML = "-- Выберите из списка  --";
                        select.appendChild(opt);
                    
                         $.get("worker?speciality=" + speciality, function (data, status) {
                            obj = $.parseJSON(data);
                            document.getElementById('worker').style.display = 'block';
    
                            for (var i = 0; i < obj.length; i++) {
                                opt = document.createElement('option');
                                opt.value = obj[i].id;
                                opt.innerHTML = obj[i].surname + " " + obj[i].name + " " + obj[i].patronymic;
                                select.appendChild(opt);
                            }
    
                        });

                     });
                 }
                  
                 $("#worker").change(function () {
                        worker=document.getElementById('worker').value;
                        $.get("/datatime?speciality=" + speciality+ "&worker=" + worker, function (data, status) {
                            obj = $.parseJSON(data);
                            var obj = $.parseJSON(data);
                            calendar.fullCalendar( 'removeEvents');
                            calendar.fullCalendar('addEventSource', obj);
                       });
                    
                  });
                  
                  
                  
                  
                  
             });  
  
  
            
});  