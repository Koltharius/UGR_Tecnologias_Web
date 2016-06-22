var id;
//Función que asigna un valor a una variable global
function obtenerID(idem) {
    id = idem;
}
//Función encargada de habilitar el boton activar, sólo se habilita si la fecha de la cola que queremos activar 
//coincide con la fecha y hora actual
function comprobarFecha(hora, fecha) {
    var fechaActual = new Date();

    var mesActual = fechaActual.getMonth();
    mesActual += 1;
    var anho = fecha.slice(0, 5);
    var mes = fecha.slice(6, 8);
    var dia = fecha.slice(9, 11);
    var horas = hora.slice(0, 3);
    var minutos = hora.slice(4, 6);

    if (anho == fechaActual.getFullYear() && mes == mesActual && dia == fechaActual.getDate()) {
        if (horas > fechaActual.getHours()) {
            document.getElementById("activar").style.display = "initial";
        } else if (horas == fechaActual.getHours() && minutos <= fechaActual.getMinutes()) {
            document.getElementById("activar").style.display = "initial";
        }
    }
}

function validarFecha(hora, fecha) {
    var fechaActual = new Date();

    var mesActual = fechaActual.getMonth();
    mesActual += 1;
    var anho = fecha.slice(0, 4);
    var mes = fecha.slice(5, 7);
    var dia = fecha.slice(8, 10);
    var horas = hora.slice(0, 2);
    var minutos = hora.slice(3, 5);

    if (anho == fechaActual.getFullYear() && mes == mesActual && dia >= fechaActual.getDate()) {
        if (horas > fechaActual.getHours()) {
            return true;
        } else if (horas == fechaActual.getHours() && minutos >= fechaActual.getMinutes()) {
            return true;
        } else {
            return false;
        }

    } else if (anho >= fechaActual.getFullYear() && mes > mesActual) {
        return true;
    } else {
        return false;
    }
}

//Función encargada de habilitar los botones modificar y borrar
function habilitarBotones() {
    document.getElementById("modificar").style.display = "initial";
    document.getElementById("borrar").style.display = "initial";

}
//Función encargada de direccionarnos a otra página, pasandole por la url una variable que será
//usada en la otra página. Ha esta función se le pasa dos parámetros, url de la página a la que queremos
//ser redireccionados y el un hiperenlace.
function cogerDatos(url, enlace) {
    var tags_input = new Array();
    var tags_input = document.getElementsByTagName('input');
    var codigo;
    document.getElementById(enlace).href = url + id;
    window.location = document.getElementById(enlace);
}

//Función encargada de confirmar el borrado de una información
function borrarCola() {

    var respuesta = confirm("¿Desea usted borrar este revisión de la base de datos?");
    if (respuesta == true) {
        return true;
    } else
        window.location = "GestionColasAdministrador.php";
    return false;
}

//Función encargada de confirmar el borrado de una información
function borrarColaProfesor() {

    var respuesta = confirm("¿Desea usted borrar este revisión de la base de datos?");
    if (respuesta == true) {
        return true;
    } else
        window.location = "GestionColasProfesor.php";
    return false;
}

//Función encargada de confirmar el borrado de una información
function borrarAlumno() {
    var respuesta = confirm("¿Desea usted borrarse de esta revisión?");
    if (respuesta == true) {
        return true;
    } else
        window.location = "VerMiPosicion.php";
    return false;
}

//Función encargada de confirmar el modificado de la información de una revisión
function validateFormColas() {
    var respuesta = confirm("¿Desea usted modificar los datos de esta revisión?");
    if (respuesta == true) {
        return true;
    } else {
        window.location = "GestionColasAdministrador.php";
        return false;
    }
}
function validateFormColasProfesor() {
    var respuesta = confirm("¿Desea usted modificar los datos de esta revisión?");
    if (respuesta == true) {
        return true;
    } else {
        window.location = "GestionColasProfesor.php";
        return false;
    }
}

