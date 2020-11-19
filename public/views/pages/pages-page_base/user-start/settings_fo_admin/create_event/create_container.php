<div id="create_event_container" class="create_event_container no">
<hr>
    <div class="create_event_subcontainer_01">
        <h2>Nuevo evento</h2>
        <select class="combobox" id="combo_objetive">
            <option>Recoleccion de informacion militar</option>
            <option>Saab</option>
            <option>Opel</option>
            <option>Audi</option>
        </select>
        <textarea id="text_description" name="description" maxlength="250" rows="3" cols="5" required></textarea>
        <div class="container_rango_enevt">
            <p>Rango del evento:</p>
            <div class="radios">
                <div class="radio_once">                    
                    <input type="radio" name="rank" id="cinco" value="5">
                    <label for="cinco">5pts</label>
                </div>
                <div class="radio_once">
                    <input type="radio" name="rank" id="doce" value="12">
                    <label for="doce">12pts</label>
                </div>
                <div class="radio_once">
                    <input type="radio" name="rank" id="vetitres" value="23">
                    <label for="vetitres">23pts</label>
                </div>
            </div>
        </div>
    </div>
    <div class="create_event_subcontainer_02">
        <div class="calendario">
            <div class="header_calendar">
                <button id="last_month">&lt;</button>
                <div>
                    <span id="text_month_02">Null</span>
                    <span id="text_year">0000</span>
                </div>
                <button id="next_month">&gt;</button>
            </div>
        <div class="container_weedays">
                <span class="week_days_item">DOM</span>
                <span class="week_days_item">LUN</span>
                <span class="week_days_item">MAR</span>
                <span class="week_days_item">MÍE</span>
                <span class="week_days_item">JUE</span>
                <span class="week_days_item">VIE</span>
                <span class="week_days_item">SÁB</span>
            </div>
            <div class="container_days">
                <span class="week_days_item item_day">0</span>
            </div>
        </div>
        <div class="start_finish">Inicio: <p id="date_start" class="start">03/07/2020</p></div>
        <div class="start_finish">Finalizacion: <p class="finish"><label id="f_date_day">--</label>/<label id="f_date_month">--</label>/<label id="f_date_year">----</label></p></div>
        <div class="buttons_create_event">
            <button class="button_event crear" id="create_event">Crear</button>
            <button class="button_event cancelar" id="cancel_event">Cancelar</button>
            <style>
            .disable{opacity: 0.4;}
            .disable:hover{opacity: 0.4;}
            </style>
        </div>
    </div>
</div>
<script src="/public/js/calendario_____.js"></script>
<script src="/public/js/create_event____.js"></script>