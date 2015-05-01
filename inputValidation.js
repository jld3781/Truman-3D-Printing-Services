// Jessica DiMariano
window.onload = function(){
  document.getElementById("retypepassword").onblur = validateNewPassword;
  document.getElementById("email").onblur = validateEmail;
}

function validateNewPassword(){
  if( document.getElementById("newpassword").value !== document.getElementById("retypepassword").value ){
    addInputError("retypepassword","retypeError", "Passwords do not match.");
  } 
  else {
    removeInputError("retypepassword","retypeError");
  }
}

function validateEmail() {
  if( !document.getElementById("email").value.match(/@truman.edu$/) ){
    addInputError("email", "invalidEmail", "Not a Truman email.");
  }
  else {
    removeInputError("email", "invalidEmail");
  }
}

function addInputError(inputId, errorId, msg) {
  document.getElementById(inputId).classList.add("input-error");
  var error = document.createElement("p");
  var errorText = document.createTextNode(msg);
  error.appendChild(errorText);
  error.classList.add("error-text");
  error.id = errorId;
  var element = document.getElementById(inputId);
  
  if( !document.getElementById(errorId) ){
    element.parentNode.insertBefore(error, element.nextSibling);
  }
}

function removeInputError(inputId,errorId){
  document.getElementById(inputId).classList.remove("input-error");
  var child = document.getElementById(errorId);
  child.parentNode.removeChild(child);
}