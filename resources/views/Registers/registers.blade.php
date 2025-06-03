<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>REGISTRO PERSONA</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css">       
        {!! Html::style('plugins/toastr/css/toastr.min.css') !!}
    </head>
    <body>
        <div class="container" id="pageContainer">
            <div class="left-panel">
                <img src="../../images/logo_empresa.png" alt="alt"/>
                <h2>Registro de Clientes</h2>
                <p>Un buen registro garantiza tu seguridad</p>
            </div>

            <div class="right-panel">
                <h2>Regístrese</h2>
                
                {!! Form::open(array('id'=>'frmNewClient', 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form','onsubmit'=>'return false;')) !!}                    
                    {!! Form::select('optIdType', $arr_type_doc ,0, ['id'=>'optIdType', 'class' => 'form-control','onchange'=>'mostrarCampos(this.value);cambiarValidacionIdentificacion();']); !!}

                    <div id="campo_nombre" class="form-group hidden">
                        {!! Form::text('txtNombre',  null, array('id'=>'txtNombre','placeholder'=>'Nombres *','maxlength'=>50, 'class' => 'full-width', 'oninput'=>'validarEntradaTexto();')) !!}             
                    </div>
                    <div id="campo_apellido" class="form-group hidden">
                        {!! Form::text('txtPrimerApellido',  null, array('id'=>'txtPrimerApellido','placeholder'=>'Primer Apellido *','maxlength'=>50, 'class' => 'full-width', 'oninput'=>'this.value = this.value.toUpperCase();validarEntradaTexto();')) !!}             
                    </div>
                    <div id="campo_segundo_apellido" class="form-group hidden">
                        {!! Form::text('txtSegundoApellido',  null, array('id'=>'txtSegundoApellido','placeholder'=>'Segundo Apellido *','maxlength'=>50, 'class' => 'full-width', 'oninput'=>'this.value = this.value.toUpperCase();validarEntradaTexto();')) !!}             
                    </div>

                    <div id="campo_nro_identificacion" class="form-group hidden" >
                        <div style="display: flex; gap: 10px;">
                            <div style="flex: 14;">
                                {!! Form::text('txtNroIdentificacion',  null, array('id'=>'txtNroIdentificacion','placeholder'=>'Número de Identificación *','maxlength'=>13,'class' => 'full-width')) !!}             
                            </div>
                            <div style="flex: 1;" id="campo_dv" class="hidden">   
                                {!! Form::text('txtDigitoVerificacion',  null, array('id'=>'txtDigitoVerificacion','placeholder'=>'D.V.','maxlength'=>1,'pattern'=>'[0-9]+', 'class' => 'dv', 'oninput'=> 'this.value = this.value.replace(/[^0-9]/g, "")')) !!}             
                            </div>  
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; gap: 10px;">
                        <div style="flex: 1;">
                            {!! Form::email('txtEmail',  null, array('id'=>'txtEmail','placeholder'=>'Correo de notificación de facturación electrónica *','class' => 'form-group hidden','style' => 'flex: 1', 'oninput'=>'validarEntradaTexto();')) !!}             
                        </div>
                    </div>
                        <div style="flex: 1;">
                            {!! Form::tel('txtPhoneNumber',  null, array('id'=>'txtPhoneNumber','placeholder'=>'Número de teléfono *','maxlength'=>10, 'pattern'=>'[0-9]+','class' => 'form-group hidden', 'oninput'=> 'this.value = this.value.replace(/[^0-9]/g, "")','style' => 'flex: 1')) !!}             
                        </div>
                    {!! Form::button('Registrar Cliente', array('id'=>'btnClientRegister', 'class' => 'btn-guardar hidden','type'=>'submit')); !!}

                {!! Form::close() !!}
            </div>
        </div>
        
        
    <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                background-color: #cccccc; /* Gris claro */
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                transition: background-color 0.3s;
            }

            .container {
                display: flex;
                width: 90%;
                max-width: 1000px;
                background-color:#d6d6d6;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                border-radius: 20px;
                overflow: hidden;
                animation: zoomIn 0.6s ease;
                flex-wrap: wrap;
                margin: 20px;
            }

            @keyframes zoomIn {
                from {
                    transform: scale(0.8);
                    opacity: 0;
                }

                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }
            h2 {
                text-align: center;
            }
            h6 {
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
            }

        .left-panel {
            background-color: #ffffff;       /* Fondo blanco */
            color: #000000;                  /* Texto negro */
            padding: 50px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1); /* suavizar sombra interna */
            box-sizing: border-box;
        }


            .right-panel {
                padding: 20px 30px 30px 30px;
                width: 100%;
                max-width: 600px;
                background-color: #f9f9f9;
                box-sizing: border-box;
                display: flow;
                place-content: center;
            }

            @media (min-width: 768px) {
                .right-panel {
                    width: 60%;
                }
            }

            .full-width {
                width: 100%;
            }

            input,
            select {
                width: 100%;
                padding: 14px;
                margin: 12px 0;
                border-radius: 8px;
                border: 1px solid #ccc;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                font-size: 14px;
                outline: none;
                transition: box-shadow 0.3s, border-color 0.3s;
                background-color: #fff;
            }

            input:focus,
            select:focus {
                border-color: #6c63ff;
                box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
            }

            #btnClientRegister {
                width: 100%;
                padding: 14px;
                background-color: #ffffff; /* Fondo blanco */
                color: #000000; /* Letras negras */
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-weight: 600;
                font-size: 16px;
                margin-top: 20px;
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s, transform 0.3s;
            }


                #btnClientRegister:hover {
                    background-color: #f0f0f0;
                    transform: translateY(-2px);
                }


            .hidden {
                display: none;
            }

            .dv {
                width: 80px;
            }
            .logo {
                width: 200px !important;
                height: auto !important;
                display: block;
                margin: 0 auto 10px auto;
                max-width: 100%;
            }

