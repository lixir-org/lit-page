//Get all buttons and blog post
let read_btn = $(".read_more");
let article_content = $(".article-content");

//Set function on button
article_content.map(value => {
    $(read_btn[value]).on("click", () => {
        let active_post = $(article_content[value]);

        if (parseInt(active_post.css("height")) > 300) {
            $(article_content).css("height", "300px")
            active_post.css("height", "300px")
        }
        else {
            $(article_content).css("height", "300px")
            active_post.css("height", "auto");

        }
    })
})


//Get post article button
let add_post = $(".post-article h3 .control");
let article_form = $(".post-article form")
$(add_post).on("click", () => {
    $(article_form).slideToggle()
    let test = (add_post.hasClass("fa-plus"));
    if (test) {
        add_post.removeClass("fa-plus");
        add_post.addClass("fa-minus");

    } else {
        add_post.removeClass("fa-minus");
        add_post.addClass("fa-plus")
    }
})