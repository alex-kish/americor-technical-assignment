# Запуск проекта

1. Клонируйте репозиторий
2. Выполните команду ```make install```
3. Выполните команду ```make migrate```

## REST API

В каталоге проекта в директории requests находятся файлы с запросами к API, их можно выполнить в среде PHPStorm.

## Статический анализ и линтеры
В проекте используются phpstan, deptrac и php code style fixer. Эти инструменты могут быть встроенные в процесс доставки кода и\или добавлены в событие pre commit гита.

Для удобства запуска добавлены команды в makefile

```make phpstan-analyse``` Проведет статический анализ кода

```make deptrac-layers-analyse``` Проверит нарушение правил между слоями приложения

```make deptrac-modules-analyse``` Проверит нарушение правил между модулями приложения

```make php-cs-fixer:``` Исправит файлы в соответствии с заданным code style

## Докер
Для удобства управления контейнерами докера добавлены команды

```make start``` соберет и запустит контейнеры в фоне

```make status``` выведет статус по запущенным контейнерам

```make stop``` остановит контейнеры

```make kill``` остановит и удалит все контейнеры и тома

```make clear``` остановит и удалит все контейнеры, тома и папку vendor

## Авто тесты
К сожалению времени на покрытие проекта тестами не хватило, но то немногое что есть можно запустить командой ```make tests```

## ENV и dev tools
В env файлах намерены оставлены конфиги БД, пароли и прочие вещи которых не должно быть в репозитории.

Это сделано намерено для экономии времени.

## Комментарии к задаче
К сожалению задача не была выполнена в полном объеме, она и так отняла сильно больше 4-х часов. Несмотря на это я надеюсь что мое время было потрачено не зря и вы ознакомитесь.

В ходе реализации я испытывал острую нехватку доменных знаний да и просто уточнений, но я решил что это не столь важно.

-----

# Тестовое задание (Payments Team)

В данном тестовом задании мы ожидаем, что вы продемонстрируете умение применять принципы DDD (Domain-Driven Design) и следовать принципам Clean Architecture при проектировании кода. Имейте в виду, что мы не требуем полностью рабочего кода, но ваш код должен быть функциональным на базовом уровне. Это позволит нам оценить ваше понимание принципов программирования, проектирования и качество написанного кода. Мы предполагаем, что выполнение тестового задания займет до 4 часов.

## Детали задачи
Вам нужно разработать код для процесса выдачи кредита. Реализуйте функциональность создания нового клиента, проверки возможности выдачи кредита, принятия решения о выдаче или отказе, а также уведомления клиента о результате.

## Условия выдачи кредита
- Кредитный рейтинг клиента должен быть выше 500.
- Ежемесячный доход клиента должен быть не менее $1000.
- Возраст клиента должен быть от 18 до 60 лет.
- Кредиты выдаются только в штатах CA, NY, NV.
- Клиентам из штата NY отказ производится случайным образом.
- Клиентам из штата Калифорния процентная ставка увеличивается на 11.49%.

## Сущности

### Клиент
- Фамилия
- Имя
- Возраст
- SSN (социальный страховой номер)
- Адрес США (Адрес, Город, Штат, ZIP)
- Кредитный рейтинг FICO (число от 300 до 850)
- Email
- Номер телефона

### Продукт (Кредит)

- Название продукта
- Срок кредита
- Процентная ставка
- Сумма

## Сценарии

- Создание нового клиента.
- Изменение информации о существующем клиенте.
- Предварительная проверка возможности выдачи кредита.
- Выдача кредита:
  - Принятие решения о выдаче или отказе.
  - Уведомление клиента о результате через Email или SMS.

## Требования и ограничения
- Код должен быть размещен в Git-репозитории с предоставлением ссылки.
- Напишите код с использованием PHP версии 8+ и соблюдением стандартов PSR.
- Разрешено использование фреймворков Yii2 или Symfony, а также написание кода без фреймворков.
- Приложение должно работать с любой базой данных или без использования базы данных. Допустимо возвращать данные статически, без выполнения операций записи, если это поможет сократить время реализации.
- Интерфейс взаимодействия с приложением может быть любым: CLI, REST API, веб-интерфейс (HTML).
- Наличие тестов не обязательно, но их наличие будет преимуществом.
- Применение инструментов статического анализа и использование Docker также будут считаться преимуществом.
