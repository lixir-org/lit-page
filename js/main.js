//hover effect on log details

$(".log_details_container h4").on("mouseenter", function () {
    $(this).next().css("height", "30px")
})

$(".log_details_container h4").on("mouseleave", function () {
    $(this).next().css("height", "0")
})




//Slider config
let init = 0;
let slides = document.getElementsByClassName("carousel1_slide");
let clone1 = $([...slides]).clone(true);
let clone2 = $([...slides]).clone(true);
($(clone1[0]).removeClass("active"));
($(clone2[0]).removeClass("active"));
$(clone1).appendTo(".carousel1");
$(clone2).appendTo(".carousel1");
let slide_stack = $(".carousel1_slide").length;

function automateSlider() {
    let browserWidth = document.body.clientWidth;
    if (browserWidth < 600) {
        return
    }
    else {
        if (init >= slide_stack - 1) {
            $(".control--right").css("display", "none")
            return
        }
        else {
            $(".control--left").css("display", "block")
            let active_slide = $(".carousel1 .active");
            let next_slide = active_slide.next();
            active_slide.css("left", "-100%").removeClass("active");
            next_slide.addClass("active");
            init++
        }
    }
}


setInterval(automateSlider, 5000);


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
            $(".control--right").css("display", "block")

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


// Control on team slider
$(".controlT").click(function () {
    let obj = $(".team-carousel")[0];
    if ($(this).hasClass("control_left")) {
        obj.scrollLeft -= 300;
    }
    else {
        obj.scrollLeft += 300;
    }
})


//Auto slide on team container
setInterval(() => {
    let obj = $(".team-carousel")[0];
    obj.scrollLeft += 300;
}, 10000);

//Added animation
document.body.onscroll = () => {
    if (window.pageYOffset > 100) {
        let box = $(".services aside");
        $(box[0]).addClass("animateTop")
        $(box[1]).addClass("animateLeft")
        $(box[2]).addClass("animateRight")
        $(box[3]).addClass("animateTop")
    }
}
