! function(e) {
    e(".SeeMore2").click(function() {
        var a = e(this);
        a.toggleClass("SeeMore2"), a.text(a.hasClass("SeeMore2") ? "Xem thêm" : "Thu gọn")
    }), e("#td-top-mobile-toggle a, .td-mobile-close a").click(function() {
        e("body").hasClass("td-menu-mob-open-menu") ? e("body").removeClass("td-menu-mob-open-menu") : (window.scrollTo(0, 0), setTimeout(function() {
            e("body").addClass("td-menu-mob-open-menu")
        }, 100))
    });
    var a = {
            platform: "unknown",
            name: "unknown",
            type: "unknown",
            screen: "unknown",
            browser: "unknown"
        },
        t = navigator.userAgent.toLowerCase();
    t.indexOf("ipad") > -1 ? (a.platform = "ios", a.name = "ipad", a.type = "tablet") : t.indexOf("iphone") > -1 ? (a.platform = "ios", a.name = "iphone", a.type = "smartphone") : t.indexOf("android") > -1 ? (a.platform = "android", a.type = t.indexOf("mobile") > -1 ? "smartphone" : "tablet") : t.indexOf("windows phone") > -1 ? (a.platform = "windows", a.type = "smartphone") : a.type = "desktop", t.indexOf("chrome") > -1 ? a.browser = "chrome" : t.indexOf("firefox") > -1 ? a.browser = "firefox" : t.indexOf("msie") > -1 ? a.browser = "ie" : t.indexOf("safari") > -1 && t.indexOf("chrome") < 0 && (a.browser = "safari");
    var o = {
            common: {
                init: function() {
                    "string" == typeof AppData.ajax._token && jQuery.ajaxSetup({
                        headers: {
                            "X-CSRF-Token": AppData.ajax._token
                        }
                    }), e("[data-custom-scrollbar=true]").each(function() {
                        e(this).mCustomScrollbar({
                            horizontalScroll: e(this).data("customScrollbarHorizontal") ? !0 : !1,
                            autoDraggerLength: e(this).data("customScrollbarAutolength") ? !0 : !1,
                            mouseWheel: e(this).data("customScrollbarMousewheel") ? !0 : !1
                        })
                    }), e(".slider-nav-button").on("click", function() {
                        var a = e(this).hasClass("next") ? "right" : "left",
                            t = e(this).siblings(".slide-container");
                        e(t).mCustomScrollbar("scrollTo", a)
                    }), jQuery(".film-thumbnail > a,.thumb > a").each(function() {
                        e(this).data("popupDisabled") || jQuery(this).qtip({
                            content: {
                                text: e(this).closest("div").siblings(".film-info-popup")
                            },
                            hide: {
                                fixed: !0,
                                delay: 300
                            },
                            style: {
                                classes: "realfilm-popup"
                            }
                        })
                    }), e(".online-support-wrapper .toggle").on("click", function(a) {
                        a.preventDefault();
                        e(this).siblings(".online-support").animate({
                            width: "toggle"
                        })
                    })
                },
                lazyLoadingSetup: function() {
                    jQuery("img.lazy").lazy({
                        effect: "fadeIn",
                        effectTime: "slow"
                    })
                },
                hotMovieSliderSetup: function() {
                    e("#hot-movies").bxSlider({
                        auto: !0,
                        pause: 12e3,
                        slideWidth: 960,
                        minSlides: 3,
                        maxSlides: 3,
                        pager: !1,
                        slideMargin: 8
                    })
                },
                loginHandler: function() {
                    if ("function" == typeof FormValidator) {
                        new FormValidator("login_form", [{
                            name: "username",
                            display: "username",
                            rules: "required|min_length[3]|max_length[32]"
                        }, {
                            name: "password",
                            display: "password",
                            rules: "required"
                        }], function(a, t) {
                            if (t.preventDefault(), a.length > 0) e.each(a, function(a, t) {
                                e("#" + t.id).closest(".form-group").addClass("has-error")
                            });
                            else {
                                e("#login-form").find(".form-group").removeClass("has-error");
                                var o = e("#login-form").serialize(),
                                    r = new ajaxLoader("body", {
                                        classOveride: "blue-loader",
                                        bgColor: "#000",
                                        opacity: "0.3"
                                    });
                                jQuery.post(AppData.ajax.login_url, o).done(function(e) {
                                    r && r.remove(), e.error ? e.message ? alert(e.message) : "string" == typeof e.redirect_url && (window.location = e.redirect_url) : location.reload()
                                })
                            }
                        })
                    }
                },
                registerHandler: function() {
                    if ("function" == typeof FormValidator) {
                        new FormValidator("register_form", [{
                            name: "email",
                            display: "email",
                            rules: "required|valid_email"
                        }, {
                            name: "username",
                            display: AppData.trans.username,
                            rules: "required|alpha_numeric"
                        }, {
                            name: "password",
                            display: AppData.trans.password,
                            rules: "required|min_length[6]|max_length[32]"
                        }, {
                            name: "re_password",
                            display: AppData.trans.re_password,
                            rules: "required|matches[password]"
                        }, {
                            name: "first_name",
                            display: AppData.trans.first_name,
                            rules: "required|max_length[100]"
                        }, {
                            name: "last_name",
                            display: AppData.trans.last_name,
                            rules: "required|max_length[100]"
                        }, {
                            name: "captcha",
                            display: AppData.trans.captcha,
                            rules: "required|max_length[7]"
                        }], function(a, t) {
                            t.preventDefault(), a.length ? (e("#register-form").find(".form-group").removeClass("has-error"), e.each(a, function(a, t) {
                                e("#register-form #" + t.id).closest(".form-group").addClass("has-error")
                            }), alert(a[0].message), t.returnValue = !1) : t.returnValue = !1
                        })
                    }
                },
                recoverPasswordHandler: function() {
                    if ("function" == typeof FormValidator) {
                        new FormValidator("recover_password_form", [{
                            name: "email",
                            display: "email",
                            rules: "required|email"
                        }, {
                            name: "captcha",
                            display: AppData.trans.captcha,
                            rules: "required|max_length[7]"
                        }], function(a, t) {
                            if (t.preventDefault(), a.length) e.each(a, function(a, t) {
                                e("#recover_password-form #" + t.id).closest(".form-group").addClass("has-error")
                            });
                            else {
                                e("#recover_password-form").find(".form-group").removeClass("has-error");
                                var o = e("#recover_password-form").serialize(),
                                    r = new ajaxLoader("body", {
                                        classOveride: "blue-loader",
                                        bgColor: "#000",
                                        opacity: "0.3"
                                    });
                                e.post(AppData.ajax.recover_password_url, o).done(function(e) {
                                    r && r.remove(), e.error ? location.reload() : location.href = "/"
                                })
                            }
                        })
                    }
                },
                resendActiveCodeHandler: function() {
                    if ("function" == typeof FormValidator) {
                        new FormValidator("resend_active_code_form", [{
                            name: "email",
                            display: "email",
                            rules: "required|email"
                        }, {
                            name: "captcha",
                            display: AppData.trans.captcha,
                            rules: "required|max_length[7]"
                        }], function(a, t) {
                            if (t.preventDefault(), a.length) e.each(a, function(a, t) {
                                e("#resend_active_code-form #" + t.id).closest(".form-group").addClass("has-error")
                            });
                            else {
                                e("#resend_active_code-form").find(".form-group").removeClass("has-error");
                                var o = e("#resend_active_code-form").serialize(),
                                    r = new ajaxLoader("body", {
                                        classOveride: "blue-loader",
                                        bgColor: "#000",
                                        opacity: "0.3"
                                    });
                                e.post(AppData.ajax.resend_active_code_url, o).done(function(e) {
                                    r && r.remove(), e.error ? location.reload() : location.href = "/"
                                })
                            }
                        })
                    }
                },
                resetPasswordHandler: function() {
                    if ("function" == typeof FormValidator) {
                        new FormValidator("reset_password_form", [{
                            name: "password",
                            display: AppData.trans.password,
                            rules: "required|min_length[6]|max_length[32]"
                        }, {
                            name: "re_password",
                            display: AppData.trans.re_password,
                            rules: "required|min_length[6]|max_length[32]"
                        }], function(a, t) {
                            if (t.preventDefault(), a.length) e.each(a, function(a, t) {
                                e("#reset_password-form #" + t.id).closest(".form-group").addClass("has-error")
                            });
                            else {
                                e("#reset_password-form").find(".form-group").removeClass("has-error");
                                var o = e("#reset_password-form").serialize(),
                                    r = new ajaxLoader("body", {
                                        classOveride: "blue-loader",
                                        bgColor: "#000",
                                        opacity: "0.3"
                                    });
                                e.post(AppData.ajax.reset_password_url, o).done(function(e) {
                                    r && r.remove(), e.error ? location.reload() : location.href = "/"
                                })
                            }
                        })
                    }
                },
                logoutHandler: function() {
                    jQuery("#user-logout").on("click", function(a) {
                        a.preventDefault(), vex.dialog.confirm({
                            message: AppData.trans.logout_seriously,
                            className: "vex-theme-os",
                            callback: function(a) {
                                a && e.post(AppData.ajax.logout_url).done(function(e) {
                                    e.error ? alert(e.message ? e.message : "Error !") : location.reload()
                                })
                            }
                        })
                    })
                },
                updateInfoBoxHandler: function() {
                    vex.dialog.confirm({
                        message: AppData.trans.show_box_update_info,
                        className: "vex-theme-os",
                        callback: function(e) {
                            e && (location.href = AppData.ajax.update_info_url)
                        }
                    })
                },
                vexSetup: function() {
                    vex.defaultOptions.className = "vex-theme-os"
                },
                initSearchFormAutocomplete: function() {
                    "undefined" != typeof jQuery.autoComplete && jQuery("[data-auto-complete-enable=true]").autoComplete({
                        ajax: AppData.ajax.search,
                        requestType: "POST",
                        postVar: "query",
                        postData: {
                            _token: AppData.ajax._token
                        },
                        minChars: 3,
                        onListFormat: function(e, a) {
                            a.list.valid && jQuery.each(a.list.items, function(e, t) {
                                a.ul.append("<li>" + t.title + "</li>")
                            })
                        },
                        onSelect: function() {}
                    })
                }
            },
            SearchForm: {
                init: function() {
                    if ("undefined" != typeof jQuery.autoComplete) {
                        var e = this;
                        jQuery("[data-auto-complete-enable=true]").autoComplete({
                            ajax: AppData.ajax.search,
                            requestType: "POST",
                            postVar: "query",
                            postData: {
                                _token: AppData.ajax._token
                            },
                            onListFormat: e.formatListHandler,
                            onSelect: e.selectListItemHandler,
                            onLoad: e.loadListHandler,
                            minChars: 3
                        })
                    }
                },
                loadListHandler: function(e, a) {
                    return a.list.valid ? a.list.items : void 0
                },
                formatListHandler: function(e, a) {
                    a.ul.children().remove(), jQuery.each(a.list, function(e, t) {
                        a.ul.append('<li><div class="media"><a class="pull-left" href="' + t.url + '"><img src="' + t.thumbnail + '"/></a><div class="media-body"><h3 class="media-heading">' + t.title + "</h3> " + t.title_translate + "</div></div></li>")
                    })
                },
                selectListItemHandler: function(e, a) {
                    "string" == typeof a.data.url && (window.location = a.data.url)
                }
            },
            film: {
                handleFilmAction: function() {
                    var e = this;
                    "ok" == AppData.film.status ? jQuery(".play-video,.film-big-banner,.vjs-big-play-button").on("click", function(a) {
                        a.preventDefault(), e.toggleFilmInfo(e)
                    }) : jQuery(".play-video").on("click", this.handleFilmUnavailable)
                },
                handleFilmUnavailable: function(e) {
                    e.preventDefault(), vex.dialog.alert(AppData.trans.film_unavailable)
                },
                handleFilmTrailer: function() {
                    e(".play-trailer").fancybox({
                        maxWidth: 800,
                        maxHeight: 600,
                        fitToView: !1,
                        width: "70%",
                        height: "70%",
                        autoSize: !1,
                        closeClick: !1,
                        openEffect: "none",
                        closeEffect: "none"
                    })
                },
                toggleFilmInfo: function(e) {
                    var a = jQuery(".film-info-container"),
                        t = jQuery(".film-big-banner"),
                        o = {
                            opacity: null,
                            bottom: null
                        };
                    a.hasClass("hide") ? (o.opacity = 1, o.bottom = 0) : (o.opacity = 0, o.bottom = "-500px"), a.animate(o, {
                        duration: 1e3,
                        done: function() {
                            a.toggleClass("hide"), "function" == typeof e && e()
                        }
                    }), t.fadeToggle(1e3)
                },
            },
            slider: {
                init: function() {
                    jQuery(".main-slider").unslider({
                        speed: 500,
                        delay: 4e3,
                        complete: function() {},
                        dots: !0,
                        fluid: !1
                    })
                }
            },
            user: {
                handleInfoForm: function() {
                    if ("function" == typeof FormValidator) {
                        new FormValidator("info_form", [{
                            name: "email",
                            display: "username",
                            rules: "required|email"
                        }, {
                            name: "first_name",
                            display: AppData.trans.first_name,
                            rules: "required|min_length[3]|max_length[32]"
                        }, {
                            name: "last_name",
                            display: AppData.trans.last_name,
                            rules: "required|min_length[3]|max_length[32]"
                        }, {
                            name: "day",
                            display: AppData.trans.day,
                            rules: "required|integer|less_than[32]|greater_than[0]"
                        }, {
                            name: "month",
                            display: AppData.trans.month,
                            rules: "required|integer|less_than[13]|greater_than[0]"
                        }, {
                            name: "year",
                            display: AppData.trans.year,
                            rules: "required|integer|greater_than[1969]"
                        }, {
                            name: "gender",
                            display: AppData.trans.gender,
                            rules: "required"
                        }], function(a, t) {
                            if (t.preventDefault(), a.length > 0) e.each(a, function(a, t) {
                                e("#info-form #" + t.id).closest(".form-group").addClass("has-error")
                            });
                            else {
                                var o = e("#info-form").serialize();
                                e.post(AppData.ajax.update_url, o).done(function(e) {
                                    e.valid ? e.redirect_url ? window.location = redirect_url : e.message && alert(e.message) : alert(e.message)
                                })
                            }
                        })
                    }
                }
            }
        },
        r = {
            calledActions: [],
            fire: function(a, t) {
                actions = a.split("."), -1 === e.inArray(actions[0], this.calledActions) && "function" == typeof o[actions[0]].init && (o[actions[0]].init(), this.calledActions.push(actions[0])), "init" != actions[1] && "function" == typeof o[actions[0]][actions[1]] && o[actions[0]][actions[1]](t)
            },
            init: function(e) {
                for (i = 0; i < e.length; i++) this.fire(e[i])
            }
        };
    e(function() {
        "undefined" != typeof AppData.events && r.init(AppData.events)
    }), e("#user-menu .user-info").click(function() {
        e("#user-menu a").removeClass("hover"), e(this).attr("class", "hover"), box = new ajaxLoader("body", {
            classOveride: "blue-loader",
            bgColor: "#000",
            opacity: "0.3"
        }), e.ajax({
            url: "account/info",
            type: "POST",
            context: this,
            datatype: "json",
            success: function(a) {
                box && box.remove(), e("#user-body").html("").append(a.error ? "Lỗi: " + a.message : a)
            },
            error: function() {
                box && box.remove(), e("#user-body").html("").append("Lỗi")
            }
        })
    }), e("#user-menu .user-rate").click(function() {
        e("#user-body").html("").append("Đang cập nhật đổi coin ..."), e("#user-menu a").removeClass("hover"), e(this).attr("class", "hover")
    }), e("#user-menu .user-history").click(function() {
        e("#user-menu a").removeClass("hover"), e(this).attr("class", "hover"), box = new ajaxLoader("body", {
            classOveride: "blue-loader",
            bgColor: "#000",
            opacity: "0.3"
        }), e.ajax({
            url: "account/transaction",
            type: "POST",
            context: this,
            datatype: "json",
            success: function(a) {
                box && box.remove(), e("#user-body").html("").append(a.error ? "Lỗi: " + a.message : a)
            },
            error: function() {
                box && box.remove(), e("#user-body").html("").append("Lỗi")
            }
        })
    }), e("#user-menu .user-refill").click(function() {
        e("#user-menu a").removeClass("hover"), e(this).attr("class", "hover"), box = new ajaxLoader("body", {
            classOveride: "blue-loader",
            bgColor: "#000",
            opacity: "0.3"
        }), e.ajax({
            url: "account/refill",
            type: "POST",
            context: this,
            datatype: "json",
            success: function(a) {
                box && box.remove(), e("#user-body").html("").append(a.error ? "Lỗi: " + a.message : a)
            },
            error: function() {
                box && box.remove(), e("#user-body").html("").append("Lỗi")
            }
        })
    })
}(jQuery);