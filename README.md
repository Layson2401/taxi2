### Разделение на роуты

- ✔ Вынести singleton в абстрактный класс

- ✔ Доработать регистр. роутов. Возможно сделать методы статичными (эксперемент)

- ✔ Выяснить как работает вывод View

- 
  - Подумать где (в каких классах) работать с авторизацией.
  - Возвращать всегда 1 объект
    ```php
    Response() {headers, body};
    header(response->headers);
    echo response->body;
    ```
**Тестировать с разными поддоменами**
  Проверить сохраняется ли router при переходе по разным поддоменам