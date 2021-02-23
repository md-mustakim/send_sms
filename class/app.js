function refresh() {
    var paths = window.location.href;
    setTimeout(function () {
        window.location.href = paths;
        alert("successfully created");
    }, 2000)
}


