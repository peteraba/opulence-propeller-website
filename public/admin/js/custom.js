$(document).ready(function () {
    const alerts = $('.alert');

    window.setTimeout(
        function () {
            alerts.remove();
        },
        3000
    );
});
