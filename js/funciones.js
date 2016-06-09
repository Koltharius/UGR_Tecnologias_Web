var id;
function setID(idem) {
    id = idem;
    return id;
}

function obtenerID(id) {
    setID(id);
}

function habilitarBotones() {
    document.getElementById("modificar").style.display = "initial";
    document.getElementById("borrar").style.display = "initial";
    document.getElementById("activar").style.display = "initial";
}

function cogerDatos(url, enlace) {
    var tags_input = new Array();
    var tags_input = document.getElementsByTagName('input');
    var codigo;
    document.getElementById(enlace).href = url + id;
    window.location = document.getElementById(enlace);
}


function borrarCola() {

    var respuesta = confirm("¿Desea usted borrar este revisión de la base de datos?");
    if (respuesta == true) {
        return true;
    } else
        window.location = "GestionColasAdministrador.php";
    return false;
}

function validateFormColas() {
    var respuesta = confirm("¿Desea usted modificar los datos de esta revisión?");
    if (respuesta == true) {
        return true;
    } else {
        window.location = "GestionColasAdministrador.php";
        return false;
    }
}

function validateModificarProfesor() {

    var respuesta = confirm("¿Desea usted modificar los datos de este profesor?");
    if (respuesta == true) {
        return true;
    } else {
        window.location = "GestionUsuarioAdministrador.php";
        return false;
    }
}

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
function validateAltaProfesor() {
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

function loginUsuario() {
    var usuario = document.forms[0].elements[0].value;
    var password = document.forms[0].elements[1].value;
    if (usuario.length < 1) {
        alert("El usuario está vacío");
        return false;
    } else if (password.length < 1) {
        alert("La contraseña está vacío");
        return false;
    } else {
        return true;
    }
}