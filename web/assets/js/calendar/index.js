(function ($) {
    "use strict";
    $(document)
        .on("pageinit, pageshow", "body", function () {
            $("#this-week").find("li>a:last-of-type").on("click", function () {
                var listitem = $(this).parent("li");
                $.ajax({
                    url: "service/schedule/student/" + listitem.attr("data-student-id") + "/timeslot/" + listitem.attr("data-timeslot-id"),
                    type: "DELETE",
                    statusCode: {
                       200: function () {
                           listitem.hide();
                       }
                    }
                });
            });
        }
    );
})(jQuery);