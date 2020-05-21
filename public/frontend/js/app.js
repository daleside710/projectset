(function ($) {
    "use strict";

    $.fn.SocialCounter = function (options) {
        var settings = $.extend(
            {
                // These are the defaults.
                facebook_user: "",
                facebook_token: "",
                instagram_user: "",
                instagram_user_sandbox: "",
                instagram_token: ""
            },
            options
        );

        function facebook() {
            //Facebook API
            //60 Day Access Token - Regenerate a new one after two months
            //https://smashballoon.com/custom-facebook-feed/access-token/
            $.ajax({
                url: "https://graph.facebook.com/v2.8/" + settings.facebook_user,
                dataType: "json",
                type: "GET",
                data: {
                    access_token: settings.facebook_token,
                    fields: "fan_count"
                },
                success: function (data) {
                    var followers = parseInt(data.fan_count);
                    var k = kFormatter(followers);
                    $(".btn-social-counter--fb .btn-social-counter__count-num").append(k);
                }
            });
            $(".btn-social-counter--fb").attr(
                "href",
                "https://facebook.com/" + settings.facebook_user
            );
        }

        function instagram() {
            //Create access tokens
            //https://www.youtube.com/watch?v=LkuJtIcXR68
            //http://instagram.pixelunion.net
            //http://dmolsen.com/2013/04/05/generating-access-tokens-for-instagram
            //http://ka.lpe.sh/2015/12/24/this-request-requires-scope-public_content-but-this-access-token-is-not-authorized-with-this-scope/
            $.ajax({
                url: "https://api.instagram.com/v1/users/self/",
                dataType: "jsonp",
                type: "GET",
                data: {
                    access_token: settings.instagram_token
                },
                success: function (data) {
                    var followers = parseInt(data.data.counts.followed_by);
                    var k = kFormatter(followers);
                    $(
                        ".btn-social-counter--instagram .btn-social-counter__count-num"
                    ).append(k);
                }
            });
            $(".btn-social-counter--instagram").attr(
                "href",
                "https://instagram.com/" + settings.instagram_user
            );
        }

        //Function to add commas to the thousandths
        $.fn.digits = function () {
            return this.each(function () {
                $(this).text(
                    $(this)
                        .text()
                        .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                );
            });
        };

        //Function to add K to thousands
        function kFormatter(num) {
            return num > 999 ? (num / 1000).toFixed(1) + "k" : num;
        }

        //Call Functions
        if (settings.facebook_user != "" && settings.facebook_token != "") {
            facebook();
        }
        if (settings.instagram_user != "" && settings.instagram_token != "") {
            instagram();
        }
        if (settings.twitter_user != "") {
            twitter();
        }
    };

    $.fn.exists = function () {
        return this.length > 0;
    };

    /* ----------------------------------------------------------- */
    /*  Predefined Variables
    /* ----------------------------------------------------------- */
    var $main_nav = $(".main-nav");
    var $marquee = $(".marquee");
    var $insta_feed = $("#instagram-feed");
    var $social_counters = $(".widget-social");

    var Core = {
        initialize: function () {
            this.UrlHashMonitor();

            this.TelInput();

            this.SvgPolyfill();

            this.headerNav();

            this.countDown();

            this.InstagramFeed();

            this.SocialCounters();

            this.miscScripts();
        },

        UrlHashMonitor: function () {
            var UrlHashMonitor = {};
            UrlHashMonitor.oldHash = "";
            UrlHashMonitor.newHash = "";
            UrlHashMonitor.oldHref = "";
            UrlHashMonitor.newHref = "";

            UrlHashMonitor.onHashChange = function (f) {
                $(window).on("hashchange", function (e) {
                    UrlHashMonitor.oldHash = UrlHashMonitor.newHash;
                    UrlHashMonitor.newHash = window.location.hash;
                    UrlHashMonitor.oldHref = UrlHashMonitor.newHref;
                    UrlHashMonitor.newHref = window.location.href;
                    f(e);
                });
            };

            UrlHashMonitor.init = function () {
                UrlHashMonitor.oldHash = UrlHashMonitor.newHash = window.location.hash;
                UrlHashMonitor.oldHref = UrlHashMonitor.newHref = window.location.href;
            };

            window.UrlHashMonitor = UrlHashMonitor;
            //return UrlHashMonitor;
        },

        TelInput: function () {
            // TelInput element one
            var telInput = $('#phone_one');

            telInput.intlTelInput({
                formatOnDisplay: true,
                nationalMode: false,
                customContainer: 'd-flex',
                autoPlaceholder: 'aggressive',
                separateDialCode: true,
                preferredCountries: ['NO', 'SE', 'DK'],
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/utils.js'
            });

            if (typeof selectedCountry === 'undefined') {
                telInput.intlTelInput('setCountry', 'no');
            }

            telInput.on("keyup change", resetIntlTelInput);

            function resetIntlTelInput() {
                var selectedCountry = telInput.intlTelInput('getSelectedCountryData').iso2,
                    targetCountry = ['no', 'se', 'dk'];

                switch (selectedCountry) {
                    case targetCountry[0]:
                        if (telInput.intlTelInput('getNumberType') == 0) telInput.attr({ maxLength: 11 });
                        if (telInput.intlTelInput('getNumberType') == 1) telInput.attr({ maxLength: 10 });
                        break;
                    case targetCountry[1]:
                        if (telInput.intlTelInput('getNumberType') == 0) telInput.attr({ maxLength: 10 });
                        if (telInput.intlTelInput('getNumberType') == 1) telInput.attr({ maxLength: 9 });
                        break;
                    case targetCountry[2]:
                        if (telInput.intlTelInput('getNumberType') == 0) telInput.attr({ maxLength: 11 });
                        if (telInput.intlTelInput('getNumberType') == 1) telInput.attr({ maxLength: 10 });
                        break;
                    default:
                        if (telInput.intlTelInput('getNumberType') == 0) telInput.attr({ maxLength: 11 });
                        if (telInput.intlTelInput('getNumberType') == 1) telInput.attr({ maxLength: 10 });
                }

                if (typeof intlTelInputUtils !== 'undefined') {
                    var currentText = telInput.intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
                    if (typeof currentText === 'string') {
                        telInput.intlTelInput('setNumber', currentText);
                    }
                }
            }

            // TelInput element two
            var telInputTwo = $('#phone_two');

            telInputTwo.intlTelInput({
                formatOnDisplay: true,
                nationalMode: false,
                customContainer: 'd-flex',
                autoPlaceholder: 'aggressive',
                separateDialCode: true,
                preferredCountries: ['NO', 'SE', 'DK'],
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/utils.js'
            });

            if (typeof selectedCountryTwo === 'undefined') {
                telInputTwo.intlTelInput('setCountry', 'no');
            }

            telInputTwo.on("keyup change", resetIntlTelInputTwo);

            function resetIntlTelInputTwo() {
                var selectedCountryTwo = telInputTwo.intlTelInput('getSelectedCountryData').iso2,
                    targetCountryTwo = ['no', 'se', 'dk'];

                switch (selectedCountryTwo) {
                    case targetCountryTwo[0]:
                        if (telInputTwo.intlTelInput('getNumberType') == 0) telInputTwo.attr({ maxLength: 11 });
                        if (telInputTwo.intlTelInput('getNumberType') == 1) telInputTwo.attr({ maxLength: 10 });
                        break;
                    case targetCountryTwo[1]:
                        if (telInputTwo.intlTelInput('getNumberType') == 0) telInputTwo.attr({ maxLength: 10 });
                        if (telInputTwo.intlTelInput('getNumberType') == 1) telInputTwo.attr({ maxLength: 9 });
                        break;
                    case targetCountryTwo[2]:
                        if (telInputTwo.intlTelInput('getNumberType') == 0) telInputTwo.attr({ maxLength: 11 });
                        if (telInputTwo.intlTelInput('getNumberType') == 1) telInputTwo.attr({ maxLength: 10 });
                        break;
                }

                if (typeof intlTelInputUtils !== 'undefined') {
                    var currentTextTwo = telInputTwo.intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
                    if (typeof currentText === 'string') {
                        telInputTwo.intlTelInput('setNumber', currentTextTwo);
                    }
                }
            }

            // TelInput element three
            var telInputThree = $('#phone_three');

            telInputThree.intlTelInput({
                formatOnDisplay: true,
                nationalMode: false,
                customContainer: 'd-flex',
                autoPlaceholder: 'aggressive',
                separateDialCode: true,
                preferredCountries: ['NO', 'SE', 'DK'],
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/utils.js'
            });

            if (typeof selectedCountryThree === 'undefined') {
                telInputThree.intlTelInput('setCountry', 'no');
            }

            telInputThree.on("keyup change", resetIntlTelInputThree);

            function resetIntlTelInputThree() {
                var selectedCountryThree = telInputThree.intlTelInput('getSelectedCountryData').iso2,
                    targetCountryThree = ['no', 'se', 'dk'];

                switch (selectedCountryThree) {
                    case targetCountryThree[0]:
                        if (telInputThree.intlTelInput('getNumberType') == 0) telInputThree.attr({ maxLength: 11 });
                        if (telInputThree.intlTelInput('getNumberType') == 1) telInputThree.attr({ maxLength: 10 });
                        break;
                    case targetCountryThree[1]:
                        if (telInputThree.intlTelInput('getNumberType') == 0) telInputThree.attr({ maxLength: 10 });
                        if (telInputThree.intlTelInput('getNumberType') == 1) telInputThree.attr({ maxLength: 9 });
                        break;
                    case targetCountryThree[2]:
                        if (telInputThree.intlTelInput('getNumberType') == 0) telInputThree.attr({ maxLength: 11 });
                        if (telInputThree.intlTelInput('getNumberType') == 1) telInputThree.attr({ maxLength: 10 });
                        break;
                }

                if (typeof intlTelInputUtils !== 'undefined') {
                    var currentTextThree = telInputThree.intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
                    if (typeof currentText === 'string') {
                        telInputThree.intlTelInput('setNumber', currentTextThree);
                    }
                }
            }
        },

        SvgPolyfill: function () {
            svg4everybody();
        },

        headerNav: function () {
            if ($main_nav.exists()) {
                var $top_nav = $(".nav-account");
                var $top_nav_li = $(".nav-account > li");
                var $social = $(".social-links--main-nav");
                var $info_nav_li = $(".info-block--header > li");
                var $wrapper = $(".site-wrapper");
                var $nav_list = $(".main-nav__list");
                var $nav_list_li = $(".main-nav__list > li");
                var $toggle_btn = $("#header-mobile__toggle");
                var $pushy_btn = $(".pushy-panel__toggle");

                // Clone Search Form
                var $header_search_form = $(".header-search-form").clone();
                $("#header-mobile").append($header_search_form);

                // Clone Shopping Cart to Mobile Menu
                var $shop_cart = $(
                    ".info-block__item--shopping-cart > .info-block__link-wrapper"
                ).clone();
                $shop_cart
                    .appendTo($nav_list)
                    .wrap('<li class="main-nav__item--shopping-cart"></li>');

                // Add arrow and class if Top Bar menu ite has submenu
                $top_nav_li
                    .has("ul")
                    .addClass("has-children")
                    .prepend('<span class="main-nav__toggle"></span>');

                // Clone Top Bar menu to Main Menu
                if ($top_nav.exists()) {
                    var children = $top_nav.children().clone();
                    $nav_list.append(children);
                }

                // Clone Header Logo to Mobile Menu
                var $logo_mobile = $(".header-mobile__logo").clone();
                $nav_list.prepend($logo_mobile);
                $logo_mobile.prepend('<span class="main-nav__back"></span>');

                // Clone Header Info to Mobile Menu
                var header_info1 = $(".info-block__item--contact-primary").clone();
                var header_info2 = $(".info-block__item--contact-secondary").clone();
                $nav_list.append(header_info1).append(header_info2);

                // Clone Social Links to Main Menu
                if ($social.exists()) {
                    var social_li = $social.children().clone();
                    var social_li_new = social_li.contents().unwrap();
                    social_li_new
                        .appendTo($nav_list)
                        .wrapAll('<li class="main-nav__item--social-links"></li>');
                }

                // Add arrow and class if Info Header Nav has submenu
                $info_nav_li.has("ul").addClass("has-children");

                // Mobile Menu Toggle
                $toggle_btn.on("click", function () {
                    $wrapper.toggleClass("site-wrapper--has-overlay");
                });

                $(".site-overlay, .main-nav__back").on("click", function () {
                    $wrapper.toggleClass("site-wrapper--has-overlay");
                });

                // Pushy Panel Toggle
                $pushy_btn.on("click", function (e) {
                    e.preventDefault();
                    $wrapper.toggleClass("site-wrapper--has-overlay-pushy");
                });

                $(".site-overlay, .pushy-panel__back-btn").on("click", function (e) {
                    e.preventDefault();
                    $wrapper.removeClass(
                        "site-wrapper--has-overlay-pushy site-wrapper--has-overlay"
                    );
                });

                // Add toggle button and class if menu has submenu
                $nav_list_li
                    .has(".main-nav__sub")
                    .addClass("has-children")
                    .prepend('<span class="main-nav__toggle"></span>');

                $(".main-nav__toggle").on("click", function () {
                    $(this)
                        .toggleClass("main-nav__toggle--rotate")
                        .parent()
                        .siblings()
                        .children()
                        .removeClass("main-nav__toggle--rotate");

                    $(".main-nav__sub")
                        .not($(this).siblings(".main-nav__sub"))
                        .slideUp("normal");
                    $(this)
                        .siblings(".main-nav__sub")
                        .slideToggle("normal");
                });

                // Add toggle button and class if submenu has sub-submenu
                $(".main-nav__list > li > ul > li")
                    .has(".main-nav__sub-2")
                    .addClass("has-children")
                    .prepend('<span class="main-nav__toggle-2"></span>');
                $(".main-nav__list > li > ul > li > ul > li")
                    .has(".main-nav__sub-3")
                    .addClass("has-children")
                    .prepend('<span class="main-nav__toggle-2"></span>');

                $(".main-nav__toggle-2").on("click", function () {
                    $(this).toggleClass("main-nav__toggle--rotate");
                    $(this)
                        .siblings(".main-nav__sub-2")
                        .slideToggle("normal");
                    $(this)
                        .siblings(".main-nav__sub-3")
                        .slideToggle("normal");
                });

                // Mobile Search
                $("#header-mobile__search-icon").on("click", function () {
                    $(this).toggleClass("header-mobile__search-icon--close");
                    $(".header-mobile").toggleClass("header-mobile--expanded");
                });
            }
        },

        countDown: function () {
            var countdown = $(".countdown-counter");
            var count_time = countdown.data("date");
            countdown.countdown({
                date: count_time,
                render: function (data) {
                    $(this.el).html(
                        "<div class='countdown-counter__item countdown-counter__item--days'>" +
                        this.leadingZeros(data.days, 2) +
                        " <span class='countdown-counter__label'>dager</span></div><div class='countdown-counter__item countdown-counter__item--hours'>" +
                        this.leadingZeros(data.hours, 2) +
                        " <span class='countdown-counter__label'>timer</span></div><div class='countdown-counter__item countdown-counter__item--mins'>" +
                        this.leadingZeros(data.min, 2) +
                        " <span class='countdown-counter__label'>min</span></div><div class='countdown-counter__item countdown-counter__item--secs'>" +
                        this.leadingZeros(data.sec, 2) +
                        " <span class='countdown-counter__label'>sek</span></div>"
                    );
                }
            });
        },

        InstagramFeed: function () {
            // Basketball version (Footer)
            if ($insta_feed.exists()) {
                var insta_feed = new Instafeed({
                    get: "user",
                    target: "instagram-feed",
                    userId: "2251271172",
                    accessToken: "",
                    limit: 6,
                    template:
                        '<li class="widget-instagram__item"><a href="{{link}}" id="{{id}}" class="widget-instagram__link-wrapper" target="_blank"><span class="widget-instagram__plus-sign"><img src="{{image}}" alt="" class="widget-instagram__img" /></span></a></li>'
                });
                insta_feed.run();
            }
        },

        SocialCounters: function () {
            if ($social_counters.exists()) {
                $social_counters.SocialCounter({
                    // Facebook
                    facebook_user: "",
                    facebook_token: "",

                    // Google+
                    google_plus_id: "",
                    google_plus_key: "",

                    // Instagram
                    instagram_user: "",
                    instagram_token: "",

                    // Twitter
                    twitter_user: "",

                    // Twitch
                    twitch_username: "",
                    twitch_client_id: "",

                    // YouTube
                    youtube_user: "",
                    youtube_key: ""
                });
            }
        },

        miscScripts: function () {
            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            feather.replace();

            // Fullscreen support
            $(document).on("click", '[data-toggle="fullscreen"]', function () {
                return (
                    $(this).toggleClass("active-fullscreen"),
                    document.fullscreenEnabled
                        ? $(this).hasClass("active-fullscreen")
                            ? document.documentElement.requestFullscreen()
                            : document.exitFullscreen()
                        : notify("Nettleseren din støtter ikke fullskjerm modus."),
                    !1
                );
            });

            // Dropdown menu
            $(document).on("click", ".dropdown-menu", function (e) {
                e.stopPropagation();
            });

            // Marquee
            if ($marquee.exists()) {
                $marquee.marquee({
                    allowCss3Support: true,
                    pauseOnHover: true
                });
            }

            window.notify = function notify(message) {
                $(".notify").remove();
                $("body").append('<div class="notify">' + message + "</div>");
                setTimeout(function () {
                    var el = $(".notify");
                    el.addClass("active");
                    setTimeout(function () {
                        el.removeClass("active");
                        setTimeout(function () {
                            el.remove();
                        }, 500);
                    }, 3000);
                }, 100);
            }

            $("form#register-form").submit(function (event) {
                event.preventDefault();
                var name = $(this).find("input[name=name]").val();
                var email = $(this).find("input[name=email]").val();
                var dialCode = $(this).find('.iti__selected-dial-code').text();
                var dialNumber = $(this).find("input[name=phone_one]").val().replace(/\s+/g, '');
                var phone = dialCode + dialNumber;
                var password = $(this).find("input[name=password]").val();
                var _token = $(this).find("input[name=_token]").val();
                if (name === "" && email === "" && dialNumber === "" && password === "") {
                    $(this).submit();
                } else {
                    var invalid_name = $("span#invalid-name");
                    var invalid_email = $("span#invalid-email");
                    var invalid_phone = $("span#invalid-phone");
                    var invalid_password = $("span#invalid-password");
                    var valid_register_feedback = $("span#valid-register-feedback");
                    var invalid_register_feedback = $("span#invalid-register-feedback");
                    invalid_name.hide().html("");
                    invalid_email.hide().html("");
                    invalid_phone.hide().html("");
                    invalid_password.hide().html("");
                    valid_register_feedback.hide().html("");
                    invalid_register_feedback.hide().html("");
                    $.ajax({
                        url: "register",
                        method: "POST",
                        data: {
                            name: name,
                            email: email,
                            phone: phone,
                            password: password,
                            _token: _token
                        },
                        success: function (response) {
                            if (response.errors) {
                                $.each(response.errors, function (index, value) {
                                    switch (index) {
                                        case "name":
                                            invalid_name.show().html(value[0]);
                                            break;
                                        case "email":
                                            invalid_email.show().html(value[0]);
                                            break;
                                        case "phone":
                                            invalid_phone.show().html(value[0]);
                                            break;
                                        case "password":
                                            invalid_password.show().html(value[0]);
                                            break;
                                    }
                                });
                                return false;
                            } else if (response.status === true) {
                                valid_register_feedback.show().html(response.message);
                                $(this).find("input[name=name]").val("");
                                $(this).find("input[name=email]").val("");
                                $(this).find("input[name=phone]").val("");
                                $(this).find("input[name=password]").val("");

                                var expireTime = new Date();
                                expireTime.setTime(expireTime.getTime() + (4 * 60 * 1000 + 50 * 1000));
                                $.cookie('registered', '1', { expires: expireTime });

                                setTimeout(function () {
                                    window.location.href = "#verificationModal"
                                }, 2000);
                            } else {
                                invalid_register_feedback.show().html(response.message);
                            }
                        },
                        error: function () {
                            invalid_register_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                        }
                    });
                }
            });

            $("form#verification-form").submit(function (event) {
                event.preventDefault();
                var code = $(this).find("input[name=code]").val();
                var _token = $(this).find("input[name=_token]").val();
                if (code === "") {
                    $(this).submit();
                } else {
                    var invalid_code = $("span#invalid-code-feedback");
                    var invalid_verification_feedback = $("span#invalid-verification-feedback");
                    var valid_verification_feedback = $("span#valid-verification-feedback");
                    invalid_verification_feedback.hide().html("");
                    valid_verification_feedback.hide().html("");
                    $.ajax({
                        url: "verification",
                        method: "POST",
                        data: {
                            code: code,
                            _token: _token
                        },
                        success: function (response) {
                            if (response.errors) {
                                $.each(response.errors, function (index, value) {
                                    if (index === "code") {
                                        invalid_code.show().html(value[0]);
                                    }
                                });
                                return false;
                            } else if (response.status === true) {
                                valid_verification_feedback.show().html(response.message);
                                $(this).find("input[name=code]").val("");
                                setTimeout(function () {
                                    window.location.href = "/"
                                }, 2000);
                            } else {
                                invalid_verification_feedback.show().html(response.message);
                            }
                        },
                        error: function () {
                            invalid_verification_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                        }
                    });
                }
            });

            $("form#login-form").submit(function (event) {
                event.preventDefault();
                var email = $(this).find("input[name=email]").val();
                var password = $(this).find("input[name=password]").val();
                var remember = $(this).find("input[name=remember]").prop("checked");
                var _token = $(this).find("input[name=_token]").val();
                if (email === "" && password === "") {
                    $(this).submit();
                } else {
                    $.ajax({
                        url: "login",
                        method: "POST",
                        data: {
                            email: email,
                            password: password,
                            remember: remember,
                            _token: _token
                        },
                        success: function (response) {
                            if (response.success === true) {
                                $("span#valid-login-feedback").show().html(response.message);
                                $("span#invalid-login-feedback").hide();
                                setTimeout(function () {
                                    //window.location.href = document.referrer;
                                    window.location.href = response.redirectUrl;
                                }, 2000);
                            } else {
                                $("span#valid-login-feedback").hide();
                                $("span#invalid-login-feedback").show().html(response.message);
                            }
                        },
                        error: function (requestObject, error, errorThrown) {
                            $("span#valid-login-feedback").hide();
                            $("span#invalid-login-feedback").show().html("Noe gikk galt, prøv på nytt igjen senere...");
                        }
                    });
                }
            });

            $("form#forget-password-form").submit(function (event) {
                event.preventDefault();
                var dialCode = $(this).find('.iti__selected-dial-code').text();
                var dialNumber = $(this).find("input[name=phone_two]").val().replace(/\s+/g, '');
                var phone = dialCode + dialNumber;
                var _token = $(this).find("input[name=_token]").val();
                if (dialCode === "" && dialNumber === "") {
                    $(this).submit();
                } else {
                    var valid_phone_feedback = $("span#valid-phone-feedback");
                    var invalid_phone_feedback = $("span#invalid-phone-feedback");
                    valid_phone_feedback.hide().html("");
                    invalid_phone_feedback.hide().html("");
                    $.ajax({
                        url: "resetPassword",
                        type: "POST",
                        data: {
                            phone: phone,
                            _token: _token
                        },
                        success: function (response) {
                            if (response.status === true) {
                                window.location.href = '#resetPasswordVerificationForm';
                                valid_phone_feedback.show().html(response.message);
                            } else {
                                invalid_phone_feedback.show().html(response.message);
                            }
                        },
                        error: function () {
                            invalid_phone_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                        }
                    });
                }
            });

            $("form#reset-forget-password-form").submit(function (event) {
                event.preventDefault();
                var code = $("#resetforgetPassword").val();
                var _token = $(this).find("input[name=_token]").val();
                if (code === "") {
                    $(this).submit();
                } else {
                    var valid_reset_password_feedback = $("span#valid-reset-password-feedback");
                    var invalid_reset_password_feedback = $("span#invalid-reset-password-feedback");
                    valid_reset_password_feedback.hide().html("");
                    invalid_reset_password_feedback.hide().html("");
                    $.ajax({
                        url: "resetForgotPassword",
                        type: "POST",
                        data: {
                            code: code,
                            _token: _token
                        },
                        success: function (response) {
                            if (response.status === true) {
                                window.location.href = '#resetForgotPasswordModal';
                                valid_reset_password_feedback.show().html(response.message);
                            } else {
                                invalid_reset_password_feedback.show().html(response.message);
                            }

                        },
                        error: function (err) {
                            invalid_reset_password_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                        }
                    });
                }
            });

            $("form#reset-password-form").submit(function (event) {
                event.preventDefault();
                var this_ = $(this);
                var password = this_.find("input[name=password]").val();
                var confirm_password = this_.find("input[name=password_confirmation]").val();
                var _token = this_.find("input[name=_token]").val();
                if (password === "" && confirm_password === "") {
                    $(this).submit();
                } else {
                    var invalid_password = $("span#invalid-password");
                    var invalid_confirm_password = $("span#invalid-confirm-password");
                    var valid_reset_feedback = $("span#valid-reset-feedback");
                    var invalid_reset_feedback = $("span#invalid-reset-feedback");
                    invalid_password.hide().html("");
                    invalid_confirm_password.hide().html("");
                    valid_reset_feedback.hide().html("");
                    invalid_reset_feedback.hide().html("");
                    $.ajax({
                        url: "updatePassword",
                        method: "POST",
                        data: {
                            password: password,
                            confirm_password: confirm_password,
                            _token: _token
                        },
                        success: function (response) {
                            if (response.errors) {
                                $.each(response.errors, function (index, value) {
                                    if (index === "password") {
                                        invalid_password.show().html(value[0]);
                                    }
                                    if (index === "confirm_password") {
                                        invalid_confirm_password.show().html(value[0]);
                                    }
                                });
                                return false;
                            } else if (response.status === true) {
                                valid_reset_feedback.show().html(response.message);
                                this_.find("input[name=password]").val("");
                                this_.find("input[name=password_confirmation]").val("");
                                setTimeout(function () {
                                    window.location.href = '/';
                                }, 1000);
                            } else {
                                invalid_reset_feedback.show().html(response.message);
                            }
                        },
                        error: function () {
                            invalid_reset_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                        }
                    });
                }
            });

            $("form#contact-form").submit(function (event) {
                event.preventDefault();
                var email = $("#contact-form-email").val();
                var message = $("#contact-form-message").val();
                var _token = $("#contact-form-token").val();

                $.ajax({
                    url: "send-contact-email",
                    method: "POST",
                    data: { email: email, message: message, _token: _token },
                    dataType: "json",
                    success: function (response) {
                        if (response.success === true) {
                            notify("E-post har blitt sendt!");
                            setTimeout(function () {
                                $("#contact-form-email").val("");
                                $("#contact-form-message").val("");
                            }, 1000);
                        } else {
                            notify("En feil har oppstått, prøv igjen senere.");
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            $('#resend-code').on('click', function () {
                var limit = 60;

                $('#resend-code').css({
                    'pointer-events': 'none',
                    'opacity': .5
                });
                $('#resend-timer').removeClass('d-none');

                var resendInterval = window.setInterval(function () {
                    $('#resend-timer').html(limit);

                    if (limit > 0) {
                        limit--;
                    } else {
                        $('#resend-code').css({
                            'pointer-events': 'auto',
                            'opacity': 1
                        });
                        $('#resend-timer').addClass('d-none');
                        window.clearInterval(resendInterval);
                    }
                }, 1000);

                var _token = $("#verification-form-token").val();
                var valid_verification_feedback = $("span#valid-verification-feedback");
                var invalid_verification_feedback = $("span#invalid-verification-feedback");
                valid_verification_feedback.hide().html("");
                invalid_verification_feedback.hide().html("");

                $.ajax({
                    url: "resendPhoneVerificationCode",
                    method: "POST",
                    data: { _token: _token },
                    success: function (response) {
                        if (response.status === true) {
                            valid_verification_feedback.show().html(response.message);
                        } else {
                            invalid_verification_feedback.show().html(response.message);
                        }
                    },
                    error: function () {
                        invalid_verification_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                    }
                });
            });

            $('#resend-password-code').on('click', function () {
                var limit = 60;

                $('#resend-password-code').css({
                    'pointer-events': 'none',
                    'opacity': .5
                });
                $('#resend-password-timer').removeClass('d-none');

                var resendInterval = window.setInterval(function () {
                    $('#resend-password-timer').html(limit);

                    if (limit > 0) {
                        limit--;
                    } else {
                        $('#resend-password-code').css({
                            'pointer-events': 'auto',
                            'opacity': 1
                        });
                        $('#resend-password-timer').addClass('d-none');
                        window.clearInterval(resendInterval);
                    }
                }, 1000);

                var _token = $("#reset-forget-password-form-token").val();
                var valid_reset_password_feedback = $("span#valid-reset-password-feedback");
                var invalid_reset_password_feedback = $("span#invalid-reset-password-feedback");
                valid_reset_password_feedback.hide().html("");
                invalid_reset_password_feedback.hide().html("");

                $.ajax({
                    url: "resendPasswordVerificationCode",
                    method: "POST",
                    data: { _token: _token },
                    success: function (response) {
                        if (response.status === true) {
                            valid_reset_password_feedback.show().html(response.message);
                        } else {
                            invalid_reset_password_feedback.show().html(response.message);
                        }
                    },
                    error: function () {
                        invalid_reset_password_feedback.show().html("Noe gikk galt, prøv på nytt igjen senere...");
                    }
                });
            });

        }
    };

    $(document).on("ready", function () {
        Core.initialize();

        var url = window.location.href;
        var urlParam = url.split("/").pop().split("#")[0];

        if (!urlParam) {
            UrlHashMonitor.init();
            UrlHashMonitor.onHashChange(function () {
                $(UrlHashMonitor.oldHash).modal("hide");
                $(UrlHashMonitor.newHash).modal("show");
            });

            if (window.location.hash) {
                var hash = window.location.hash;
                $(hash).modal("toggle");
            }

            $(".modal").on("show.bs.modal", function (e) {
                if (typeof e.relatedTarget != "undefined") {
                    window.location.hash = $(e.relatedTarget).attr("href");
                }
                $('a[href="' + window.location.hash + '"]').click();
            });

            $(".modal").on("hide.bs.modal", function () {
                if ($(window.location.hash).hasClass('show')) {
                    history.replaceState(null, "", window.location.pathname)
                }
            });
        }

        $('header #linkRegister').on('click', function(e){
            if( !isEmpty( $.cookie('registered') ) && parseInt( $.cookie('registered') ) === 1 ){
                window.location.href = "#verificationModal";
            } else {
                window.location.href = "#registerModal";
            }
        });

        $('#loginModal #linkRegister').on('click', function(e){
            if( !isEmpty( $.cookie('registered') ) && parseInt( $.cookie('registered') ) === 1 ){
                window.location.href = "#verificationModal";
            } else {
                window.location.href = "#registerModal";
            }
        });

        $('#registerModal #chkAgree').on('change', function(e){
            if( $('#registerModal #chkAgree').prop('checked') ){
                /*
                $('#registerModal #chkAgree')
                    .removeClass('is-invalid')
                    .addClass('is-valid');
                */
                $('#registerModal .form-group > button').prop('disabled', false);
            } else {
                /*
                $('#registerModal #chkAgree')
                    .removeClass('is-valid')
                    .addClass('is-invalid');
                */
                $('#registerModal .form-group > button').prop('disabled', true);
            }
        });
    });
})(jQuery);
