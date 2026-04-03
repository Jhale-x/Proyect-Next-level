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
            mañana: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ],
            tarde: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ]
        },
        unia: {
            mañana: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ],
            tarde: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ]
        },
        san_marcos: {
            mañana: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ],
            tarde: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ]
        },
        uni: {
            mañana: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ],
            tarde: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ]
        },
        catolica: {
            mañana: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ],
            tarde: [
                { id: "1", nombre: "CICLO VERANO I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "2", nombre: "CICLO VERANO II", fechas: "21/07/2026 - 15/12/2026" },
                { id: "3", nombre: "CICLO SEMESTRAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "4", nombre: "CICLO SEMESTRAL II", fechas: "16/03/2026 - 18/07/2026" },
                { id: "5", nombre: "CICLO ANUAL I", fechas: "16/03/2026 - 18/07/2026" },
                { id: "6", nombre: "CICLO ANUAL II", fechas: "16/03/2026 - 18/07/2026" }
            ]
        }
    };

    const DB_CRONOGRAMAS = {
        unu: {
            mañana: {
                "1": [
                    { c: "CUOTA 1 UNU M", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNU M", f: "30/04/2026", i: 200 },
                    { c: "CUOTA 3 UNU M", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNU M", f: "30/06/2026", i: 200 }
                ],
                "2": [
                    { c: "CUOTA 1 UNU M II", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNU M II", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNU M II", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNU M II", f: "31/06/2026", i: 250 }
                ],
                "3": [
                    { c: "CUOTA 1 UNU M", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNU M", f: "30/04/2026", i: 200 },
                    { c: "CUOTA 3 UNU M", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNU M", f: "30/06/2026", i: 200 }
                ],
                "4": [
                    { c: "CUOTA 1 UNU M II", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNU M II", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNU M II", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNU M II", f: "31/06/2026", i: 250 }
                ],
                "5": [
                    { c: "CUOTA 1 UNU M", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNU M", f: "30/04/2026", i: 200 },
                    { c: "CUOTA 3 UNU M", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNU M", f: "30/06/2026", i: 200 }
                ],
                "6": [
                    { c: "CUOTA 1 UNU M II", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNU M II", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNU M II", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNU M II", f: "31/06/2026", i: 250 }
                ]
            },
            tarde: {
                "1": [
                    { c: "CUOTA 1 UNU T", f: "31/03/2026", i: 180 },
                    { c: "CUOTA 2 UNU T", f: "31/04/2026", i: 180 },
                    { c: "CUOTA 3 UNU T", f: "31/05/2026", i: 180 },
                    { c: "CUOTA 4 UNU T", f: "31/06/2026", i: 180 }
                ],
                "2": [
                    { c: "CUOTA 1 UNU T II", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNU T II", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNU T II", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNU T II", f: "31/06/2026", i: 190 }
                ],
                "3": [
                    { c: "CUOTA 1 UNU T", f: "31/03/2026", i: 180 },
                    { c: "CUOTA 2 UNU T", f: "31/04/2026", i: 180 },
                    { c: "CUOTA 3 UNU T", f: "31/05/2026", i: 180 },
                    { c: "CUOTA 4 UNU T", f: "31/06/2026", i: 180 }
                ],
                "4": [
                    { c: "CUOTA 1 UNU T II", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNU T II", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNU T II", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNU T II", f: "31/06/2026", i: 190 }
                ],
                "5": [
                    { c: "CUOTA 1 UNU T", f: "31/03/2026", i: 180 },
                    { c: "CUOTA 2 UNU T", f: "31/04/2026", i: 180 },
                    { c: "CUOTA 3 UNU T", f: "31/05/2026", i: 180 },
                    { c: "CUOTA 4 UNU T", f: "31/06/2026", i: 180 }
                ],
                "6": [
                    { c: "CUOTA 1 UNU T II", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNU T II", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNU T II", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNU T II", f: "31/06/2026", i: 190 }
                ]
            }
        },
        unia: {
            mañana: {
                "1": [
                    { c: "CUOTA 1 UNIA M", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 UNIA M", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 UNIA M", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 UNIA M", f: "31/06/2026", i: 210 }
                ],
                "2": [
                    { c: "CUOTA 1 UNIA M II", f: "31/03/2026", i: 220 },
                    { c: "CUOTA 2 UNIA M II", f: "31/04/2026", i: 220 },
                    { c: "CUOTA 3 UNIA M II", f: "31/05/2026", i: 220 },
                    { c: "CUOTA 4 UNIA M II", f: "31/06/2026", i: 220 }
                ],
                "3": [
                    { c: "CUOTA 1 UNIA M", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 UNIA M", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 UNIA M", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 UNIA M", f: "31/06/2026", i: 210 }
                ],
                "4": [
                    { c: "CUOTA 1 UNIA M II", f: "31/03/2026", i: 220 },
                    { c: "CUOTA 2 UNIA M II", f: "31/04/2026", i: 220 },
                    { c: "CUOTA 3 UNIA M II", f: "31/05/2026", i: 220 },
                    { c: "CUOTA 4 UNIA M II", f: "31/06/2026", i: 220 }
                ],
                "5": [
                    { c: "CUOTA 1 UNIA M", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 UNIA M", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 UNIA M", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 UNIA M", f: "31/06/2026", i: 210 }
                ],
                "6": [
                    { c: "CUOTA 1 UNIA M II", f: "31/03/2026", i: 220 },
                    { c: "CUOTA 2 UNIA M II", f: "31/04/2026", i: 220 },
                    { c: "CUOTA 3 UNIA M II", f: "31/05/2026", i: 220 },
                    { c: "CUOTA 4 UNIA M II", f: "31/06/2026", i: 220 }
                ]
            },
            tarde: {
                "1": [
                    { c: "CUOTA 1 UNIA T", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNIA T", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNIA T", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNIA T", f: "31/06/2026", i: 190 }
                ],
                "2": [
                    { c: "CUOTA 1 UNIA T II", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNIA T II", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 UNIA T II", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNIA T II", f: "31/06/2026", i: 200 }
                ],
                "3": [
                    { c: "CUOTA 1 UNIA T", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNIA T", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNIA T", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNIA T", f: "31/06/2026", i: 190 }
                ],
                "4": [
                    { c: "CUOTA 1 UNIA T II", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNIA T II", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 UNIA T II", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNIA T II", f: "31/06/2026", i: 200 }
                ],
                "5": [
                    { c: "CUOTA 1 UNIA T", f: "31/03/2026", i: 190 },
                    { c: "CUOTA 2 UNIA T", f: "31/04/2026", i: 190 },
                    { c: "CUOTA 3 UNIA T", f: "31/05/2026", i: 190 },
                    { c: "CUOTA 4 UNIA T", f: "31/06/2026", i: 190 }
                ],
                "6": [
                    { c: "CUOTA 1 UNIA T II", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 UNIA T II", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 UNIA T II", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 UNIA T II", f: "31/06/2026", i: 200 }
                ]
            }
        },
        san_marcos: {
            mañana: {
                "1": [
                    { c: "CUOTA 1 UNMSM M", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNMSM M", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNMSM M", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNMSM M", f: "31/06/2026", i: 250 }
                ],
                "2": [
                    { c: "CUOTA 1 UNMSM M II", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNMSM M II", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNMSM M II", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNMSM M II", f: "31/06/2026", i: 260 }
                ],
                "3": [
                    { c: "CUOTA 1 UNMSM M", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNMSM M", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNMSM M", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNMSM M", f: "31/06/2026", i: 250 }
                ],
                "4": [
                    { c: "CUOTA 1 UNMSM M II", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNMSM M II", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNMSM M II", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNMSM M II", f: "31/06/2026", i: 260 }
                ],
                "5": [
                    { c: "CUOTA 1 UNMSM M", f: "31/03/2026", i: 250 },
                    { c: "CUOTA 2 UNMSM M", f: "31/04/2026", i: 250 },
                    { c: "CUOTA 3 UNMSM M", f: "31/05/2026", i: 250 },
                    { c: "CUOTA 4 UNMSM M", f: "31/06/2026", i: 250 }
                ],
                "6": [
                    { c: "CUOTA 1 UNMSM M II", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNMSM M II", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNMSM M II", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNMSM M II", f: "31/06/2026", i: 260 }
                ]
            },
            tarde: {
                "1": [
                    { c: "CUOTA 1 UNMSM T", f: "31/03/2026", i: 230 },
                    { c: "CUOTA 2 UNMSM T", f: "31/04/2026", i: 230 },
                    { c: "CUOTA 3 UNMSM T", f: "31/05/2026", i: 230 },
                    { c: "CUOTA 4 UNMSM T", f: "31/06/2026", i: 230 }
                ],
                "2": [
                    { c: "CUOTA 1 UNMSM T II", f: "31/03/2026", i: 240 },
                    { c: "CUOTA 2 UNMSM T II", f: "31/04/2026", i: 240 },
                    { c: "CUOTA 3 UNMSM T II", f: "31/05/2026", i: 240 },
                    { c: "CUOTA 4 UNMSM T II", f: "31/06/2026", i: 240 }
                ],
                "3": [
                    { c: "CUOTA 1 UNMSM T", f: "31/03/2026", i: 230 },
                    { c: "CUOTA 2 UNMSM T", f: "31/04/2026", i: 230 },
                    { c: "CUOTA 3 UNMSM T", f: "31/05/2026", i: 230 },
                    { c: "CUOTA 4 UNMSM T", f: "31/06/2026", i: 230 }
                ],
                "4": [
                    { c: "CUOTA 1 UNMSM T II", f: "31/03/2026", i: 240 },
                    { c: "CUOTA 2 UNMSM T II", f: "31/04/2026", i: 240 },
                    { c: "CUOTA 3 UNMSM T II", f: "31/05/2026", i: 240 },
                    { c: "CUOTA 4 UNMSM T II", f: "31/06/2026", i: 240 }
                ],
                "5": [
                    { c: "CUOTA 1 UNMSM T", f: "31/03/2026", i: 230 },
                    { c: "CUOTA 2 UNMSM T", f: "31/04/2026", i: 230 },
                    { c: "CUOTA 3 UNMSM T", f: "31/05/2026", i: 230 },
                    { c: "CUOTA 4 UNMSM T", f: "31/06/2026", i: 230 }
                ],
                "6": [
                    { c: "CUOTA 1 UNMSM T II", f: "31/03/2026", i: 240 },
                    { c: "CUOTA 2 UNMSM T II", f: "31/04/2026", i: 240 },
                    { c: "CUOTA 3 UNMSM T II", f: "31/05/2026", i: 240 },
                    { c: "CUOTA 4 UNMSM T II", f: "31/06/2026", i: 240 }
                ]
            }
        },
        uni: {
            mañana: {
                "1": [
                    { c: "CUOTA 1 UNI M", f: "31/03/2026", i: 280 },
                    { c: "CUOTA 2 UNI M", f: "31/04/2026", i: 280 },
                    { c: "CUOTA 3 UNI M", f: "31/05/2026", i: 280 },
                    { c: "CUOTA 4 UNI M", f: "31/06/2026", i: 280 }
                ],
                "2": [
                    { c: "CUOTA 1 UNI M II", f: "31/03/2026", i: 290 },
                    { c: "CUOTA 2 UNI M II", f: "31/04/2026", i: 290 },
                    { c: "CUOTA 3 UNI M II", f: "31/05/2026", i: 290 },
                    { c: "CUOTA 4 UNI M II", f: "31/06/2026", i: 290 }
                ],
                "3": [
                    { c: "CUOTA 1 UNI M", f: "31/03/2026", i: 280 },
                    { c: "CUOTA 2 UNI M", f: "31/04/2026", i: 280 },
                    { c: "CUOTA 3 UNI M", f: "31/05/2026", i: 280 },
                    { c: "CUOTA 4 UNI M", f: "31/06/2026", i: 280 }
                ],
                "4": [
                    { c: "CUOTA 1 UNI M II", f: "31/03/2026", i: 290 },
                    { c: "CUOTA 2 UNI M II", f: "31/04/2026", i: 290 },
                    { c: "CUOTA 3 UNI M II", f: "31/05/2026", i: 290 },
                    { c: "CUOTA 4 UNI M II", f: "31/06/2026", i: 290 }
                ],
                "5": [
                    { c: "CUOTA 1 UNI M", f: "31/03/2026", i: 280 },
                    { c: "CUOTA 2 UNI M", f: "31/04/2026", i: 280 },
                    { c: "CUOTA 3 UNI M", f: "31/05/2026", i: 280 },
                    { c: "CUOTA 4 UNI M", f: "31/06/2026", i: 280 }
                ],
                "6": [
                    { c: "CUOTA 1 UNI M II", f: "31/03/2026", i: 290 },
                    { c: "CUOTA 2 UNI M II", f: "31/04/2026", i: 290 },
                    { c: "CUOTA 3 UNI M II", f: "31/05/2026", i: 290 },
                    { c: "CUOTA 4 UNI M II", f: "31/06/2026", i: 290 }
                ]
            },
            tarde: {
                "1": [
                    { c: "CUOTA 1 UNI T", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNI T", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNI T", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNI T", f: "31/06/2026", i: 260 }
                ],
                "2": [
                    { c: "CUOTA 1 UNI T II", f: "31/03/2026", i: 270 },
                    { c: "CUOTA 2 UNI T II", f: "31/04/2026", i: 270 },
                    { c: "CUOTA 3 UNI T II", f: "31/05/2026", i: 270 },
                    { c: "CUOTA 4 UNI T II", f: "31/06/2026", i: 270 }
                ],
                "3": [
                    { c: "CUOTA 1 UNI T", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNI T", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNI T", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNI T", f: "31/06/2026", i: 260 }
                ],
                "4": [
                    { c: "CUOTA 1 UNI T II", f: "31/03/2026", i: 270 },
                    { c: "CUOTA 2 UNI T II", f: "31/04/2026", i: 270 },
                    { c: "CUOTA 3 UNI T II", f: "31/05/2026", i: 270 },
                    { c: "CUOTA 4 UNI T II", f: "31/06/2026", i: 270 }
                ],
                "5": [
                    { c: "CUOTA 1 UNI T", f: "31/03/2026", i: 260 },
                    { c: "CUOTA 2 UNI T", f: "31/04/2026", i: 260 },
                    { c: "CUOTA 3 UNI T", f: "31/05/2026", i: 260 },
                    { c: "CUOTA 4 UNI T", f: "31/06/2026", i: 260 }
                ],
                "6": [
                    { c: "CUOTA 1 UNI T II", f: "31/03/2026", i: 270 },
                    { c: "CUOTA 2 UNI T II", f: "31/04/2026", i: 270 },
                    { c: "CUOTA 3 UNI T II", f: "31/05/2026", i: 270 },
                    { c: "CUOTA 4 UNI T II", f: "31/06/2026", i: 270 }
                ]
            }
        },
        catolica: {
            mañana: {
                "1": [
                    { c: "CUOTA 1 Católica M", f: "31/03/2026", i: 300 },
                    { c: "CUOTA 2 Católica M", f: "31/04/2026", i: 300 },
                    { c: "CUOTA 3 Católica M", f: "31/05/2026", i: 300 },
                    { c: "CUOTA 4 Católica M", f: "31/06/2026", i: 300 }
                ],
                "2": [
                    { c: "CUOTA 1 Católica M II", f: "31/03/2026", i: 400 },
                    { c: "CUOTA 2 Católica M II", f: "31/04/2026", i: 400 },
                    { c: "CUOTA 3 Católica M II", f: "31/05/2026", i: 400 },
                    { c: "CUOTA 4 Católica M II", f: "31/06/2026", i: 400 }
                ],
                "3": [
                    { c: "CUOTA 1 Católica M", f: "31/03/2026", i: 300 },
                    { c: "CUOTA 2 Católica M", f: "31/04/2026", i: 300 },
                    { c: "CUOTA 3 Católica M", f: "31/05/2026", i: 300 },
                    { c: "CUOTA 4 Católica M", f: "31/06/2026", i: 300 }
                ],
                "4": [
                    { c: "CUOTA 1 Católica M II", f: "31/03/2026", i: 400 },
                    { c: "CUOTA 2 Católica M II", f: "31/04/2026", i: 400 },
                    { c: "CUOTA 3 Católica M II", f: "31/05/2026", i: 400 },
                    { c: "CUOTA 4 Católica M II", f: "31/06/2026", i: 400 }
                ],
                "5": [
                    { c: "CUOTA 1 Católica M", f: "31/03/2026", i: 300 },
                    { c: "CUOTA 2 Católica M", f: "31/04/2026", i: 300 },
                    { c: "CUOTA 3 Católica M", f: "31/05/2026", i: 300 },
                    { c: "CUOTA 4 Católica M", f: "31/06/2026", i: 300 }
                ],
                "6": [
                    { c: "CUOTA 1 Católica M II", f: "31/03/2026", i: 400 },
                    { c: "CUOTA 2 Católica M II", f: "31/04/2026", i: 400 },
                    { c: "CUOTA 3 Católica M II", f: "31/05/2026", i: 400 },
                    { c: "CUOTA 4 Católica M II", f: "31/06/2026", i: 400 }
                ]
            },
            tarde: {
                "1": [
                    { c: "CUOTA 1 Católica T", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 Católica T", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 Católica T", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 Católica T", f: "31/06/2026", i: 200 }
                ],
                "2": [
                    { c: "CUOTA 1 Católica T II", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 Católica T II", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 Católica T II", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 Católica T II", f: "31/06/2026", i: 210 }
                ],
                "3": [
                    { c: "CUOTA 1 Católica T", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 Católica T", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 Católica T", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 Católica T", f: "31/06/2026", i: 200 }
                ],
                "4": [
                    { c: "CUOTA 1 Católica T II", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 Católica T II", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 Católica T II", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 Católica T II", f: "31/06/2026", i: 210 }
                ],
                "5": [
                    { c: "CUOTA 1 Católica T", f: "31/03/2026", i: 200 },
                    { c: "CUOTA 2 Católica T", f: "31/04/2026", i: 200 },
                    { c: "CUOTA 3 Católica T", f: "31/05/2026", i: 200 },
                    { c: "CUOTA 4 Católica T", f: "31/06/2026", i: 200 }
                ],
                "6": [
                    { c: "CUOTA 1 Católica T II", f: "31/03/2026", i: 210 },
                    { c: "CUOTA 2 Católica T II", f: "31/04/2026", i: 210 },
                    { c: "CUOTA 3 Católica T II", f: "31/05/2026", i: 210 },
                    { c: "CUOTA 4 Católica T II", f: "31/06/2026", i: 210 }
                ]
            }
        }
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


    const horarios = {
        unu: { mañana: "7:30 AM - 1:00 PM", tarde: "3:00 PM - 8:00 PM" },
        unia: { mañana: "8:00 AM - 1:30 PM", tarde: "3:30 PM - 8:30 PM" },
        san_marcos: { mañana: "8:30 AM - 2:00 PM", tarde: "4:00 PM - 9:00 PM" },
        uni: { mañana: "9:00 AM - 2:30 PM", tarde: "4:30 PM - 9:30 PM" },
        catolica: { mañana: "9:30 AM - 3:00 PM", tarde: "5:00 PM - 10:00 PM" }
    };

    function validarPaso1() {
        const modalidad = selectorModalidad.value;
        let esValido = false;

        if (modalidad === 'colegio') {
            esValido = nivelSelect.value !== "" &&
                   gradoSelect.value !== "" &&
                   seccionSelect.value !== "" &&
                   turnoEscolarSelect.value !== "";
        } else if (modalidad === 'academia') {
            const cicloRadio = document.querySelector('input[name="ciclo_op"]:checked');
            const pagoRadio = document.querySelector('input[name="p"]:checked');

            esValido = uniSelect.value !== "" && turnoSelect.value !== "" && cicloRadio !== null && pagoRadio !== null;
        }

        if (btnContinuar) {
            btnContinuar.disabled = !esValido;
        }
    }

    selectorModalidad.addEventListener('change', function() {
        limpiarSecciones();

        secAcademia.classList.add('hidden-section');
        secColegio.classList.add('hidden-section');
        footerActions.classList.add('hidden-section');
        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');

        if (this.value === 'academia') {
            secAcademia.classList.remove('hidden-section');
            footerActions.classList.remove('hidden-section');
        } else if (this.value === 'colegio') {
            secColegio.classList.remove('hidden-section');
            footerActions.classList.remove('hidden-section');
        }
        validarPaso1();
    });

    nivelSelect.addEventListener('change', function() {
        gradoSelect.innerHTML = '<option value="" disabled selected hidden>Grado Correspondiente</option>';
        gradoSelect.disabled = false;

        seccionSelect.selectedIndex = 0;
        seccionSelect.disabled = true;
        turnoEscolarSelect.selectedIndex = 0;
        turnoEscolarSelect.disabled = true;

        const maxGrado = (this.value === 'primaria') ? 6 : 5;
        for (let i = 1; i <= maxGrado; i++) {
            const label = `${i}${ (i===1||i===3) ? "ero" : (i===2) ? "do" : "to" }`;
            gradoSelect.add(new Option(label, i));
        }
        validarPaso1();
    });

    gradoSelect.addEventListener('change', function() {
    const nivel = nivelSelect.value;
    const grado = this.value;

    seccionSelect.innerHTML = '<option value="" disabled selected hidden>Sección</option>';

    const seccionesDisponibles = DB_COLEGIO[nivel][grado].secciones;

    Object.keys(seccionesDisponibles).forEach(letra => {
        seccionSelect.add(new Option(`Sección ${letra}`, letra));
    });

    seccionSelect.disabled = false;
    turnoEscolarSelect.disabled = true;
    validarPaso1();
    });

    seccionSelect.addEventListener('change', function() {
    const nivel = nivelSelect.value;
    const grado = gradoSelect.value;
    const letraSeccion = this.value;

    turnoEscolarSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';

    const horarios = DB_COLEGIO[nivel][grado].secciones[letraSeccion];

    if (horarios.mañana) {
        turnoEscolarSelect.add(new Option(`Mañana (${horarios.mañana})`, "mañana"));
    }
    if (horarios.tarde) {
        turnoEscolarSelect.add(new Option(`Tarde (${horarios.tarde})`, "tarde"));
    }

    turnoEscolarSelect.disabled = false;
    validarPaso1();
    });

    turnoEscolarSelect.addEventListener('change', validarPaso1);

    uniSelect.addEventListener('change', function() {
        const seleccion = this.value;
        turnoSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';
        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');

        if (horarios[seleccion]) {
            turnoSelect.disabled = false;
            turnoSelect.add(new Option(`Mañana (${horarios[seleccion].mañana})`, "mañana"));
            turnoSelect.add(new Option(`Tarde (${horarios[seleccion].tarde})`, "tarde"));
        } else {
            turnoSelect.disabled = true;
        }
        validarPaso1();
    });

    function renderizarCiclos() {
        const uniId = uniSelect.value;
        const turnoId = turnoSelect.value;
        const ciclos = DB_CICLOS[uniId] && DB_CICLOS[uniId][turnoId] ? DB_CICLOS[uniId][turnoId] : [];

        ciclosCont.innerHTML = "";

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

        const cicloId = radioChecked.value;

        const datosBase = DB_CRONOGRAMAS[uniId] && DB_CRONOGRAMAS[uniId][turnoId]
                    ? DB_CRONOGRAMAS[uniId][turnoId][cicloId] : null;

        if (!datosBase) {
            cronogramaBody.innerHTML = "";
            return;
        }

        cronogramaBody.dataset.baseData = JSON.stringify(datosBase);

        actualizarTotales();

    cronogramaCont.classList.remove('hidden-section');
        validarPaso1();
    }

    function limpiarSecciones() {
        uniSelect.value = "";
        turnoSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';
        turnoSelect.disabled = true;
        ciclosCont.innerHTML = "";
        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');
        cronogramaBody.innerHTML = "";
        delete cronogramaBody.dataset.baseData;

        nivelSelect.value = "";
        gradoSelect.innerHTML = '<option value="" disabled selected hidden>Grado Correspondiente</option>';
        gradoSelect.disabled = true;

        seccionSelect.innerHTML = '<option value="" disabled selected hidden>Sección</option>';
        seccionSelect.disabled = true;

        turnoEscolarSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';
        turnoEscolarSelect.disabled = true;

        const inputsPaso2 = [...step2Colegio.querySelectorAll('input'), ...step2Academia.querySelectorAll('input'),
                             ...step2Colegio.querySelectorAll('select'), ...step2Academia.querySelectorAll('select')];

    inputsPaso2.forEach(el => {
        if (el.type === 'radio') {
            if (el.name === 'es_mayor' && el.value === 'no') el.checked = true;
            else el.checked = false;
        } else {
            el.value = "";
        }
    });

        const seccionApoderadoAca = document.getElementById('seccion-apoderado-academia');
        if (seccionApoderadoAca) seccionApoderadoAca.classList.remove('hidden-section');
        }

        function actualizarTotales() {
        const radioPago = document.querySelector('input[name="p"]:checked');
        if (!radioPago || !cronogramaBody.dataset.baseData) return;

        const datosBase = JSON.parse(cronogramaBody.dataset.baseData);
        const modoPago = radioPago.value;
        const totalGeneralTxt = document.getElementById('cronograma-total-general');
        const templateFila = document.getElementById('template-fila-cronograma');

        cronogramaBody.innerHTML = "";
        let sumaTotalFinal = 0;

        if (modoPago === 'c') {
        // MODO CUOTAS
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
        const porcentajeDesc = 0.05; // 5%
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

        [welcomeCard, secAcademia, secColegio, ciclosCont, cronogramaCont, footerActions].forEach(el => {
            el.classList.add('hidden-section');
        });

        document.getElementById('step-1-indicator').classList.remove('active');
        document.getElementById('step-2-indicator').classList.add('active');

        if (modalidad === 'colegio') {
            step2Colegio.classList.remove('hidden-section');
        } else {
            step2Academia.classList.remove('hidden-section');
        }
    });

    document.addEventListener('change', (e) => {
        if (e.target.name === 'ciclo_op') {
            generarCronograma();
            validarPaso1();
        }

        if (e.target.name === 'p') {
            actualizarTotales();
            validarPaso1();
        }

        if (e.target.name === 'es_mayor') {
            const seccionApoderadoAca = document.getElementById('seccion-apoderado-academia');
            if (seccionApoderadoAca) {
                if (e.target.value === 'si') {
                    seccionApoderadoAca.classList.add('hidden-section');
                } else {
                    seccionApoderadoAca.classList.remove('hidden-section');
                }
            }
        }
    });
});
