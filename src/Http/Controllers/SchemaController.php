<?php 

namespace Armincms\Namayaan\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Armincms\TruthOrDare\Game;
use Illuminate\Http\Request;
use Armincms\RawData\Common;


class SchemaController extends Controller
{  
    public function handle(Request $request)
    {
        return response()->json([  
            'home' => [
                'method' => 'get',
                'path'   => 'namayaan/home',
                'params' => [
                    'per_page' => [
                        'type' => 'integer',
                        'default' => 15,
                        'required' => false,
                    ],
                    'page' => [
                        'type' => 'integer',
                        'default' => 1,
                        'required' => false,
                    ],
                ],
                'response' => [ 
                    'code'  => 200,
                    'params' => [ 
                        'links' => [
                            'first' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                            'last' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                            'prev' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                            'next' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                        ],
                        'meta' => [
                            'current_page' => [
                                'type' => 'integer'
                            ],
                            'from' => [
                                'type' => 'integer'
                            ],
                            'last_page' => [
                                'type' => 'integer'
                            ],
                            'path' => [
                                'type' => 'string', 
                            ],
                            'per_page' => [
                                'type' => 'integer'
                            ],
                            'to' => [
                                'type' => 'integer'
                            ],
                            'total' => [
                                'type' => 'integer'
                            ]
                        ], 
                        'data' => [
                            'type' => 'array[linkObejct]'
                        ], 
                    ],
                    'linkObejct' => [
                        'label' => [
                            'type' => 'string'
                        ],
                        'genre' => [
                            'type' => 'array[integer]'
                        ], 
                        'tag' => [
                            'type' => 'array[integer]'
                        ], 
                        'media' => [
                            'type' => 'array[string]'
                        ], 
                        'data' => [
                            'type' => 'array[mediaListObject]'
                        ], 
                    ],
                ],
            ], 
            'filter' => [
                'method' => 'get',
                'path'   => 'namayaan/filter',
                'params' => [
                    'per_page' => [
                        'type' => 'integer',
                        'default' => 15,
                        'required' => false,
                    ],
                    'page' => [
                        'type' => 'integer',
                        'default' => 1,
                        'required' => false,
                    ],
                    'genre' => [
                        'type' => 'array[integer]'
                    ],
                    'tag' => [
                        'type' => 'array[integer]'
                    ],
                    'media' => [
                        'type' => 'array[string]',
                        'values' => [
                            'movie',
                            'series',
                            'episode'
                        ]
                    ],
                ],
                'response' => [ 
                    'code'  => 200,
                    'params' => [ 
                        'links' => [
                            'first' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                            'last' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                            'prev' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                            'next' => [
                                'type' => 'string',
                                'nullable' => true,
                            ],
                        ],
                        'meta' => [
                            'current_page' => [
                                'type' => 'integer'
                            ],
                            'from' => [
                                'type' => 'integer'
                            ],
                            'last_page' => [
                                'type' => 'integer'
                            ],
                            'path' => [
                                'type' => 'string', 
                            ],
                            'per_page' => [
                                'type' => 'integer'
                            ],
                            'to' => [
                                'type' => 'integer'
                            ],
                            'total' => [
                                'type' => 'integer'
                            ]
                        ], 
                        'data' => [
                            'type' => 'array[mediaListObject]'
                        ], 
                    ], 
                ],
            ],  
            'mediaListObject' => [
                'id' => [
                    'type' => 'integer',
                ],
                'name' => [
                    'type' => 'string',
                ],
                'label' => [
                    'type' => 'string',
                ],
                'group' => [
                    'type' => 'string',
                    'values' => [
                        'movie',
                        'series',
                        'episode',
                    ],
                ],
                'gallery' => [
                    'type' => 'object'
                ], 

            ] 
            'genre' => [ 
                'method' => 'get',
                'path'   => 'namayaan/genre',
                'params' => [],
                'response' => [ 
                    'code'  => 200,
                    'params' => [ 
                        // 'links' => [
                        //     'first' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        //     'last' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        //     'prev' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        //     'next' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        // ],
                        // 'meta' => [
                        //     'current_page' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'from' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'last_page' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'path' => [
                        //         'type' => 'string', 
                        //     ],
                        //     'per_page' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'to' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'total' => [
                        //         'type' => 'integer'
                        //     ]
                        // ], 
                        'data' => [
                            'type' => 'array[genreObejct]'
                        ], 
                    ],
                    'genreObejct' => [
                        'genreId' => [
                            'type' => 'integer'
                        ],
                        'label' => [
                            'type' => 'string'
                        ], 
                    ],
                ], 
            ], 
            'tag' => [ 
                'method' => 'get',
                'path'   => 'namayaan/tag',
                'params' => [],
                'response' => [ 
                    'code'  => 200,
                    'params' => [ 
                        // 'links' => [
                        //     'first' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        //     'last' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        //     'prev' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        //     'next' => [
                        //         'type' => 'string',
                        //         'nullable' => true,
                        //     ],
                        // ],
                        // 'meta' => [
                        //     'current_page' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'from' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'last_page' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'path' => [
                        //         'type' => 'string', 
                        //     ],
                        //     'per_page' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'to' => [
                        //         'type' => 'integer'
                        //     ],
                        //     'total' => [
                        //         'type' => 'integer'
                        //     ]
                        // ], 
                        'data' => [
                            'type' => 'array[tagObejct]'
                        ], 
                    ],
                    'tagObejct' => [
                        'tagId' => [
                            'type' => 'integer'
                        ],
                        'label' => [
                            'type' => 'string'
                        ], 
                    ],
                ], 
            ],  
        ]);
    } 
}