//Función encargada de confirmar el modificado de la información de un profesor
function validateModificarProfesor() {

    var respuesta = confirm("¿Desea usted modificar los datos de este profesor?");
    if (respuesta == true) {
        return true;
    } else {
        window.location = "GestionUsuarioAdministrador.php";
        return false;
    }
}
//Función encargada de comprobar si el DNI es válido o no
function validarDNI(dni) {
    var numero, let, letra;
    var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;
    dni = dni.toUpperCase();
    if (expresion_regular_dni.test(dni) === true) {
        numero = dni.substr(0, dni.length - 1);
        numero = numero.replace('X', 0);
        numero = numero.replace('Y', 1);
        numero = numero.replace('Z', 2);
        let = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != let) {
            alert('Dni erroneo, la letra del NIF no se corresponde');
            return false;
        } else {

            return true;
        }
    } else {
        alert('Dni erroneo, formato no válido');
        return false;
    }

}
//Función encargada de comprobar que el formulario tiene todos los campos rellenos.
function validarDatosRellenos() {
    var nombre = document.forms[0].elements[0].value;
    var apellido1 = document.forms[0].elements[1].value;
    var apellido2 = document.forms[0].elements[2].value;
    var dni = document.forms[0].elements[3].value;
    var email = document.forms[0].elements[4].value;
    if (nombre == null || nombre == "") {
        alert("El nombre esta vacio");
        return false;
    } else if (apellido1 == null || apellido1 == "") {
        alert("El primer apellido esta vacio");
        return false;
    } else if (apellido2 == null || apellido2 == "") {
        alert("El segundo apellido esta vacio");
        return false;
    } else if (dni == null || dni == "") {
        alert("El dni esta vacio");
        return false;
    } else if (email == null || email == "") {
        alert("El email esta vacio");
        return false;
    } else if (validarDNI(dni) != true)
        return false;
    else
        return true;
}


function validarMensajes() {
    var nombre = document.forms[0].elements[0].value;
    var fecha = document.forms[0].elements[1].value;
    var hora = document.forms[0].elements[2].value;
    var aviso = document.forms[0].elements[3].value;
    if (nombre == null || nombre == "") {
        alert("El nombre esta vacio");
        return false;
    } else if (fecha == null || fecha == "") {
        alert("La fecha esta vacia");
        return false;
    } else if (hora == null || hora == "") {
        alert("La hora esta vacia");
        return false;
    } else if (!validarFecha(hora, fecha)) {
        alert("La fecha es pasada");
        return false;
    } else if (aviso == null || aviso == "") {
        alert("El aviso esta vacio");
        return false;
    } else{
        return true;
    }
}


//Función encargada de comprobar que el formulario tiene todos los campos rellenos.
function validateFormCrearColas() {
    var asignatura = document.forms[0].elements[0].value;
    var lugar = document.forms[0].elements[1].value;
    var fecha = document.forms[0].elements[2].value;
    var hora = document.forms[0].elements[3].value;
    var profesor = document.forms[0].elements[4].value;
    if (asignatura == null || asignatura == "") {
        alert("La asignatura esta vacia");
        return false;
    } else if (lugar == null || lugar == "") {
        alert("El Lugar esta vacio");
        return false;
    } else if (fecha == null || fecha == "") {
        alert("la Fecha esta vacia");
        return false;
    } else if (hora == null || hora == "") {
        alert("La hora esta vacia");
        return false;
    } else if (!validarFecha(hora, fecha)) {
        alert("La fecha es pasada");
    } else if (profesor == null || profesor == "") {
        alert("El profesor esta vacio");
        return false;
    } else if (validarDNI(dni) != true)
        return false;
    else
        return true;
}

//Función encargada de comprobar que el usuario y la contraseña no este vacía.
function loginUsuario() {
    var usuario = document.forms[0].elements[0].value;
    var password = document.forms[0].elements[1].value;
    if (usuario.length < 1) {
        alert("El usuario está vacío");
        return false;
    } else if (password.length < 1) {
        alert("La contraseña está vacía");
        return false;
    } else {
        return true;
    }

}