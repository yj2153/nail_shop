require('./bootstrap');

import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { faAddressCard, faClock } from '@fortawesome/free-regular-svg-icons'
import { faSearch, faStoreAlt, faShoppingBag, faShoppingCart, faTrashAlt, faSignOutAlt, faWonSign, faCamera, faBars, faImage, faDoorClosed, faIdCard, faCalendar } from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faTrashAlt, faShoppingCart, faSignOutAlt, faWonSign, faClock, faCamera, faBars, faImage, faDoorClosed, faIdCard, faCalendar);

dom.watch();

var http = require("http");
var update = setInterval(function () {
  var today = new Date();
  var hh = today.getHours();

  if (hh === 23) {
    clearInterval(update);
  }
  http.get("http://yj-php-laravel.herokuapp.com/");
}, 600000);
