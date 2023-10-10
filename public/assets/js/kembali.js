function loadEmployee() {
  if ($("#employee").find("option").length === 1) {
    $("#employee").empty().append("<option>select</option>");
    $.ajax({
      url: "/dashboard/loadEmployee",
      dataType: "json",
      type: "POST",
      data: { employee: selectedValue },
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

loadEmployee();

$(document).ready(function () {
  $(document).ready(function () {
    // Inisialisasi DataTables dengan konfigurasi awal
    var itemTable = $("#itemTable").DataTable({
      columns: [
        { data: "kodeItemId" },
        { data: "namaItem" },
        { data: "brand" },
        { data: "type" },
        { data: "detail" },
        { data: "lokasiItem" },
        { data: "warehouse" },
        { data: "tglPembelian" },
        { data: "employeId" },
        { data: "kondisi" },
        { data: "createBy" },
        // { data: "status" },
      ],
      order: [[1, "asc"]],
      rowId: "kodeItemId",
      stateSave: true,
      responsive: true,
      retrieve: true,
      scroller: true,
      searching: false,
      paging: false,
      select: true,
      info: false,
      autoWidth: false,
    });

    // Event handler untuk ketika tombol "Submit" ditekan
    $("#kembalikan").on("submit", function (e) {
      e.preventDefault(); // Mencegah pengiriman formulir

      // Cek apakah ada baris yang dipilih dalam tabel
      var selectedRows = itemTable.rows({ selected: true }).data();

      if (selectedRows.length > 0) {
        // Mengumpulkan kode item dari baris-baris yang dipilih
        var kodeItemArray = selectedRows.toArray().map(function (row) {
          return row.kodeItemId;
        });

        // Mengirim data ke controller melalui permintaan AJAX
        $.ajax({
          url: "/dashboard/returnItem", // Ganti dengan URL yang sesuai
          type: "POST",
          dataType: "json",
          data: { kodeItems: kodeItemArray },
          success: function (response) {
            if (response.success) {
              alert("Asset terpilih berhasil dikembalikan.");
              location.reload(true);
            } else {
              alert("Terjadi kesalahan saat memproses asset terpilih.");
            }
          },
          error: function () {
            alert("Terjadi kesalahan saat mengirim permintaan.");
          },
        });
      } else {
        // Tampilkan pesan alert jika tidak ada baris yang dipilih
        alert("Pilih setidaknya satu baris dalam tabel sebelum mengirim.");
      }
    });

    // Event handler untuk ketika employe dipilih
    $("#namaBorrower").on("change", function () {
      var selectedValue = $(this).val();

      if (selectedValue) {
        // Perform an AJAX request to get available kode items for the selected employe
        $.ajax({
          url: "/dashboard/getEmployeKode", // Ganti dengan URL yang sesuai
          type: "POST",
          dataType: "json",
          data: { employeId: selectedValue },
          success: function (response) {
            if (response.success) {
              //   $("#itemTable").show();
              $("#submitBtn").prop("disabled", false);
              // Kosongkan DataTables dan isi dengan data baru dari response.items
              itemTable.clear().rows.add(response.items).draw();
            } else {
              console.log("No kode items found for the selected employe.");
              // Kosongkan DataTables jika tidak ada data
              itemTable.clear().draw();
            }
          },
          error: function () {
            console.log("An error occurred while fetching kode items.");
          },
        });
      } else {
        // Clear DataTables jika employe tidak dipilih
        itemTable.clear().draw();
      }
    });
  });
});
