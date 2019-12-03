<?php
if (!getenv('COMSPEC')) {
    //exit(0);
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

$data = [
    'Полное наименование'                                 => 'Общество с ограниченной ответственностью «Торговый Дом «Континент»',
    'Сокращенное наименование'                            => 'ООО «ТД «Континент»',
    'Юридический адрес'                                   => '129164, г. Москва, бул. Ракетный, д. 14',
    'Фактический и почтовый адрес'                        => '101000 г. Москва, Большой Спасоглинищевский пер., д. 9/1 стр. 10, помещение 1, комната № 2',
    'e-mail'                                              => '<a href="mailto:info.continent@mail.ru">info.continent@mail.ru</a>',
    'ФИО, должность руководителя, основание для действия' => 'Знак Сергей Николаевич, генеральный директор, действует на основании Устава',
    'ИНН/КПП'                                             => '7717618675/771701001',
    'ОГРН'                                                => '1087746577148',
    'ОКПО'                                                => '86413639',
    'ОКАТО'                                               => '45280552000',
    'ОКТМО'                                               => '45349000000',
    'ОКВЭД'                                               => '51.3, 51.2, 51.4, 51.5, 52.1, 52.2, 52.3, 52.4, 52.6',
    '<h4>Банковские реквизиты</h4>'                       => '',
    'Наименование банка'                                  => 'ПАО «Сбербанк » г . Москва',
    'Корреспондентский счет'                              => '30101810400000000225',
    'БИК'                                                 => '044525225',
    'Расчетный счет'                                      => '40702810738000046003',
];

require_once 'main.php';
