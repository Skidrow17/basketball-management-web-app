var firebaseConfig = {
    apiKey: "AIzaSyDPZ1Q0S5bCCbpmdc2m1Ccs5e1-wwHWDps",
    authDomain: "ekasdym-e8cc1.firebaseapp.com",
    databaseURL: "https://ekasdym-e8cc1.firebaseio.com",
    projectId: "ekasdym-e8cc1",
    storageBucket: "ekasdym-e8cc1.appspot.com",
    messagingSenderId: "707613194453",
    appId: "1:707613194453:web:905ce196429e4643e70a5c",
    measurementId: "G-H2K5SM5YRM"
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