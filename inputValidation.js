// Jessica DiMariano
window.onload = function(){
  if(document.getElementById("retypepassword")){
    document.getElementById("retypepassword").onblur = validateNewPassword;
  }
  if(document.getElementById("email")){
    document.getElementById("email").onblur = validateEmail;
  }
  /*if(document.getElementById("projectname")){
    document.getElementById("projectname").onblur = validateProjectName;
  }*/
}

/*function asynRequest(url){
  var ajax = new XMLHttpRequest();
  ajax.open("GET", url, true);
  ajax.send(null);
  return ajax.responseText;
}*/

/*function validateProjectName(){
  var request = new XMLHttpRequest();
  request.open("GET", "check_project_name.php", true);
  var test;
  request.onload = function() {
    var projects = request.responseText;
  }
  request.send(null);  
  var projectname = document.getElementById("projectname").value;
document.getElementById("projectlink").value = test;
  for ( var i = 0; i < projects.length; i++){
    if ( projects[i] == projectname && (!document.getElementById("dupProject"))){
      addInputError("projectname", "dupProject", "You already have a project with this name.");
      i = projects.length;
    }
    else if ( !(projects[i] == projectname) && document.getElementById("dupProject") ){
        removeInputError("projectname", "dupProject");
    }   
  }
}*/

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
  if(document.getElementById("submit")){
    document.getElementById("submit").disabled = true;
  }
}

function removeInputError(inputId,errorId){
  document.getElementById(inputId).classList.remove("input-error");
  var child = document.getElementById(errorId);
  child.parentNode.removeChild(child);
    if(document.getElementById("submit")){
    document.getElementById("submit").disabled = false;
  }
}