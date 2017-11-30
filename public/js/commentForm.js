function comment_result(avatar,name,msg,pic){
    var comment_html = '<div class="people_msg_top">';
    comment_html +=          '<a href="#">';
    comment_html +=                '<div class=" people_pic3 link"><img src="'+avatar+'" width="100%" ></div>';
    comment_html +=          '</a>';
    comment_html +=           '<div class="people_msg_topbox">';
    comment_html +=                    '<span class="people_msgli">'+name+'</span>';
    comment_html +=            '</div>';
    comment_html +=            '<div class="msg_text_1">';
    comment_html +=                 msg;
    comment_html +=                 '<p><img src="' + pic +'" width="100%">';
    comment_html +=            '</div>';
    comment_html +=     '</div>';
    return comment_html;
}