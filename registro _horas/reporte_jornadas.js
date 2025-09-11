const meses = [
"", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

async function cargarReporte() {
    try {
    const res = await fetch("reporte_jornadas.php");
    const data = await res.json();

    const yearActual = new Date().getFullYear();
    const tablaActual = document.getElementById("tablaActual");
    const tablaAnterior = document.getElementById("tablaAnterior");

    const encabezado = `
        <tr>
        <th>Año</th>
        <th>Mes</th>
        <th>Semana</th>
        <th>Total Horas</th>
        <th>Estado</th>
        </tr>
    `;

    tablaActual.innerHTML = encabezado;
    tablaAnterior.innerHTML = encabezado;

    if (!Array.isArray(data)) {
        tablaActual.innerHTML += `<tr><td colspan="5">Error en respuesta del servidor</td></tr>`;
        tablaAnterior.innerHTML += `<tr><td colspan="5">Error en respuesta del servidor</td></tr>`;
    return;
    }

    data.forEach(reg => {
    const tr = document.createElement("tr");
    const cumplida = reg.total_horas >= 21;
    tr.className = cumplida ? "cumplida" : "incumplida";

    tr.innerHTML = `
        <td>${reg.year}</td>
        <td>${meses[reg.mes]}</td>
        <td>Semana ${reg.semana}</td>
        <td>${reg.total_horas}</td>
        <td>${cumplida ? "Cumplida" : "Incompleta"}</td>
    `;

    if (parseInt(reg.year) === yearActual) {
        tablaActual.appendChild(tr);
    } else {
        tablaAnterior.appendChild(tr);
    }
    });

} catch (err) {
    console.error("Error cargando reporte:", err);
}
}

document.addEventListener("DOMContentLoaded", cargarReporte);
