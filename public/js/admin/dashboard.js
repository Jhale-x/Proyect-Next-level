document.addEventListener("DOMContentLoaded", () => {

    const ctx = document.getElementById("estadisticasChart");

    if (!ctx) return;

    const gradientBlue = ctx.getContext("2d")
        .createLinearGradient(0, 0, 0, 400);

    gradientBlue.addColorStop(0, "rgba(37,99,235,1)");
    gradientBlue.addColorStop(1, "rgba(37,99,235,.3)");

    const gradientRed = ctx.getContext("2d")
        .createLinearGradient(0, 0, 0, 400);

    gradientRed.addColorStop(0, "rgba(220,38,38,1)");
    gradientRed.addColorStop(1, "rgba(220,38,38,.3)");

    const gradientDark = ctx.getContext("2d")
        .createLinearGradient(0, 0, 0, 400);

    gradientDark.addColorStop(0, "rgba(10,31,68,1)");
    gradientDark.addColorStop(1, "rgba(10,31,68,.3)");

    const gradientPink = ctx.getContext("2d")
        .createLinearGradient(0, 0, 0, 400);

    gradientPink.addColorStop(0, "rgba(248,113,113,1)");
    gradientPink.addColorStop(1, "rgba(248,113,113,.3)");

    const gradientSky = ctx.getContext("2d")
        .createLinearGradient(0, 0, 0, 400);

    gradientSky.addColorStop(0, "rgba(96,165,250,1)");
    gradientSky.addColorStop(1, "rgba(96,165,250,.3)");

    new Chart(ctx, {

        type: "bar",

        data: {

            labels: [
                "Alumnos",
                "Docentes",
                "Admins",
                "Auxiliares",
                "Cursos"
            ],

            datasets: [{

                label: "Cantidad",

                data: [
                    alumnosCount,
                    docentesCount,
                    adminsCount,
                    auxiliaresCount,
                    cursosCount
                ],

                borderRadius: 14,
                borderSkipped: false,

                barThickness: 55,
                maxBarThickness: 60,

                backgroundColor: [
                    gradientBlue,
                    gradientRed,
                    gradientDark,
                    gradientPink,
                    gradientSky
                ],

                hoverBackgroundColor: [
                    "#2563eb",
                    "#dc2626",
                    "#0a1f44",
                    "#f87171",
                    "#60a5fa"
                ]
            }]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            animation: {
                duration: 1800,
                easing: "easeOutQuart"
            },

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {

                    backgroundColor: "#0a1f44",

                    titleFont: {
                        size: 14
                    },

                    bodyFont: {
                        size: 13
                    },

                    padding: 12,
                    cornerRadius: 12
                }
            },

            scales: {

                x: {

                    grid: {
                        display: false
                    },

                    ticks: {
                        color: "#0a1f44",
                        font: {
                            weight: "600"
                        }
                    }
                },

                y: {

                    beginAtZero: true,

                    grid: {
                        color: "rgba(0,0,0,.05)"
                    },

                    ticks: {
                        color: "#64748b"
                    }
                }
            }
        }
    });

});