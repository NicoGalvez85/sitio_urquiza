const cambiarClaveCheckbox = document.getElementById("cambiarClaveCheckbox");
const claveInput = document.getElementById("clave1");
const claveLabel = document.getElementById("claveLabel");
function activarClave() {
    if (cambiarClaveCheckbox.checked) {
        claveLabel.style.display = "block";
        claveInput.style.display = "block";
        claveInput.removeAttribute("readonly");
        claveInput.value = "";
    } else {
        claveLabel.style.display = "none";
        claveInput.style.display = "none";
        claveInput.setAttribute("readonly", "readonly");
    }
}

const checkboxes = document.querySelectorAll('input[name="rol[]"]:not([value="0"])');

if(document.getElementById("admin").checked){
    checkboxes.forEach(function (box){
        box.disabled = true;
        box.checked = false;
    })
}

function toggleCheckboxes(admin){

    if(admin.checked){
        checkboxes.forEach(function (box){
            box.disabled = true;
            box.checked = false;
        })
    }else{
        checkboxes.forEach(function (box){
            box.disabled = false;
        })
    }
}
