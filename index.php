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

    #left_pannel span {
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


</style>

<body>
    <div id="wrapper">

        <div id="left_pannel">
            <div style="padding: 10px">

                <img src="ui/images/user1.jpg" alt="User Pfp" id="profile_image">
                <br>
                Sabareesan Thirukumaran
                <br>
                <span>SabareesanThirukumaran@hotmail.com</span>

                
                <br>
                <br>
                <br>
                <div>
                    <label id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
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

    var label = _("label_chat");

    label.addEventListener("click", function(){
        var inner_pannel = _("inner_left_pannel");

        var ajax = new XMLHttpRequest();
        ajax.onload = function(){
            if (ajax.status == 200 || ajax.readyState == 4){
                inner_pannel.innerHTML = ajax.responseText;
            }
        };

        ajax.open("POST", "file.txt", true);
        ajax.send();

    });

</script>
</html>