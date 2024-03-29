// Jquery Dependency
var minDate, maxDate;

// Create date inputs
minDate = new DateTime($("#start"), {
    format: "YYYY-MM-DD",
});
maxDate = new DateTime($("#end"), {
    format: "YYYY-MM-DD",
});

$("input[data-type='currency']").on({
    keyup: function () {
        formatCurrency($(this));
    },
    blur: function () {
        formatCurrency($(this), "blur");
    },
});

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
        return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    input_val = formatNumber(input_val);
    input_val = input_val;

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function senderDataModal(id, desc, module, action) {
    $("#modalDeleteForm").attr("action", action);
    $("#idModalDelete").val(id);
    $("#smModalDeleteTitle").html(
        action.includes("hapus")
            ? "Apakah Yakin Akan Menghapus Data " + module + " " + desc + "?"
            : desc + "?"
    );
}
$(".datetimepicker").each(function () {
    $(this).datetimepicker({
        format: "Y-m-d H:i:s",
        stepping: 1,
        forceMinuteStep: true,
        defaultDate: false,
    });
});
