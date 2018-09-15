function setSessionDate(date) {
    $.post(
        "../php/ajax/set_session_date.php", {
            date: date
        }
    ).done(function (data) {
        window.location.assign("events/");
    });
}

function setSessionHall(hall, redirect) {
    $.post(
        "../php/ajax/set_session_hall.php", {
            hall: hall,
            redirect: redirect,
        }
    ).done(function (data) {
        if (data == "redirect") {window.location.assign('/');}
        else {window.location.reload();}
    });
}

function nextSessionDate(date) {
    $.post(
        "../php/ajax/next_session_date.php", {
            date: date
        }
    ).done(function (data) {
        window.location.reload();
    });
}

function prevSessionDate(date) {
    $.post(
        "../php/ajax/prev_session_date.php", {
            date: date
        }
    ).done(function (data) {
        window.location.reload();
    });
}

function prevPage(url) {
    var pdata;
    $.get(url, function(data) {
        pdata = data;
    });
    return pdata;
}