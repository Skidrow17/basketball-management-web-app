var firebaseConfig = {
    // add configuration
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

navigator.serviceWorker.register('firebase/firebase-messaging-sw.js')
        .then((registration) => {
           messaging.useServiceWorker(registration);
messaging.requestPermission().
        then(function () {
        return messaging.getToken()
    })
    .then(function(token) {
        var post = "mobile_token="+token;
        $.ajax({
            type: "POST",
            url: "php/jquery/tokenRegister.php",
            data: post,
            success: function(result) {
            }
        });
    })
    .catch(function (err) {
    });
});

messaging.onMessage(function(payload) {
    //kenng - foreground notifications
    if(window.location.pathname.split('/').pop() !== 'chatting.php' && window.location.pathname.split('/').pop() !== 'chatting_user.php'){
        const {message, ...options} = payload.data;
        firebase_contact = payload.data.title.split("/");

        const notificationOptions = {
            body: payload.data.message,
            icon: '/itwonders-web-logo.png',
            url: 'www.google.com'
        };

        navigator.serviceWorker.register('firebase/firebase-messaging-sw.js')
        .then((registration) => {
            registration.showNotification(firebase_contact[0], notificationOptions);
        }).catch(function (err) {
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