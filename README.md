<h2>Почему расширение .md?</h2>

<h3>Разделение на роуты</h3>
<ul>
<li>
    Вынести singleton в абстрактный класс
</li>

<li>
    Доработать регистр. роутов. Возможно сделать методы статичными (эксперемент)
</li>

<li>
    Выяснить как работает вывод View
</li>

<li>
    <ul>
<li>
Подумать где (в каких классах) работать с авторизацией.
</li>
<li>
Возвращать всегда 1 объект

    Response() {headers, body};
    header(response->headers);
    echo response->body;

</li>
    </ul>

</li>

<li>
    Возвращать всегда 1 объект

    Response() {headers, body};

    header(response->headers);
    echo response->body;

</li>

</ul>