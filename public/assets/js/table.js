$(document).ready(function () {
  function format(d) {
    return (
      '<pre style="margin-left: 35px;">' +
      "<strong>Brand : </strong>" +
      d.brand +
      "<strong> || Type :</strong> " +
      d.type +
      "<strong> || Specification :</strong> " +
      d.detail +
      "<strong> || Create By :</strong> " +
      d.createBy +
      "<strong> || Create Date :</strong>" +
      d.createDate +
      "<br>" +
      "<strong>Condition : </strong>" +
      d.kondisi +
      "</pre>"
    );
  }

  const table = $("#item").DataTable({
    ajax: {
      url: "/dashboard/maset/item",
      type: "GET",
    },
    columns: [
      {
        className: "dt-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
      { data: "kodeItemId", defaultContent: "-" },
      { data: "namaItem", defaultContent: "-" },
      { data: "lokasiItem", defaultContent: "-" },
      { data: "warehouse", defaultContent: "-" },
      { data: "tglPembelian", defaultContent: "-" },
      { data: "nama_peminjam", defaultContent: "-" },
      {
        data: "status",
        render: function (data) {
          if (data == "1") {
            return "Dipinjam";
          } else {
            return "Tersedia";
          }
        },
      },
    ],
    order: [[1, "asc"]],
    rowId: "id",
    stateSave: true,

    dom: "Bfrtip",
    select: true,
    paging: false,
    scrollCollapse: true,
    searching: true,
    info: true,
    autoWidth: false,
  });

  table.buttons().container().appendTo($("#item_info"));

  table.on("requestChild.dt", function (e, row) {
    row.child(format(row.data())).show();
  });

  table.on("click", "td.dt-control", function (e) {
    let tr = e.target.closest("tr");
    let row = table.row(tr);

    if (row.child.isShown()) {
      row.child.hide();
    } else {
      row.child(format(row.data())).show();
    }
  });

  new $.fn.dataTable.Buttons(table, {
    buttons: [
      {
        text: "Add",
        className: "btn btn-primary",
        action: function () {
          window.location.href = "/dashboard/add";
        },
      },
      //edit
      {
        text: "Edit",
        className: "btn btn-primary",
        action: function () {
          const selectedRows = table
            .rows({ page: "current", selected: true })
            .data()
            .toArray();
          if (selectedRows.length === 1) {
            var xhr = new XMLHttpRequest();
            console.log(selectedRows);
            var itemId = selectedRows[0]["kodeItemId"];
            // console.log(itemId);

            var form = document.createElement("form");
            form.method = "POST";
            form.action = "maset/item/edit";

            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "itemId";
            input.value = itemId;

            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
          } else {
            alert("please select a row");
          }
        },
      },
      //delete
      {
        text: "Delete",
        className: "btn btn-danger me-3",
        action: function () {
          const selectedRows = table
            .rows({ selected: true })
            .data()
            .pluck("kodeItemId")
            .toArray();
          if (selectedRows.length > 0) {
            // var itemId = [];
            // var itemId = selectedRows[0]["id"];
            console.log(selectedRows);
            var hasil = window.confirm("Delete Item?");

            if (hasil) {
              $.ajax({
                url: "maset/item/delete",
                type: "post",
                data: { id: selectedRows },
                success: function (response) {
                  var successCount = 0;
                  var errorCount = 0;

                  for (var i = 0; i < response.length; i++) {
                    if (response[i].status === "success") {
                      successCount++;
                    } else {
                      errorCount++;
                    }
                  }

                  if (successCount > 0) {
                    alert(successCount + " item(s) deleted successfully.");
                  }

                  if (errorCount > 0) {
                    alert(
                      errorCount + " item(s) encountered errors while deleting."
                    );
                  }

                  table.ajax.reload();
                },
                error: function () {
                  alert("An error occurred.");
                },
              });
            } else {
              alert("Delete dibatalkan");
            }
          } else {
            alert("please select a row");
          }
        },
      },
    ],
    fade: true,
  })
    .container()
    .appendTo($("#item_filter"));
});
