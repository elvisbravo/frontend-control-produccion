document.addEventListener("DOMContentLoaded", function () {
  var currentDate = new Date();
  var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
  var year = currentDate.getFullYear();
  var day = ("0" + currentDate.getDate()).slice(-2);
  var calendarElement = document.getElementById("calendar");

  new Calendar(calendarElement, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "timeGridWeek",
    locale: "es",
    height: "auto",
    slotMinTime: "07:00:00",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    events: function (info, successCallback, failureCallback) {
      fetch("horario-by-id")
        .then((response) => response.json())
        .then((data) => {
          // Mapear eventos si es necesario
          const datos = data.result;
          const eventos = datos.map((evento) => ({
            id: evento.id,
            title: evento.title,
            start: evento.start,
            end: evento.end,
            className: evento.className,
          }));

          successCallback(eventos);
        })
        .catch((error) => {
          console.error("Error cargando eventos:", error);
          failureCallback(error);
        });
    },
    eventContent: function (info) {
      return { html: info.event.title };
    },
  }).render();
});
