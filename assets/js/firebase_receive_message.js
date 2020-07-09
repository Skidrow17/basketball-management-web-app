var firebaseConfig = {
	// add configuration
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
messaging.onMessage(function(payload) {
    console.log("Message received. ", JSON.stringify(payload));
    //kenng - foreground notifications
    const {title, ...options} = payload.data;
    navigator.serviceWorker.register('firebase/firebase-messaging-sw.js')
    .then((registration) => {
        registration.showNotification(title, options);
    }).catch(function (err) {
        console.log("sECOND FAILED ALSO", err);
    });
});