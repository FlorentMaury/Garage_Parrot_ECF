$(document).ready(function () {

    filter_data();

    function filter_data() {
        $('.filter_data').html('<div class="loader">Chargement...</div>');

        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();

        var minimum_year = $('#hidden_minimum_year').val();
        var maximum_year = $('#hidden_maximum_year').val();

        var minimum_km = $('#hidden_minimum_km').val();
        var maximum_km = $('#hidden_maximum_km').val();

        $.ajax({

            url: "./model/modelFilterCars.php",
            method: "POST",
            data: {
                action: action,
                minimum_price: minimum_price,
                maximum_price: maximum_price,
                minimum_year: minimum_year,
                maximum_year: maximum_year,
                minimum_km: minimum_km,
                maximum_km: maximum_km,
            },
            success: function (data) {
                $('.filter_data').html(data);
            }
        });
    }


    $('#price_range').slider({
        range: true,
        min: 100,
        max: 30000,
        values: [100, 30000],
        step: 50,
        stop: function (event, ui) {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

    $('#year_range').slider({
        range: true,
        min: 1980,
        max: 2023,
        values: [1980, 2023],
        step: 1,
        stop: function (event, ui) {
            $('#year_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_year').val(ui.values[0]);
            $('#hidden_maximum_year').val(ui.values[1]);
            filter_data();
        }
    });

    $('#km_range').slider({
        range: true,
        min: 0,
        max: 300000,
        values: [0, 300000],
        step: 1000,
        stop: function (event, ui) {
            $('#km_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_km').val(ui.values[0]);
            $('#hidden_maximum_km').val(ui.values[1]);
            filter_data();
        }
    });
});