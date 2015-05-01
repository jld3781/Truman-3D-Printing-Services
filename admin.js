//Samuel Livingston

"use strict";
window.onload = function()
{
    var size = document.getElementsByName( 'status' ).length; //The array starts at 0
    var status = "status";
    for( var i = 0; i < size; i++)
    {
      var tempVal = status.concat(String(i)); //Example: "status2"
      document.getElementById( tempVal ).onchange = updateStatus;
    }
}

// constants
var POSSIBLE_STATUS = 
    [
        "Waiting",
        "Printing",
        "Completed",
        "On Hold",
        "Rejected"
    ];

function updateStatus()
{
    var index = this.selectedIndex;
    var newStatus = this.children[index].value;
    var request = new XMLHttpRequest();

    request.open( "GET", 
                  "admin.php?newStatus=" + newStatus,
                  false );
    request.send( null );
    document.getElementById("gallery").innerHTML = request.responseText;
}
