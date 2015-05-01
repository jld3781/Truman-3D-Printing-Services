//Samuel Livingston

"use strict";
window.onload = function()
{
  var statusSelectors = document.getElementsByClassName('status');
  for( var i = 0; i < statusSelectors.length; i++ )
  {
    statusSelectors[i].onchange = updateStatus;
  }
}

function updateStatus()
{
  var jobid = parseInt(this.id);
  var index = this.selectedIndex;
  var newstatus = this.children[index].value;
  
  var request = new XMLHttpRequest();
  request.open( "GET", 
                "getPrintJobs.php?status=" + newstatus + "&" + "jobId=" + jobid,
                false );
  request.send( null );
  document.getElementById("jobsTable").innerHTML = request.responseText;
  var statusSelectors = document.getElementsByClassName('status');
  for( var i = 0; i < statusSelectors.length; i++ )
  {
    statusSelectors[i].onchange = updateStatus;
  }
}

