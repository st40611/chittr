<html>
<body>
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.2.custom.css" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<link type="text/css" href="jquery.ui.chatbox.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.ui.chatbox.js"></script>
<script type="text/javascript" src="chatboxManager.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript">
$(document).ready(function(){

      var counter = 0;
      var idList = new Array();

      var broadcastMessageCallback = function(from, msg) {
      	//if (idList.length > 1) {
      	//	$("#" + idList[idList.length - 2]).chatbox("option", "boxManager").clean();
      	//}
      	$("#" + idList[idList.length - 1]).chatbox("option", "boxManager").addMsg("Me", msg);
      	//$($(this).html() + '_chat').chatbox("option", "boxManager").addMsg(from, msg);
          /*for(var i = 0; i < idList.length; i ++) {
              chatboxManager.addBox(idList[i]);
              $("#" + idList[i]).chatbox("option", "boxManager").addMsg(from, msg);
          }*/
      }


      // chatboxManager is excerpt from the original project
      // the code is not very clean, I just want to reuse it to manage multiple chatboxes
      chatboxManager.init({messageSent : broadcastMessageCallback});

      $("span").click(function(event, ui) {
          counter ++;
          var id = $(this).html() + '_chat';
          idList.push(id);
          chatboxManager.addBox(id, 
                                  {dest:"dest" + counter, // not used in demo
                                   title: $(this).html(),
                                   first_name: $(this).html(),
                                   last_name: ""
                                   //you can add your own options too
                                  });

          event.preventDefault();
      });

      });
    </script>


    <div id="contacts">
    	<img src="http://chittr.herokuapp.com/header.png" style="padding-bottom:5px">
        <span class="online_contact">ambujpunn</span><br>
        <span class="busy_contact">angelaxue918</span><br>
        <span class="idle_contact">it4kiran</span><br>
        <span class="offline_contact">jonathanlook7</span><br>
    </div>
    <div id="chat_div"></div>
</body>


</html>
