document.addEventListener("DOMContentLoaded", load);
function load(){
    hideErrors();
    document.getElementsByName("form")[0].addEventListener("submit", validate);
    document.getElementById("reset").addEventListener("click", refresh);
}
function validate(e){
    hideErrors();
    if(formHasErrors()){
        e.preventDefault();
        return false;
    }
    return true;
}
function hideErrors(){
    let error = document.getElementsByClassName("error");

    for(let i = 0; i < error.length; i++)
    {
        error[i].style.display = "none";
    }
}
function refresh(e){
    if(confirm('Do you want to clear the fields?'))
    {
        hideErrors();
        return true;
    }
    e.preventDefault();
    return false;
}
function hasInput(fieldElement){
    let hasInput = true;
    if(fieldElement.value == null || fieldElement.value.trim() == "")
    {
        hasInput = false;
    }
    return hasInput;
}
function formHasErrors(){
    let errorFlag = false;
    let requiredFields = ["name", "email", "phonenumber"];

    for(let i = 0; i < requiredFields.length; i++)
    {
        let inputs = document.getElementById(requiredFields[i]);

        if(!hasInput(inputs))
        {
            document.getElementById(requiredFields[i] + "_error").style.display = "block";
            document.getElementById(requiredFields[i]).focus();
            errorFlag = true;
        }
    }

    let regExp = new RegExp(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/);
    let email = document.getElementById("email").value;

    if(!regExp.test(email))
    {
        document.getElementById("emailformat_error").style.display = "block";
        document.getElementById("email").focus();
        errorFlag = true;
    }

    let phonenumber = document.getElementById("phonenumber").value;

    if(phonenumber.length != 10)
    {
        document.getElementById("numberformat_error").style.display = "block";
        document.getElementById("phonenumber").focus();
        errorFlag = true;
    }

    return errorFlag;
}