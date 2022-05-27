const { find } = require("lodash");

require("./bootstrap");
$(function () {
    $(function () {
        $("#links").DataTable();
        $("#users").DataTable();
    });

    $("html").on("click", function (e) {
        var side = $(".sidebar");
        if (!side.is(e.target) && side.has(e.target).length === 0) {
            $(".sidebar-content").fadeOut();
            $(".box").fadeOut();
        }
    });
    $(window).on("scroll", function (e) {
        var side = $(".sidebar");
        if (window.scrollY > 0) {
            $(".sidebar-content").fadeOut();
            $(".box").fadeOut();
        }
    });
    $(".sidebar").on("click", function (e) {
        var side = $(".sidebar-content");
        if (!side.is(e.target) && side.has(e.target).length === 0) {
            $(".sidebar-content").fadeToggle();
            $(".box").fadeToggle();
        }
    });

    $(".sign-in-btn").on("click", function (e) {
        e.preventDefault();
        var email = $("#emailinput"),
            pass = $("#passwordinput"),
            errors = 0;
        function ifEmpty(e) {
            if (e.val() == "") {
                e.next().find("span").text("هذا الحقل مطلوب");
                e.next().slideDown();
                e.next().css({ display: "flex" });
                errors = 1;
            } else {
                e.next().slideUp();
                errors = 0;
            }
        }
        ifEmpty(email);
        ifEmpty(pass);
        if (errors === 0) {
            var form = $("#loginForm");
            var inputs = form.find("input");
            var serializedData = form.serialize();
            $.get({
                url: "logInValidate",
                data: serializedData,
                success: function (response) {
                    if (response == "success") {
                        location.href = "../";
                    } else {
                        $(".athoo-alert").html(response);
                        $(".athoo-alert").slideDown();
                    }
                },
            });
        }
    });
    $(".sign-up-btn").on("click", function (e) {
        e.preventDefault();

        var name = $("#nameinput"),
            email = $("#emailinput"),
            pass = $("#passwordinput"),
            pass2 = $("#password2input"),
            errors = 0;

        function ifEmpty(e) {
            if (e.val() == "") {
                e.next().find("span").text("هذا الحقل مطلوب");
                e.next().slideDown();
                e.next().css({ display: "flex" });
                errors = 1;
            } else if (e.val() != "" && e.val().length <= 2) {
                e.next().find("span").text("قصير للغاية");
                e.next().slideDown();
                e.next().css({ display: "flex" });
                errors = 1;
            } else {
                e.next().slideUp();
            }
        }
        ifEmpty(name);
        ifEmpty(email);
        ifEmpty(pass);
        ifEmpty(pass2);
        if (errors == 0) {
            if (
                $("#ss").find("input").val() != "" &&
                $("#ss").find("input").val().length > 4 &&
                pass2.val() != pass.val()
            ) {
                pass2.next().find("span").text("كلمة المرور غير متطابقة");
                pass2.next().slideDown();
                pass2.next().css({ display: "flex" });
                errors = 1;
            } else {
                $(".sign-up-btn").hide();
                $(".dis").show();
                var form = $("#ss");
                var inputs = form.find("input");
                var serializedData = form.serialize();
                $.get({
                    url: "validate",
                    data: serializedData,
                    success: function (response) {
                        if (response == "success") {
                            location.href = "log-in";
                        } else {
                            $(".athoo-alert").html(response);
                            $(".athoo-alert").show();
                            $(".sign-up-btn").show();
                            $(".dis").hide();
                        }
                    },
                });
            }
        }
    });

    $("#dark, #day").on("click", function () {
        var link = $(this).data("href");
        $.get({
            url: link,
            success: function (data) {
                location.reload();
            },
        });
    });
    $(".links-info > i").on("click", function (e) {
        if ($(this).next().hasClass("showen") == false) {
            $(".links-hidden").slideUp();
            $(this).next().slideDown();
            $(this).next().addClass("showen");
        } else {
            $(this).next().removeClass("showen");
            $(this).next().slideUp();
        }
    });
    $("#new-link-btn").on("click", function (e) {
        e.preventDefault();

        var form = $("#new-link-form");
        var inputs = form.find("input");
        var serializedData = form.serialize();
        $.get({
            url: "link/new",
            data: serializedData,
            success: function (d) {
                location.href = d + "/stats";
            },
        });
    });
    $("#users .btn-success , .edit").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            form = "#" + id,
            serializedData = $(form).serialize();

        $.get({
            url: "edituser",
            data: serializedData,
            success: function success(r) {
                location.reload();
            },
        });
    });
    $("#users .btn-danger").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        $.get({
            url: "deleteuser",
            data: { id: id },
            success: function success(r) {
                location.reload();
            },
        });
    });
    $(".editpass").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            form = "#editpass",
            serializedData = $(form).serialize();

        $.get({
            url: "editpass",
            data: serializedData,
            success: function success(r) {
                location.reload();
            },
        });
    });
    $(".visitors .select-date").on("change", function () {
        if ($(this).val() == "اليوم") {
            var day = moment().format("YY-MM-DD");
            $.get({
                url: "../day_visits",
                data: { day: day },
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
        }
        if ($(this).val() == "اخر اسبوع") {
            dateTo = moment().format("MM/DD/YYYY");
            dateFrom = moment().subtract(7, "d").format("MM/DD/YYYY");
            $.get({
                url: "../week_visits",
                data: { to: dateTo, from: dateFrom },
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
        }
        if ($(this).val() == "اخر شهر") {
            dateTo = moment().format("MM/DD/YYYY");
            dateFrom = moment().subtract(30, "d").format("MM/DD/YYYY");
            $.get({
                url: "../mounth_visits",
                data: { to: dateTo, from: dateFrom },
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
        }
        if ($(this).val() == "اخر سنة") {
            dateTo = moment().format("MM/DD/YYYY");
            dateFrom = moment().subtract(365, "d").format("MM/DD/YYYY");
            $.get({
                url: "../year_visits",
                data: { to: dateTo, from: dateFrom },
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
        }
        if ($(this).val() == "تاريخ مخصص") {
            $(".date-range").show();
        }
        if ($(this).val() == "الجميع") {
            $.get({
                url: "../visits",
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
        }
    });
    $(".visitors #reservation").on("change", function () {
        if ($(".select-date").val() == "تاريخ مخصص") {
            var data = $(this).val();
            $.get({
                url: "../custom_visits",
                data: { data: data },
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
        }
    });

    $("#copy").on("click", function () {
        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            sampleTextarea.setSelectionRange(0, 99999);
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }

        function myFunction() {
            var copyText = document.getElementById("copylink");
            copyToClipboard(copyText.value);
        }
        myFunction();
        $(".copied").slideDown();
        setTimeout(function () {
            $(".copied").fadeOut();
        }, 2000);
    });

    $("#upload").on("change", function (e) {});
});
