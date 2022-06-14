/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/fullcalendar.js":
/*!**************************************!*\
  !*** ./resources/js/fullcalendar.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var calendar; //calendar object
// document.addEventListener('DOMContentLoaded', function () {

window.onload = function () {
  var Calendar = FullCalendar.Calendar;
  var calendarEl = document.getElementById('calendar'); // initialize the calendar

  calendar = new Calendar(calendarEl, {
    plugins: ['interaction', 'dayGrid', 'timeGrid'],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    minTime: '09:00',
    maxTime: '22:10',
    locale: $('html').attr('lang'),
    editable: true,
    buttonText: {
      today: btn_today,
      month: btn_month,
      week: btn_week,
      day: btn_day,
      list: btn_list
    },
    events: '/mypage/fullcalendar/' + new Date().yyyymmdd(),
    eventDrop: function eventDrop(info) {
      //eventDrop
      ajaxUpdate(info);
    },
    eventResize: function eventResize(info) {
      //eventResize
      ajaxUpdate(info);
    },
    eventRender: function eventRender(info) {
      clickCnt = 0;
      info.el.addEventListener('click', function () {
        clickCnt++;

        if (clickCnt === 1) {
          oneClickTimer = setTimeout(function () {
            clickCnt = 0; // SINGLE CLICK
          }, 400);
        } else if (clickCnt === 2) {
          clearTimeout(oneClickTimer);
          clickCnt = 0; // DOUBLE CLICK

          ajaxEdit(info);
        }
      });
    },
    dateClick: function dateClick(info) {
      //캘릭더 셀 클릭
      initForm();
      $('#calendar-ymd').val(info.dateStr);
      $('#delete-btn').css('display', 'none');
      $('#exampleModalCenter').modal('toggle');
    }
  });
  calendar.render(); // });

  document.getElementById('update-btn').addEventListener('click', ajaxStore);
  document.getElementById('delete-btn').addEventListener('click', ajaxDestory);
}; //yyyymmdd format


Date.prototype.yyyymmdd = function () {
  var yyyy = this.getFullYear().toString();
  var mm = (this.getMonth() + 1).toString();
  var dd = this.getDate().toString();
  return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
};
/**
 * initForm clear.
 */


var initForm = function initForm() {
  $('#calendar-id').val('');
  $('#calendar-ymd').val('');
  $('#calendar-title').val('');
  $('#calendar-user').val('');
  $('#calendar-start-hour').val('');
  $('#calendar-start-minute').val('');
  $('#calendar-end-hour').val('');
  $('#calendar-end-minute').val('');
  $('#calendar-color').val('Summer Sky');
  $('.is-invalid').each(function (key, value) {
    var msgID = $(value).attr('id');
    $("#" + msgID + "-msg").find('strong').html('');
    $(value).removeClass("is-invalid");
  });
}; //end initForm

/**
 * modal -> create or update.
 */


var ajaxStore = function ajaxStore() {
  // csrf。
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'post',
    data: {
      'calendar-ymd': $('#calendar-ymd').val(),
      'calendar-start-hour': $('#calendar-start-hour').val(),
      'calendar-start-minute': $('#calendar-start-minute').val(),
      'calendar-end-hour': $('#calendar-end-hour').val(),
      'calendar-end-minute': $('#calendar-end-minute').val(),
      'calendar-user': $('#calendar-user').val(),
      'calendar-id': $('#calendar-id').val(),
      'calendar-title': $('#calendar-title').val()
    },
    datatype: 'json',
    url: '/mypage/fullcalendar'
  }).done(function (data) {
    json = JSON.parse(data);

    if (json['result'] == 'success') {
      //success
      alert(success_msg); //get id

      var id = $('#calendar-id').val(); //remove

      if (id == json['model']['id']) {
        var event = calendar.getEventById(id);
        event.remove();
      } //add event


      calendar.addEvent(json['model']);
      $('#exampleModalCenter').modal('toggle');
    } else {
      $('.is-invalid').each(function (key, value) {
        var msgID = $(value).attr('id');
        $("#" + msgID + "-msg").find('strong').html('');
        $(value).removeClass("is-invalid");
      });
      $.each(json['error'], function (key, value) {
        $("#" + key).addClass("is-invalid");
        $("#" + key + "-msg").find("strong").append('<span>' + value + '</span>');
      });
    }
  }).fail(function (data) {
    alert(error_msg);
  });
}; //end ajaxUpdate

/**
 * eventDrop, eventResize event.
 */


var ajaxUpdate = function ajaxUpdate(info) {
  // csrf。
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'put',
    data: {
      'calendarStart': info.event.start,
      'calendarEnd': info.event.end,
      'calendar-id': info.event.id
    },
    datatype: 'json',
    url: '/mypage/fullcalendar/' + info.event.id
  }).done(function (data) {
    json = JSON.parse(data);

    if (json['result'] == 'success') {
      alert(success_msg);
    }
  }).fail(function (data) {
    alert(error_msg);
  });
}; //end ajaxUpdate

/**
 * modal -> Edit.
 */


var ajaxEdit = function ajaxEdit(info) {
  var editURL = '/mypage/fullcalendar/{fullcalendar}/edit';
  editURL = editURL.replace('{fullcalendar}', info.event.id); //init

  initForm();
  $.ajax({
    type: 'get',
    datatype: 'json',
    url: editURL
  }).done(function (data) {
    json = JSON.parse(data);
    $('#calendar-id').val(json['id']);
    $('#calendar-title').val(json['title']);
    $('#calendar-user').val(json['user_id']);
    startDate = new Date(json['start']);
    $('#calendar-ymd').val(startDate.yyyymmdd());
    $('#calendar-start-hour').val(startDate.getHours());
    $('#calendar-start-minute').val(startDate.getMinutes());

    if (json['end'] != null) {
      endDate = new Date(json['end']);
      $('#calendar-end-hour').val(endDate.getHours());
      $('#calendar-end-minute').val(endDate.getMinutes());
    }

    $('#delete-btn').css('display', '');
    $('#exampleModalCenter').modal('toggle');
  }).fail(function (data) {
    alert('error');
  });
}; // end ajaxEdit

/**
 * delete.
 */


var ajaxDestory = function ajaxDestory() {
  var destoryID = $('#calendar-id').val(); // csrf。

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'delete',
    datatype: 'json',
    url: '/mypage/fullcalendar/' + destoryID
  }).done(function (data) {
    json = JSON.parse(data);

    if (json['result'] == 'success') {
      alert(delete_success_msg); //remove

      var event = calendar.getEventById(destoryID);
      event.remove(); //modal close

      $('#exampleModalCenter').modal('toggle');
    }
  }).fail(function (data) {
    alert(delete_error_msg);
  });
}; //end ajaxDestory

/***/ }),

/***/ 3:
/*!********************************************!*\
  !*** multi ./resources/js/fullcalendar.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/resources/js/fullcalendar.js */"./resources/js/fullcalendar.js");


/***/ })

/******/ });