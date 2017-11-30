var wsServer = 'wss://edwardspeedforce.com:9504'
var websocket = new WebSocket(wsServer);

//onopen監聽連接
websocket.onopen = function (evt) {
    //websocket.readyState 属性：
    /*
    CONNECTING    0    The connection is not yet open.
    OPEN    1    The connection is open and ready to communicate.
    CLOSING    2    The connection is in the process of closing.
    CLOSED    3    The connection is closed or couldn't be opened.
    */
    //console.log(websocket.readyState);
    if (websocket.readyState == 1) {
        var data = '{"type":1,"uid":"' + getUid + '"}';
        console.log(data);
        websocket.send(data);//上線登入
    }
};
function song(toUid,Name){
    var text = $("#text_"+toUid).val() ;
    $("#text_" + toUid).val('');
    toUid = toUid.split('-')[1];
    var data = '{"type":2,"from_uid":"' + getUid + '","msg":"' +  text + '","to_uid":"' +  parseInt(toUid) +'"}';
    console.log(data);
    websocket.send(data);
}

function post(type, getPostId) {
    var area = $("#post_area").val();
    if (type == 1) {
        var post = $("#post_body").val();
        post = post.replace(/\r?\n/g, '<br />');
        $(".msg_input").html(" ");
        var data = JSON.stringify({
            type: 5,
            from_uid: getUid,
            area: area,
            post: post,
            post_id: getPostId,
        });  
    } else {
        var post = $("#post_comment_body_" + getPostId).val();
        post = post.replace(/\r?\n/g, '<br />');
        $(".msg_input").html(" ");
        var data = JSON.stringify({
            type: 7,
            from_uid: getUid,
            area: area,
            post: post,
            image: $('#comment_file')[0].files[0],
            post_id: getPostId,
        });    
        
    }
    console.log(data);
    websocket.send(data);
}
//監聽關閉連接
websocket.onclose = function (evt) {
    console.log("Disconnected");
};
 //onmessage 監聽server資料推送
