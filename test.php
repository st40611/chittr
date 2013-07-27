<html>
<body>
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.2.custom.css" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<link type="text/css" href="css/jquery.ui.chatbox.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.ui.chatbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/chatboxManager.js"></script>

<script type="text/javascript">

var headerToggle = 0;
var counter = 0;
var idList = new Array();

function getChatbox(userId) {
          counter ++;
          var id = userId+ '_chat';
          idList.push(id);
          chatboxManager.addBox(id, 
                                  {dest:"dest" + counter, // not used in demo
                                   title: userId,
                                   first_name: userId,
                                   last_name: ""
                                   //you can add your own options too
                                  });

          event.preventDefault();
      }

$(document).ready(function(){
  showNames();
      
      $('#header').click(function(){
        if (headerToggle == 0) {
          $('#contacts').fadeTo('slow', 0).slideUp();
          headerToggle = 1;
        }
        else {
          $('#contacts').fadeIn('slow', 0);
          headerToggle = 0;
        }
      });
      
      

      var broadcastMessageCallback = function(from, msg) {
      	//if (idList.length > 1) {
      	//	$("#" + idList[idList.length - 2]).chatbox("option", "boxManager").clean();
      	//}
      	$("#" + idList[idList.length - 1]).chatbox("option", "boxManager").addMsg("Me", msg);
         var payload = {
                    userId: user,
                    message: msg 
                    };
                   $.ajax({
                    url: "./messenger-sdk-php/client.php?json=" + JSON.stringify(payload),
                    type: "GET",
                    contentType: "application/json",
                    processData: false,
                   // data: JSON.stringify(payload)
                   complete: function (data) {
                     getIncomeMessage();
                    }
                });
      	//$($(this).html() + '_chat').chatbox("option", "boxManager").addMsg(from, msg);
          /*for(var i = 0; i < idList.length; i ++) {
              chatboxManager.addBox(idList[i]);
              $("#" + idList[i]).chatbox("option", "boxManager").addMsg(from, msg);
          }*/
      }


      // chatboxManager is excerpt from the original project
      // the code is not very clean, I just want to reuse it to manage multiple chatboxes
      chatboxManager.init({messageSent : broadcastMessageCallback});

      

      });

function showNames()
{
if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    var arr = xmlhttp.responseText;
    document.getElementById("contacts").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","./messenger-sdk-php/client.php?q=names",true);
//xmlhttp.open("GET","gethint.php",true);
xmlhttp.send();

}
function getIncomingMessage()
{
  var arr ="";
  console.log('trying to get messages');
if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    arr = xmlhttp.responseText;
    if (arr.length != 0) 
    $("#chat_div").chatbox("option", "boxManager").addMsg("You", xmlhttp.responseText);
    }
  }

xmlhttp.open("GET","./messenger-sdk-php/client.php?q=reply",true);
//xmlhttp.open("GET","gethint.php",true);
xmlhttp.send();
if (arr.length == 0)
  setTimeout(getIncomingMessage, 1500);

}
    </script>

    <img id="header" src="images/header.png" style="padding-bottom:5px">

    <div id="contacts">
    </div>
    <div id="chat_div"></div>
</body>



</html>
