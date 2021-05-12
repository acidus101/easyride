let type = document.registration.type;
let model = document.registration.model;
function formValidation() {
    if(model_validation(model)){
        return true;
    }
    return false;
}

function model_validation(model) {
    if( type === "car"){
        if (model !== "sedan" || model !== "mini" || model !== "suv") {
            alert("enter a valid model");
            model.focus();
            return false;
        }
    }else {
        if (model !== "classic" || model !== "sports" || model !== "economy") {
            alert("enter a valid model");
            model.focus();
            return false;
        }
    }
    return true;
}

