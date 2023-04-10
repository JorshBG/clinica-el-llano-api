
let dataTable
let dataTableInitialized = false
const dataTableOptions = {
    pageLength: 8,
    lengthMenu: [8,15,25,50,100],
    destroy: true,
    language: {
        processing:     "Espere un momento",
        search:         "Buscar&nbsp;:",
        lengthMenu:    "Mostrar _MENU_  elementos",
        info:           "Mostrando desde _START_ hasta _END_ de _TOTAL_ elementos",
        infoEmpty:      "Mostrando desde 0 hasta 0 de 0 elementos",
        infoFiltered:   "(filtrados desde _MAX_ registros totales)",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "No se han encontrado elementos",
        emptyTable:     "Actualmente esta tabla no tiene registros",
        paginate: {
            first:      "Primer",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Último"
        }
    }
}

export const verifyDataTable = () => {
  
    if (dataTableInitialized) {
        dataTable.destroy()
    }

}

export const createDataTable = () => {
    dataTable = $('#dashboard_data-table').DataTable(dataTableOptions)


    dataTableInitialized = true
}