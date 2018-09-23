    Chart.pluginService.register({
        beforeRender: function (chart) {
            if (chart.config.options.showAllTooltips) {
                // create an array of tooltips
                // we can't use the chart tooltip because there is only one tooltip per chart
                chart.pluginTooltips = [];
                chart.config.data.datasets.forEach(function (dataset, i) {
                    chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                        chart.pluginTooltips.push(new Chart.Tooltip({
                            _chart: chart.chart,
                            _chartInstance: chart,
                            _data: chart.data,
                            _options: chart.options.tooltips,
                            _active: [sector]
                        }, chart));
                    });
                });

                //turn off normal tooltips
                chart.options.tooltips.enabled = false;
            }
        },
        afterDraw: function (chart, easing) {
            if (chart.config.options.showAllTooltips) {
               // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                if (!chart.allTooltipsOnce) {
                    if (easing !== 1)
                        return;
                    chart.allTooltipsOnce = true;
                }

                // turn on tooltips
                chart.options.tooltips.enabled = true;
                Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                    tooltip.initialize();
                    tooltip.update();
                    //we don't actually need this since we are not animating tooltips
                    tooltip.pivot();
                    tooltip.transition(easing).draw();
                });
                chart.options.tooltips.enabled = false;
            }
        }
    });
//     var myChart = new Chart(ctx, {
//         type: 'line',
//         data: {
//             labels: months,//months
//             datasets: [{
//                 label: 'Cantidad',
//                 data: valores,//Values
//                 backgroundColor: [
//                     'rgba(255, 99, 132, 0.2)',
//                     'rgba(54, 162, 235, 0.2)',
//                     'rgba(255, 206, 86, 0.2)',
//                     'rgba(75, 192, 192, 0.2)',
//                     'rgba(153, 102, 255, 0.2)',
//                     'rgba(255, 159, 64, 0.2)'
//                 ],
//                 borderColor: [
//                     'rgba(255,99,132,1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)'
//                 ],
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             title: {
//                 display: true,
//                 text: 'Valores: '+valores.join(' - '),
//                 position: 'bottom'
//             },
//             tooltips: {

//             },
//             showAllTooltips: false,//Muestra los Tooltips de siempre(si está en true)
//             elements: {
//                 line: {
//                     tension: 0, // disables bezier curves
//                 }
//             },
//             scales: {

//                 yAxes: [{
//                     ticks: {
//                         beginAtZero:true
//                     }
//                 }]
//             }
//         }
//     });
//     ctx.font = "30px Arial";
//     ctx.strokeText("Hello World",10,50);
// })


$(function () {
    /* INICIO: crea las variables para los datos de los graficos, con los datos de las vistas. */
    // var datosAlimentacion = {
    //     labels: fechas_alimentacion,
    //     datasets:
    //         [{
    //             showLine: false, // disable for a single dataset
    //             label: 'Alimentación',
    //             data: alimentacion,
    //             lineTension: 0,
    //             fill: false,
    //             borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
    //             backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
    //             borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
    //             pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
    //             pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
    //             pointRadius: 3, //Punto en el grafico, que tan ancho sera
    //             pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
    //             pointHitRadius: 30,
    //             pointBorderWidth: 2,
    //             pointStyle: 'circle'
    //         }]
    //
    // };

    var datosTemperaturas = {
        labels: fechas_temperaturas,
        datasets:
            [{
                label: 'Temperatura',
                data: temperaturas,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]

    };

    var datosPh = {
        labels: fechas_ph,
        datasets:
            [{
                label: 'pH',
                data: ph,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]
    };

    var datosNitritos = {
        labels: fechas_nitritos,
        datasets:
            [{
                label: 'Nitritos',
                data: nitritos,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]
    };

    var datosNitratos = {
        labels: fechas_nitratos,
        datasets:
            [{
                label: 'Nitratos',
                data: nitratos,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]
    };

    var datosSalinidad = {
        labels: fechas_salinidad,
        datasets:
            [{
                label: 'Salinidad',
                data: salinidad,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]
    };

    var datosAmonio = {
        labels: fechas_amonio,
        datasets:
            [{
                label: 'Amonio',
                data: amonio,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]
    };

    var datosOxigeno = {
        labels: fechas_oxigeno,
        datasets:
            [{
                label: 'Oxígeno',
                data: oxigeno,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]
    };

    var datosMortalidad = {
        labels: fechas_mortalidades,
        datasets:
            [{
                label: 'Mortalidades',
                data: mortalidades,
                lineTension: 0,
                fill: false,
                borderColor:  'rgba(0,192,239)', //Color de la linea del grafico
                backgroundColor: 'transparent', //Color de fondo de la etiqueta que describe la linea
                borderDash: [1, 0], //Linea continua, primer valor la cantidad de pixeles, segundo valor la separacion entre uno y otro
                pointBorderColor: 'rgba(0,115,183)', //Color del bordeado del punto
                pointBackgroundColor: 'rgba(0,115,183)', //Color del punto
                pointRadius: 3, //Punto en el grafico, que tan ancho sera
                pointHoverRadius: 5, //Ancho del punto en el grafico al pasar el mouse
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'circle'
            }]

    };
    /* FIN: se cargan los graficos con los datos de las vistas */


    // var opcionesDelGrafico = {
    //     legend: {
    //         display: false,
    //         position: 'top',
    //         labels: {
    //             boxWidth: 80,
    //             fontColor: 'black'
    //         }
    //
    //     },
    //     showAllTooltips: false,//Muestra los Tooltips de siempre(si está en true)
    // };


    // INICIO: se obtienen los contextos de la vista, para dibujar los graficos.
    // Para el grafico de lineas para la variable de Temperaturas
if ($("#graficoMortalidad").length > 0) {
  var ctx_mort = document.getElementById("graficoMortalidad").getContext("2d");
}
    // var ctx_alimentacion = document.getElementById('graficoAlimentacion').getContext("2d")

    var ctx_temp = document.getElementById("graficoTemperatura").getContext("2d");

    // Para el grafico de lineas para la variable de Ph
    var ctx_ph = document.getElementById("graficoPh").getContext("2d");

    // Para el grafico de lineas para la variable de Ph
    var ctx_nitritos = document.getElementById("graficoNitritos").getContext("2d");

    // Para el grafico de lineas para la variable de Ph
    var ctx_nitratos = document.getElementById("graficoNitratos").getContext("2d");

    // Para el grafico de lineas para la variable de Ph
    var ctx_salinidad = document.getElementById("graficoSalinidad").getContext("2d");

    // Para el grafico de lineas para la variable de Ph
    var ctx_amonio = document.getElementById("graficoAmonio").getContext("2d");

    // Para el grafico de lineas para la variable de Ph
    var ctx_oxigeno = document.getElementById("graficoOxigeno").getContext("2d");
    // FIN: se obtienen los contextos de las vistas


    //INICIO: se crean los graficos y se dibujan en la vista
    // graficoAlimentacion = new Chart(ctx_alimentacion, {
    //     type: 'line',
    //     data: datosAlimentacion,
    //     options: {
    //         title: {
    //             display: true,
    //             text: 'Valores: '+alimentacion.join(' - '),
    //             position: 'bottom'
    //         },
    //     }
    // });

    graficoTemperaturas = new Chart(ctx_temp, {
        type: 'line',
        data: datosTemperaturas,
        options: {
            title: {
                display: true,
                text: 'Valores: '+temperaturas.join(' - '),
                position: 'bottom'
            },
        }
    });

    graficoPh = new Chart(ctx_ph, {
        type: 'line',
        data: datosPh,
        options: {
            title: {
                display: true,
                text: 'Valores: '+ph.join(' - '),
                position: 'bottom'
            },
        }
    });

    graficoNitritos = new Chart(ctx_nitritos, {
        type: 'line',
        data: datosNitritos,
        options: {
            title: {
                display: true,
                text: 'Valores: '+nitritos.join(' - '),
                position: 'bottom'
            },
        }
    });

    graficoNitratos = new Chart(ctx_nitratos, {
        type: 'line',
        data: datosNitratos,
        options: {
            title: {
                display: true,
                text: 'Valores: '+nitratos.join(' - '),
                position: 'bottom'
            },
        }
    });

    graficoSalinidad = new Chart(ctx_salinidad, {
        type: 'line',
        data: datosSalinidad,
        options: {
            title: {
                display: true,
                text: 'Valores: '+salinidad.join(' - '),
                position: 'bottom'
            },
        }
    });

    graficoAmonio = new Chart(ctx_amonio, {
        type: 'line',
        data: datosAmonio,
        options: {
            title: {
                display: true,
                text: 'Valores: '+amonio.join(' - '),
                position: 'bottom'
            },
        }
    });

    graficoOxigeno = new Chart(ctx_oxigeno, {
        type: 'line',
        data: datosOxigeno,
        options: {
            title: {
                display: true,
                text: 'Valores: '+oxigeno.join(' - '),
                position: 'bottom'
            },
        }
    });
    //FIN: creación de los gráficos
    if ($("#graficoMortalidad").length > 0) {
      graficoMortalidad = new Chart(ctx_mort, {
          type: 'line',
          data: datosMortalidad,
          options: {
              title: {
                  display: true,
                  text: 'Valores: '+mortalidades.join(' - '),
                  position: 'bottom'
              },
          }
      });
    }


    // INICIO: grafico de barras
    /**Datos para cargar el grafico, donde se establecen las etiquetas y los datos, de los
     * desoves totales del estanque especificado
     */
    var datos_desoves_totales = {
        labels: desoves_fechas, //Etiquetas de la parte de abajo del grafico
        datasets: [{
            label: "Huevos totales", //Etiqueta que se muestra al pasar el mouse sobre la barra del grafico
            data: desoves_totales, //Datos a cargar en la barra del grafico
            backGroundColor: 'black', //Color de fondo de la barra del grafico
            borderColor: 'black', //Color de borde de la barra del grafico
            borderWidth: 1 //Ancho del borde de la barra
        }]
    };

    /**Datos para cargar el grafico, donde se establecen las etiquetas y los datos, de los
     * huevos viables en el desove del estanque especificado.
     */
    var datos_desoves_viables = {
        labels: desoves_fechas, //Etiquetas de la parte de abajo del grafico
        datasets: [{
            label: "Huevos viables", //Etiqueta que se muestra al pasar el mouse sobre la barra del grafico
            data: desoves_viables, //Datos a cargar en la barra del grafico
            backGroundColor: 'black', //Color de fondo de la barra del grafico
            borderColor: 'black', //Color de borde de la barra del grafico
            borderWidth: 1 //Ancho del borde de la barra
        }]
    };

    /**Datos para cargar el grafico, donde se establecen las etiquetas y los datos, de los
     * huevos NO viables en el desove del estanque especificado.
     */
    var datos_desoves_noViables = {
        labels: desoves_fechas, //Etiquetas de la parte de abajo del grafico
        datasets: [{
            label: "Huevos no viables", //Etiqueta que se muestra al pasar el mouse sobre la barra del grafico
            data: desoves_no_viables, //Datos a cargar en la barra del grafico
            backGroundColor: 'black', //Color de fondo de la barra del grafico
            borderColor: 'black', //Color de borde de la barra del grafico
            borderWidth: 1 //Ancho del borde de la barra
        }]
    };

    /**Datos para cargar el grafico, donde se establecen las etiquetas y los datos, de los
     * porcentajes de viabilidad en el desove del estanque especificado.
     */
    var datos_desoves_porcViabilidad = {
        labels: desoves_fechas, //Etiquetas de la parte de abajo del grafico
        datasets: [{
            label: "Porcentaje de viabilidad", //Etiqueta que se muestra al pasar el mouse sobre la barra del grafico
            data: desoves_porcentaje_viabilidad, //Datos a cargar en la barra del grafico
            backGroundColor: 'black', //Color de fondo de la barra del grafico
            borderColor: 'black', //Color de borde de la barra del grafico
            borderWidth: 1 //Ancho del borde de la barra
        }]
    };

    /**Datos para cargar el grafico, donde se establecen las etiquetas y los datos, de los
     * diametros de huevo en el desove del estanque especificado.
     */
    var datos_desoves_diametroHuevo = {
        labels: desoves_fechas, //Etiquetas de la parte de abajo del grafico
        datasets: [{
            label: "Diametros de huevos", //Etiqueta que se muestra al pasar el mouse sobre la barra del grafico
            data: desoves_diametro_huevo, //Datos a cargar en la barra del grafico
            backGroundColor: 'black', //Color de fondo de la barra del grafico
            borderColor: 'black', //Color de borde de la barra del grafico
            borderWidth: 1 //Ancho del borde de la barra
        }]
    };

    /**Datos para cargar el grafico, donde se establecen las etiquetas y los datos, de los
     * diametros de la gota en el desove del estanque especificado.
     */
    var datos_desoves_diametroGota = {
        labels: desoves_fechas, //Etiquetas de la parte de abajo del grafico
        datasets: [{
            label: "Diametros de gota", //Etiqueta que se muestra al pasar el mouse sobre la barra del grafico
            data: desoves_diametro_gota, //Datos a cargar en la barra del grafico
            backGroundColor: 'black', //Color de fondo de la barra del grafico
            borderColor: 'black', //Color de borde de la barra del grafico
            borderWidth: 1 //Ancho del borde de la barra
        }]
    };

    var ctxTotales = document.getElementById("graficoHuevosTotales").getContext("2d");
    var ctxViables = document.getElementById("graficoHuevosViables").getContext("2d");
    var ctxNoViables = document.getElementById("graficoHuevosNoViables").getContext("2d");
    var ctxPorcViabilidad = document.getElementById("graficoPorcViabilidad").getContext("2d");
    var ctxDiametroHuevo = document.getElementById("graficoDiametroHuevo").getContext("2d");
    var ctxDiametroGota = document.getElementById("graficoDiametroGota").getContext("2d");

    var chartOptions = {
        responsive: true,
        title: {
            display: true,
            fontSize: 18,
            fontColor: "#111"
        },
        legend: {
            display: true,
            position: "top",
            labels: {
                fontColor: "#333",
                fontSize: 16
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0
                }
            }]
        }
    };

    graficoTotales = new Chart(ctxTotales, {
        type: 'bar',
        data: datos_desoves_totales,
        options: chartOptions
    });

    graficoViables = new Chart(ctxViables, {
        type: 'bar',
        data: datos_desoves_viables,
        options: chartOptions
    });

    graficoNoViables = new Chart(ctxNoViables, {
        type: 'bar',
        data: datos_desoves_noViables,
        options: chartOptions
    });

    graficoViabilidad = new Chart(ctxPorcViabilidad, {
        type: 'bar',
        data: datos_desoves_porcViabilidad,
        options: chartOptions
    });

    graficoDiametroHuevo = new Chart(ctxDiametroHuevo, {
        type: 'bar',
        data: datos_desoves_diametroHuevo,
        options: chartOptions
    });

    graficoDiametroGota = new Chart(ctxDiametroGota, {
        type: 'bar',
        data: datos_desoves_diametroGota,
        options: chartOptions
    });



});
