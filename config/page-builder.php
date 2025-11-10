<?php

return [
    'blocks' => [
        'image' => [
            'label' => 'Image',
            'description' => 'Display a single media asset with optional caption, alt text, and link.',
            'media' => [
                'mode' => 'single',
                'field' => 'image_id',
            ],
            'fields' => [
                'image_id' => [
                    'type' => 'media',
                    'required' => true,
                ],
                'alt_text' => [
                    'type' => 'string',
                    'required' => false,
                    'max' => 255,
                ],
                'caption' => [
                    'type' => 'string',
                    'required' => false,
                    'max' => 255,
                ],
                'link_url' => [
                    'type' => 'url',
                    'required' => false,
                    'max' => 2048,
                ],
            ],
            'defaults' => [
                'content' => [
                    'image_id' => null,
                    'alt_text' => null,
                    'caption' => null,
                    'link_url' => null,
                ],
            ],
        ],
        'gallery' => [
            'label' => 'Gallery',
            'description' => 'Display a grid of media items with captions.',
            'media' => [
                'mode' => 'collection',
                'field' => 'items',
                'item_field' => 'image_id',
            ],
            'fields' => [
                'items' => [
                    'type' => 'collection',
                    'required' => true,
                    'item_fields' => [
                        'image_id' => [
                            'type' => 'media',
                            'required' => true,
                        ],
                        'caption' => [
                            'type' => 'string',
                            'required' => false,
                            'max' => 255,
                        ],
                        'order' => [
                            'type' => 'integer',
                            'required' => false,
                            'min' => 0,
                        ],
                    ],
                ],
                'columns' => [
                    'type' => 'integer',
                    'required' => false,
                    'min' => 1,
                    'max' => 6,
                ],
            ],
            'defaults' => [
                'content' => [
                    'items' => [],
                    'columns' => 3,
                ],
            ],
        ],
        'slider' => [
            'label' => 'Slider',
            'description' => 'Render a horizontal carousel of media items with captions.',
            'media' => [
                'mode' => 'collection',
                'field' => 'slides',
                'item_field' => 'image_id',
            ],
            'fields' => [
                'slides' => [
                    'type' => 'collection',
                    'required' => true,
                    'item_fields' => [
                        'image_id' => [
                            'type' => 'media',
                            'required' => true,
                        ],
                        'caption' => [
                            'type' => 'string',
                            'required' => false,
                            'max' => 255,
                        ],
                        'order' => [
                            'type' => 'integer',
                            'required' => false,
                            'min' => 0,
                        ],
                    ],
                ],
                'autoplay' => [
                    'type' => 'boolean',
                    'required' => false,
                ],
                'interval' => [
                    'type' => 'integer',
                    'required' => false,
                    'min' => 1000,
                    'max' => 15000,
                ],
            ],
            'defaults' => [
                'content' => [
                    'slides' => [],
                    'autoplay' => true,
                    'interval' => 5000,
                ],
            ],
        ],
    ],
];
