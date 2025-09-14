document.getElementById("buscarForm").addEventListener("submit", async e => { 
    e.preventDefault();
    const ci_usuario = document.getElementById("ci_usuario").value.trim();
    if (!ci_usuario) return;

    try {
        const res = await fetch("backoffice_jornada.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `ci_usuario=${encodeURIComponent(ci_usuario)}`
        });

        const data = await res.json();

        const mensajesDiv = document.getElementById("mensajes");
        mensajesDiv.innerHTML = "";
        if (data.messages) {
            data.messages.forEach(m => {
                const p = document.createElement("p");
                p.className = m.type;
                p.textContent = m.text;
                mensajesDiv.appendChild(p);
            });
        }

        const tablaDiv = document.getElementById("tablaJornadas");
        tablaDiv.innerHTML = "";

        if (data.jornadas && data.jornadas.length > 0) {
            // Filtrar jornadas ya verificadas
            const jornadasFiltradas = data.jornadas.filter(j => !j.verificado);

            if (jornadasFiltradas.length === 0) {
                tablaDiv.innerHTML = "<p>No hay jornadas pendientes de verificación.</p>";
                return;
            }

            // Agrupar por semana para marcar colores
            const semanas = {};
            jornadasFiltradas.forEach(j => {
                const fecha = new Date(j.fecha);
                const year = fecha.getFullYear();
                const week = getWeekNumber(fecha);
                const key = `${year}-S${week}`;
                if (!semanas[key]) semanas[key] = [];
                semanas[key].push(j);
            });

            const table = document.createElement("table");
            table.innerHTML = `
                <thead>
                    <tr>
                        <th>Semana</th>
                        <th>Mes</th>
                        <th>Fecha</th>
                        <th>Horas trabajadas</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody></tbody>
            `;
            const tbody = table.querySelector("tbody");

            for (let semana in semanas) {
                const semanaData = semanas[semana];
                const totalHoras = semanaData.reduce((acc,j)=>acc+parseFloat(j.horas_semanales),0);
                const colorClass = totalHoras >= 21 ? "verificado" : "no-verificado";

                semanaData.forEach(j => {
                    const fechaObj = new Date(j.fecha);
                    const tr = document.createElement("tr");
                    tr.className = colorClass;
                    tr.innerHTML = `
                        <td>${semana}</td>
                        <td>${fechaObj.toLocaleString('es-ES', {month:'long'})}</td>
                        <td>${j.fecha}</td>
                        <td>${j.horas_semanales}</td>
                        <td>${j.descripcion || ""}</td>
                        <td><button data-id="${j.id}">Verificar</button></td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            tablaDiv.appendChild(table);

            // Event listener para verificar
            tablaDiv.querySelectorAll("button[data-id]").forEach(btn => {
                btn.addEventListener("click", async () => {
                    const id = btn.dataset.id;
                    try {
                        const resVer = await fetch(`backoffice_jornada.php?verificar_id=${id}`, { method: "GET" });
                        const dataVer = await resVer.json();
                        alert(dataVer.messages[0].text);
                        document.getElementById("buscarForm").dispatchEvent(new Event("submit"));
                    } catch(err) {
                        console.error("Error al verificar:", err);
                    }
                });
            });
        }
    } catch (err) {
        console.error("Error:", err);
    }
});

// Función para obtener número de semana ISO
function getWeekNumber(d) {
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    const dayNum = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    const yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
    return Math.ceil((((d - yearStart) / 86400000) + 1)/7);
}
