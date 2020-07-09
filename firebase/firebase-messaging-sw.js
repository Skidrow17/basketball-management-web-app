importScripts('https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.2.1/firebase-messaging.js');
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics. 
importScripts('https://www.gstatic.com/firebasejs/7.2.1/firebase-analytics.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
  'messagingSenderId': '<SENDER_ID>'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  firebase_contact = payload.data.title.split("/");

  const notificationTitle = firebase_contact[0];
  const notificationOptions = {
    body: payload.data.message,
    icon: '/itwonders-web-logo.png'
  };

  self.addEventListener('notificationclick', function(event) {
    let url = 'https://zafora.ece.uowm.gr/~ictest00909/EKA/chat_redirect.php?firebase_contact='+firebase_contact[1];
    console.log(url);
    event.notification.close(); // Android needs explicit close.
    event.waitUntil(
        clients.matchAll({type: 'window'}).then( windowClients => {
            // Check if there is already a window/tab open with the target URL
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                // If so, just focus it.
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }
            // If not, then open the target URL in a new window/tab.
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
  });

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});