websocket.onmessage = function (evt) {
    res(evt.data);
};
function res(data) {
    var rst = eval('(' + data + ')');
    console.log(rst);
    switch (rst.type) {
        case 1://上線
            // console.log("222222222222222");    
            // // $("#sidebar-list-"+rst.uid).find('.chat-status').addClass('chat-online');
            // // $("#sidebar-list-" + rst.uid).find('.chat-status').text('上線');
            var data1 = '{"type":8,"from_uid":"' + getUid + '"}';
            console.log(data1);
            websocket.send(data1);
            break;
        case 2:
            console.log('1');   
            var get_from_uid = rst.to_uid;
            if(rst.from_uid ==  getUid){
                var t = '<li class="chat__bubble chat__bubble--sent">' + rst.msg+'</li>';
                $("#room-"+get_from_uid).find('.chat').append(t);
            }else{
                get_from_uid = rst.from_uid;
                var t = '<li class="chat__bubble chat__bubble--rcvd chat__bubble--stop">' + rst.msg+'</li>';
                $("#room-"+rst.from_uid).find('.chat').append(t);
                // var count = $("#msg_count_" + rst.from_uid).html();
                // if(count.length == 0 || count == null)
                //     count = 1;
                // else
                //     count = parseInt(count) + 1;
                // $("#msg_count_"+rst.from_uid).addClass("notification-counter");
                // $("#msg_count_"+rst.from_uid).html(count);
            }
            $("#room-"+get_from_uid).find('.popup-messages').scrollTop(9999999);
            break;
        case 3://離線
            $("#sidebar-list-"+rst.uid).find('.chat-status').removeClass('chat-online');
            $("#sidebar-list-"+rst.uid).find('.chat-status').text('離線');
        break;
        case 4:
            var get_from_uid = '';
            var get_first_uid = '';

            if (parseInt(rst.last_mid) == 0) {
                $("#room-" + rst.messages[0]['to']).find('.chat').html("");
                $("#room-" + rst.messages[0]['from']).find('.chat').html("");
            }
            //for (var i = rst.messages.length - 1; i >= 0; i--){
            for (var i = 0; i < rst.messages.length; i++){
                if(i == rst.messages.length - 1)
                    get_first_mid = rst.messages[i]['id'];
                if(rst.messages[i]['from'] == getUid){
                    get_from_uid = rst.messages[i]['to'];
                    var t = '<li class="chat__bubble chat__bubble--sent">' + rst.messages[i]['message'] + '</li>';
                    $("#room-"+rst.messages[i]['to']).find('.chat').prepend(t);
                }else{
                    get_from_uid = rst.messages[i]['from'];
                    var t = '<li class="chat__bubble chat__bubble--rcvd chat__bubble--stop">' + rst.messages[i]['message']+'</li>';
                    $("#room-"+rst.messages[i]['from']).find('.chat').prepend(t);
                }
            }
            $("#room-" + get_from_uid).find('.popup-messages').scrollTop(9999999);
            var get_last_mid = parseInt(rst.last_mid) + 5;
            var get_m_counts = parseInt(rst.m_counts);
            if (get_last_mid >= get_m_counts)
                $("#room-" + get_from_uid).find('.popup-messages').unbind('scroll');
            else
                scrollEven($("#room-" + get_from_uid).find('.popup-messages'), get_from_uid, get_last_mid);
        break;
        case 5:
            var avatar = avatarDefault;
            if(rst.avatar.length != 0 && rst.avatar != null){
                avatar = avatarRootPath+ rst.avatar;
            }
            var post_html = post_result(avatar, rst.name, rst.msg, rst.area);
            $(".list_past_msg").prepend(post_html);
        break;
        case 6:
            $("#comment_list_" + rst.post_id).html("");
            for (var i = 0; i < rst.comments.length; i++) { 
                var avatar = avatarDefault;
                if(rst.comments[i]['avatar'].length != 0 && rst.comments[i]['avatar'] != null){
                    avatar = avatarRootPath+ rst.comments[i]['avatar'];
                }
                var name = rst.comments[i]['name'];
                var pic_path = postPicPath + rst.comments[i]['pic'];
                console.log(pic_path);
                var comment_html = comment_result(avatar, name, rst.comments[i]['body'], pic_path);
                $("#comment_list_"+rst.post_id).prepend(comment_html);
            }
        break;    
        case 7:
            var avatar = avatarDefault;
            if(rst.avatar.length != 0 && rst.avatar != null){
                avatar = avatarRootPath+ rst.avatar;
            }
            var name = rst.name;
            var comment_html = comment_result(avatar, name, rst.msg);
            $("#comment_list_"+rst.post_id).prepend(comment_html);
        break;
        case 8:
            $("#tab_1").html("");
            //$("#tab_2").html("");
            console.log(rst.user);
            for (var i = 0; i < rst.user.length; i++) { 
                var avatar = avatarDefault;
                
                if(rst.user.length != 0 && rst.user[i]['avatar'] != null){
                    avatar = avatarRootPath+ rst.user[i]['avatar'];
                }
                var name = rst.user[i]['name'];
                var time = rst.user[i]['time'];
                var getRoom = "room-"+rst.user[i]['uid'];
                var comment_html = ' <a href="javascript:void(0);" class="popuproom" id=room_' + getRoom + '_' + name + '_'+ avatar +'>';
                comment_html += '  <div class="memu_msg_list link">';
                comment_html += '  <div class=" people_pic3 " style="border: 3px solid #e6002d; float:left;">';
                comment_html += '   <img src="'+avatar+'" width="100%" >';
                comment_html += '  </div>';
                comment_html += '   <div class="menu_msg_right">';
                comment_html += '  <div class="menu_msg_day">'+time+'</div>';
                comment_html += '  <div class="menu_msg_name">'+name+'</div>';    
                comment_html += '  </div>';
                comment_html += '  </div>';
                comment_html += '  </a>';
                $("#tab_1").append(comment_html);
               // $("#tab_2").prepend(comment_html);
            }
            // var avatar = avatarDefault;
            // if(rst.avatar.length != 0 && rst.avatar != null){
            //     avatar = avatarRootPath+ rst.avatar;
            // }
            // var name = rst.name;
            // var comment_html = comment_result(avatar, name, rst.msg);
            // $("#comment_list_"+rst.post_id).prepend(comment_html);
            break;
            case 9:
                alert(rst.message);
                break;
            case 10:
                location.reload();
            case 11:
                location.reload();
            case 12:
                var avatar = avatarDefault;
                if(getUserAvatar.length != 0 && getUserAvatar != null){
                    avatar = getUserAvatar;
                }
                var name = getName;
                var comment_html = ' <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">';
                comment_html += '   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">';
                comment_html += '       <div class="friend_box">';    
                comment_html += '           <div style="width:100%; float:left; display:block;">';    
                comment_html += '               <div class="friend_name">'+rst.content+'</div>'; 
                comment_html += '           </div>';
                comment_html += '           <div class="friend_text">';    
                //comment_html += '               <font style="font-weight:bold; color:#000000;">興趣：</font>';    
                comment_html += '                 <div style=" display:none;">rst.content</div>';
                comment_html += '               <input class="inter_permission" id="inter_' + rst.id + '_1" name="inter_' + rst.id + '" type="radio" value="1" ><span style="height:35px; line-height:35px; padding-left:10px;">朋友搜尋權限</span>';
                comment_html += '               <br><input class="inter_permission" id="inter_'+rst.id+'_2" name="inter_'+rst.id+'" type="radio" value="2" checked><span style="height:35px; line-height:35px; padding-left:10px;">公開搜尋權限</span>';
				comment_html += '           <div class="myinterest_del" style="float:right;">'; 
				comment_html += '           <input class="inter_del" id="del_inter_'+rst.id+'" type="button" value="刪除">';
				comment_html += '           </div>'; 
                comment_html += '           </div>'; 
                comment_html += '       </div>';
                comment_html += '   </div>';
                comment_html += '  </div>';
                $(".interest_list").prepend(comment_html);
            break;
            case 13:
                var comment_html = ' <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_bottom_40 m_sm_bottom_35 blog_animate wow fadeInUp animated " style="padding:10px;">';
                comment_html += '    <figure>';
                comment_html += '       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  blog_animate link relative">';
                comment_html += '          <div class="my_photo_bg">';
                comment_html += '              <a href="javascript:void(0)" class="del_album" id="del_album_' + rst.album_id + '"><div class="del_link link" style="z-index: 9999;">link</div></a>';
                comment_html += '              <a href="'+photoPagePath+'/'+rst.album_id+'">';
                comment_html += '                  <img src="uploads/avatars/default.jpg" width="100%">';
                comment_html += '               </a>';
                comment_html += '           </div>';
                comment_html += '       </div>';
                comment_html += '        <figcaption>';
                comment_html += '           <div class="album_box">';    
                comment_html += '               <div class="album_text">';    
                comment_html += '                   <a href="album-content.php">'+rst.title+'</a>'; 
                comment_html += '               </div>';
                comment_html += '           </div>'; 
                comment_html += '        </figcaption>';
                comment_html += '   </figure>';
                comment_html += '  </div>';
                $(".album_list").prepend(comment_html);
            break;
            case 14:
                if (rst.result == "success") {
                    var getcount = $("#poll_count_" + rst.to_uid).html();
                    getcount = parseInt(getcount);
                    getcount++;
                    $("#poll_count_" + rst.to_uid).html(getcount);
                } else {
                    alert("今天已經投票囉");
                }  
            break;
            case 15:
                if (rst.result == "success") {
                    var getcount = $("#thumb_count_" + rst.to_pid).html();
                    getcount = parseInt(getcount);
                    getcount++;
                    $("#thumb_count_" + rst.to_pid).html(getcount);
                } else {
                    alert("給過掌聲囉");
                }  
            break;
            case 17:
                location.reload();
            break;
            case 18:
                $(".interest_compare_list").html('');
                var avatar = avatarDefault;
                for (var i = 0; i < rst.interest_arrays.length; i++) { 
                    if(rst.interest_arrays[i]['avatar'].length != 0 && rst.interest_arrays[i]['avatar'] != null){
                        avatar = avatarRootPath+ rst.interest_arrays[i]['avatar'];
                    }
                    var name = rst.interest_arrays[i]['name'];
                    var puid = rst.interest_arrays[i]['puid'];
                    var content = rst.interest_arrays[i]['interest_name'];
                    var comment_html = ' <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">';
                    comment_html += '    <a href="' + userPagePath + '/' + puid+'">';
                    comment_html += '       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 blog_animate link" style=" padding:5px; " >';
                    comment_html += '           <img src="'+avatar+'" width="100%">';
                    comment_html += '       </div>';
                    comment_html += '   </a>';
                    comment_html += '   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">';
                    comment_html += '       <div class="friend_box">';    
                    comment_html += '           <div style="width:100%; float:left; display:block;">';    
                    comment_html += '               <div class="friend_name">'+name+'</div>'; 
                    comment_html += '           </div>';
                    comment_html += '           <div class="friend_text">';    
                    comment_html += '               <font style="font-weight:bold; color:#000000;">興趣：</font>';    
                    comment_html +=                  content;
                    comment_html += '           </div>'; 
                    comment_html += '       </div>';
                    comment_html += '   </div>';
                    comment_html += '  </div>';
                    $(".interest_compare_list").prepend(comment_html);
                }
            break;
            case 19:
                location.reload();
            break;
            case 20:
                location.reload();
            break;
            case 21:
                alert('刪除成功');
                location.reload();
            break;
            case 23:
                alert(rst.message);
                break;
            case 22:
                location.reload();
            break;
            case 24:
                location.reload();
            break;
    }
}

