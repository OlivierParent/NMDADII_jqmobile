$(document).delegate("body", "pageinit, pageshow", function() {
    $("#timeslots").selectmenu("disable");
    $(document).on("change", "#day", function () {
        $("#timeslots").val([])               // Verwijder alle geslecteerde option-elementen.
                      .selectmenu("refresh") // Bouw het jQM-versie van het select-element opnieuw op.
        ;
        if ($("#day").val() !== null) {
            $("#timeslots").selectmenu("enable");
        }
    });
    $(document).on("change", "#day, #timeslots", function () {
        $("#timeslots option").each(function (index) {
            if ($(this).attr("data-day") === $("#day").val()) {
                $("#timeslots-menu li[data-option-index=" + index + "]").removeClass("ui-screen-hidden");
            } else {
                $("#timeslots-menu li[data-option-index=" + index + "]").addClass("ui-screen-hidden");
                $(this).removeAttr("selected");
            }
        });

    });
});