<div class="formBody">
    <h1>Crear una Fuerza Operativa</h1>
    <p class="description">¡los cimientos de una buena fuerza operativa comienza aquí!</p>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="contImg">
            <img src="/img/img-fo.jpg" id="imagePreview" alt="">
            <div class="semi-circulo">
                <input type="file" name="image" accept="image/jpeg, image/png" id="inpFile" hidden>
                <label for="inpFile">Cambiar</label>
            </div>
        </div>
        <div class="section">
            <p>Nombre*</p>
            <input type="text" maxlength="15" name="namee" id="txtName" required>  
        </div>
        <div class="section">
            <p class="p2">Descripcion*</p>
            <textarea name="description" maxlength="250" rows="3" cols="5" required></textarea>
        </div>
        <div class="section">
            <p>Tag</p>
            <input type="text" maxlength="5" name="tag" id="txtTag">
        </div>
        <div class="explication">
            <p>abrebieaturas representativas de la F.O que se deveran de poner los integrantes mas comprometidos.</p>
        </div>
        <div class="section">
            <p>URL de web<br>alternativa</p>
            <input type="text" maxlength="60" name="UrlWebAlternative" id="txtUrlWebAlternative">
        </div>
        <div class="explication">
            <p>si se tiene un sitio web adicional no estaria nada mal, y si no es el caso esta opcion no es obligatoria.</p>
        </div>
        <div class="section">
            <p>URL direccion<br>boom beach F.O*</p>
            <input type="text" maxlength="60" name="UrlFo" id="txtUrlFo" required>
        </div>
        <div class="explication">
            <p>Para que la gente pueda acceder a traves de esta web a el juego, comcretamente a la F.O.<br>
            La URL se encuentra en la opcion (compartir)  dentro de la interfaz de la F.O.</p>
        </div>
        <div class="section">
            <p>URL musica o <br>audio</p>
            <input type="text" maxlength="60" name="UrlMusic" id="txtUrlMusic">
        </div>
        <div class="explication">
            <p>Esta opcion no es obligatoria, pero si tienes un audio o musica que quieres que la gente pueda escuchar al visitar tu F.O, puedes hacerlo</p>
        </div>
        <div class="alert"><p id="alert"></p></div>
        <center>
        <input type="submit" name="sb_data" value="Siguiente" id="" >
        </center>
    </form>
    <script src="/public/js/view_img.js"></script>
</div>