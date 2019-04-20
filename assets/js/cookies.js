window.addEventListener("load", function(){
window.cookieconsent.initialise({
	
	content: {
    header: 'Cookies used on the website!',
    message: 'Αυτός ο ιστότοπος χρησιμοποιεί cookies για να εξασφαλίσει ότι θα έχετε την καλύτερη εμπειρία στον ιστότοπό μας',
    dismiss: 'Το κατάλαβα!',
    allow: 'Allow cookies',
    deny: 'Decline',
    link: 'Μάθε περισσότερα',
    href: 'http://cookiesandyou.com',
    close: '&#x274c;',
  },

  "palette": {
    "popup": {
      "background": "#eb6c44",
      "text": "#ffffff"
    },
    "button": {
      "background": "#ffffff"
    }
  },
  "theme": "classic"
})});
