<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

    body {
        color: white;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal
    }

    #wrapper {
        max-width: 900px;
        min-height: 500px;
        display: flex;
        margin: auto;
    }

    #left_pannel {
        min-height: 500px;
        background-color: #27344b;
        color: white;
        flex: 1;
        text-align: center;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
        font-size: 14px;
    }

    #profile_image {
        border-radius: 50%;
        border: 1px solid white;
        width: 40%;
        margin: 10px;
        padding: 5px;
    }

    #left_pannel #email {
        opacity: 0.5;
        font-size: 12px;
    }

    #left_pannel label {
        width: 100%;
        height: 20px;
        display: block;
        font-size: 13px;
        background-color: #404b56;
        border-bottom: solid thin #ffffff55;
        cursor: pointer;
        padding: 5px;
        transition: all 0.5s ease;
    }

    #left_pannel label:hover {
        background-color:rgb(99, 109, 117);
    }

    #left_pannel label img {
        float: right;
        width: 25px;
    }

    #right_pannel {
        min-height: 500px;
        flex: 4;
    }

    #header {
        background-color: #485b6c;
        color: #fff;
        height: 70px;
        font-weight: 700;
        font-size: 50px;
        text-align: center;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal
    }

    #inner_left_pannel {
        background-color: #383e48;
        flex: 1;
        min-height: 430px;
        text-align: center;
        
    }

    #inner_right_pannel {
        background-color: #f2f7f8;
        flex: 2;
        min-height: 430px;
        transition: all 0.5s;
    }

    #radio_contacts:checked ~ #inner_right_pannel, #radio_settings:checked ~ #inner_right_pannel {
        flex: 0;
    }

    #contact {

        width: 100px;
        height: 140px;
        margin:10px;
        display: inline-block;
        vertical-align: top;
    
    }

    #contact img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }


</style>

<body>
    <div id="wrapper">

        <div id="left_pannel">
            <div id="user_info" style="padding: 10px">

                <img src="ui/images/male.jpg" alt="User Pfp" id="profile_image">
                <br>
                <span id="username" >Username</span>
                <br>
                <span id="email">email@gmail.com</span>

                
                <br>
                <br>
                <br>
                <div>
                    <label id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                    <label id="logout" for="radio_logout">Logout <img src="ui/icons/logout.png" alt=""></label>
                </div>

            </div>

        </div>

        <div id="right_pannel">

            <div id="header">
                WeChat
            </div>

            <div id="container" style="display: flex;">

                <div id="inner_left_pannel">


                </div>

                <input type="radio" id="radio_chat" name="buts" style="display: none;">
                <input type="radio" id="radio_contacts" name="buts" style="display: none;">
                <input type="radio" id="radio_settings" name="buts" style="display: none;">

                <div id="inner_right_pannel">
                </div>

            </div>

        </div>

    </div>
</body>
<script>
    function _(ele){
        return document.getElementById(ele);
    }
    
    var label_contacts = _("label_contacts");
    label_contacts.addEventListener("click", get_contacts);

    var label_chat = _("label_chat");
    label_chat.addEventListener("click", get_chats);

    var label_settings = _("label_settings");
    label_settings.addEventListener("click", get_settings);

    var logout = _("logout");
    logout.addEventListener("click", unlog);


    function get_data(find,type){

        var xml = new XMLHttpRequest();

        xml.onload = function(){

            if(xml.readyState == 4 || xml.status == 200){
                handle_result(xml.responseText,type);
            }

        }

        var data = {};
        data.find = find;
        data.data_type = type;
        data = JSON.stringify(data);

        xml.open("POST", "api.php", true);
        xml.send(data);
    }

    function handle_result(result, type){
        if(result.trim() != ""){

            var obj = JSON.parse(result);
            if(typeof(obj.logged_in) != "undefined" && !obj.logged_in){

                window.location = "login.php";
            } else {

                switch(obj.data_type){

                    case "user_info":
                        var username = _("username");
                        var email = _("email");

                        username.innerHTML = obj.username;
                        email.innerHTML = obj.email;
                        break;

                    case "contacts":
                        var inner_left_pannel = _("inner_left_pannel");

                        inner_left_pannel.innerHTML = obj.message;

                        break;

                    case "chats":
                        var inner_left_pannel = _("inner_left_pannel");

                        inner_left_pannel.innerHTML = obj.message;

                        break;

                    case "settings":
                        var inner_left_pannel = _("inner_left_pannel");

                        inner_left_pannel.innerHTML = obj.message;

                        break;
                }
            }
        }
    }

    function unlog(){
        var answer = confirm("Are you sure you want to log out ?");
        if (answer){
            get_data({}, "logout"); 
        }
    }

    function get_contacts(e){
        get_data({}, "contacts"); 
    }

    function get_chats(e){
        get_data({}, "chats"); 
    }    

    function get_settings(e){
        get_data({}, "settings"); 
    }

    get_data({}, "user_info");

</script>
</html>