function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    const headerId = elmnt.id + "_header"

    if (document.getElementById(headerId)) {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(headerId).onmousedown = dragMouseDown;
    } else {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        let top = (elmnt.offsetTop - pos2) + "px";
        let left = (elmnt.offsetLeft - pos1) + "px";

        if (parseInt(top) < 0) {
            top = "0px";
        }

        if (parseInt(left) < 0) {
            left = "0px";
        }

        elmnt.style.top = top;
        elmnt.style.left = left;
    }

    function closeDragElement() {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
    }
}