<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="manifest" href="manifest.json">
</head>
<body>
<h1 id="bigOne"></h1>

<form action="send_noti.php" method="POST">
  Title: <input type="text" name="title"><br/>
  Msg: <input type="text" name="msg">
  <input type="submit" value="submit">
</form>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.8.0/firebase.js"></script>


<script>

Notification.requestPermission().then(function(result) {
  if(result=="granted")
  {
    getToken();
    if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('firebase-messaging-sw.js').then(function(reg) {
            console.log('Yey!', reg);
          }).catch(function(err) {
            console.log('Boo!', err);
          });
    }
  }
});
document.addEventListener('DOMContentLoaded', function () {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

if('PushManager' in window) {
  console.log("Pus");
}
  // Initialize Firebase
  var config = {
    apiKey: "xxxxxx",
    projectId: "medayipush",
    messagingSenderId: "xxxxxx"//located in Project Setting > Cloud Messaging
  };
  firebase.initializeApp(config);

/*
  var bigOne=document.querySelector("#bigOne");
  var dbRef=firebase.database().ref().child('text');
  dbRef.on('value',snap=>bigOne.innerText=snap.val());*/
const messaging = firebase.messaging();

function getToken()
{
  messaging.getToken()
  .then(function(currentToken) {
    console.log(currentToken);
    if (currentToken) {
       sendTokenToServer(currentToken);
    } else {
      // Show permission request.
      console.log('No Instance ID token available. Request permission to generate one.');
      setTokenSentToServer(false);
    }
  })
  .catch(function(err) {
    console.log('An error occurred while retrieving token. ', err);
    setTokenSentToServer(false);
  });
}





function isTokenSentToServer() {
    if (window.localStorage.getItem('sentToServer') == 1) {
          return true;
    }
    return false;
  }

function setTokenSentToServer(sent) {
  window.localStorage.setItem('sentToServer', sent ? 1 : 0);
}
function sendTokenToServer(currentToken) {
  if (!isTokenSentToServer()) {
      $.ajax(
      {
        url:"fcm_insert.php",
        data:{"fcm_token":currentToken},
        method:"POST",
        success:function(res){
          console.log("Token Sent:",res);
        }
      });
    setTokenSentToServer(true);
  } else {
    console.log('Token already sent to server so won\'t send it again ' +
        'unless it changes');
  }

}

messaging.onMessage(function(payload) {
  //console.log("Message received. ", payload.data);
  // ...
});
</script>
</html>