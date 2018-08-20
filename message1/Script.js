$(document).ready(function(){

    $("#reply").on("click", function(){
        var message = $("#message").val(),
            conversation_id = $("#conversation_id").val(),
            user_from = $("#user_from").val(),
            user_to = $("#user_to").val(),
            error = $("#error");
 
        if((message != "") && (conversation_id != "") && (user_from != "") && (user_to != "")){
            error.text("Sending...");
            $.post("post_message_ajax.php",{message:message,conversation_id:conversation_id,user_from:user_from,user_to:user_to}, function(data){
                error.text(data);
                $("#message").val("");
            });
            setTimeout(function(){
                $("body, html").scrollTop($(".display-message")[0].scrollHeight);    
            }, 800);
        }
    });
    c_id = $("#conversation_id").val();
    setInterval(function(){
        $(".display-message").load("get_message_ajax.php?c_id="+c_id);
    }, 2000);
 
    setTimeout(function(){
        $("body, html").scrollTop($(".display-message")[0].scrollHeight);    
    }, 2040);

});
