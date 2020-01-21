//hover effect on log details

$(".log_details_container h4").on("mouseenter", function () {
    $(this).next().css("height", "30px")
})

$(".log_details_container h4").on("mouseleave", function () {
    $(this).next().css("height", "0")
})

let init = 0;
let slide_stack = $(".carousel1_slide").length;

function automateSlider() {
    let browserWidth = document.body.clientWidth;
    if (browserWidth < 770) {
        return
    }
    else {
        if (init >= slide_stack - 1) {
            return
        }
        else {
            let active_slide = $(".carousel1 .active");
            let next_slide = active_slide.next();
            active_slide.css("left", "-100%").removeClass("active");
            next_slide.addClass("active");
            init++
        }
    }
}
setInterval(automateSlider, 10000);
//banner slider
$(".control").click(function () {
    let active_slide = $(".carousel1 .active");
    let next_slide = active_slide.next();
    let prev_slide = active_slide.prev();

    //left btn control
    if ($(this).hasClass("control--left")) {
        if (init === 0) { }
        else {
            active_slide.css("left", "100%").removeClass("active")
            prev_slide.addClass("active");
            init--
        }
    }
    //right btn control
    else {
        if (init >= slide_stack - 1) { }
        else {
            active_slide.css("left", "-100%").removeClass("active");
            next_slide.addClass("active");
            init++
        }
    }
})

// console.log(($(".team-carousel")[0]).scrollWidth)
$(".controlT").click(function () {
    let obj = $(".team-carousel")[0];
    if ($(this).hasClass("control_left")) {
        obj.scrollLeft -= 200;
    }
    else {
        obj.scrollLeft += 200;
    }
})

setInterval(() => {
    let obj = $(".team-carousel")[0];
    obj.scrollLeft += 300;
    console.log(obj.offsetWidth)
}, 10000);