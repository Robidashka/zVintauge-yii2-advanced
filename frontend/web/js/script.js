// (function ($) {
//     $(document).ready(function () {
//         $('#cssmenu').prepend('<div id="menu-button">Menu</div>');
//         $('#cssmenu #menu-button').on('click', function () {
//             var menu = $(this).next('ul');
//             if (menu.hasClass('open')) {
//                 menu.removeClass('open');
//             }
//             else {
//                 menu.addClass('open');
//             }
//         });
//     });
// })(jQuery);

// let slideIndex = 1;
// showSlides(slideIndex);

// function nextSlide() {
//     showSlides(slideIndex += 1);
// }

// function previousSlide() {
//     showSlides(slideIndex -= 1);
// }

// function currentSlide(n) {
//     showSlides(slideIndex = n);
// }

// function showSlides(n) {
//     let slides = document.getElementsByClassName("item");

//     if (n > slides.length) {
//       slideIndex = 1
//     }
//     if (n < 1) {
//         slideIndex = slides.length
//     }

//     for (let slide of slides) {
//         slide.style.display = "none";
//     }
//     slides[slideIndex - 1].style.display = "block";
// }

// $(".subscribe-form").submit(function(e) {
$(document).on('click', '#subscription', function (e) {
    e.preventDefault();

    var sub = $('.subscribe-email').val();
    // var url = $(this).attr('/action/subscription');

    console.log(sub);


    $.post(
        "/article/subscription", {
        email: sub,
        agree: true,
    }, function (data) {
        console.log(data);
    });
    // $.ajax({
    //     url: '/article/subscription',
    //     type: 'post',
    //     dataType: 'json',
    //     data: {
    //         email: sub
    //     },
    // }).done(function (response) {
    //         if (response.data.success == true) {
    //             e.target.reset();
    //             $("#modalC").load(window.location.href + " #modalC");
    //         }
    //     })
})

$(document).on('click','#comment-btn',function (e) {
    e.preventDefault(); // stopping submitting
    let formComment = $('.contact-form').find("#commentform-comment").val();
    let id = $(this).data('article-id');
    // var data = form.serializeArray();
    // var url = $(this).attr('action'); 

    $.post(
        "/article/comment", {
            formComment:formComment,
            id:id
    }, function (data) {
        $.pjax.reload('#pjax-comment-show');
    });

    // $.ajax({
    //     url: "/article/comment",
    //     type: 'post',
    //     dataType: 'json',
    //     data: {
    //         formComment:formComment,
    //         id:id
    //     }
    // })
    // .done(function(response) {
    //     if (response.data.success == true) {
    //         $.pjax.reload({container: "#pjax-comment-show", timeout: false});
    //         $.pjax.reload('#pjax-comment-show');
    //     }
    // })
    // .fail(function() {
    //     console.log("error");
    // });
});
