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
loadEmployee();

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

  const maset = $("#maset").DataTable({
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
    select: false,
    paging: true,
    scrollCollapse: true,
    searching: false,
    info: true,
    autoWidth: true,
  });
  maset.on("requestChild.dt", function (e, row) {
    row.child(format(row.data())).show();
  });

  maset.on("click", "td.dt-control", function (e) {
    let tr = e.target.closest("tr");
    let row = maset.row(tr);

    if (row.child.isShown()) {
      row.child.hide();
    } else {
      row.child(format(row.data())).show();
    }
  });

  // Inisialisasi elemen select2
  $("#kodeItemId").select2({
    theme: "bootstrap-5",
    placeholder: "Choose items",
    width: $(this).data("width")
      ? $(this).data("width")
      : $(this).hasClass("w-100")
      ? "100%"
      : "style",
    closeOnSelect: false,
    allowClear: true,
    language: {
      noResults: function () {
        return "Code Item Not Found"; // Ganti dengan teks kustom yang Anda inginkan
      },
    },
  });

  var list;

  $("#kodeItemId").on("change", function () {
    var selectedCodeItem = $(this).val();

    var table = $("#items")
      .show()
      .DataTable({
        data: null,
        columns: [
          { data: "kodeItemId" },
          { data: "namaItem" },
          { data: "brand" },
          { data: "type" },
          { data: "detail" },
          // { data: "lokasiItem" },
          // { data: "warehouse" },
          { data: "tglPembelian" },
          // { data: "employeId" },
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

    function removeDataFromTable(kodeItemId) {
      var rowId = table.row("#" + kodeItemId).index();
      if (rowId >= 0) {
        table.row(rowId).remove().draw(false);
      }
    }

    $("#kodeItemId").on("select2:unselect", function (e) {
      $("#namaItem").val("");
      var unselectedId = e.params.data.id;
      removeDataFromTable(unselectedId);
    });

    $.ajax({
      url: "/dashboard/getKode",
      method: "POST",
      data: { kodeItemId: selectedCodeItem },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#namaItem").val(response.item);
          // console.log(response.items);
          var newData = response.items;
          table.clear().rows.add(newData).draw();
        } else {
          $("#namaItemDisplay").text("Item not found");
          console.log(list);
          list = "";
        }
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
      },
    });
  });

  $("#pinjam").submit(function (e) {
    e.preventDefault(); // Mencegah formulir dikirim secara default

    // Memeriksa apakah semua data yang diperlukan telah diisi
    var employe = $("#namaBorrower").val();
    var kodeItemId = $("#kodeItemId").val();
    var borrowDate = $("#tglPeminjaman").val();
    var lokasiItem = $("#lokasiItem").val();
    var desc = $("#description").val();
    var warehouse = $("#warehouse").val();

    if (!employe || !kodeItemId || !borrowDate || !desc || !warehouse) {
      console.error("Silakan isi semua data yang diperlukan.");
      return;
    }

    var formData = {
      employe: $("#namaBorrower").val(),
      kodeItemId: $("#kodeItemId").val(),
      tglPeminjaman: $("#tglPeminjaman").val(),
      lokasiItem: $("#lokasiItem").val(),
      desc: $("#description").val(),
      warehouse: $("#warehouse").val(),
      // Tambahkan data lainnya dari formulir sesuai kebutuhan
    };

    $.ajax({
      type: "POST",
      url: "/dashboard/Pinjamitem",
      data: formData,
      success: function (response) {
        // Handle respons dari server (jika diperlukan)
        // console.log("Sukses:", response);
        // console.log(formData);
        var hasil = window.confirm("Pinjam Item Berhasil");
        // if (hasil) {
        //   location.reload(true);
        // } else {
        //   alert("kembali ke measter asset");
        window.location.href = "/dashboard/master/maset";
        // }
      },
      error: function (xhr, status, error) {
        // Handle kesalahan (jika diperlukan)
        console.error("Kesalahan:", xhr);
      },
    });
  });
});
