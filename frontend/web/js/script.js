(function ($) {
    $(document).ready(function () {
        $('#cssmenu').prepend('<div id="menu-button">Menu</div>');
        $('#cssmenu #menu-button').on('click', function () {
            var menu = $(this).next('ul');
            if (menu.hasClass('open')) {
                menu.removeClass('open');
            }
            else {
                menu.addClass('open');
            }
        });
    });
})(jQuery);

let slideIndex = 1;
showSlides(slideIndex);

function nextSlide() {
    showSlides(slideIndex += 1);
}

function previousSlide() {
    showSlides(slideIndex -= 1);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let slides = document.getElementsByClassName("item");

    if (n > slides.length) {
      slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }

    for (let slide of slides) {
        slide.style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}


$(document).on('click', '#subscription', function (e) {
    e.preventDefault(0);

    var data = $(this).serializeArray();
    var url = $(this).attr('action/subscription'); 

    console.log(data);

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
    })

    .done(function(response) {
        if (response.data.success == true) {
            e.target.reset();
            $( "#modalC" ).load(window.location.href + " #modalC" );
        }
    })
})