<?
$arr = [
    'acce' =>[
        'css' => [
            'name' => 'style.css',
            'schedules' => ['schedules.css',],
            'evaluations' => ['evaluations.css', ],
            'students' => ['students.css', ],
            'groups' => ['groups.css', ],
        ],
        'js' => [
            'name' => 'script.js',
            'schedules' => ['schedules.js',],
        ]
    ],
    'main' => [
        'page' => 'main', 
        'html'=>'main.html', 
        'ru' => 'Главная',       
    ],
    'schedules' => [
        'page' => 'schedules',
        'html'=>'schedules.html',
        'ru' => 'Предметы',
        'sub' => [
            'page22' => ['page' => 'page22', 'html'=>'pages/pages_schedules22.html', 'ru' => 'page22'],
            'page23' => ['page' => 'page23', 'html'=>'pages/pages_schedules.html', 'ru' => 'page23','sub' => [
                'page222' => ['page' => 'page222', 'html'=>'pages/pages_students.html', 'ru' => 'page222'],
                'page223' => ['page' => 'page223', 'html'=>'pages/pages_students.html', 'ru' => 'page223'],
                'page224' => ['page' => 'page224', 'html'=>'pages/pages_students.html', 'ru' => 'page224'],
            ],],
            'page24' => ['page' => 'page24', 'html'=>'pages/pages_schedules.html', 'ru' => 'page24'],
            'page25' => [
                'page' => 'page25', 
                'html'=>'pages/pages_schedules.html', 
                'ru' => 'page25',
                'sub' => [
                    'page222' => ['page' => 'page222', 'html'=>'pages/pages_students.html', 'ru' => 'page222'],
                    'page223' => ['page' => 'page223', 'html'=>'pages/pages_students.html', 'ru' => 'page223'],
                    'page224' => ['page' => 'page224', 'html'=>'pages/pages_students.html', 'ru' => 'page224'],
                ],
            ],
        ]
    ],
    'evaluations' => [
        'page' => 'evaluations', 
        'html'=>'evaluations.html', 
        'ru' => 'Оценки',
        'sub' => [
            'page22' => ['page' => 'page22', 'html'=>'pages/pages_evaluations.html', 'ru' => 'page22'],
            'page23' => ['page' => 'page23', 'html'=>'pages/pages_evaluations.html', 'ru' => 'page23'],
            'page24' => ['page' => 'page24', 'html'=>'pages/pages_evaluations.html', 'ru' => 'page24'],
            'page25' => ['page' => 'page25', 'html'=>'pages/pages_evaluations.html', 'ru' => 'page25','sub' => [
                'page222' => ['page' => 'page222', 'html'=>'pages/pages_students.html', 'ru' => 'page222'],
                'page223' => ['page' => 'page223', 'html'=>'pages/pages_students.html', 'ru' => 'page223'],
                'page224' => ['page' => 'page224', 'html'=>'pages/pages_students.html', 'ru' => 'page224'],
            ],],
        ]
    ],
    'students' => [
        'page' => 'students', 
        'html'=>'students.html', 
        'ru' => 'Студенты',
        'sub' => [
            'page22' => ['page' => 'page22', 'html'=>'pages/pages_students.html', 'ru' => 'page22'],
            'page23' => ['page' => 'page23', 'html'=>'pages/pages_students.html', 'ru' => 'page23'],
            'page24' => ['page' => 'page24', 'html'=>'pages/pages_students.html', 'ru' => 'page24'],
            'page25' => [
                'page' => 'page25', 
                'html'=>'pages/pages_students.html', 
                'ru' => 'page25',
                'sub' => [
                    'page222' => ['page' => 'page222', 'html'=>'pages/pages_students.html', 'ru' => 'page222'],
                    'page223' => ['page' => 'page223', 'html'=>'pages/pages_students.html', 'ru' => 'page223'],
                    'page224' => ['page' => 'page224', 'html'=>'pages/pages_students.html', 'ru' => 'page224'],
                ],
            ],
        ]
    ],
    'groups' => [
        'page' => 'groups', 
        'html'=>'groups.html', 
        'ru' => 'Группы',
        'sub' => [
            'page22' => ['page' => 'page22', 'html'=>'pages/pages_groups.html', 'ru' => 'page22'],
            'page23' => ['page' => 'page23', 'html'=>'pages/pages_groups.html', 'ru' => 'page23'],
            'page24' => ['page' => 'page24', 'html'=>'pages/pages_groups.html', 'ru' => 'page24'],
            'page25' => ['page' => 'page25', 'html'=>'pages/pages_groups.html', 'ru' => 'page25','sub' => [
                'page222' => ['page' => 'page22', 'html'=>'pages/pages_students.html', 'ru' => 'page222'],
                'page223' => ['page' => 'page23', 'html'=>'pages/pages_students.html', 'ru' => 'page223'],
                'page224' => ['page' => 'page24', 'html'=>'pages/pages_students.html', 'ru' => 'page224'],
            ],],
        ]
    ],
    'registration' => [
        'page' => 'registration',
        'html' => 'registration.html',
        'ru' => 'Регистрация',
        'cook' => 'registration'
    ],
];