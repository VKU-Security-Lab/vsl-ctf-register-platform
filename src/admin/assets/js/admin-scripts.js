$(document).ready(function () {
  // Initialize DataTable with Buttons
  var table = $("#teams-table").DataTable({
    order: [[1, "asc"]], // Default sort by ID ascending
    columnDefs: [
      { orderable: false, targets: [0, 7] }, // Disable ordering on checkbox and actions
    ],
    dom: "Bfrtip",
    buttons: [
      {
        extend: "csvHtml5",
        text: '<i class="fas fa-file-csv me-1"></i> Export CSV',
        className: "btn btn-success btn-sm me-2",
      },
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel me-1"></i> Export Excel',
        className: "btn btn-success btn-sm me-2",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fas fa-file-pdf me-1"></i> Export PDF',
        className: "btn btn-success btn-sm me-2",
        orientation: "landscape",
        pageSize: "A4",
      },
    ],
    language: {
      emptyTable: "Không có dữ liệu.",
    },
  });

  // Handle "Select All" checkbox
  $("#select-all").on("click", function () {
    var rows = table.rows({ search: "applied" }).nodes();
    $('input[type="checkbox"]', rows).prop("checked", this.checked);
    toggleBulkDeleteButton();
  });

  // Handle individual checkbox click
  $("#teams-table tbody").on("change", 'input[type="checkbox"]', function () {
    if (!this.checked) {
      var el = $("#select-all").get(0);
      if (el && el.checked && "indeterminate" in el) {
        el.indeterminate = true;
      }
    }
    toggleBulkDeleteButton();
  });

  // Function to toggle bulk delete button
  function toggleBulkDeleteButton() {
    var anyChecked = $("input.team-checkbox:checked").length > 0;
    $("#bulk-delete-btn").prop("disabled", !anyChecked);
  }

  // Handle bulk delete button click
  $("#bulk-delete-btn").on("click", function () {
    var selectedTeams = [];
    $("input.team-checkbox:checked").each(function () {
      selectedTeams.push($(this).val());
    });

    if (selectedTeams.length === 0) {
      alert("Vui lòng chọn ít nhất một đội để xoá.");
      return;
    }

    if (!confirm("Bạn có chắc chắn muốn xoá các đội đã chọn?")) {
      return;
    }

    // Gửi yêu cầu xoá bằng AJAX
    $.ajax({
      url: "delete-teams.php",
      type: "POST",
      data: {
        team_ids: selectedTeams,
        csrf_token: $('input[name="csrf_token"]').val(),
      },
      success: function (response) {
        if (response.success) {
          // Hiển thị thông báo thành công
          alert(response.message);
          // Xoá các hàng đã chọn khỏi DataTable
          selectedTeams.forEach(function (id) {
            table
              .row($('input.team-checkbox[value="' + id + '"]').parents("tr"))
              .remove()
              .draw();
          });
          // Reset "Select All" checkbox
          $("#select-all").prop("checked", false);
          toggleBulkDeleteButton();
        } else {
          // Hiển thị thông báo lỗi
          alert(response.message);
        }
      },
      error: function () {
        alert("Đã xảy ra lỗi khi xử lý yêu cầu. Vui lòng thử lại sau.");
      },
    });
  });
  $(document).ready(function () {
    $("#individuals-table").DataTable({
      order: [[0, "asc"]],
      language: {
        emptyTable: "Không có dữ liệu.",
      },
    });
  });
  $(".view-individual-btn").on("click", function (e) {
    e.preventDefault();
    var individualId = $(this).data("id");

    // Mở modal
    $("#viewIndividualModal").modal("show");

    // Hiển thị thông báo đang tải
    $("#individual-details").html("<p>Đang tải...</p>");

    // Tải chi tiết user qua AJAX
    $.ajax({
      url: "view-individual.php",
      type: "GET",
      data: { id: individualId },
      success: function (response) {
        if (response.success) {
          $("#individual-details").html(response.html);
        } else {
          $("#individual-details").html(
            '<p class="text-danger">' + response.message + "</p>"
          );
        }
      },
      error: function () {
        $("#individual-details").html(
          '<p class="text-danger">Đã xảy ra lỗi khi tải dữ liệu.</p>'
        );
      },
    });
  });
  // Handle View Team Details
  $(".view-team-btn").on("click", function (e) {
    e.preventDefault();
    var teamId = $(this).data("id");

    // Open the modal
    $("#viewTeamModal").modal("show");

    // Load team details via AJAX
    $.ajax({
      url: "view-team-details.php",
      type: "GET",
      data: { id: teamId },
      success: function (response) {
        if (response.success) {
          $("#team-details").html(response.html);
        } else {
          $("#team-details").html(
            '<p class="text-danger">' + response.message + "</p>"
          );
        }
      },
      error: function () {
        $("#team-details").html(
          '<p class="text-danger">Đã xảy ra lỗi khi tải dữ liệu.</p>'
        );
      },
    });
  });
});
