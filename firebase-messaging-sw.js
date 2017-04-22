
self.addEventListener('install', function(event) {
    console.log('Service Worker is being installed.');
});

self.addEventListener('activate', function(event) {
    console.log('Service Worker is being activated.');
});

// [START initialize_firebase_in_sw]
// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
  // Initialize Firebase
  var config = {
    apiKey: "xxxxxxx",
    projectId: "xxxxxxx",
    messagingSenderId: "xxxxxx"
  };
  firebase.initializeApp(config);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
console.log(messaging);
// [END initialize_firebase_in_sw]

// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// [START background_handler]

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.title;
  const notificationOptions = {
    body: payload.body,
    icon: payload.icon
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});

// [END background_handler]
