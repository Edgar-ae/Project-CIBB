function data(){
    var cb = document.getElementById('combo_objetive');
    var objetive = cb.options[cb.selectedIndex].text;
    var description = document.getElementById('text_description').value;
    var radios = document.getElementsByName('rank');
    for(var i=0,length=radios.length;i<length;i++){if(radios[i].checked)var rank = radios[i].value;}

    var day = document.getElementById('f_date_day').innerHTML;
    var month = document.getElementById('f_date_month').innerHTML;
    var year = document.getElementById('f_date_year').innerHTML;

    var array_data = [objetive,description,rank,day,month,year];
    return array_data;
}

$("#create_event").click(function(){
    var array_data = data();
    var val_empty = valid_empty(array_data);
    if(val_empty == false)messagebox_2('error','falta relleno');
    else messagebox_1('Crear Eveto','¿Estas seguro de crear el evento?','create_the_event');
});

function valid_empty(array_data){
    if(array_data[1] == '' || array_data[2] == null)return false;
    else return true;
}

function create_the_event(){
    var array_data = data();
    var dataa = ('objetive='+array_data[0]+'&description='+array_data[1]+'&rank='+array_data[2]+
    '&day='+array_data[3]+'&month='+array_data[4])+'&year='+array_data[5];

    $.ajax({
        url: '/public/ajax/event_ctr/ctr_create_event.php',
        type: 'POST',
        data: dataa,
        dataType: "json",
        success:function(rpt){
            alert(rpt['year']);
        }
    }); 
}

$("#cancel_event").click(function(){
    alert('cerrar');
});
function messagebox_1(title,description,run){
            $("#id_warning_").removeClass("no");
            $("#id_warning_").html
            (
                "<div class='advert'>"+
                    "<h4>"+title+"</h4>"+
                    "<p>"+description+"</p>"+
                    "<hr>"+
                    "<div class='buttons'>"+
                        "<input type='submit'value='Cancelar'onclick='closet();'class='cancel'>"+
                        "<input type='submit' value='Aceptar' onclick='"+run+"();' class='acept'>"+
                    "</div>"+
                "</div>"
            );
}
function messagebox_2(title,description){
    $("#id_warning_").removeClass("no");
    $("#id_warning_").html
    (
        "<div class='advert'>"+
            "<h4>"+title+"</h4>"+
            "<p>"+description+"</p>"+
            "<hr>"+
            "<div class='buttons'>"+
                "<input type='submit' value='Aceptar'onclick='closet();' class='acept'>"+
            "</div>"+
        "</div>"
    );
}
function closet(){
    $("#id_warning_").addClass("no");
}
function create_(data){
    $("#id_warning_").addClass("no");
    alert('loli'+data);
}