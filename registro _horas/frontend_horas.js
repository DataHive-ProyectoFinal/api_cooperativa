const monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
const weekdays = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];

const selectMes = document.getElementById('selectMes');
const selectYear = document.getElementById('selectYear');
const calendarEl = document.getElementById('calendar');
const calendarHeader = document.getElementById('calendarHeader');

const inputMes = document.getElementById('inputMes');
const inputDia = document.getElementById('inputDia');
const inputYear = document.getElementById('inputYear');
const inputWeekday = document.getElementById('inputWeekday');

// poblar selects
const now = new Date();
for (let i=0;i<12;i++) {
const opt = document.createElement('option');
opt.value = i+1;
opt.textContent = monthNames[i];
if (i===now.getMonth()) opt.selected = true;
selectMes.appendChild(opt);
}
for (let y = now.getFullYear()-1; y <= now.getFullYear()+1; y++) {
const opt = document.createElement('option');
opt.value = y;
opt.textContent = y;
if (y===now.getFullYear()) opt.selected = true;
selectYear.appendChild(opt);
}

function renderCalendar() {
    const mes = parseInt(selectMes.value, 10) - 1; // JS months 0-11
    const year = parseInt(selectYear.value, 10);
    calendarEl.innerHTML = '';
    calendarHeader.innerHTML = '';

  // header (weekdays)
    for (let d=0; d<7; d++) {
    const el = document.createElement('div');
    el.className = 'small';
    el.style.textAlign='center';
    el.style.fontWeight='600';
    el.textContent = weekdays[d].slice(0,3);
    calendarHeader.appendChild(el);
    }

    const firstDay = new Date(year, mes, 1).getDay();
    const daysInMonth = new Date(year, mes+1, 0).getDate();

  // fill leading empty cells
    for (let i=0;i<firstDay;i++){
    const c = document.createElement('div'); c.className='cell disabled'; calendarEl.appendChild(c);
    }

  // fill days
    for (let d=1; d<=daysInMonth; d++){
    const date = new Date(year, mes, d);
    const c = document.createElement('div');
    c.className='cell';
    c.textContent = d;

    // no permitir seleccionar días futuros (opcional)
    const today = new Date();
    today.setHours(0,0,0,0);
    const dateOnly = new Date(year, mes, d);
    if (dateOnly > today) {
        c.classList.add('disabled');
        c.title = 'No puedes seleccionar días futuros';
    } else {
        c.addEventListener('click', ()=> selectDay(d, mes+1, year));
      // marcar hoy
    const isToday = (dateOnly.getTime() === today.getTime());
        if (isToday) c.classList.add('today');
    }

    calendarEl.appendChild(c);
}
}

function selectDay(dia, mes, year){
  // deseleccionar previo
    document.querySelectorAll('.cell.selected').forEach(el=>el.classList.remove('selected'));
  // encontrar celda
    const cells = Array.from(calendarEl.querySelectorAll('.cell')).filter(c=>!c.classList.contains('disabled'));
    const target = cells.find(c => c.textContent==String(dia));
    if (target) target.classList.add('selected');

  // set inputs
    inputMes.value = mes;
    inputDia.value = dia;
    inputYear.value = year;
    const fecha = new Date(year, mes-1, dia);
    inputWeekday.value = weekdays[fecha.getDay()];
}

// evitar enviar sin día
function beforeSubmit(){
    if (!inputMes.value || !inputDia.value || !inputYear.value) {
    alert('Selecciona un día en el calendario antes de enviar.');
    return false;
    }
  // validar horas (cliente)
    const hrs = document.getElementById('horas').value;
    if (!/^(\d{1,2})(?:\.\d+)?$/.test(hrs) || parseFloat(hrs) < 0 || parseFloat(hrs) > 24) {
    alert('Ingresa horas válidas entre 0 y 24.');
    return false;
    }
    return true;
}

selectMes.addEventListener('change', renderCalendar);
selectYear.addEventListener('change', renderCalendar);
renderCalendar();
// pre-seleccionar hoy si es válido
(function preSelectToday(){
    const t = new Date();
    const todayCell = Array.from(calendarEl.querySelectorAll('.cell')).find(c => c.textContent == t.getDate() && !c.classList.contains('disabled'));
    if (todayCell) { todayCell.click(); }
})();

// ======================
// Envío de formulario con AJAX
// ======================

document.getElementById("registroForm").addEventListener("submit", async e => {
    e.preventDefault();

    const formData = new FormData(e.target);

    try {
    const res = await fetch("frontend_horas.php", {
        method: "POST",
        body: formData
    });

    const messages = await res.json();

    const container = document.getElementById("mensajes");
    container.innerHTML = "";

    messages.forEach(m => {
        const div = document.createElement("div");
        div.className = "msg " + m.type;
        div.textContent = m.text;
        container.appendChild(div);
    });
    } catch (error) {
    console.error("Error al enviar datos:", error);
    }
});

console.log("frontend_horas.js cargado");