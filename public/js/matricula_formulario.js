document.addEventListener('DOMContentLoaded', () => {

    const DB_COLEGIO = {
        primaria: {
            "1": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "2": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "3": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "4": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "5": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "6": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
        },
        secundaria: {
            "1": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "2": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "3": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "4":    {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
            "5": {
                secciones: {
                    "A": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "B": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "C": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" },
                    "D": { mañana: "7:00 AM - 12:00 PM", tarde: "12:45 PM - 6:00 PM" }
                }
            },
        }
    };

    const DB_CICLOS = {
        unu: {
            verano: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "v1_m", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_m", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "v1_t", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_t", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ]
                },
            },
            semestral: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "s1_m", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_m", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "s1_t", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_t", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
            anual: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "a1_m", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_m", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "a1_t", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_t", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
        },
        unia: {
            verano: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "v1_m", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_m", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "v1_t", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_t", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ]
                },
            },
            semestral: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "s1_m", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_m", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "s1_t", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_t", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
            anual: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "a1_m", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_m", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "a1_t", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_t", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
        },
        san_marcos: {
            verano: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "v1_m", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_m", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "v1_t", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_t", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ]
                },
            },
            semestral: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "s1_m", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_m", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "s1_t", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_t", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
            anual: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "a1_m", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_m", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "a1_t", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_t", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
        },
        uni: {
            verano: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "v1_m", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_m", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "v1_t", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_t", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ]
                },
            },
            semestral: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "s1_m", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_m", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "s1_t", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_t", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
            anual: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "a1_m", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_m", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "a1_t", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_t", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
        },
        catolica: {
            verano: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "v1_m", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_m", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "v1_t", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "v2_t", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" }
                    ]
                },
            },
            semestral: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "s1_m", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_m", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "s1_t", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "s2_t", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
            anual: {
                mañana: {
                    horario: "7:00 AM - 12:00 PM",
                    grupos: [
                        { id: "a1_m", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_m", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ],
                },
                tarde: {
                    horario: "12:45 PM - 5:00 PM",
                    grupos: [
                        { id: "a1_t", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                        { id: "a2_t", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
                    ]
                },
            },
        },
    };

    const DB_CRONOGRAMAS = {
        unu: {
            mañana: {
                "v1_m": [
                    { c: "CUOTA 1 UNU M", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNU M", f: "30/04/2026", i: 200 },
                    { c: "CUOTA 3 UNU M", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNU M", f: "30/06/2026", i: 200 }
                ],
                "v2_m": [
                    { c: "CUOTA 1 UNU M II", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNU M II", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNU M II", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNU M II", f: "31/06/2026", i: 250 }
                ],
                "s1_m": [
                    { c: "CUOTA 1 UNU M", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNU M", f: "30/04/2026", i: 200 },
                    { c: "CUOTA 3 UNU M", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNU M", f: "30/06/2026", i: 200 }
                ],
                "s2_m": [
                    { c: "CUOTA 1 UNU M II", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNU M II", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNU M II", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNU M II", f: "31/06/2026", i: 250 }
                ],
                "a1_m": [
                    { c: "CUOTA 1 UNU M", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNU M", f: "30/04/2026", i: 200 },
                    { c: "CUOTA 3 UNU M", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNU M", f: "30/06/2026", i: 200 }
                ],
                "a2_m": [
                    { c: "CUOTA 1 UNU M II", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNU M II", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNU M II", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNU M II", f: "31/06/2026", i: 250 }
                ]
            },
            tarde: {
                "v1_t": [
                    { c: "CUOTA 1 UNU T", f: "31/03/2026", i: 180 },
                    { c: "CUOTA 2 UNU T", f: "31/04/2026", i: 180 },
                    { c: "CUOTA 3 UNU T", f: "31/05/2026", i: 180 },
                    { c: "CUOTA 4 UNU T", f: "31/06/2026", i: 180 }
                ],
                "v2_t": [
                    { c: "CUOTA 1 UNU T II", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNU T II", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNU T II", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNU T II", f: "31/06/2026", i: 190 }
                ],
                "s1_t": [
                    { c: "CUOTA 1 UNU T", f: "31/03/2026", i: 180 },
                    { c: "CUOTA 2 UNU T", f: "31/04/2026", i: 180 },
                    { c: "CUOTA 3 UNU T", f: "31/05/2026", i: 180 },
                    { c: "CUOTA 4 UNU T", f: "31/06/2026", i: 180 }
                ],
                "s2_t": [
                    { c: "CUOTA 1 UNU T II", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNU T II", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNU T II", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNU T II", f: "31/06/2026", i: 190 }
                ],
                "a1_t": [
                    { c: "CUOTA 1 UNU T", f: "31/03/2026", i: 180 },
                    { c: "CUOTA 2 UNU T", f: "31/04/2026", i: 180 },
                    { c: "CUOTA 3 UNU T", f: "31/05/2026", i: 180 },
                    { c: "CUOTA 4 UNU T", f: "31/06/2026", i: 180 }
                ],
                "a2_t": [
                    { c: "CUOTA 1 UNU T II", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNU T II", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNU T II", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNU T II", f: "31/06/2026", i: 190 }
                ]
            },
        },
        unia: {
            mañana: {
                "v1_m": [
                    { c: "CUOTA 1 UNIA M", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 UNIA M", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 UNIA M", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 UNIA M", f: "31/06/2026", i: 210 }
                ],
                "v2_m": [
                    { c: "CUOTA 1 UNIA M II", f: "31/03/2026", i: 220 },
                    { c: "CUOTA 2 UNIA M II", f: "31/04/2026", i: 220 },
                    { c: "CUOTA 3 UNIA M II", f: "31/05/2026", i: 220 },
                    { c: "CUOTA 4 UNIA M II", f: "31/06/2026", i: 220 }
                ],
                "s1_m": [
                    { c: "CUOTA 1 UNIA M", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 UNIA M", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 UNIA M", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 UNIA M", f: "31/06/2026", i: 210 }
                ],
                "s2_m": [
                    { c: "CUOTA 1 UNIA M II", f: "31/03/2026", i: 220 },
                    { c: "CUOTA 2 UNIA M II", f: "31/04/2026", i: 220 },
                    { c: "CUOTA 3 UNIA M II", f: "31/05/2026", i: 220 },
                    { c: "CUOTA 4 UNIA M II", f: "31/06/2026", i: 220 }
                ],
                "a1_m": [
                    { c: "CUOTA 1 UNIA M", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 UNIA M", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 UNIA M", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 UNIA M", f: "31/06/2026", i: 210 }
                ],
                "a2_m": [
                    { c: "CUOTA 1 UNIA M II", f: "31/03/2026", i: 220 },
                    { c: "CUOTA 2 UNIA M II", f: "31/04/2026", i: 220 },
                    { c: "CUOTA 3 UNIA M II", f: "31/05/2026", i: 220 },
                    { c: "CUOTA 4 UNIA M II", f: "31/06/2026", i: 220 }
                ]
            },
            tarde: {
                "v1_t": [
                    { c: "CUOTA 1 UNIA T", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNIA T", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNIA T", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNIA T", f: "31/06/2026", i: 190 }
                ],
                "v2_t": [
                    { c: "CUOTA 1 UNIA T II", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNIA T II", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 UNIA T II", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNIA T II", f: "31/06/2026", i: 200 }
                ],
                "s1_t": [
                    { c: "CUOTA 1 UNIA T", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNIA T", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNIA T", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNIA T", f: "31/06/2026", i: 190 }
                ],
                "s2_t": [
                    { c: "CUOTA 1 UNIA T II", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNIA T II", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 UNIA T II", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNIA T II", f: "31/06/2026", i: 200 }
                ],
                "a1_t": [
                    { c: "CUOTA 1 UNIA T", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNIA T", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNIA T", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNIA T", f: "31/06/2026", i: 190 }
                ],
                "a2_t": [
                    { c: "CUOTA 1 UNIA T II", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNIA T II", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 UNIA T II", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNIA T II", f: "31/06/2026", i: 200 }
                ]
            },
        },
        san_marcos: {
            mañana: {
                "v1_m": [
                    { c: "CUOTA 1 UNMSM M", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNMSM M", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNMSM M", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNMSM M", f: "31/06/2026", i: 250 }
                ],
                "v2_m": [
                    { c: "CUOTA 1 UNMSM M II", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNMSM M II", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNMSM M II", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNMSM M II", f: "31/06/2026", i: 260 }
                ],
                "s1_m": [
                    { c: "CUOTA 1 UNMSM M", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNMSM M", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNMSM M", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNMSM M", f: "31/06/2026", i: 250 }
                ],
                "s2_m": [
                    { c: "CUOTA 1 UNMSM M II", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNMSM M II", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNMSM M II", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNMSM M II", f: "31/06/2026", i: 260 }
                ],
                "a1_m": [
                    { c: "CUOTA 1 UNMSM M", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNMSM M", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNMSM M", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNMSM M", f: "31/06/2026", i: 250 }
                ],
                "a2_m": [
                    { c: "CUOTA 1 UNMSM M II", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNMSM M II", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNMSM M II", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNMSM M II", f: "31/06/2026", i: 260 }
                ]
            },
            tarde: {
                "v1_t": [
                    { c: "CUOTA 1 UNMSM T", f: "31/03/2026", i: 230 },
                    { c: "CUOTA 2 UNMSM T", f: "31/04/2026", i: 230 },
                    { c: "CUOTA 3 UNMSM T", f: "31/05/2026", i: 230 },
                    { c: "CUOTA 4 UNMSM T", f: "31/06/2026", i: 230 }
                ],
                "v2_t": [
                    { c: "CUOTA 1 UNMSM T II", f: "31/03/2026", i: 240 },
                    { c: "CUOTA 2 UNMSM T II", f: "31/04/2026", i: 240 },
                    { c: "CUOTA 3 UNMSM T II", f: "31/05/2026", i: 240 },
                    { c: "CUOTA 4 UNMSM T II", f: "31/06/2026", i: 240 }
                ],
                "s1_t": [
                    { c: "CUOTA 1 UNMSM T", f: "31/03/2026", i: 230 },
                    { c: "CUOTA 2 UNMSM T", f: "31/04/2026", i: 230 },
                    { c: "CUOTA 3 UNMSM T", f: "31/05/2026", i: 230 },
                    { c: "CUOTA 4 UNMSM T", f: "31/06/2026", i: 230 }
                ],
                "s2_t": [
                    { c: "CUOTA 1 UNMSM T II", f: "31/03/2026", i: 240 },
                    { c: "CUOTA 2 UNMSM T II", f: "31/04/2026", i: 240 },
                    { c: "CUOTA 3 UNMSM T II", f: "31/05/2026", i: 240 },
                    { c: "CUOTA 4 UNMSM T II", f: "31/06/2026", i: 240 }
                ],
                "a1_t": [
                    { c: "CUOTA 1 UNMSM T", f: "31/03/2026", i: 230 },
                    { c: "CUOTA 2 UNMSM T", f: "31/04/2026", i: 230 },
                    { c: "CUOTA 3 UNMSM T", f: "31/05/2026", i: 230 },
                    { c: "CUOTA 4 UNMSM T", f: "31/06/2026", i: 230 }
                ],
                "a2_t": [
                    { c: "CUOTA 1 UNMSM T II", f: "31/03/2026", i: 240 },
                    { c: "CUOTA 2 UNMSM T II", f: "31/04/2026", i: 240 },
                    { c: "CUOTA 3 UNMSM T II", f: "31/05/2026", i: 240 },
                    { c: "CUOTA 4 UNMSM T II", f: "31/06/2026", i: 240 }
                ]
            },
        },
        uni: {
            mañana: {
                "v1_m": [
                    { c: "CUOTA 1 UNI M", f: "31/03/2026", i: 280 },
                    { c: "CUOTA 2 UNI M", f: "31/04/2026", i: 280 },
                    { c: "CUOTA 3 UNI M", f: "31/05/2026", i: 280 },
                    { c: "CUOTA 4 UNI M", f: "31/06/2026", i: 280 }
                ],
                "v2_m": [
                    { c: "CUOTA 1 UNI M II", f: "31/03/2026", i: 290 },
                    { c: "CUOTA 2 UNI M II", f: "31/04/2026", i: 290 },
                    { c: "CUOTA 3 UNI M II", f: "31/05/2026", i: 290 },
                    { c: "CUOTA 4 UNI M II", f: "31/06/2026", i: 290 }
                ],
                "s1_m": [
                    { c: "CUOTA 1 UNI M", f: "31/03/2026", i: 280 },
                    { c: "CUOTA 2 UNI M", f: "31/04/2026", i: 280 },
                    { c: "CUOTA 3 UNI M", f: "31/05/2026", i: 280 },
                    { c: "CUOTA 4 UNI M", f: "31/06/2026", i: 280 }
                ],
                "s2_m": [
                    { c: "CUOTA 1 UNI M II", f: "31/03/2026", i: 290 },
                    { c: "CUOTA 2 UNI M II", f: "31/04/2026", i: 290 },
                    { c: "CUOTA 3 UNI M II", f: "31/05/2026", i: 290 },
                    { c: "CUOTA 4 UNI M II", f: "31/06/2026", i: 290 }
                ],
                "a1_m": [
                    { c: "CUOTA 1 UNI M", f: "31/03/2026", i: 280 },
                    { c: "CUOTA 2 UNI M", f: "31/04/2026", i: 280 },
                    { c: "CUOTA 3 UNI M", f: "31/05/2026", i: 280 },
                    { c: "CUOTA 4 UNI M", f: "31/06/2026", i: 280 }
                ],
                "a2_m": [
                    { c: "CUOTA 1 UNI M II", f: "31/03/2026", i: 290 },
                    { c: "CUOTA 2 UNI M II", f: "31/04/2026", i: 290 },
                    { c: "CUOTA 3 UNI M II", f: "31/05/2026", i: 290 },
                    { c: "CUOTA 4 UNI M II", f: "31/06/2026", i: 290 }
                ]
            },
            tarde: {
                "v1_t": [
                    { c: "CUOTA 1 UNI T", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNI T", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNI T", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNI T", f: "31/06/2026", i: 260 }
                ],
                "v2_t": [
                    { c: "CUOTA 1 UNI T II", f: "31/03/2026", i: 270 },
                    { c: "CUOTA 2 UNI T II", f: "31/04/2026", i: 270 },
                    { c: "CUOTA 3 UNI T II", f: "31/05/2026", i: 270 },
                    { c: "CUOTA 4 UNI T II", f: "31/06/2026", i: 270 }
                ],
                "s1_t": [
                    { c: "CUOTA 1 UNI T", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNI T", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNI T", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNI T", f: "31/06/2026", i: 260 }
                ],
                "s2_t": [
                    { c: "CUOTA 1 UNI T II", f: "31/03/2026", i: 270 },
                    { c: "CUOTA 2 UNI T II", f: "31/04/2026", i: 270 },
                    { c: "CUOTA 3 UNI T II", f: "31/05/2026", i: 270 },
                    { c: "CUOTA 4 UNI T II", f: "31/06/2026", i: 270 }
                ],
                "a1_t": [
                    { c: "CUOTA 1 UNI T", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNI T", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNI T", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNI T", f: "31/06/2026", i: 260 }
                ],
                "a2_t": [
                    { c: "CUOTA 1 UNI T II", f: "31/03/2026", i: 270 },
                    { c: "CUOTA 2 UNI T II", f: "31/04/2026", i: 270 },
                    { c: "CUOTA 3 UNI T II", f: "31/05/2026", i: 270 },
                    { c: "CUOTA 4 UNI T II", f: "31/06/2026", i: 270 }
                ]
            },
        },
        catolica: {
            mañana: {
                "v1_m": [
                    { c: "CUOTA 1 Católica M", f: "31/03/2026", i: 300 },
                    { c: "CUOTA 2 Católica M", f: "31/04/2026", i: 300 },
                    { c: "CUOTA 3 Católica M", f: "31/05/2026", i: 300 },
                    { c: "CUOTA 4 Católica M", f: "31/06/2026", i: 300 }
                ],
                "v2_m": [
                    { c: "CUOTA 1 Católica M II", f: "31/03/2026", i: 400 },
                    { c: "CUOTA 2 Católica M II", f: "31/04/2026", i: 400 },
                    { c: "CUOTA 3 Católica M II", f: "31/05/2026", i: 400 },
                    { c: "CUOTA 4 Católica M II", f: "31/06/2026", i: 400 }
                ],
                "s1_m": [
                    { c: "CUOTA 1 Católica M", f: "31/03/2026", i: 300 },
                    { c: "CUOTA 2 Católica M", f: "31/04/2026", i: 300 },
                    { c: "CUOTA 3 Católica M", f: "31/05/2026", i: 300 },
                    { c: "CUOTA 4 Católica M", f: "31/06/2026", i: 300 }
                ],
                "s2_m": [
                    { c: "CUOTA 1 Católica M II", f: "31/03/2026", i: 400 },
                    { c: "CUOTA 2 Católica M II", f: "31/04/2026", i: 400 },
                    { c: "CUOTA 3 Católica M II", f: "31/05/2026", i: 400 },
                    { c: "CUOTA 4 Católica M II", f: "31/06/2026", i: 400 }
                ],
                "a1_m": [
                    { c: "CUOTA 1 Católica M", f: "31/03/2026", i: 300 },
                    { c: "CUOTA 2 Católica M", f: "31/04/2026", i: 300 },
                    { c: "CUOTA 3 Católica M", f: "31/05/2026", i: 300 },
                    { c: "CUOTA 4 Católica M", f: "31/06/2026", i: 300 }
                ],
                "a2_m": [
                    { c: "CUOTA 1 Católica M II", f: "31/03/2026", i: 400 },
                    { c: "CUOTA 2 Católica M II", f: "31/04/2026", i: 400 },
                    { c: "CUOTA 3 Católica M II", f: "31/05/2026", i: 400 },
                    { c: "CUOTA 4 Católica M II", f: "31/06/2026", i: 400 }
                ]
            },
            tarde: {
                "v1_t": [
                    { c: "CUOTA 1 Católica T", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 Católica T", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 Católica T", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 Católica T", f: "31/06/2026", i: 200 }
                ],
                "v2_t": [
                    { c: "CUOTA 1 Católica T II", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 Católica T II", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 Católica T II", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 Católica T II", f: "31/06/2026", i: 210 }
                ],
                "s1_t": [
                    { c: "CUOTA 1 Católica T", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 Católica T", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 Católica T", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 Católica T", f: "31/06/2026", i: 200 }
                ],
                "s2_t": [
                    { c: "CUOTA 1 Católica T II", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 Católica T II", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 Católica T II", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 Católica T II", f: "31/06/2026", i: 210 }
                ],
                "a1_t": [
                    { c: "CUOTA 1 Católica T", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 Católica T", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 Católica T", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 Católica T", f: "31/06/2026", i: 200 }
                ],
                "a2_t": [
                    { c: "CUOTA 1 Católica T II", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 Católica T II", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 Católica T II", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 Católica T II", f: "31/06/2026", i: 210 }
                ]
            },
        },
    };

    const selectorModalidad = document.getElementById('modalidadSelector');
    const secAcademia = document.getElementById('section-academia');
    const secColegio = document.getElementById('section-colegio');
    const footerActions = document.getElementById('footer-actions');
    const uniSelect = document.getElementById('universidadSelector');
    const turnoSelect = document.getElementById('turnoAcademiaSelector');
    const ciclosCont = document.getElementById('ciclos-container');
    const cronogramaCont = document.getElementById('cronograma-container');
    const cronogramaBody = document.getElementById('cronograma-body');
    const nivelSelect = document.getElementById('nivel_escolar');
    const gradoSelect = document.getElementById('grado_escolar');
    const seccionSelect = document.getElementById('seccion_escolar');
    const turnoEscolarSelect = document.getElementById('turno_escolar');
    const btnContinuar = document.querySelector('.btn-premium-next');
    const welcomeCard = document.getElementById('welcome-card');
    const step2Colegio = document.getElementById('step-2-colegio');
    const step2Academia = document.getElementById('step-2-academia');
    const templateCiclo = document.getElementById('template-ciclo');
    const tipoCicloSelect = document.getElementById('tipoCicloSelector');

    function limpiarSelector(selector) {
        selector.options.length = 1;
        selector.selectedIndex = 0;

        const optionDefault = selector.options[0];

        if (selector.id === "grado_escolar") optionDefault.textContent = "Seleccionar Grado";
        if (selector.id === "seccion_escolar") optionDefault.textContent = "Seleccionar Sección";
        if (selector.id === "turno_escolar") optionDefault.textContent = "Turno de Estudio";
    }

    function validarPaso1() {
        const modalidad = selectorModalidad.value;
        let esValido = false;

        if (modalidad === 'colegio') {
            esValido = nivelSelect.value !== "" &&
                       gradoSelect.value !== "" &&
                       seccionSelect.value !== "" &&
                       turnoEscolarSelect.value !== "";
        }
        else if (modalidad === 'academia') {
            const selectsValidos = uniSelect.value !== "" && tipoCicloSelect.value !== "" && turnoSelect.value !== "";

            const cicloSeleccionado = document.querySelector('input[name="ciclo_op"]:checked');
            const pagoSeleccionado = document.querySelector('input[name="p"]:checked');

            esValido = selectsValidos && cicloSeleccionado !== null && pagoSeleccionado !== null;
        }

        if (btnContinuar) {
            btnContinuar.disabled = !esValido;
        }
    }

    selectorModalidad.addEventListener('change', function() {
        limpiarSecciones();

        secAcademia.classList.add('hidden-section');
        secColegio.classList.add('hidden-section');
        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');
        footerActions.classList.add('hidden-section');

        if (this.value === 'academia') {
            secAcademia.classList.remove('hidden-section');
            footerActions.classList.remove('hidden-section');

        } else if (this.value === 'colegio') {
            secColegio.classList.remove('hidden-section');
            footerActions.classList.remove('hidden-section');

            nivelSelect.selectedIndex = 0;

        }

        validarPaso1();
    });

    nivelSelect.addEventListener('change', function() {
        limpiarSelector(gradoSelect);
        gradoSelect.length = 1;
        gradoSelect.disabled = false;

        seccionSelect.selectedIndex = 0;
        seccionSelect.disabled = true;

        turnoEscolarSelect.selectedIndex = 0;
        turnoEscolarSelect.disabled = true;

        const maxGrado = (this.value === 'primaria') ? 6 : 5;

        for (let i = 1; i <= maxGrado; i++) {
            const sufijo = (i === 1 || i === 3) ? "ero" : (i === 2) ? "do" : "to";
            const textoGrado = `${i}${sufijo}`;

            gradoSelect.add(new Option(textoGrado, i));
        }

        validarPaso1();
    });

    gradoSelect.addEventListener('change', function() {
        const nivel = nivelSelect.value;
        const grado = this.value;

        seccionSelect.length = 1;
        turnoEscolarSelect.length = 1;

        turnoEscolarSelect.disabled = true;

        const seccionesDisponibles = DB_COLEGIO[nivel][grado].secciones;

        Object.keys(seccionesDisponibles).forEach(letra => {
            seccionSelect.add(new Option(`Sección ${letra}`, letra));
        });

        seccionSelect.disabled = false;

        validarPaso1();
    });

    seccionSelect.addEventListener('change', function() {
        const nivel = nivelSelect.value;
        const grado = gradoSelect.value;
        const letraSeccion = this.value;

        turnoEscolarSelect.length = 1;

        const horariosDisponibles = DB_COLEGIO[nivel][grado].secciones[letraSeccion];

        if (horariosDisponibles) {
            if (horariosDisponibles.mañana) {
                turnoEscolarSelect.add(new Option(`Mañana (${horariosDisponibles.mañana})`, "mañana"));
            }
            if (horariosDisponibles.tarde) {
                turnoEscolarSelect.add(new Option(`Tarde (${horariosDisponibles.tarde})`, "tarde"));
            }

            turnoEscolarSelect.disabled = false;
        } else {
            turnoEscolarSelect.disabled = true;
        }

        validarPaso1();
    });

    turnoEscolarSelect.addEventListener('change', validarPaso1);

    uniSelect.addEventListener('change', function() {
        const uniId = this.value;
        limpiarSelector(tipoCicloSelect);
        limpiarSelector(turnoSelect);

        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');

        if (uniId && DB_CICLOS[uniId]) {
            tipoCicloSelect.disabled = false;
            turnoSelect.disabled = true;

            const tiposDisponibles = Object.keys(DB_CICLOS[uniId]);

            tiposDisponibles.forEach(tipo => {
                const nombreFormateado = "Ciclo " + tipo.charAt(0).toUpperCase() + tipo.slice(1);
                tipoCicloSelect.add(new Option(nombreFormateado, tipo));
            });
        } else {
            tipoCicloSelect.disabled = true;
            turnoSelect.disabled = true;
        }

        validarPaso1();
    });

    tipoCicloSelect.addEventListener('change', function() {
        const uniId = uniSelect.value;
        const tipoId = this.value;

        limpiarSelector(turnoSelect);

        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');

        const configTurnos = (DB_CICLOS[uniId] && DB_CICLOS[uniId][tipoId])
                             ? DB_CICLOS[uniId][tipoId] : null;

        if (configTurnos) {
            turnoSelect.disabled = false;

            Object.keys(configTurnos).forEach(turnoKey => {
                const data = configTurnos[turnoKey];

                const labelTurno = turnoKey.charAt(0).toUpperCase() + turnoKey.slice(1);

                const textoConHorario = `${labelTurno} (${data.horario})`;

                turnoSelect.add(new Option(textoConHorario, turnoKey));
            });
        } else {
            turnoSelect.disabled = true;
        }

        validarPaso1();
    });

    function renderizarCiclos() {
        const uniId = uniSelect.value;
        const tipoId = tipoCicloSelect.value;
        const turnoId = turnoSelect.value;

        const configDelTurno = (DB_CICLOS[uniId] && DB_CICLOS[uniId][tipoId] && DB_CICLOS[uniId][tipoId][turnoId])
                               ? DB_CICLOS[uniId][tipoId][turnoId] : null;

        const ciclos = (configDelTurno && configDelTurno.grupos) ? configDelTurno.grupos : [];

        while (ciclosCont.firstChild) {
            ciclosCont.removeChild(ciclosCont.firstChild);
        }

        if (ciclos.length === 0) {
            ciclosCont.classList.add('hidden-section');
            return;
        }

        ciclos.forEach(ciclo => {
            const instancia = templateCiclo.content.cloneNode(true);

            const radio = instancia.querySelector('.ciclo-radio');
            radio.value = ciclo.id;

            instancia.querySelector('.nombre-ciclo').textContent = ciclo.nombre;
            instancia.querySelector('.fechas-ciclo').textContent = ciclo.fechas;

            ciclosCont.appendChild(instancia);
        });

        ciclosCont.classList.remove('hidden-section');
    }

    turnoSelect.addEventListener('change', function() {
        renderizarCiclos();
        cronogramaCont.classList.add('hidden-section');
        validarPaso1();
    });

    function generarCronograma() {
        const uniId = uniSelect.value;
        const turnoId = turnoSelect.value;

        const radioChecked = document.querySelector('input[name="ciclo_op"]:checked');
        if (!radioChecked) return;

        const radioCuotas = document.querySelector('input[name="p"][value="c"]');
        if (radioCuotas) {
            radioCuotas.checked = true;
        }

        const cicloId = radioChecked.value;

        const datosBase = (DB_CRONOGRAMAS[uniId] && DB_CRONOGRAMAS[uniId][turnoId])
                          ? DB_CRONOGRAMAS[uniId][turnoId][cicloId] : null;

        while (cronogramaBody.firstChild) {
            cronogramaBody.removeChild(cronogramaBody.firstChild);
        }

        if (!datosBase) {
            cronogramaCont.classList.add('hidden-section');
            return;
        }

        cronogramaBody.dataset.baseData = JSON.stringify(datosBase);

        actualizarTotales();

        cronogramaCont.classList.remove('hidden-section');

        validarPaso1();
    }

    function limpiarSecciones() {
        uniSelect.selectedIndex = 0;
        limpiarSelector(tipoCicloSelect);
        limpiarSelector(turnoSelect);

        tipoCicloSelect.disabled = true;
        turnoSelect.disabled = true;

        while (ciclosCont.firstChild) {
            ciclosCont.removeChild(ciclosCont.firstChild);
        }
        ciclosCont.classList.add('hidden-section');

        nivelSelect.selectedIndex = 0;
        limpiarSelector(gradoSelect);
        limpiarSelector(seccionSelect);
        limpiarSelector(turnoEscolarSelect);

        gradoSelect.disabled = true;
        seccionSelect.disabled = true;
        turnoEscolarSelect.disabled = true;

        while (cronogramaBody.firstChild) {
            cronogramaBody.removeChild(cronogramaBody.firstChild);
        }

        cronogramaCont.classList.add('hidden-section');

        delete cronogramaBody.dataset.baseData;

        validarPaso1();
    }

    function actualizarTotales() {
        const radioPago = document.querySelector('input[name="p"]:checked');
        if (!radioPago || !cronogramaBody.dataset.baseData) return;

        const datosBase = JSON.parse(cronogramaBody.dataset.baseData);
        const modoPago = radioPago.value;
        const totalGeneralTxt = document.getElementById('cronograma-total-general');
        const templateFila = document.getElementById('template-fila-cronograma');

        while (cronogramaBody.firstChild) {
            cronogramaBody.removeChild(cronogramaBody.firstChild);
        }
        // ---------------------------------------------------------

        let sumaTotalFinal = 0;

        if (modoPago === 'c') {
            datosBase.forEach(item => {
                const fila = templateFila.content.cloneNode(true);

                fila.querySelector('.col-cuota').textContent = item.c;
                fila.querySelector('.col-vencimiento').textContent = item.f;
                fila.querySelector('.col-importe').textContent = item.i.toFixed(2);
                fila.querySelector('.col-descuento').textContent = "0.00";
                fila.querySelector('.col-total').textContent = item.i.toFixed(2);

                cronogramaBody.appendChild(fila);
                sumaTotalFinal += item.i;
            });
        } else {
            const subtotal = datosBase.reduce((acc, cur) => acc + cur.i, 0);
            const porcentajeDesc = 0.05;
            const montoDesc = subtotal * porcentajeDesc;
            const neto = subtotal - montoDesc;

            const fila = templateFila.content.cloneNode(true);

            fila.querySelector('.col-cuota').textContent = "PAGO ÚNICO AL CONTADO";
            fila.querySelector('.col-vencimiento').textContent = datosBase[0].f;
            fila.querySelector('.col-importe').textContent = subtotal.toFixed(2);

            const celdaDesc = fila.querySelector('.col-descuento');
            celdaDesc.textContent = `-${montoDesc.toFixed(2)}`;
            celdaDesc.classList.add('monto-negativo');

            fila.querySelector('.col-total').textContent = neto.toFixed(2);

            cronogramaBody.appendChild(fila);
            sumaTotalFinal = neto;
        }

        if (totalGeneralTxt) {
            totalGeneralTxt.textContent = sumaTotalFinal.toFixed(2);
        }
    }

    btnContinuar.addEventListener('click', () => {
        if (btnContinuar.disabled) return;

        const modalidad = selectorModalidad.value;

        const seccionesStep1 = [
            welcomeCard,
            secAcademia,
            secColegio,
            ciclosCont,
            cronogramaCont,
            footerActions
        ];

        seccionesStep1.forEach(seccion => {
            seccion.classList.add('hidden-section');
        });

        document.getElementById('step-1-indicator').classList.remove('active');
        document.getElementById('step-2-indicator').classList.add('active');

        if (modalidad === 'colegio') {
            step2Colegio.classList.remove('hidden-section');
        } else {
            step2Academia.classList.remove('hidden-section');
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.addEventListener('change', (e) => {

        if (e.target.name === 'ciclo_op') {
            generarCronograma();
            const uniId = uniSelect.value;
            const turnoId = turnoSelect.value;
            const cicloId = e.target.value;

            const datos = (DB_CRONOGRAMAS[uniId] && DB_CRONOGRAMAS[uniId][turnoId])
                          ? DB_CRONOGRAMAS[uniId][turnoId][cicloId] : null;

            if (datos) {
                cronogramaBody.dataset.baseData = JSON.stringify(datos);
                actualizarTotales();

                cronogramaCont.classList.remove('hidden-section');
            }
            validarPaso1();
        }

        if (e.target.name === 'p') {
            actualizarTotales();
            validarPaso1();
        }

        if (e.target.name === 'es_mayor') {
            const seccionApoderadoAca = document.getElementById('seccion-apoderado-academia');

            if (seccionApoderadoAca) {
                const debeOcultar = (e.target.value === 'si');
                seccionApoderadoAca.classList.toggle('hidden-section', debeOcultar);
            }
        }
    });
});
