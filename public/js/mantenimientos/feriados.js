document.addEventListener("DOMContentLoaded", function () {
  const holidays = [
    // Ejemplos predefinidos (formato YYYY-MM-DD)
    { date: "2026-01-01", name: "Año Nuevo", type: "nacional" },
    { date: "2026-05-01", name: "Día del Trabajo", type: "nacional" },
  ];

  const tableBody = document.querySelector("#holidaysTable tbody");
  const yearSelect = document.getElementById("yearSelect");
  const generateEasterBtn = document.getElementById("generateEaster");
  const addHolidayBtn = document.getElementById("addHolidayBtn");

  const holidayModal = new bootstrap.Modal(
    document.getElementById("holidayModal"),
  );
  const holidayType = document.getElementById("holidayType");
  const regionGroup = document.getElementById("regionGroup");

  function render() {
    tableBody.innerHTML = "";
    holidays.forEach((h, idx) => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${h.date}</td>
        <td>${h.name}</td>
        <td>${h.type}${h.type === "regional" && h.region ? " (" + h.region + ")" : ""}</td>
        <td><button class="btn btn-sm btn-outline-danger" data-idx="${idx}">Eliminar</button></td>
      `;
      tableBody.appendChild(tr);
    });

    // attach delete handlers
    tableBody.querySelectorAll("button[data-idx]").forEach((btn) => {
      btn.addEventListener("click", function () {
        const i = parseInt(this.dataset.idx, 10);
        holidays.splice(i, 1);
        render();
      });
    });
  }

  function computeEaster(year) {
    // Algoritmo de Gauss para fecha de Pascua (Gregorio)
    const a = year % 19;
    const b = Math.floor(year / 100);
    const c = year % 100;
    const d = Math.floor(b / 4);
    const e = b % 4;
    const f = Math.floor((b + 8) / 25);
    const g = Math.floor((b - f + 1) / 3);
    const h = (19 * a + b - d - g + 15) % 30;
    const i = Math.floor(c / 4);
    const k = c % 4;
    const l = (32 + 2 * e + 2 * i - h - k) % 7;
    const m = Math.floor((a + 11 * h + 22 * l) / 451);
    const month = Math.floor((h + l - 7 * m + 114) / 31);
    const day = ((h + l - 7 * m + 114) % 31) + 1;
    return new Date(year, month - 1, day);
  }

  generateEasterBtn.addEventListener("click", function () {
    const year = parseInt(yearSelect.value, 10);
    const easter = computeEaster(year);

    // Jueves Santo = easter - 3
    const maundy = new Date(easter);
    maundy.setDate(easter.getDate() - 3);
    const goodFriday = new Date(easter);
    goodFriday.setDate(easter.getDate() - 2);

    function toISO(d) {
      const y = d.getFullYear();
      const m = (d.getMonth() + 1).toString().padStart(2, "0");
      const day = d.getDate().toString().padStart(2, "0");
      return `${y}-${m}-${day}`;
    }

    // Añadir si no existen
    const candidates = [
      { date: toISO(maundy), name: "Jueves Santo", type: "nacional" },
      { date: toISO(goodFriday), name: "Viernes Santo", type: "nacional" },
    ];

    candidates.forEach((c) => {
      if (!holidays.find((h) => h.date === c.date && h.name === c.name)) {
        holidays.push(c);
      }
    });

    render();
  });

  addHolidayBtn.addEventListener("click", function () {
    document.getElementById("holidayDate").value = "";
    document.getElementById("holidayName").value = "";
    document.getElementById("holidayType").value = "nacional";
    document.getElementById("holidayRegion").value = "";
    regionGroup.style.display = "none";
    holidayModal.show();
  });

  holidayType.addEventListener("change", function () {
    if (this.value === "regional") regionGroup.style.display = "";
    else regionGroup.style.display = "none";
  });

  document.getElementById("saveHoliday").addEventListener("click", function () {
    const date = document.getElementById("holidayDate").value;
    const name = document.getElementById("holidayName").value.trim();
    const type = document.getElementById("holidayType").value;
    const region = document.getElementById("holidayRegion").value.trim();

    if (!date || !name) {
      alert("Fecha y nombre son requeridos");
      return;
    }

    holidays.push({ date, name, type, region });
    holidayModal.hide();
    render();
  });

  // inicializar tabla
  render();
});
