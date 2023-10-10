var dataArray = [];

function loadEmployee() {
  if ($("#employee").find("option").length === 1) {
    $("#employee").empty().append("<option>select</option>");
    $.ajax({
      url: "/dashboard/loadEmployee",
      dataType: "json",
      type: "POST",
      data: { employee: nama },
      success: function (response) {
        var array = response.value;
        if (array.length > 0) {
          $("#employe").empty();
          for (var i = 0; i < array.length; i++) {
            $("#employe").append(
              "<option value='" +
                array[i].id +
                "'>" +
                array[i].nama +
                "</option>"
            );
            console.log(array[i].nama);
          }
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }
}

$(document).ready(function () {
  // Fungsi untuk mengatur inputan berdasarkan status
  function toggleInputs() {
    var status = $("#status").val();
    if (status == "1") {
      // Jika statusnya "Dipinjam"
      $("#lokasiItem, #warehouse, #employeId").prop("disabled", false);
    } else {
      // Jika statusnya "Tersedia"
      $("#lokasiItem, #warehouse, #employeId").prop("disabled", true);
    }
  }

  // Panggil fungsi saat halaman dimuat
  toggleInputs();

  // Panggil fungsi saat status berubah
  $("#status").change(function () {
    toggleInputs();
  });
});

$(document).ready(function () {
  var table = $("#addItems").DataTable({
    data: dataArray,
    columns: [
      { data: "kodeItemId", tittle: "kodeItemId", defaultContent: "-" },
      { data: "namaItem", tittle: "namaItem", defaultContent: "-" },
      { data: "brand", tittle: "brand", defaultContent: "-" },
      { data: "type", tittle: "type", defaultContent: "-" },
      { data: "detail", tittle: "detail", defaultContent: "-" },
      // { data: "lokasiItem", tittle: "lokasiItem", defaultContent: "-" },
      // { data: "warehouse", tittle: "whText", defaultContent: "-" },
      { data: "tglPembelian", tittle: "tglPembelian", defaultContent: "-" },
      // { data: "employeId", tittle: "employeId", defaultContent: "-" },
      { data: "kondisi", tittle: "kondisi", defaultContent: "-" },
      { data: "createBy", tittle: "cbText", defaultContent: "-" },
      { data: "status", tittle: "stText", defaultContent: "-" },
    ],
    order: [[1, "asc"]],
    rowId: "kodeItemId",
    stateSave: true,
    responsive: true,

    searching: false,
    paging: false,
    select: true,
    info: false,
    autoWidth: false,
    dom: "Bfrtip",
  });
  table.buttons().container().appendTo($("#addItems"));

  // Mengecek jika ada data dalam tabel
  function isTableNotEmpty() {
    return table.rows().count() > 0;
  }

  // Mengaktifkan atau menonaktifkan tombol "Save"
  function toggleSaveButton() {
    var saveButton = $("button[id='save']");
    if (isTableNotEmpty()) {
      saveButton.prop("disabled", false);
    } else {
      saveButton.prop("disabled", true);
    }
  }

  // Memanggil fungsi toggleSaveButton() saat halaman dimuat
  toggleSaveButton();

  // Memanggil fungsi toggleSaveButton() setiap kali data diubah dalam tabel
  table.on("draw.dt", function () {
    toggleSaveButton();
  });

  // Mengirim data ke controller saat tombol "Save" diklik
  $("button[id='save']").on("click", function () {
    if (isTableNotEmpty()) {
      var dataToSave = table.rows().data().toArray();

      var jsonData = JSON.stringify(dataToSave);

      var confirmSave = window.confirm(
        "Apakah Anda yakin ingin menyimpan data?"
      );
      if (confirmSave) {
        // Mengirim dataToSave ke controller dengan metode AJAX
        $.ajax({
          url: "/dashboard/addAction",
          type: "POST",
          data: jsonData,
          dataType: "json",
          contentType: "application/json",
          success: function (response) {
            // table.clear().draw();
            // dataArray = [];
            // console.log("Data berhasil disimpan ke database.");

            alert("Item berhasil disimpan ke database");

            var hasil = window.confirm("Apakah ingin menabeh item lagi?");

            if (hasil) {
              location.reload(true);
            } else {
              alert("kembali ke measter asset");
              window.location.href = "/dashboard/master/maset";
            }
          },
          error: function (xhr, status, error) {
            console.error("Kesalahan saat mengirim data: " + error);
          },
        });
      }
    }
  });

  table.on("select", function (e, dt, type, indexes) {
    if (type === "row") {
      var selectedRowId = indexes[0]; // Menggunakan indeks baris sebagai ID sementara

      console.log("ID baris terpilih: " + selectedRowId);
    }
  });

  new $.fn.dataTable.Buttons(table, {
    buttons: [
      {
        text: "Delete item table",
        className: "btn btn-danger btn-sm",
        action: function () {
          const selectedRows = table
            .rows({ selected: true })
            .indexes()
            .toArray();
          if (selectedRows.length > 0) {
            var hasil = window.confirm(
              "Delete " + selectedRows.length + " items?"
            );

            if (hasil) {
              selectedRows.sort(function (a, b) {
                return b - a; // Urutkan indeks secara descending agar penghapusan tidak mengubah indeks lainnya
              });

              selectedRows.forEach(function (rowIndex) {
                table.row(rowIndex).remove().draw(false);
              });

              // Perbarui dataArray untuk mencerminkan perubahan
              dataArray = table.rows().data().toArray();

              console.log(selectedRows.length + " baris telah dihapus.");
              console.log("Data Array setelah dihapus:", dataArray);
            } else {
              alert("Delete dibatalkan");
            }
          } else {
            alert("please select one or more rows");
          }
        },
      },
    ],
    fade: false,
  })
    .container()
    .appendTo($("#addItems_wrapper"));

  $("#add").submit(function (e) {
    e.preventDefault();

    var kodeItemId = $("#kodeItemId").val();
    var namaItem = $("#namaItem").val();
    var brand = $("#brand").val();
    var type = $("#type").val();
    var detail = $("#detail").val();
    var lokasiItem = $("#lokasiItem").val();
    var warehouse = $("#warehouse");
    var tglPembelian = $("#tglPembelian").val();
    var employeId = $("#employeId").val();
    var kondisi = $("#kondisi").val();
    var createBy = $("#createBy").val();
    var status = $("#status").val();

    console.log("statusnys:", status);

    var whText = "";

    // Periksa apakah input warehouse dinonaktifkan atau tidak
    if (!warehouse.is(":disabled")) {
      var selectedWarehouse = warehouse.val();
      if (selectedWarehouse == "1") {
        whText = "SPL 1";
      } else if (selectedWarehouse == "2") {
        whText = "SPL 4";
      } else if (selectedWarehouse == "3") {
        whText = "SPL 3";
      }
    }

    var empText = "";

    // Periksa apakah input employeId dinonaktifkan atau tidak
    if (!$("#employeId").is(":disabled")) {
      var selectedEmployeId = $("#employeId").val();
      // Periksa apakah status adalah "0"
      if (status == "0") {
        empText = ""; // Set empText menjadi string kosong
      } else {
        empText = selectedEmployeId; // Gunakan nilai selectedEmployeId
      }
    }

    var cbText = createBy == "1" ? "PAK ASEP" : "PAK NATA";
    var stText = status == "1" ? "Dipinjam" : "Tersedia";

    var data = {
      kodeItemId: kodeItemId,
      namaItem: namaItem,
      brand: brand,
      type: type,
      detail: detail,
      lokasiItem: lokasiItem,
      warehouse: whText,
      tglPembelian: tglPembelian,
      employeId: empText,
      kondisi: kondisi,
      createBy: cbText,
      status: stText,
    };

    dataArray.push(data);

    // Hapus data dengan kodeItemId yang sama dari array dataArray (jika ada)
    // dataArray = dataArray.filter(function (item) {
    //   return item.kodeItemId !== kodeItemId;
    // });

    $(
      "#kodeItemId, #namaItem, #brand, #type, #detail, #lokasiItem, #tglPembelian, #pic, #kondisi"
    ).val("");

    $("#addItems").show();
    console.log(data);

    table.clear().rows.add(dataArray).draw();
  });
});

// var selectElement = document.getElementById("employeId");

// selectElement.addEventListener("change", function () {
//   var selectedValue = selectElement.value;

//   var selectedText = selectElement.options[selectElement.selectedIndex].text;

//   console.log("Nilai Terpilih: " + selectedValue);
//   console.log("Teks Terpilih: " + selectedText);
// });