.left-panel img {
    width: 300px !important;
    height: auto !important;
    max-width: 100%;
}
            
            .form-control-danger{
                border-color: #f62d51;
            }
            .form-control-feedback{
                color: #f62d51;
            }
            .toast-container div{
                width: 42% !important;
                font-size: 12px !important;
            }
            
            

    </style>
        {!! Html::script ('plugins/jQuery/jQuery-2.1.4.min.js') !!}
        {!! Html::script ('plugins/toastr/js/toastr.min.js') !!}
        {!! Html::script ('js/funciones.js') !!}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>
        <script type="text/javascript">

        function validarCampos(){
            
            var dataValida = {
                optIdType:{required:true, type:"numeros", name:"Tipo Identificacion"}
            };
            
            if($('#optIdType').value == 7){
                dataValida.txtNroIdentificacion = {required:true, type:"pasaporte", name:"Nro Identificacion"};
            }else{
                dataValida.txtNroIdentificacion = {required:true, type:"cedula", name:"Nro Identificacion"};
            }
            
            dataValida.txtNombre = {required:true, type:"texto_espacio", name:"Nombre"};
            
            if($('#optIdType').value !== 6){
                dataValida.txtPrimerApellido = {required:true, type:"texto", name:"Primer Apellido"};
                if(($('#txtSegundoApellido').val()).length > 0 ){
                    dataValida.txtSegundoApellido = {required:true, type:"texto", name:"Segundo Apellido"};
                }
            }else{
                if(($('#txtPrimerApellido').val()).length > 0){
                    toastr["error"]('Un Nit no debe contener primer apellido', 'Error');
                    return;
                }
                if(($('#txtSegundoApellido').val()).length > 0){
                    toastr["error"]('Un Nit no debe contener segundo apellido', 'Error');
                    return;
                }
            }
            
            dataValida.txtEmail = {required:true, type:"email", name:"Correo"};
            dataValida.txtPhoneNumber = {required:true, type:"celular", name:"Celular"};
            
            return validar(dataValida);
            
        }
        
        function validar(dat){
            var fields = "";
            var val = "";
            var r = false;
            var msg = "";
            $('form input, form select, form textarea').removeClass('form-control-danger');
            $('.form-control-feedback').remove();

            for (var i in dat) {
                
                if (document.getElementById(i) !== undefined) {
                    val = document.getElementById(i).value;
                    
                    if (val) {
                        if(dat[i].type == 'texto_espacio'){
                            r = /^[A-Za-z\s]+$/.test(val);  //valida letras y espacio
                        }else if(dat[i].type == 'pasaporte'){
                            r = /^[A-Z0-9]+$/.test(val);
                        }else if(dat[i].type == 'texto'){
                            r = /^[A-Za-z]+$/.test(val);
                        }else if(dat[i].type == 'email'){
                            r = /^[a-z0-9]+([.-][a-z0-9]+)*@[a-z]+\.[a-z]{2,4}$/.test(val);
                        }else{
                            r = _validar(val, dat[i].type);
                        }
                        console.log(r);
                        if (!r) {
                            fields += (fields ? ", " : "") + dat[i].name;
                            msg = '<small class="form-control-feedback">Este Campo Es Obligatorio O Invalido</small>';
                            $('input[name="' + i + '"], textarea[name="' + i + '"],select[name="' + i + '"]').addClass('form-control-danger').after(msg); // toastError("Error","Debe completar los campos: " + dat[i].name, 'Error');
                        }
                    } else if (dat[i].required) {
                        fields += (fields ? ", " : "") + dat[i].name;
                        msg = '<small class="form-control-feedback">Este Campo Es Obligatorio O Invalido</small>';
                        $('input[name="' + i + '"], textarea[name="' + i + '"],select[name="' + i + '"]').addClass('form-control-danger').after(msg); // toastError("Error","Debe completar los campos: " + dat[i].name, 'Error');
                    }
                }
            }

            if (fields) {
              return false;
            } else return true;
        }

        $('#btnClientRegister').unbind('click');
        $('#btnClientRegister').click( function() {
            if(validarCampos()){
                var objButton = {
                    type: 'POST',
                    url: '/registers',
                    form: 'frmNewClient',
                    success: 'Persona Registrada satisfactoriamente',
                    resetForm: true,
                    retorna : true
                };
                var rta = requestAjax(objButton);
                if(rta.status == 'ok'){
                    $('#optIdType').val(0);
                    mostrarCampos();
                }
            }
        });


        function mostrarCampos() {
            const tipoIdentificacion = document.getElementById('optIdType').value;
            const nroIdentificacion = document.getElementById('campo_nro_identificacion');
            const camposNombre = document.getElementById('campo_nombre');
            const camposaApellido = document.getElementById('campo_apellido');
            const camposSegundoApellido = document.getElementById('campo_segundo_apellido');
            const camposEmail = document.getElementById('txtEmail');
            const camposNumero = document.getElementById('txtPhoneNumber');
            const campoDV = document.getElementById('campo_dv');
            const txtNombre = document.getElementById('txtNombre');
            const txtNroIdentificacion = document.getElementById('txtNroIdentificacion');
            txtNombre.placeholder = 'Nombres *';
            txtNroIdentificacion.placeholder = 'Número de Identificación *';
            document.getElementById('btnClientRegister').classList.remove('hidden');

            if (tipoIdentificacion === '3' || tipoIdentificacion === '7' || tipoIdentificacion === '1' || tipoIdentificacion === '2' || tipoIdentificacion === '5' || tipoIdentificacion === '15' || tipoIdentificacion === '4') {
                camposNombre.classList.remove('hidden');
                camposaApellido.classList.remove('hidden');
                camposSegundoApellido.classList.remove('hidden');
                nroIdentificacion.classList.remove('hidden');
                camposEmail.classList.remove('hidden');
                camposNumero.classList.remove('hidden');
                campoDV.classList.add('hidden');
            } else if (tipoIdentificacion === '6') { //NIT
                camposNombre.classList.remove('hidden');
                camposaApellido.classList.add('hidden');
                camposSegundoApellido.classList.add('hidden');
                nroIdentificacion.classList.remove('hidden');
                camposEmail.classList.remove('hidden');
                camposNumero.classList.remove('hidden');
                campoDV.classList.remove('hidden');
                txtNombre.placeholder = 'Razon social *';
                txtNroIdentificacion.placeholder = 'NIT *';
            } else {
                camposNombre.classList.add('hidden');
                camposaApellido.classList.add('hidden');
                camposSegundoApellido.classList.add('hidden');
                camposEmail.classList.add('hidden');
                camposNumero.classList.add('hidden');
                campoDV.classList.add('hidden');
                nroIdentificacion.classList.add('hidden');
                document.getElementById('btnClientRegister').classList.add('hidden');
            }
        }

        function validarEntradaTexto() {
            var select = document.getElementById("optIdType");
            
            const nombre = document.getElementById('txtNombre');
            const apellido = document.getElementById('txtPrimerApellido');
            const apellido2 = document.getElementById('txtSegundoApellido');
            const correo = document.getElementById('txtEmail');
            const regex = /[^A-Za-záéíóúÁÉÍÓÚÑñ]/g;
            
            if (select.value === "6") { //NIT 
                const regex2 = /[^A-Za-zÑñ0-9\s]/g;
                nombre.value = nombre.value.replace(regex2, '').toUpperCase();
            }else{
                const regex2 = /[^A-Za-zÑñ\s]/g;
                nombre.value = nombre.value.replace(regex2, '').toUpperCase();
            }
            
            correo.value = correo.value.replace(/\.{2,}/g, '.');
            correo.value = correo.value.replace(/[^a-z0-9@.\-_]/gi, '').toLowerCase();
            
            apellido.value = apellido.value.replace(regex, '').toUpperCase();
            apellido2.value = apellido2.value.replace(regex, '').toUpperCase();
        }

        function cambiarValidacionIdentificacion() {
            var select = document.getElementById("optIdType");
            var nroIdentificacion = document.getElementById("txtNroIdentificacion");

            if (select.value === "7") { //PASAPORTE 
                nroIdentificacion.removeAttribute('pattern');
                nroIdentificacion.setAttribute('oninput', 'this.value = this.value.replace(/[^A-Za-z0-9]/g, "")');
            } else {
                nroIdentificacion.setAttribute('pattern', '[0-9]+');
                nroIdentificacion.setAttribute('oninput', 'this.value = this.value.replace(/[^0-9]/g, "")');
            }
        }
        window.onload = function() {
            cambiarValidacionIdentificacion();
        };

        function limpiarCampos() {
            const form = document.getElementById("frmNewClient");
            form.reset();
            
            document.getElementById("campo_dv").classList.add("hidden");
            document.getElementById("campo_nombre").classList.add("hidden");
            document.getElementById("campo_apellido").classList.add("hidden");
        }
        
        </script>
    </body>
</html>