function scrollEven(target, get_from_uid, get_last_mid) {
    var init_x = 0;
    target.scroll(function() {
        if ($(this).scrollTop() == 0 && init_x == 0) {
            var data = '{"type":4,"self_uid":"' + getUid + '","from_uid":"' + get_from_uid + '","last_mid":"' + get_last_mid + '"}';
            websocket.send(data);
            init_x = 1;
        }
    });
}
//監聽錯誤訊息
websocket.onerror = function (evt, e) {
    console.log('Error occured: ' + evt.data);
};

$(document).on("click", '.chat-pop', function () {
    var getId = $(this).prop('id');
    var getUid = getId.split('-')[2];
    if ($("#msg_count_" + getUid).text().length != 0 && $("#msg_count_" + getUid).text() != null) { 
        $("#msg_count_" + getUid).removeClass("notification-counter");
        $("#msg_count_" + getUid).text('');
    }    
});

$(document).on("click", '.msg_show_commit', function () {
    var getPostId = $(this).prop("id").split("_")[2];
    if ($("#commit_" + getPostId).css("display") == "none") {
        var data = '{"type":6,"self_uid":"' + getUid + '","post_id":"' + getPostId + '"}';
        websocket.send(data);
        $("#commit_" + getPostId).show();
    } else {
        $("#commit_" + getPostId).hide();
    }
});
// $(document).on("click", '.msg_icon_li2', function () {
//     console.log('1');
//     $("#post_body").append("<img  src=\""+imageRootPath+"icon26.png\" />");
// });

