$(document).ready(()=>{

  

let table = $("#dataTable");
let rowsPerPage = 8;
let currentPage = 1;

function buildTable() {
  let start = (currentPage - 1) * rowsPerPage;
  let end = start + rowsPerPage;

  table.find("tbody tr").hide();
  table.find("tbody tr").slice(start, end).show();

  buildPagination();
}

function buildPagination() {
  let totalRows = table.find("tbody tr").length;
  let totalPages = Math.ceil(totalRows / rowsPerPage);

  let pagination = $("#pagination");
  pagination.html("");

  for (var i = 1; i <= totalPages; i++) {
    let link = $("<a>");
    link.attr("href", "#");
    link.html(i);

    if (i == currentPage) {
      link.addClass("active");
    }

    link.on("click", function () {
      currentPage = parseInt($(this).html());
      buildTable();
      return false;
    });

    pagination.append(link);
  }
}

buildTable();



})

