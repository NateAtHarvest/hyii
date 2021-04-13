/*
|--------------------------------------------------------------------------
| Imports
|--------------------------------------------------------------------------|
*/

// lazyload Images - https://github.com/aFarkas/lazysizes
import "lazysizes";
import "lazysizes/plugins/unveilhooks/ls.unveilhooks";

/*
|--------------------------------------------------------------------------
| Import Foundation
|--------------------------------------------------------------------------|
|
| Requires jQuery.
| To import all of Foundation use ... import Foundation from 'foundation-sites';
|
*/

import $ from "jquery";
window.$ = window.jQuery = $;

import { CoreUtils } from "foundation-sites";
//import { Abide } from 'foundation-sites';
import { Accordion } from "foundation-sites";
import { AccordionMenu } from "foundation-sites";
//import { Drilldown } from 'foundation-sites';
import { Dropdown } from "foundation-sites";
import { DropdownMenu } from "foundation-sites";
//import { Equalizer } from 'foundation-sites';
//import { Interchange } from 'foundation-sites';
//import { Magellan } from 'foundation-sites';
import { OffCanvas } from "foundation-sites";
//import { Orbit } from 'foundation-sites';
import { ResponsiveMenu } from "foundation-sites";
//import { ResponsiveToggle } from 'foundation-sites';
//import { Reveal } from 'foundation-sites';
//import { Slider } from 'foundation-sites';
//import { SmoothScroll } from 'foundation-sites';
//import { Sticky } from 'foundation-sites';
//import { Tabs } from 'foundation-sites';
//import { Toggler } from 'foundation-sites';
//import { Tooltip } from 'foundation-sites';
//import { ResponsiveAccordionTabs } from 'foundation-sites';

/*
|--------------------------------------------------------------------------
| Initialize Foundation Plugins
|--------------------------------------------------------------------------|
|
*/
//Foundation.Tooltip.defaults.hoverDelay = 500;
//Foundation.Tooltip.defaults.showOn = "large";
$(document).foundation();

/*
|--------------------------------------------------------------------------
| Cacheable forms - with CSRF protection
|--------------------------------------------------------------------------|
|
*/
if ($("input[name='CRAFT_CSRF_TOKEN']").length > 0) {
    $(() => {
        $.ajax({
            url: "/get-token",
            success: response => {
                $("input[name='CRAFT_CSRF_TOKEN']").val(response);
            }
        });
    });
}

/*
|--------------------------------------------------------------------------
| Magnific Popup
|--------------------------------------------------------------------------|
|
*/
/*
require("magnific-popup");
$(".jsGallery").each(function() {
  // the containers for all your galleries
  $(this).magnificPopup({
    delegate: "a.jsGalleryItem", // the selector for gallery item
    type: "image",
    gallery: {
      enabled: true
    }
  });
});
*/

/*
|--------------------------------------------------------------------------
| Click to go to a link - avoids redundant links (duplicate neighboring links) which are an accessability warning
|--------------------------------------------------------------------------|
|
*/
$(".jsClickForHref")
    .css("cursor", "pointer")
    .on("click", function(evt) {
        var $this = $(this);
        var href = $this.attr("data-href");
        if (href) {
            window.location = href;
        }
    });
