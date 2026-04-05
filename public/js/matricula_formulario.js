document.addEventListener('DOMContentLoaded', () => {

    const DB_COLEGIO = {
        primaria: {
            "1": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p1a_m", nombre: "PRIMARIA - 1ERO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p1b_m", nombre: "PRIMARIA - 1ERO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p1c_t", nombre: "PRIMARIA - 1ERO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p1d_t", nombre: "PRIMARIA - 1ERO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "2": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p2a_m", nombre: "PRIMARIA - 2DO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p2b_m", nombre: "PRIMARIA - 2DO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p2c_t", nombre: "PRIMARIA - 2DO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p2d_t", nombre: "PRIMARIA - 2DO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "3": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p3a_m", nombre: "PRIMARIA - 3ERO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p3b_m", nombre: "PRIMARIA - 3ERO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p3c_t", nombre: "PRIMARIA - 3ERO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p3d_t", nombre: "PRIMARIA - 3ERO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "4": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p4a_m", nombre: "PRIMARIA - 4TO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p4b_m", nombre: "PRIMARIA - 4TO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p4c_t", nombre: "PRIMARIA - 4TO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p4d_t", nombre: "PRIMARIA - 4TO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "5": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p5a_m", nombre: "PRIMARIA - 5TO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p5b_m", nombre: "PRIMARIA - 5TO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p5c_t", nombre: "PRIMARIA - 5TO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p5d_t", nombre: "PRIMARIA - 5TO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "6": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p6a_m", nombre: "PRIMARIA - 6TO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "p1b_m", nombre: "PRIMARIA - 1ERO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p1c_t", nombre: "PRIMARIA - 1ERO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "p1d_t", nombre: "PRIMARIA - 1ERO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
        },
        secundaria: {
            "1": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s1a_m", nombre: "SECUNDARIA - 1ERO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s1b_m", nombre: "SECUNDARIA - 1ERO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s1c_t", nombre: "SECUNDARIA - 1ERO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s1d_t", nombre: "SECUNDARIA - 1ERO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "2": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s2a_m", nombre: "SECUNDARIA - 2DO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s2b_m", nombre: "SECUNDARIA - 2DO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s2c_t", nombre: "SECUNDARIA - 2DO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s2d_t", nombre: "SECUNDARIA - 2DO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "3": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s3a_m", nombre: "SECUNDARIA - 3ERO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s3b_m", nombre: "SECUNDARIA - 3ERO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s3c_t", nombre: "SECUNDARIA - 3ERO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s3d_t", nombre: "SECUNDARIA - 3ERO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "4": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s4a_m", nombre: "SECUNDARIA - 4TO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s4b_m", nombre: "SECUNDARIA - 4TO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s4c_t", nombre: "SECUNDARIA - 4TO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s4d_t", nombre: "SECUNDARIA - 4TO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
            "5": {
                secciones: {
                    "A": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s5a_m", nombre: "SECUNDARIA - 5TO - SECCIÓN A", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "B": {
                        mañana: {
                            horario: "7:00 AM - 12:00 PM",
                            grupos: [{ id: "s5b_m", nombre: "SECUNDARIA - 5TO - SECCIÓN B", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "C": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s5c_t", nombre: "SECUNDARIA - 5TO - SECCIÓN C", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                    "D": {
                        tarde: {
                            horario: "12:45 PM - 5:00 PM",
                            grupos: [{ id: "s5d_t", nombre: "SECUNDARIA - 5TO - SECCIÓN D", fechas: "02/03/2026 - 15/12/2026"}]
                        }
                    },
                },
            },
        },
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

    const DB_CRONOGRAMA_COLEGIO = {
        "p1a_m": [
            { c: "CUOTA 1 PRIMARIA - 1ERO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 1ERO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 1ERO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 1ERO - A", f: "30/06/2026", i: 150.00 }
        ],
        "p1b_m": [
            { c: "CUOTA 1 PRIMARIA - 1ERO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 1ERO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 1ERO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 1ERO - B", f: "30/06/2026", i: 150.00 }
        ],
        "p1c_t": [
            { c: "CUOTA 1 PRIMARIA - 1ERO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 1ERO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 1ERO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 1ERO - C", f: "30/06/2026", i: 150.00 }
        ],
        "p1d_t": [
            { c: "CUOTA 1 PRIMARIA - 1ERO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 1ERO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 1ERO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 1ERO - D", f: "30/06/2026", i: 150.00 }
        ],
        "p2a_m": [
            { c: "CUOTA 1 PRIMARIA - 2DO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 2DO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 2DO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 2DO - A", f: "30/06/2026", i: 150.00 }
        ],
        "p2b_m": [
            { c: "CUOTA 1 PRIMARIA - 2DO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 2DO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 2DO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 2DO - B", f: "30/06/2026", i: 150.00 }
        ],
        "p2c_t": [
            { c: "CUOTA 1 PRIMARIA - 2DO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 2DO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 2DO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 2DO - C", f: "30/06/2026", i: 150.00 }
        ],
        "p2d_t": [
            { c: "CUOTA 1 PRIMARIA - 2DO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 2DO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 2DO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 2DO - D", f: "30/06/2026", i: 150.00 }
        ],
        "p3a_m": [
            { c: "CUOTA 1 PRIMARIA - 3ERO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 3ERO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 3ERO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 3ERO - A", f: "30/06/2026", i: 150.00 }
        ],
        "p3b_m": [
            { c: "CUOTA 1 PRIMARIA - 3ERO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 3ERO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 3ERO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 3ERO - B", f: "30/06/2026", i: 150.00 }
        ],
        "p3c_t": [
            { c: "CUOTA 1 PRIMARIA - 3ERO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 3ERO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 3ERO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 3ERO - C", f: "30/06/2026", i: 150.00 }
        ],
        "p3d_t": [
            { c: "CUOTA 1 PRIMARIA - 3ERO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 3ERO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 3ERO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 3ERO - D", f: "30/06/2026", i: 150.00 }
        ],
        "p4a_m": [
            { c: "CUOTA 1 PRIMARIA - 4TO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 4TO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 4TO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 4TO - A", f: "30/06/2026", i: 150.00 }
        ],
        "p4b_m": [
            { c: "CUOTA 1 PRIMARIA - 4TO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 4TO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 4TO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 4TO - B", f: "30/06/2026", i: 150.00 }
        ],
        "p4c_t": [
            { c: "CUOTA 1 PRIMARIA - 4TO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 4TO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 4TO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 4TO - C", f: "30/06/2026", i: 150.00 }
        ],
        "p4d_t": [
            { c: "CUOTA 1 PRIMARIA - 4TO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 4TO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 4TO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 4TO - D", f: "30/06/2026", i: 150.00 }
        ],
        "p5a_m": [
            { c: "CUOTA 1 PRIMARIA - 5TO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 5TO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 5TO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 5TO - A", f: "30/06/2026", i: 150.00 }
        ],
        "p5b_m": [
            { c: "CUOTA 1 PRIMARIA - 5TO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 5TO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 5TO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 5TO - B", f: "30/06/2026", i: 150.00 }
        ],
        "p5c_t": [
            { c: "CUOTA 1 PRIMARIA - 5TO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 5TO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 5TO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 5TO - C", f: "30/06/2026", i: 150.00 }
        ],
        "p5d_t": [
            { c: "CUOTA 1 PRIMARIA - 5TO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 5TO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 5TO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 5TO - D", f: "30/06/2026", i: 150.00 }
        ],
        "p6a_m": [
            { c: "CUOTA 1 PRIMARIA - 6TO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 6TO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 6TO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 6TO - A", f: "30/06/2026", i: 150.00 }
        ],
        "p6b_m": [
            { c: "CUOTA 1 PRIMARIA - 6TO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 6TO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 6TO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 6TO - B", f: "30/06/2026", i: 150.00 }
        ],
        "p6c_t": [
            { c: "CUOTA 1 PRIMARIA - 6TO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 6TO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 6TO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 6TO - C", f: "30/06/2026", i: 150.00 }
        ],
        "p6d_t": [
            { c: "CUOTA 1 PRIMARIA - 6TO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 PRIMARIA - 6TO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 PRIMARIA - 6TO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 PRIMARIA - 6TO - D", f: "30/06/2026", i: 150.00 }
        ],
        "s1a_m": [
            { c: "CUOTA 1 SECUNDARIA - 1ERO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 1ERO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 1ERO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 1ERO - A", f: "30/06/2026", i: 150.00 }
        ],
        "s1b_m": [
            { c: "CUOTA 1 SECUNDARIA - 1ERO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 1ERO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 1ERO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 1ERO - B", f: "30/06/2026", i: 150.00 }
        ],
        "s1c_t": [
            { c: "CUOTA 1 SECUNDARIA - 1ERO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 1ERO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 1ERO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 1ERO - C", f: "30/06/2026", i: 150.00 }
        ],
        "s1d_t": [
            { c: "CUOTA 1 SECUNDARIA - 1ERO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 1ERO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 1ERO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 1ERO - D", f: "30/06/2026", i: 150.00 }
        ],
        "s2a_m": [
            { c: "CUOTA 1 SECUNDARIA - 2DO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 2DO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 2DO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 2DO - A", f: "30/06/2026", i: 150.00 }
        ],
        "s2b_m": [
            { c: "CUOTA 1 SECUNDARIA - 2DO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 2DO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 2DO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 2DO - B", f: "30/06/2026", i: 150.00 }
        ],
        "s2c_t": [
            { c: "CUOTA 1 SECUNDARIA - 2DO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 2DO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 2DO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 2DO - C", f: "30/06/2026", i: 150.00 }
        ],
        "s2d_t": [
            { c: "CUOTA 1 SECUNDARIA - 2DO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 2DO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 2DO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 2DO - D", f: "30/06/2026", i: 150.00 }
        ],
        "s3a_m": [
            { c: "CUOTA 1 SECUNDARIA - 3ERO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 3ERO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 3ERO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 3ERO - A", f: "30/06/2026", i: 150.00 }
        ],
        "s3b_m": [
            { c: "CUOTA 1 SECUNDARIA - 3ERO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 3ERO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 3ERO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 3ERO - B", f: "30/06/2026", i: 150.00 }
        ],
        "s3c_t": [
            { c: "CUOTA 1 SECUNDARIA - 3ERO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 3ERO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 3ERO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 3ERO - C", f: "30/06/2026", i: 150.00 }
        ],
        "s3d_t": [
            { c: "CUOTA 1 SECUNDARIA - 3ERO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 3ERO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 3ERO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 3ERO - D", f: "30/06/2026", i: 150.00 }
        ],
        "s4a_m": [
            { c: "CUOTA 1 SECUNDARIA - 4TO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 4TO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 4TO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 4TO - A", f: "30/06/2026", i: 150.00 }
        ],
        "s4b_m": [
            { c: "CUOTA 1 SECUNDARIA - 4TO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 4TO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 4TO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 4TO - B", f: "30/06/2026", i: 150.00 }
        ],
        "s4c_t": [
            { c: "CUOTA 1 SECUNDARIA - 4TO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 4TO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 4TO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 4TO - C", f: "30/06/2026", i: 150.00 }
        ],
        "s4d_t": [
            { c: "CUOTA 1 SECUNDARIA - 4TO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 4TO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 4TO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 4TO - D", f: "30/06/2026", i: 150.00 }
        ],
        "s5a_m": [
            { c: "CUOTA 1 SECUNDARIA - 5TO - A", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 5TO - A", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 5TO - A", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 5TO - A", f: "30/06/2026", i: 150.00 }
        ],
        "s5b_m": [
            { c: "CUOTA 1 SECUNDARIA - 5TO - B", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 5TO - B", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 5TO - B", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 5TO - B", f: "30/06/2026", i: 150.00 }
        ],
        "s5c_t": [
            { c: "CUOTA 1 SECUNDARIA - 5TO - C", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 5TO - C", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 5TO - C", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 5TO - C", f: "30/06/2026", i: 150.00 }
        ],
        "s5d_t": [
            { c: "CUOTA 1 SECUNDARIA - 5TO - D", f: "31/03/2026", i: 150.00 },
            { c: "CUOTA 2 SECUNDARIA - 5TO - D", f: "30/04/2026", i: 150.00 },
            { c: "CUOTA 3 SECUNDARIA - 5TO - D", f: "31/05/2026", i: 150.00 },
            { c: "CUOTA 4 SECUNDARIA - 5TO - D", f: "30/06/2026", i: 150.00 }
        ],
    }

    const DB_CRONOGRAMA_ACADEMIA = {
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
    const ciclosCont = document.getElementById('ciclos-container-academia');
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
    const ciclosContCol = document.getElementById('ciclos-container-colegio');
    const cronogramaContCol = document.getElementById('cronograma-container-colegio');
    const cronogramaBodyCol = document.getElementById('cronograma-body-colegio');
    const totalGeneralCol = document.getElementById('cronograma-total-general-colegio');
    const navStep2 = document.querySelector('.step2-navigation-actions');
    const btnRegresar = document.querySelector('.btn-premium-prev');
    const step3Resumen = document.getElementById('step-3-resumen');
    const checkTerminos = document.getElementById('check-terminos');
    const checkPoliticas = document.getElementById('check-politicas');
    const btnNextStep2 = document.querySelector('.btn-premium-next-step2');

    if (navStep2) navStep2.classList.add('hidden-section');

    if (btnNextStep2) {
        btnNextStep2.disabled = true;
        btnNextStep2.style.cursor = "not-allowed";
    }

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

        const cicloSeleccionado = document.querySelector('input[name="ciclo_op"]:checked');

        if (modalidad === 'colegio') {
            const selectoresLlenos = nivelSelect.value !== "" &&
                                    gradoSelect.value !== "" &&
                                    seccionSelect.value !== "" &&
                                    turnoEscolarSelect.value !== "";

            esValido = selectoresLlenos && cicloSeleccionado !== null;
        }
        else if (modalidad === 'academia') {
            const selectsAcademiaOK = uniSelect.value !== "" &&
                                      tipoCicloSelect.value !== "" &&
                                      turnoSelect.value !== "";

            esValido = selectsAcademiaOK && cicloSeleccionado !== null;
        }

        if (btnContinuar) {
            btnContinuar.disabled = !esValido;

            btnContinuar.style.opacity = "1";
            btnContinuar.style.filter = "none";

            btnContinuar.style.cursor = esValido ? "pointer" : "not-allowed";
        }
    }

    function validarPaso2() {
        const modalidad = selectorModalidad.value;
        let esValido = true;

        const contenedorActivo = (modalidad === 'colegio') ? step2Colegio : step2Academia;
        if (!contenedorActivo) return;

        const camposObligatorios = contenedorActivo.querySelectorAll('input[required], select[required]');

        camposObligatorios.forEach(input => {
            const estaEnSeccionOculta = input.closest('.hidden-section');

            if (!estaEnSeccionOculta) {
                if (!input.value.trim() || input.value === "") {
                    esValido = false;
                }
            }
        });

        if (modalidad === 'academia') {
            const esMayorChecked = document.querySelector('input[name="es_mayor"]:checked');
            if (!esMayorChecked) {
                esValido = false;
            }
        }

        if (btnNextStep2) {
            btnNextStep2.disabled = !esValido;

            if (esValido) {
                btnNextStep2.style.cursor = "pointer";
            } else {
                btnNextStep2.style.cursor = "not-allowed";
            }
        }
    }

    document.querySelectorAll('#step-2-colegio input, #step-2-colegio select, #step-2-academia input, #step-2-academia select').forEach(input => {
        input.addEventListener('input', validarPaso2);
        input.addEventListener('change', validarPaso2);
    });

    function validarChecksPaso3() {
        const enPaso3 = !step3Resumen.classList.contains('hidden-section');

        if (enPaso3) {
            const terminosAceptados = checkTerminos.checked;
            const politicasAceptadas = checkPoliticas.checked;
            const ambosAceptados = terminosAceptados && politicasAceptadas;

            btnNextStep2.disabled = !ambosAceptados;

            if (ambosAceptados) {
                btnNextStep2.style.cursor = "pointer";
            } else {
                btnNextStep2.style.cursor = "not-allowed";
            }
        }
    }

    if (checkTerminos) checkTerminos.addEventListener('change', validarChecksPaso3);
    if (checkPoliticas) checkPoliticas.addEventListener('change', validarChecksPaso3);

    btnNextStep2.addEventListener('click', (e) => {
        if (btnNextStep2.disabled) {
            e.preventDefault();
            return false;
        }

        if (step3Resumen.classList.contains('hidden-section')) {
            const modalidad = selectorModalidad.value;

            document.getElementById('res-modalidad').textContent = modalidad.toUpperCase();

            if (modalidad === 'colegio') {
                const gradoTexto = gradoSelect.options[gradoSelect.selectedIndex].text;
                const seccionTexto = seccionSelect.options[seccionSelect.selectedIndex].text;
                document.getElementById('res-ciclo').textContent = `${gradoTexto} - SECCIÓN ${seccionTexto}`;
                document.getElementById('res-turno').textContent = turnoEscolarSelect.value.toUpperCase();

                const nom = document.querySelector('input[name="col_nombres"]').value;
                const apeP = document.querySelector('input[name="col_ape_paterno"]').value;
                const apeM = document.querySelector('input[name="col_ape_materno"]').value;
                document.getElementById('res-alumno-full').textContent = `${nom} ${apeP} ${apeM}`;
                document.getElementById('res-alumno-dni').textContent = document.querySelector('input[name="col_dni"]').value;
                document.getElementById('res-alumno-email').textContent = document.querySelector('input[name="col_email"]').value;

                document.getElementById('res-alumno-celular').textContent = "NO REGISTRADO";

                const gen = document.querySelector('select[name="col_genero"]').value === 'M' ? 'MASCULINO' : 'FEMENINO';
                const fec = document.querySelector('input[name="col_fecha_nac"]').value;
                document.getElementById('res-alumno-extra').textContent = `${gen} | NAC: ${fec}`;

                document.getElementById('res-card-apoderado').style.display = 'block';
                const nomApo = document.querySelector('input[name="apo_nombres"]').value;
                const apePApo = document.querySelector('input[name="apo_ape_paterno"]').value;
                document.getElementById('res-apo-nombre').textContent = `${nomApo} ${apePApo}`;
                document.getElementById('res-apo-dni').textContent = document.querySelector('input[name="apo_dni"]').value;
                document.getElementById('res-apo-cel').textContent = document.querySelector('input[name="apo_celular"]').value;

            } else {
                const cicloActivo = document.querySelector('input[name="ciclo_op"]:checked');
                document.getElementById('res-ciclo').textContent = cicloActivo ? cicloActivo.closest('.ciclo-card').querySelector('.nombre-ciclo').textContent : "-";
                document.getElementById('res-turno').textContent = turnoSelect.value.toUpperCase();

                const nom = document.querySelector('input[name="aca_nombres"]').value;
                const apeP = document.querySelector('input[name="aca_ape_paterno"]').value;
                const apeM = document.querySelector('input[name="aca_ape_materno"]').value;
                document.getElementById('res-alumno-full').textContent = `${nom} ${apeP} ${apeM}`;
                document.getElementById('res-alumno-dni').textContent = document.querySelector('input[name="aca_dni"]').value;
                document.getElementById('res-alumno-email').textContent = document.querySelector('input[name="aca_email"]').value;
                document.getElementById('res-alumno-celular').textContent = document.querySelector('input[name="aca_celular"]').value;

                const gen = document.querySelector('select[name="aca_genero"]').value === 'M' ? 'MASCULINO' : 'FEMENINO';
                const fec = document.querySelector('input[name="aca_fecha_nac"]').value;
                document.getElementById('res-alumno-extra').textContent = `${gen} | NAC: ${fec}`;

                const esMayor = document.querySelector('input[name="es_mayor"]:checked')?.value === 'si';
                const cardApo = document.getElementById('res-card-apoderado');

                if (esMayor) {
                    cardApo.style.display = 'none';
                } else {
                    cardApo.style.display = 'block';
                    const nomApo = document.querySelector('input[name="aca_apo_nombres"]').value;
                    const apePApo = document.querySelector('input[name="aca_apo_ape_paterno"]').value;
                    document.getElementById('res-apo-nombre').textContent = `${nomApo} ${apePApo}`;
                    document.getElementById('res-apo-dni').textContent = document.querySelector('input[name="aca_apo_dni"]').value;
                    document.getElementById('res-apo-cel').textContent = document.querySelector('input[name="aca_apo_celular"]').value;
                }
            }

            const tablaOrigen = (modalidad === 'colegio') ? cronogramaBodyCol : cronogramaBody;
            const resCronogramaBody = document.getElementById('res-cronograma-body-final');
            const templateFilaRes = document.getElementById('template-fila-resumen');

            while (resCronogramaBody.firstChild) {
                resCronogramaBody.removeChild(resCronogramaBody.firstChild);
            }

            tablaOrigen.querySelectorAll('tr').forEach(filaOriginal => {
                const instancia = templateFilaRes.content.cloneNode(true);

                instancia.querySelector('.res-col-cuota').textContent = filaOriginal.querySelector('.col-cuota').textContent;
                instancia.querySelector('.res-col-vencimiento').textContent = filaOriginal.querySelector('.col-vencimiento').textContent;

                const descTexto = filaOriginal.querySelector('.col-descuento').textContent;
                const celdaDesc = instancia.querySelector('.res-col-descuento');
                celdaDesc.textContent = "S/ " + descTexto;

                if (descTexto !== "0.00") {
                    celdaDesc.classList.add('texto-descuento-aplicado');
                }

                instancia.querySelector('.res-col-total').textContent = "S/ " + filaOriginal.querySelector('.col-total').textContent;
                resCronogramaBody.appendChild(instancia);
            });

            const nameRadio = (modalidad === 'colegio') ? 'p_col' : 'p';
            const pagoElegido = document.querySelector(`input[name="${nameRadio}"]:checked`);
            document.getElementById('res-pago-metodo').textContent = (pagoElegido && pagoElegido.value === 'c') ? "PAGO EN CUOTAS" : "PAGO AL CONTADO (5% DESC.)";
            document.getElementById('res-pago-total').textContent = (modalidad === 'colegio') ? totalGeneralCol.textContent : document.getElementById('cronograma-total-general').textContent;

            step2Colegio.classList.add('hidden-section');
            step2Academia.classList.add('hidden-section');
            step3Resumen.classList.remove('hidden-section');
            document.getElementById('step-2-indicator').classList.remove('active');
            document.getElementById('step-3-indicator').classList.add('active');

            validarChecksPaso3();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

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
        limpiarSelector(seccionSelect);
        limpiarSelector(turnoEscolarSelect);

        gradoSelect.disabled = false;
        seccionSelect.disabled = true;
        turnoEscolarSelect.disabled = true;

        const containerCardsCol = document.getElementById('ciclos-container-colegio');
        const containerCronogramaCol = document.getElementById('cronograma-container-colegio');

        if (containerCardsCol) containerCardsCol.classList.add('hidden-section');
        if (containerCronogramaCol) containerCronogramaCol.classList.add('hidden-section');

        const nivelSeleccionado = this.value;
        const maxGrado = (nivelSeleccionado === 'primaria') ? 6 : 5;

        for (let i = 1; i <= maxGrado; i++) {
            let sufijo = "to";
            if (i === 1 || i === 3) sufijo = "ero";
            else if (i === 2) sufijo = "do";

            const textoGrado = `${i}${sufijo}`;
            gradoSelect.add(new Option(textoGrado, i));
        }

        validarPaso1();
    });

    gradoSelect.addEventListener('change', function() {
        const nivel = nivelSelect.value;
        const grado = this.value;

        limpiarSelector(seccionSelect);
        limpiarSelector(turnoEscolarSelect);

        turnoEscolarSelect.disabled = true;

        const containerCardsCol = document.getElementById('ciclos-container-colegio');
        const containerCronogramaCol = document.getElementById('cronograma-container-colegio');

        if (containerCardsCol) containerCardsCol.classList.add('hidden-section');
        if (containerCronogramaCol) containerCronogramaCol.classList.add('hidden-section');

        if (DB_COLEGIO[nivel] && DB_COLEGIO[nivel][grado]) {
            const seccionesDisponibles = DB_COLEGIO[nivel][grado].secciones;

            Object.keys(seccionesDisponibles).forEach(letra => {
                seccionSelect.add(new Option(`Sección ${letra}`, letra));
            });

            seccionSelect.disabled = false;
        } else {
            seccionSelect.disabled = true;
        }

        validarPaso1();
    });

    seccionSelect.addEventListener('change', function() {
        const nivel = nivelSelect.value;
        const grado = gradoSelect.value;
        const letraSeccion = this.value;

        limpiarSelector(turnoEscolarSelect);

        const containerCardsCol = document.getElementById('ciclos-container-colegio');
        const containerCronogramaCol = document.getElementById('cronograma-container-colegio');

        if (containerCardsCol) containerCardsCol.classList.add('hidden-section');
        if (containerCronogramaCol) containerCronogramaCol.classList.add('hidden-section');

        const dataSeccion = (DB_COLEGIO[nivel] && DB_COLEGIO[nivel][grado] && DB_COLEGIO[nivel][grado].secciones)
                            ? DB_COLEGIO[nivel][grado].secciones[letraSeccion] : null;

        if (dataSeccion) {
            if (dataSeccion.mañana) {
                const textoMañana = `Mañana (${dataSeccion.mañana.horario})`;
                turnoEscolarSelect.add(new Option(textoMañana, "mañana"));
            }

            if (dataSeccion.tarde) {
                const textoTarde = `Tarde (${dataSeccion.tarde.horario})`;
                turnoEscolarSelect.add(new Option(textoTarde, "tarde"));
            }

            turnoEscolarSelect.disabled = false;
        } else {
            turnoEscolarSelect.disabled = true;
        }

        validarPaso1();
    });

    turnoEscolarSelect.addEventListener('change', function() {
        renderizarCiclos();
        validarPaso1();
    });

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
        const modalidad = selectorModalidad.value;
        let ciclos = [];
        const contenedorDestino = (modalidad === 'academia') ? ciclosCont : ciclosContCol;

        if (modalidad === 'academia') {
            const uniId = uniSelect.value;
            const tipoId = tipoCicloSelect.value;
            const turnoId = turnoSelect.value;

            const configDelTurno = (DB_CICLOS[uniId] && DB_CICLOS[uniId][tipoId] && DB_CICLOS[uniId][tipoId][turnoId])
                                   ? DB_CICLOS[uniId][tipoId][turnoId] : null;

            ciclos = (configDelTurno && configDelTurno.grupos) ? configDelTurno.grupos : [];
        }
        else if (modalidad === 'colegio') {
            const nivel = nivelSelect.value;
            const grado = gradoSelect.value;
            const seccion = seccionSelect.value;
            const turno = turnoEscolarSelect.value;

            const dataTurno = (DB_COLEGIO[nivel] &&
                               DB_COLEGIO[nivel][grado] &&
                               DB_COLEGIO[nivel][grado].secciones[seccion])
                               ? DB_COLEGIO[nivel][grado].secciones[seccion][turno] : null;

            ciclos = (dataTurno && dataTurno.grupos) ? dataTurno.grupos : [];
        }

        if (!contenedorDestino) return;

        while (contenedorDestino.firstChild) {
            contenedorDestino.removeChild(contenedorDestino.firstChild);
        }

        if (ciclos.length === 0) {
            contenedorDestino.classList.add('hidden-section');
            return;
        }

        ciclos.forEach(ciclo => {
            const instancia = templateCiclo.content.cloneNode(true);
            const radio = instancia.querySelector('.ciclo-radio');

            radio.value = ciclo.id;
            radio.name = "ciclo_op";

            instancia.querySelector('.nombre-ciclo').textContent = ciclo.nombre;
            instancia.querySelector('.fechas-ciclo').textContent = ciclo.fechas;

            contenedorDestino.appendChild(instancia);
        });

        contenedorDestino.classList.remove('hidden-section');
    }

    turnoSelect.addEventListener('change', function() {
        renderizarCiclos();
        cronogramaCont.classList.add('hidden-section');
        validarPaso1();
    });

    function generarCronograma() {
        const modalidad = selectorModalidad.value;

        const radioChecked = document.querySelector('input[name="ciclo_op"]:checked');
        if (!radioChecked) return;

        const cicloId = radioChecked.value;
        let datosBase = null;

        const bodyDestino = (modalidad === 'academia')
                            ? cronogramaBody
                            : cronogramaBodyCol;

        const contenedorDestino = (modalidad === 'academia')
                                  ? cronogramaCont
                                  : cronogramaContCol;

        if (modalidad === 'academia') {
            const uniId = uniSelect.value;
            const turnoId = turnoSelect.value;
            datosBase = (DB_CRONOGRAMA_ACADEMIA[uniId] && DB_CRONOGRAMA_ACADEMIA[uniId][turnoId])
                        ? DB_CRONOGRAMA_ACADEMIA[uniId][turnoId][cicloId] : null;
        }
        else if (modalidad === 'colegio') {
            datosBase = DB_CRONOGRAMA_COLEGIO[cicloId] || null;
        }

        const radioCuotas = contenedorDestino.querySelector('input[value="c"]');
        if (radioCuotas) radioCuotas.checked = true;

        if (!bodyDestino) return;
        while (bodyDestino.firstChild) {
            bodyDestino.removeChild(bodyDestino.firstChild);
        }

        if (!datosBase) {
            contenedorDestino.classList.add('hidden-section');
            return;
        }

        bodyDestino.dataset.baseData = JSON.stringify(datosBase);

        actualizarTotales();

        contenedorDestino.classList.remove('hidden-section');

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

        cronogramaCont.classList.add('hidden-section');
        while (cronogramaBody.firstChild) {
            cronogramaBody.removeChild(cronogramaBody.firstChild);
        }
        delete cronogramaBody.dataset.baseData;

        nivelSelect.selectedIndex = 0;
        limpiarSelector(gradoSelect);
        limpiarSelector(seccionSelect);
        limpiarSelector(turnoEscolarSelect);

        gradoSelect.disabled = true;
        seccionSelect.disabled = true;
        turnoEscolarSelect.disabled = true;

        while (ciclosContCol.firstChild) {
            ciclosContCol.removeChild(ciclosContCol.firstChild);
        }
        ciclosContCol.classList.add('hidden-section');

        cronogramaContCol.classList.add('hidden-section');
        while (cronogramaBodyCol.firstChild) {
            cronogramaBodyCol.removeChild(cronogramaBodyCol.firstChild);
        }
        delete cronogramaBodyCol.dataset.baseData;

        validarPaso1();
    }

    function actualizarTotales() {
        const modalidad = selectorModalidad.value;

        const bodyActual = (modalidad === 'academia') ? cronogramaBody : cronogramaBodyCol;
        const totalTxtActual = (modalidad === 'academia')
                               ? document.getElementById('cronograma-total-general')
                               : totalGeneralCol;

        const nameRadio = (modalidad === 'academia') ? 'p' : 'p_col';
        const radioPago = document.querySelector(`input[name="${nameRadio}"]:checked`);

        if (!radioPago || !bodyActual || !bodyActual.dataset.baseData) return;

        const datosBase = JSON.parse(bodyActual.dataset.baseData);
        const modoPago = radioPago.value;
        const templateFila = document.getElementById('template-fila-cronograma');

        while (bodyActual.firstChild) {
            bodyActual.removeChild(bodyActual.firstChild);
        }

        let sumaTotalFinal = 0;

        if (modoPago === 'c') {
            datosBase.forEach(item => {
                const fila = templateFila.content.cloneNode(true);

                fila.querySelector('.col-cuota').textContent = item.c;
                fila.querySelector('.col-vencimiento').textContent = item.f;
                fila.querySelector('.col-importe').textContent = item.i.toFixed(2);
                fila.querySelector('.col-descuento').textContent = "0.00";
                fila.querySelector('.col-total').textContent = item.i.toFixed(2);

                bodyActual.appendChild(fila);
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

            bodyActual.appendChild(fila);
            sumaTotalFinal = neto;
        }

        if (totalTxtActual) {
            totalTxtActual.textContent = sumaTotalFinal.toFixed(2);
        }
    }

    if (btnRegresar) {
        btnRegresar.addEventListener('click', () => {
            const modalidad = selectorModalidad.value;

            if (!step3Resumen.classList.contains('hidden-section')) {
                step3Resumen.classList.add('hidden-section');

                if (modalidad === 'colegio') {
                    step2Colegio.classList.remove('hidden-section');
                } else {
                    step2Academia.classList.remove('hidden-section');
                }

                document.getElementById('step-3-indicator').classList.remove('active');
                document.getElementById('step-2-indicator').classList.add('active');

                validarPaso2();
            }

            else {
                const form = document.getElementById('enrollmentForm');
                if (form) form.reset();

                limpiarSecciones();
                if (selectorModalidad) selectorModalidad.selectedIndex = 0;

                step2Colegio.classList.add('hidden-section');
                step2Academia.classList.add('hidden-section');

                if (navStep2) {
                    navStep2.classList.remove('step2-active');
                    navStep2.classList.add('hidden-section');
                }

                welcomeCard.classList.remove('hidden-section');
                secColegio.classList.add('hidden-section');
                secAcademia.classList.add('hidden-section');
                footerActions.classList.add('hidden-section');

                document.getElementById('step-2-indicator').classList.remove('active');
                document.getElementById('step-1-indicator').classList.add('active');

                validarPaso1();
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    const inputsNumericos = document.querySelectorAll('input[name*="dni"], input[name*="celular"]');

    inputsNumericos.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });


    btnContinuar.addEventListener('click', () => {
        if (btnContinuar.disabled) return;

        const modalidad = selectorModalidad.value;

        const seccionesStep1 = [
            welcomeCard,
            secAcademia,
            secColegio,
            ciclosCont,
            cronogramaCont,
            footerActions,
            ciclosContCol,
            cronogramaContCol
        ];

        seccionesStep1.forEach(seccion => {
            if (seccion) seccion.classList.add('hidden-section');
        });

        if (navStep2) {
            navStep2.classList.add('step2-active');
            navStep2.classList.remove('hidden-section');
        }

        document.getElementById('step-1-indicator').classList.remove('active');
        document.getElementById('step-2-indicator').classList.add('active');

        if (modalidad === 'colegio') {
            step2Colegio.classList.remove('hidden-section');
        } else {
            step2Academia.classList.remove('hidden-section');
        }

        validarPaso2();

        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.addEventListener('change', (e) => {

        if (e.target.name === 'ciclo_op') {
            generarCronograma();
            validarPaso1();
        }

        if (e.target.name === 'p' || e.target.name === 'p_col') {
            actualizarTotales();
            validarPaso1();
        }

        if (e.target.name === 'es_mayor') {
            const seccionApoderadoAca = document.getElementById('seccion-apoderado-academia');
            const seccionApoderadoCol = document.getElementById('seccion-apoderado-colegio');

            const debeOcultar = (e.target.value === 'si');

            if (seccionApoderadoAca) seccionApoderadoAca.classList.toggle('hidden-section', debeOcultar);
            if (seccionApoderadoCol) seccionApoderadoCol.classList.toggle('hidden-section', debeOcultar);

            validarPaso2();
        }
    });
});
