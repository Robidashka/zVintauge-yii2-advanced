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

$(document).on('click', '#subscription', function (e) {
    e.preventDefault();

    var sub = $('.subscribe-email').val();

    $.post(
        "/article/subscription", {
        email: sub,
        agree: true,
    }, function (data) {
        $('#success_modal').html(data);
        console.log(data);
    });
})

$(document).on('click','#comment-btn', function (e) {
    e.preventDefault();

    let formComment = $('.contact-form').find("#commentform-comment").val();
    let id = $(this).data('article-id');

    $.post(
        "/article/comment", {
            formComment:formComment,
            id:id
    }, function (data) {
        $('.clear_session').html('');
        $('#comments').append(data);
        $('#contact-form').trigger("reset");
    });
});
