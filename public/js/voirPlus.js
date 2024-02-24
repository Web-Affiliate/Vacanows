$(document).ready(function () {
    $(document).on('click', '#charger-plus', function () {
        var offset = $(this).data('offset');
        var total = $(this).data('total');
        $.ajax({
            url: "{{ path('load_more_articles', {'offset': 0}) }}".replace('0', offset),
            type: "GET",
            data: {
                offset: offset
            },
            success: function (response) {
                $('#nouveaux-articles-container').append(response);
                if (offset + 3 >= total) {
                    $('#charger-plus').remove();
                } else {
                    $('#charger-plus').data('offset', offset + 3);
                }
            }
        });
    });
});
