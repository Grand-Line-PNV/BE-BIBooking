d = new Date();
weekendTimes = [
  "11:00",
  "11:30",
  "12:00",
  "12:30",
  "13:00",
  "13:30",
  "14:00",
  "14:30",
  "15:00",
  "15:30",
  "16:00",
  "16:30",
  "17:00",
  "17:30"
];
weekdayTimes = [
  "7:00",
  "7:30",
  "8:00",
  "8:30",
  "9:00",
  "9:30",
  "10:00",
  "10:30",
  "11:00",
  "11:30",
  "12:00",
  "12:30",
  "13:00",
  "13:30",
  "14:00",
  "14:30"
];

if (d.getDay() == 6 || d.getDay() == 0) {
  times = weekendTimes;
} else {
  times = weekdayTimes;
}

var datePickerTime = function (currentDateTime) {
  // 'this' is $ object datetimepicker
  var day = currentDateTime.getDay();
  if (day === 0 || day === 6) {
    this.setOptions({
      allowTimes: weekendTimes
    });
  } else {
    this.setOptions({
      allowTimes: weekdayTimes
    });
  }
};
$("#datetimepicker_unixtime").datetimepicker({
  inline: false,
  minDate: 0,
  onSelectDate: datePickerTime,
  defaultDate: d,
  allowTimes: times,
  formatTime: "h:i a",
  step: 60,
  format: "d/m/y h:i a",
  onGenerate: function (hu) {
    $(this)
      .find(".xdsoft_date.xdsoft_day_of_week5")
      .addClass("xdsoft_disabled");
  }
});
$("#CalendarBtn").click(function () {
  $("#datetimepicker_unixtime").datetimepicker("show"); //support hide,show and destroy command
});
