document.addEventListener("DOMContentLoaded", function() {
  var currentDate = new Date();
  var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
  var year = currentDate.getFullYear();
  var day = ("0" + currentDate.getDate()).slice(-2);
  var calendarElement = document.getElementById("calendar");
  
  new Calendar(calendarElement, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "dayGridMonth",
    height: "auto",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay"
    },
    events: [
      /*{
        title: "All Day Event",
        className: "bg-success-subtle",
        start: year + "-" + month + "-01",
        description: "Lecture"
      },
      {
        title: "Long Event",
        className: "bg-success-subtle",
        start: year + "-" + month + "-07",
        end: year + "-" + month + "-10"
      },
      {
        groupId: 999,
        className: "bg-theme-1-space text-white",
        title: '<span class="position-absolute top-0 end-0 badge bg-success p-1 m-1"><small>Paid</small></span><p class="mb-0 small fw-medium">16:00 am</p><div class="row gx-2"><div class="col-auto"><img src="assets/img/modern-ai-image/user-4.jpg" class="avatar avatar-20 rounded-circle" alt=""> <img src="https://i.pravatar.cc/300" class="avatar avatar-20 rounded-circle" alt=""></div><div class="col">Will Johnson</div></div><p class="mb-0 opacity-75 small text-truncated">Investment Module understanding</p>',
        start: year + "-" + month + "-09T16:00:00"
      },*/
      // ... más eventos
    ],
    eventContent: function(info) {
      return { html: info.event.title };
    }
  }).render();
});