
$(function () {
  $('.datepicker').flatpickr(
    {
      dateFormat: "Y/m/d",
      locale: "ja"
    }
  );
});

const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');

const hiddenStartDate = document.getElementById('hiddenStartDate');
const hiddenEndDate = document.getElementById('hiddenEndDate');

startDate.addEventListener('change', updateStartValue);
endDate.addEventListener('change', updateEndValue);

function updateStartValue(e) {
  hiddenStartDate.value = e.target.value;
}

function updateEndValue(e) {
  hiddenEndDate.value = e.target.value;
}
