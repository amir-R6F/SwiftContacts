<?php
namespace App\R6f;

class MyCustomization{
    public static function option()
    {
        $static_field = [
            "value" => [
                "name" => "",
                "last_name" => "",
                "number" => "",
            ],
            "rules" => [
                "name" => "minmax:1,50|required",
                "last_name" => "",
                "number" => "standard",
            ],
            "fields_name" => [
                "name" => "*name",
                "last_name" => "last_name",
                "number" => "phone",
            ]
        ];
        $dynamic_field = [
            [
                "title" => "email",
                "fields" => [
                    [
                        "label" => "personal email",
                        "option" => [
                            "id" => 0,
                            "field_name" => "personal-email",
                            "rule" => "",
                            "value" => "",
                            "type" => "email"
                        ]
                    ],
                    [
                        "label" => "work email",
                        "option" => [
                            "id" => 0,
                            "field_name" => "work-email",
                            "rule" => "",
                            "value" => "",
                            "type" => "email",
                        ]
                    ],
                ],
            ],
            [
                "title" => "phone",
                "fields" => [
                    'personal_number' => [
                        "label" => "personal number",
                        "option" => [
                            "id" => 0,
                            "field_name" => "personal-number",
                            "rule" => "standard|required",
                            "value" => "",
                            "type" => "phone",
                        ]
                    ],
                    'home_number' => [
                        "label" => "home number",
                        "option" => [
                            "id" => 0,
                            "field_name" => "home-number",
                            "rule" => "",
                            "value" => "",
                            "type" => "phone",
                        ]
                    ],
                    'work_number' => [
                        "label" => "work number",
                        "option" => [
                            "id" => 0,
                            "field_name" => "work-number",
                            "rule" => "",
                            "value" => "",
                            "type" => "phone",
                        ]
                    ],
                ]
            ],
            [
                "title" => "other",
                "fields" => [
                    [
                        "label" => "other option",
                        "option" => [
                            "id" => 0,
                            "field_name" => "",
                            "rule" => "",
                            "value" => "",
                            "type" => "other",
                        ]
                    ]
                ]
            ],
        ];
        return ["static" => $static_field, "dynamic" => $dynamic_field];

    }
}
