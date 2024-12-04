<?php

class School
{
    static $data = [
        ['Иванов', 'Математика', 5],
        ['Иванов', 'Математика', 4],
        ['Иванов', 'Математика', 5],
        ['Петров', 'Математика', 5],
        ['Сидоров', 'Физика', 4],
        ['Иванов', 'Физика', 4],
        ['Петров', 'ОБЖ', 4],
    ];
    static $students = [];
    static $subjects = [];

    static public function prepareData()
    {
        foreach (self::$data as $items) {
            array_unshift(self::$students, $items[0]);
            array_unshift(self::$subjects, $items[1]);
        }

        self::$students = array_unique(self::$students, 0);
        self::$subjects = array_unique(self::$subjects, 0);

        asort(self::$students);
        asort(self::$subjects);

    }
    static public function getSubjects()
    {
        return self::$subjects;
    }
    static public function getStudents()
    {
        return self::$students;
    }

    public static function getPoint($student, $subject)
    {
        $point = null;
        foreach (self::$data as $items)
        {
            if ($items[0] == $student && $items[1] == $subject)
            {
                $point += $items[2];
            }
        }
        return $point;
    }
}
