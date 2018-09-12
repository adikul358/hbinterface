function setSessionDate(date) {
    $.post(
        "../php/set_session_date.php", {
            date: date
        }
    ).done(function (data) {
        window.location.assign("events/");
    });
}

function setSessionHall(hall, redirect) {
    $.post(
        "../php/set_session_hall.php", {
            hall: hall,
            redirect: redirect,
        }
    ).done(function (data) {
        if (data === "redirect") {window.location.assign('/');}
        else {window.location.reload();}
    });
}

function nextSessionDate(date) {
    $.post(
        "../php/next_session_date.php", {
            date: date
        }
    ).done(function (data) {
        window.location.reload();
    });
}

function prevSessionDate(date) {
    $.post(
        "../php/prev_session_date.php", {
            date: date
        }
    ).done(function (data) {
        window.location.reload();
    });
}