$(document).ready(function () {
  // debug rápido: ver que el selector realmente apunta a la tabla
  console.log(
    "Historial existe?",
    $("#Historial").length,
    $("#Historial")[0] ? $("#Historial")[0].tagName : null
  );
  console.log(
    "ListadoTabla existe?",
    $("#ListadoTabla").length,
    $("#ListadoTabla")[0] ? $("#ListadoTabla")[0].tagName : null
  );

  $("#Historial").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: false, // sin paginación
    searching: false, // sin barra de búsqueda
    info: false, // sin texto "Mostrando X de Y"
    lengthChange: false, // sin selector de cantidad de registros
    order: [[0, "desc"]], // mantiene el orden por fecha descendente
  });

  $("#ListadoTabla").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: false, // sin paginación
    searching: false, // sin barra de búsqueda
    info: false, // sin texto "Mostrando X de Y"
    lengthChange: false, // sin selector de cantidad de registros
    order: [[0, "desc"]], // mantiene el orden por fecha descendente
  });

  $("#Administrador").DataTable({
    language: {
      search: "Buscar administrador:",
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: false, // sin paginación
    info: false, // sin texto "Mostrando X de Y"
    lengthChange: false, // sin selector de cantidad de registros
    pageLength: 10,
    order: [[5, "desc"]],
  });

  $("#Supervisor").DataTable({
    language: {
      search: "Buscar supervisor:",
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: false, // sin paginación
    info: false, // sin texto "Mostrando X de Y"
    lengthChange: false, // sin selector de cantidad de registros
    pageLength: 10,
    order: [[5, "desc"]],
  });

  $("#Funcionario").DataTable({
    language: {
      search: "Buscar funcionario:",
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: false, // sin paginación
    info: false, // sin texto "Mostrando X de Y"
    lengthChange: false, // sin selector de cantidad de registros
    pageLength: 10,
    order: [[5, "desc"]],
  });
  $("#RegistroMarcas").DataTable({
    language: {
      search: "Buscar nombre de marca:",
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    info: false, // sin texto "Mostrando X de Y"
    lengthChange: false, // sin selector de cantidad de registros
    pageLength: 10,
    order: [[1, "desc"]],
  });
});
