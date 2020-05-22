<?php
  session_start();
  if ( isset($_POST['reset']) ) {
    $_SESSION['chats'] = Array();
    header("Location: index.php");
    return;
  }
  if ( isset($_POST['message']) ) {
    if ( !isset ($_SESSION['chats']) ) $_SESSION['chats'] = Array();
    $_SESSION['chats'] [] = array($_POST['message'], date(DATE_RFC2822));
    header("Location: index.php");
    return;
  }
?>
<html>
<head>
  <title>Revin Raina</title>
</head>
<body style="text-align: center;">
      <h1>Welcome to JSON Chat</h1>
      <p>You can chat from two different tabs or browsers. The chats will be updated on both sides.</p>
      <form method="post" action="index.php">
      <p>
      <input type="text" name="message" size="60"/>
      <input type="submit" value="Chat"/> 
      <input type="submit" name="reset" value="Reset"/>
      </p>
      </form>
      <div id="chatcontent">
          <img src="spinner.gif" alt="Loading..."/>
      </div>
<script type="text/javascript" src="jquery.min.js">
</script>
<script type="text/javascript">
function updateMsg() {
  window.console && console.log('Requesting JSON'); 
  $.getJSON('chatlist.php', function(rowz){
      window.console && console.log('JSON Received'); 
      window.console && console.log(rowz);
      $('#chatcontent').empty();
      for (var i = 0; i < rowz.length; i++) {
        arow = rowz[i];
        $('#chatcontent').append('<p>'+arow[0] +
            '<br/>&nbsp;&nbsp;'+arow[1]+"</p>\n");
      }
      setTimeout('updateMsg()', 4000);
  });
}

// Make sure JSON requests are not cached
$(document).ready(function() {
  $.ajaxSetup({ cache: false });
  updateMsg();
});
</script>
</body>
