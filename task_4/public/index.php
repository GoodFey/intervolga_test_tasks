<?php

function cutHtml($html, $wordLimit = 29)
{
    // Создаем новый объект DOMDocument
    $dom = new DOMDocument();

    // Загружаем HTML, подавляя предупреждения
    @$dom->loadHTML('<?xml encoding="utf-8"?><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Получаем тело документа
    $mainNode = $dom->getElementsByTagName('div')->item(0);


    // Обрезаем текст
    $wordsCount = 0;
    $wordsLimitAvailable = true;

    // Рекурсивно обрезаем узлы
    changeNode($mainNode, $wordsCount, $wordLimit, $wordsLimitAvailable);

    // Возвращаем обрезанный HTML
    return $dom->saveHTML($mainNode);
}

function changeNode($node, &$wordsCount, $wordLimit, &$wordsLimitAvailable)
{
    if ($wordsLimitAvailable = true) {

        // Перебираю дочерние узлы у переданного node
        for ($i = 0; $i < $node->childNodes->length; $i++) {

            // Получаю каждого ребенка от переданного нода в переменную
            $currentNode = $node->childNodes->item($i);

            // Если этот элемент является тестовым узлом я его обрабатываю
            // если он содержит html - отправляю его дальше в рекурсию
            if ($currentNode->nodeType === XML_TEXT_NODE) {

                // Разделяю значение нода на отдельные слова в словаре
                $wordsInCurrentNode = explode(' ', trim($currentNode->nodeValue));

                // Добавляю все слова которые укладываются в лимит в новый словарь
                $currentArray = [];
                foreach ($wordsInCurrentNode as $word) {
                    if ($wordsCount >= $wordLimit) {
                        $wordsLimitAvailable = false;

                        break;

                    } elseif ($word != '' && $wordsLimitAvailable = true) {
                        $wordsCount++;
                        $currentArray[] = $word;
                    }
                }
                $currentArray[] = ' ';
                print_r($currentArray);

                // Преобразую словарь в строку и меняю старое значение value у ноды на новое

                $newNodeValue = implode(' ', $currentArray);
                $currentNode->nodeValue = $newNodeValue;

            }

            // Рекурсивно вызываю функцию для текущего ребенка чтобы получить всех его детей и тоже проверить
            changeNode($currentNode, $wordsCount, $wordLimit, $wordsLimitAvailable);
        }


    }
}

$text = <<<HTML
<p class="big">
    Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
    <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
    <span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
    <i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
</p>
HTML;

echo cutHtml($text, 29);
