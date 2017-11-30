$(document).on("click", '[data-toggle=offcanvas]', function () {
    $('.row-offcanvas').toggleClass('active');
});
var total_popups = 0;
var popups = [];
Array.remove = function (array, from, to) {
    var rest = array.slice((to || from) + 1 || array.length);
    array.length = from < 0 ? array.length + from : from;
    return array.push.apply(array, rest);
};
//this is used to close a popup
// function close_popup(id){
//     $('room-' + id).remove();    
// }
$(document).on("click", '.remove_chatroom', function () {
    var id = $(this).prop("id").split("_")[1];
    console.log(id);
    
    //calculate_popups();
    for (var iii = 0; iii < popups.length; iii++) {
        if (id == popups[iii]) {
            Array.remove(popups, iii);
            $("#" + id).css('display', 'none');
            calculate_popups();
            return;
        }
    }
})
$(document).on("click", '.popuproom', function () {
    // function register_popup(id, name) {
    var id = $(this).prop("id").split("_")[1];
    var name = $(this).prop("id").split("_")[2];
    var avatar = $(this).prop("id").split("_")[3];
    console.log('1');
    for (var iii = 0; iii < popups.length; iii++) {
        if (id == popups[iii]) {
            Array.remove(popups, iii);
            popups.unshift(id);
            calculate_popups();
            return;
        }
    }
    var element = '<div class="popup-box chat-popup" id="' + id + '">';
    element = element + '<div class="popup-head">';
    element = element + '<div class="popup-head-left"><img src="'+avatar+'" width="30px">' + name + '</div>';
    element = element + '<div class="popup-head-right"><a href="javascript:void(0);" class="remove_chatroom" id="del_' + id + '">&#10005;</a></div>';
    element = element + "<div style=\"clear: both\"></div></div><div class=\"popup-messages\"><ul class=\"chat\"></ul></div><div style=\"bottom: 0; position: absolute;\"><input style=\"width: 240px\" type=\"text\"  id=\"text_" + id + "\" ><input type=\"submit\" value=\"send\" onclick=\"song('" + id + "','" + name + "')\"></div></div>";
    //document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;
    //console.log(document.getElementsByTagName("body")[0].innerHTML);
    $('body').append(element);
    popups.unshift(id);
    calculate_popups();
    //load history
    var get_from_uid = id.split('-')[1];
    var data = '{"type":4,"self_uid":"' + getUid + '","from_uid":"' + get_from_uid + '","last_mid":"0"}';
    websocket.send(data);
});
function calculate_popups() {
    var width = window.innerWidth;
    if (width < 540) {
        total_popups = 0;
    } else {
        width = width - 200;
        //320 is width of a single popup box
        total_popups = parseInt(width / 320);
    }
    display_popups();
}
function display_popups() {
    var right = 50;
    var iii = 0;
    for (iii; iii < total_popups; iii++) {
        if (popups[iii] != undefined) {
            var element = document.getElementById(popups[iii]);
            element.style.right = right + "px";
            right = right + 320;
            element.style.display = "block";
        }
    }
    for (var jjj = iii; jjj < popups.length; jjj++) {
        var element = document.getElementById(popups[jjj]);
        element.style.right = right + "px";
        element.style.display = "block";
    }
}
window.addEventListener("resize", calculate_popups);
window.addEventListener("load", calculate_popups);