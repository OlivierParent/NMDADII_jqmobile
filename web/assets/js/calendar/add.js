(function ($) {
    "use strict";
    $(document)
        .on("pageinit, pageshow", "body", function () {
            validateBeforeSubmit();
            if ($("#day").val() === "") {
                $("#timeslots").selectmenu("disable");
            }
            $(document)
                .on("change", "#day", function () {
                    $("#timeslots").val([])               // Verwijder alle geslecteerde option-elementen.
                                   .selectmenu("refresh") // Bouw de jQM-versie van het select-element opnieuw op.
                    ;
                    if ($("#day").val() !== null) {
                        $("#timeslots").selectmenu("enable");
                    }
                })
                .on("change", "#day, #timeslots", function () {
                    $("#timeslots option").each(function (index) {
                        if ($(this).attr("data-day") === $("#day").val()) {
                            $("#timeslots-menu li[data-option-index=" + index + "]").removeClass("ui-screen-hidden");
                        } else {
                            $("#timeslots-menu li[data-option-index=" + index + "]").addClass("ui-screen-hidden");
                            $(this).removeAttr("selected");
                        }
                    });

                })
                .on("change", "#course, #day, #timeslots, #room, #lecturers", function () {
                    validateBeforeSubmit();
                })
            ;
        })
    ;

    function validateBeforeSubmit() {
        if ($("#course")   .val() !== "" &&
            $("#timeslots").val() !== null &&
            $("#room")     .val() !== "" &&
            $("#lecturers").val() !== null
        ) {
            $("input[type=submit]").button("enable");
        } else {
            $("input[type=submit]").button("disable");
        }
    }
})(jQuery);