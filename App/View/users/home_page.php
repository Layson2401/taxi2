<!DOCTYPE html>
<html lang="ru_RU">
<head>
    <title>Быстрый старт. Размещение интерактивной карты на странице</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU"></script>
    <script>
        ymaps.ready(init);
        function init() {

            var myMap = new ymaps.Map("map", {
                center: [55.7787, 49.1621],
                zoom: 13
            }, {
                searchControlProvider: 'yandex#search'
            });
        }
    </script>
</head>

<body>
<div id="map" style="width: 100%; height: 600px"></div>
</body>
</html>