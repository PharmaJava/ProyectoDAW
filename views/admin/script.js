


document.addEventListener('DOMContentLoaded', function() {
    // Tu código aquí
    console.log('El DOM ha sido cargado');
});

$(document).ready( function () {
    $('#myTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
});

