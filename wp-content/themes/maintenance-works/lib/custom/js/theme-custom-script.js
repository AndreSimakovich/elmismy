jQuery(document).ready(function ($) {
    "use strict";
    var isMobile = false;
    if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('html').addClass('touch');
        isMobile = true;
    } else {
        $('html').addClass('no-touch');
        isMobile = false;
    }
    

    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $("#site-content").offset().top
        }, 500);
    });
    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    $('.skip-link-menu-start').focus(function () {
        if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }
    });
    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);
    });
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    $('.skip-link-menu-end').on('focus', function () {
        $('.button-offcanvas-close').focus();
    });
    // Data Background
    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });
    // Scroll to Top on Click
    $('.to-the-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Check if there's a stored active tab in the browser storage
    var storedTab = localStorage.getItem('activeTab');

    // If there's a stored active tab, show that tab
    if (storedTab) {
        showTabContent(storedTab);
    } else {
        // Otherwise, default to the first tab
        showTabContent(1);
    }
});

function showTabContent(tabNumber) {
    // Hide all tab panes
    var tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(function (tabContent) {
        tabContent.style.display = 'none';
    });

    // Show the selected tab pane
    var selectedTabContent = document.getElementById('tab-content-' + tabNumber);
    if (selectedTabContent) {
        selectedTabContent.style.display = 'block';
    }

    // Remove 'active' class from all tab items
    var tabItems = document.querySelectorAll('.tab-header .tab-item');
    tabItems.forEach(function (tabItem) {
        tabItem.classList.remove('active');
    });

    // Add 'active' class to the selected tab item
    var selectedTabItem = document.querySelector('.tab-header .tab-item:nth-child(' + tabNumber + ')');
    if (selectedTabItem) {
        selectedTabItem.classList.add('active');
    }

    // Store the active tab in the browser storage
    localStorage.setItem('activeTab', tabNumber);
}

jQuery(document).ready(function(){
  jQuery( ".Social" ).click(function() {
    jQuery('.media').css( 'display', 'none' );
    jQuery(this).parent().find('.media').css( 'display', 'block' );
  });
});

jQuery(function() {
  jQuery(".toggle-menu").click(function() {
    jQuery(this).toggleClass("active");
    jQuery('.menu-drawer').toggleClass("open");
  });
});

jQuery(document).ready(function(){
    jQuery('a[href="#search"]').on('click', function(event) {                    
        jQuery('#search').addClass('open');
        jQuery('#search > form > input[type="search"]').focus();
    });            
    jQuery('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            jQuery(this).removeClass('open');
        }
    });            
});

//Loader
jQuery(window).load(function() {
    jQuery(".preloader").delay(1000).fadeOut("fast");
  });
  
  //Sticky
  jQuery(window).scroll(function() {
      var data_sticky = jQuery('#site-header').attr('data-sticky');
  
      if (data_sticky == "true") {
        if (jQuery(this).scrollTop() > 1){
          jQuery('.Stickyy').addClass("stick_head");
        } else {
          jQuery('.Stickyy').removeClass("stick_head");
        }
      }
    });

// Second section owl js

jQuery(function(jQuery) {
   var owl = jQuery('.most-read-div .owl-carousel');
        owl.owlCarousel({
            margin: 20,
            nav: false,
            dots:false,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            loop: true,
            navText : ['<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M34.5 239L228.9 44.7c9.4-9.4 24.6-9.4 33.9 0l22.7 22.7c9.4 9.4 9.4 24.5 0 33.9L131.5 256l154 154.8c9.3 9.4 9.3 24.5 0 33.9l-22.7 22.7c-9.4 9.4-24.6 9.4-33.9 0L34.5 273c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>','<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M285.5 273L91.1 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.7-22.7c-9.4-9.4-9.4-24.5 0-33.9L188.5 256 34.5 101.3c-9.3-9.4-9.3-24.5 0-33.9l22.7-22.7c9.4-9.4 24.6-9.4 33.9 0L285.5 239c9.4 9.4 9.4 24.6 0 33.9z"/></svg>'],
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 2
              },
              1020: {
                stagePadding: 250,
                items: 2
              },
              1200: {
                stagePadding: 250,
                items: 3
              }
        }
    })
});

jQuery(function(jQuery) {
   var owl = jQuery('.theme-banner-block .owl-carousel');
        owl.owlCarousel({
            margin: 0,
            nav: false,
            dots:false,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            loop: true,
            navText : ['<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M34.5 239L228.9 44.7c9.4-9.4 24.6-9.4 33.9 0l22.7 22.7c9.4 9.4 9.4 24.5 0 33.9L131.5 256l154 154.8c9.3 9.4 9.3 24.5 0 33.9l-22.7 22.7c-9.4 9.4-24.6 9.4-33.9 0L34.5 273c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>','<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M285.5 273L91.1 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.7-22.7c-9.4-9.4-9.4-24.5 0-33.9L188.5 256 34.5 101.3c-9.3-9.4-9.3-24.5 0-33.9l22.7-22.7c9.4-9.4 24.6-9.4 33.9 0L285.5 239c9.4 9.4 9.4 24.6 0 33.9z"/></svg>'],
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 1
              },
              1020: {
                items: 1
            }
        }
    })
});

jQuery(".main-carousel-caption .entry-title a").html(function () {
    var words = jQuery(this).text().trim().split(/\s+/);

    if (words.length >= 2) {
        words[1] = `<span class="second-word">${words[1]}</span>`;
    }

    return words.join(" ");
});

jQuery(".most-read h3.list-sub-title").html(function () {
    var words = jQuery(this).text().trim().split(/\s+/);

    if (words.length >= 3) {
        var lastThree = words.slice(-3).join(" ");
        var rest = words.slice(0, -3).join(" ");

        return `${rest} <span class="three-word">${lastThree}</span>`;
    }

    return words.join(" ");
});