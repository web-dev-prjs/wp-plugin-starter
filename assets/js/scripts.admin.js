/* jshint esversion:6 */

/*
 |-------------------------------------
 | Created in 2021-08-16
 |-------------------------------------
 */

// Handles switching between tabs.
tab_switcher();

function tab_switcher() {
    jQuery(document).ready(($) => {
        // Store tabs variables.
        const tabs = $("#service_tabs ul.nav-tabs > li");

        // Attaches the click event to every member.
        tabs.each(function (index, member) {
            $(member).click(function (event) {
                event.preventDefault();

                $("#service_tabs ul.nav-tabs > li > a.nav-link.active").removeClass("active");
                $("#service_tabs div.tab-content > div.tab-pane.active").removeClass("active");

                const target = $(event.target);

                target.addClass("active");
                $(target.attr("href")).addClass("active");
            });
        });
    });
}
