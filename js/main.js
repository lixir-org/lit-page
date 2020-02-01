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
    if (browserWidth < 770) {//hover effect on log details

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
        setInterval(automateSlider, 10000);
        //banner slider
        $(".control").click(function () {
            let active_slide = $(".carousel1 .active");
            let next_slide = active_slide.next();
            let prev_slide = active_slide.prev();

            //left btn control
            if ($(this).hasClass("control--left")) {
                if (init === 0) { $(this).css("display", "none") }
                else {
                    active_slide.css("left", "100%").removeClass("active")
                    prev_slide.addClass("active");
                    init--
                    $(".control--right").css("display", "block")

                }
            }
            //right btn control
            else {
                if (init >= slide_stack - 1) { $(this).css("display", "none") }
                else {
                    active_slide.css("left", "-100%").removeClass("active");
                    next_slide.addClass("active");
                    init++
                    $(".control--left").css("display", "block")
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
        }, 10000);
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

//Added animation
document.body.onscroll = () => {
    if(window.pageYOffset > 100){
   let box = $(".services aside");
   $(box[0]).addClass("animateTop")
   $(box[1]).addClass("animateLeft")
   $(box[2]).addClass("animateRight")
   $(box[3]).addClass("animateTop")
    console.log(window.pageYOffset)
    }
}