$(function() {
    $(document).on("click", '.add_friend', function () {
        var getId = $(this).prop('id');
        var toUid = getId.split('_')[2];
        var data = '{"type":9,"to_uid":"' + toUid + '","from_uid":"' + getAuthUid + '"}';
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.pro_delete_invite', function () {
        var getId = $(this).prop('id');
        var friendId = getId.split('_')[2];
        var data = '{"type":10,"friend_id":"' + friendId + '"}';
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.pro_delete_friend', function () {
        var getId = $(this).prop('id');
        var friendId = getId.split('_')[2];
        var data = '{"type":10,"friend_id":"' + friendId + '"}';
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.promise_friend', function () {
        var getId = $(this).prop('id');
        var friendId = getId.split('_')[2];
        var data = '{"type":11,"friend_id":"' + friendId + '"}';
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '#send_interest', function () {
        var getContent = $("#interest_body").val();
       // console.log(getContent);
        var data = '{"type":12,"from_uid":"' + getUid + '","content":"' + getContent + '"}'; 
        $("select").each(function () { //added a each loop here
            $(this).select2('val', '')
        });
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '#send_album', function () {
        var getTitle = $("#album_body").val() ;
        var data = '{"type":13,"from_uid":"' + getUid + '","title":"' + getTitle + '"}'; 
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.send_poll', function () {
        var getId = $(this).prop('id');
        var getSendTo = getId.split('_')[1];
        var data = '{"type":14,"from":"' + getUid + '","to":"' + getSendTo + '"}'; 
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.thumb_click', function () {
        var getId = $(this).prop('id');
        var getSendTo = getId.split('_')[2];
        var data = '{"type":15,"from":"' + getUid + '","to":"' + getSendTo + '"}'; 
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.inter_permission', function () {
        var getId = $(this).prop('id');
        var getchangeinter = getId.split('_')[1];
        var getpermission = getId.split('_')[2];
        var data = '{"type":16,"inter":"' + getchangeinter + '","permission":"' + getpermission + '"}'; 
        websocket.send(data);
    });
    $(document).on("click", '.inter_del', function () {
        var r = confirm("確定刪除？");
        if (r == true) {
            var getId = $(this).prop('id');
            var getinter= getId.split('_')[2];
            var data = '{"type":17,"inter":"' + getinter + '"}'; 
            websocket.send(data);
        }
    });
    $(document).on("click", '#send_compare', function () {
        var getContent = $("#interest_compare_body").val() ;
        var data = '{"type":18,"from_uid":"' + getUid + '","content":"' + getContent + '"}'; 
        $("select").each(function () { //added a each loop here
            $(this).select2('val', '')
        });
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.send_photo_content_btn', function () {
        var getId = $(this).prop('id');
        var getPhotoId= getId.split('_')[3];
        var getContent = $("#photo_content_"+getPhotoId).val() ;
        var data = '{"type":19,"from_uid":"' + getUid + '","photo_id":"'+getPhotoId+'","content":"' + getContent + '"}'; 
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.del_photo', function () {
        var r = confirm("確定刪除？");
        if (r == true) {
            var getId = $(this).prop('id');
            var photoId = getId.split('_')[2];
            var data = '{"type":20,"photo_id":"' + photoId + '"}';
            websocket.send(data);
            console.log(data);
        }
    });
    $(document).on("click", '.del_album', function () {
        var r = confirm("確定刪除？");
        if (r == true) {
            var getId = $(this).prop('id');
            var albumId = getId.split('_')[2];
            var data = '{"type":21,"albumId":"' + albumId + '"}';
            websocket.send(data);
            console.log(data);
        }
    });
    $(document).on("click", '.share_btn', function () {
        var getId = $(this).prop('id');
        var postId = getId.split('_')[1];
        var data = '{"type":22,"from_uid":"' + getUid + '","postId":"' + postId + '"}';
        websocket.send(data);
        console.log(data);
    });
    $(document).on("click", '.report_btn', function () {
        var getId = $(this).prop('id');
        var postId = getId.split('_')[1];
        var data = '{"type":23,"from_uid":"' + getUid + '","postId":"' + postId + '"}';
        websocket.send(data);
        console.log(data);
    });
    $(document).on("change", '.change_permission', function () {
        var getId = $(this).prop('id');
        var postId = getId.split('_')[1];
        var data = '{"type":24,"from_uid":"' + getUid + '","postId":"' + postId + '","active":"' + $(this).val() + '"}';
        websocket.send(data);
        //console.log($(this).val());
    });
    

    $(document).on("click", '.share_post_url', function () {
        var getId = $(this).prop('id');
        var postId = getId.split('_')[2];
        copy("url_" + postId);
    });
    function copy(elementId) {
        console.log(elementId);
        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");

        document.body.removeChild(aux);

    }
    //$(document).on("click", '#send_post', function () {
    $("form#send_post").submit(function () {
        var formData = new FormData(this);
        $.ajax({
            url: sendPostPath,
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                alert(data.message);
                if (data.message == "發布動態成功") {
                    location.reload();
                }    
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });

    $("form.send_comment").submit(function () {
        var formData = new FormData(this);
        $.ajax({
            url: sendCommentPath,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert(data.message);
                if (data.message == "留言成功"){
                    var data = JSON.stringify({
                        type: 6,
                        post_id: data.post_id,
                    });
                    websocket.send(data);
                }
                $('.emoji-wysiwyg-editor').html(" ");
                $(".comment_avatar").val('');
                $("#post_comment_body_" + post_id).val('');
            },
           
        });
        return false;
    });

});
//jQuery Version
