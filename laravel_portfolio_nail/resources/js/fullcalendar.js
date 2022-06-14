let calendar; //calendar object

// document.addEventListener('DOMContentLoaded', function () {
window.onload = function () {
  let Calendar = FullCalendar.Calendar;
  let calendarEl = document.getElementById('calendar');

  // initialize the calendar
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
    events: '/mypage/fullcalendar/' + (new Date()).yyyymmdd(),
    eventDrop: function (info) {
      //eventDrop
      ajaxUpdate(info);
    },

    eventResize: function (info) {
      //eventResize
      ajaxUpdate(info);
    },

    eventRender: function (info) {
      clickCnt = 0;
      info.el.addEventListener('click', function () {
        clickCnt++;
        if (clickCnt === 1) {
          oneClickTimer = setTimeout(function () {
            clickCnt = 0;

            // SINGLE CLICK

          }, 400);
        } else if (clickCnt === 2) {
          clearTimeout(oneClickTimer);
          clickCnt = 0;

          // DOUBLE CLICK
          ajaxEdit(info);
        }
      });
    },

    dateClick: function (info) {
      //캘릭더 셀 클릭
      initForm();
      $('#calendar-ymd').val(info.dateStr);
      $('#delete-btn').css('display', 'none');
      $('#exampleModalCenter').modal('toggle');
    }
  })

  calendar.render();
  // });

  document.getElementById('update-btn').addEventListener('click', ajaxStore);
  document.getElementById('delete-btn').addEventListener('click', ajaxDestory);
};

//yyyymmdd format
Date.prototype.yyyymmdd = function () {
  var yyyy = this.getFullYear().toString();
  var mm = (this.getMonth() + 1).toString();
  var dd = this.getDate().toString();
  return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
}

/**
 * initForm clear.
 */
const initForm = () => {
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
    let msgID = $(value).attr('id');
    $("#" + msgID + "-msg").find('strong').html('');
    $(value).removeClass("is-invalid");
  });
}//end initForm

/**
 * modal -> create or update.
 */
const ajaxStore = () => {
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
  })
    .done(function (data) {
      json = JSON.parse(data);
      if (json['result'] == 'success') {
        //success
        alert(success_msg);

        //get id
        let id = $('#calendar-id').val();

        //remove
        if (id == json['model']['id']) {
          var event = calendar.getEventById(id);
          event.remove();
        }

        //add event
        calendar.addEvent(json['model']);
        $('#exampleModalCenter').modal('toggle');
      } else {
        $('.is-invalid').each(function (key, value) {
          let msgID = $(value).attr('id');
          $("#" + msgID + "-msg").find('strong').html('');
          $(value).removeClass("is-invalid");
        });

        $.each(json['error'], function (key, value) {
          $("#" + key).addClass("is-invalid");
          $("#" + key + "-msg").find("strong").append('<span>' + value + '</span>');
        });
      }
    })
    .fail(function (data) {
      alert(error_msg);
    });
};//end ajaxUpdate

/**
 * eventDrop, eventResize event.
 */
const ajaxUpdate = (info) => {
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
  })
    .done(function (data) {
      json = JSON.parse(data);
      if (json['result'] == 'success') {
        alert(success_msg);
      }
    })
    .fail(function (data) {
      alert(error_msg);
    });
};//end ajaxUpdate

/**
 * modal -> Edit.
 */
const ajaxEdit = (info) => {
  let editURL = '/mypage/fullcalendar/{fullcalendar}/edit';
  editURL = editURL.replace('{fullcalendar}', info.event.id);

  //init
  initForm();

  $.ajax({
    type: 'get',
    datatype: 'json',
    url: editURL
  })
    .done(function (data) {
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
    })
    .fail(function (data) {
      alert('error');
    });
};// end ajaxEdit

/**
 * delete.
 */
const ajaxDestory = () => {
  let destoryID = $('#calendar-id').val();

  // csrf。
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'delete',
    datatype: 'json',
    url: '/mypage/fullcalendar/' + destoryID
  })
    .done(function (data) {
      json = JSON.parse(data);
      if (json['result'] == 'success') {
        alert(delete_success_msg);

        //remove
        var event = calendar.getEventById(destoryID);
        event.remove();

        //modal close
        $('#exampleModalCenter').modal('toggle');
      }
    })
    .fail(function (data) {
      alert(delete_error_msg);
    });
};//end ajaxDestory
