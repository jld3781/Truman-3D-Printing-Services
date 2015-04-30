//Jimmy Sorsen
"use strict";

window.onload = function()
{
    document.getElementById( "sort" ).onchange = sortProjects;
}

function sortProjects()
{
    var index = this.selectedIndex;
    var sorting = this.children[index].value;
    var request = new XMLHttpRequest();

    request.open( "GET", 
                  "getOrderedGallery.php?sort=" + sorting,
                  false );
    request.send( null );
    document.getElementById("gallery").innerHTML = request.responseText;


}
