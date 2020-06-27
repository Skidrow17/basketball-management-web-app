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

navigator.serviceWorker.register('firebase/firebase-messaging-sw.js')
        .then((registration) => {
           messaging.useServiceWorker(registration);
messaging.requestPermission().
        then(function () {
        console.log("Notification permission granted.");               
        return messaging.getToken()
    })
    .then(function(token) {
        var post = "mobile_token="+token;
        $.ajax({
            type: "POST",
            url: "php/jquery/tokenRegister.php",
            data: post,
            success: function(result) {
                console.log(result+' '+token);
            }
        });
    })
    .catch(function (err) {
        console.log("Unable to get permission to notify.", err);
    });
});

messaging.onMessage(function(payload) {
    console.log("Message received. ",payload);
    //kenng - foreground notifications
    if(window.location.pathname.split('/').pop() !== 'chatting.php' && window.location.pathname.split('/').pop() !== 'chatting_user.php'){
        const {message, ...options} = payload.data;
        firebase_contact = payload.data.title.split("/");
        console.log(firebase_contact[1]);

        const notificationOptions = {
            body: payload.data.message,
            icon: '/itwonders-web-logo.png',
            url: 'www.google.com'
        };

        navigator.serviceWorker.register('firebase/firebase-messaging-sw.js')
        .then((registration) => {
            registration.showNotification(firebase_contact[0], notificationOptions);
        }).catch(function (err) {
            console.log("sECOND FAILED ALSO", err);
        });
    }
});

let refreshing = false;

// detect controller change and refresh the page
navigator.serviceWorker.addEventListener('controllerchange', () => {
    if (!refreshing) {
        window.location.reload()
        refreshing = true
    }
})