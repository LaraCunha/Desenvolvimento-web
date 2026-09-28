let botaoVacinas = document.getElementById("rankingVacinas");
let botaoMortes = document.getElementById("rankingMortes");

let resultado = document.getElementById("resultado");

function buscarRankings() {

    let buscaPaises = fetch("https://disease.sh/v3/covid-19/countries/")
        .then(function(resposta) {
            return resposta.json();
        });

    let buscaVacinas = fetch("https://disease.sh/v3/covid-19/vaccine/coverage/countries?lastdays=1")
        .then(function(resposta) {
            return resposta.json();
        });


    return Promise.all([buscaPaises, buscaVacinas])
        .then(function(resultados) {

            let dadosPaises = resultados[0];
            let dadosVacinas = resultados[1];


            let paises = dadosPaises.map(function(paisCovid) {
                return {
                    nome: paisCovid.country,
                    mortes: paisCovid.deaths,
                    populacao: paisCovid.population
                };
            });


            let vacinas = dadosVacinas.map(function(paisVacina) {

                let [quantidadeVacinas] = Object.values(paisVacina.timeline);

                return {
                    nome: paisVacina.country,
                    vacinas: quantidadeVacinas
                };
            });


            let dadosCompletos = paises
                .filter(function(paisCovid) {
                    return vacinas.find(function(vacinaDoPais) {
                        return vacinaDoPais.nome === paisCovid.nome;
                    });
                })
                .map(function(paisCovid) {

                    let vacinaDoPais = vacinas.find(function(vacinaDoPais) {
                        return vacinaDoPais.nome === paisCovid.nome;
                    });

                    return {
                        nome: paisCovid.nome,
                        mortes: paisCovid.mortes,
                        populacao: paisCovid.populacao,
                        vacinas: vacinaDoPais.vacinas,
                        porcentagemMortes: (paisCovid.mortes / paisCovid.populacao) * 100,
                        porcentagemVacinas: (vacinaDoPais.vacinas / paisCovid.populacao) * 100
                    };
                });


            let rankingVacinas = [...dadosCompletos];

            rankingVacinas.sort(function(paisA, paisB) {
                return paisB.porcentagemVacinas - paisA.porcentagemVacinas;
            });


            let rankingMortes = [...dadosCompletos];

            rankingMortes.sort(function(paisA, paisB) {
                return paisB.porcentagemMortes - paisA.porcentagemMortes;
            });


            return {
                rankingVacinas: rankingVacinas,
                rankingMortes: rankingMortes
            };

        });
}

botaoVacinas.addEventListener("click", function() {
     buscarRankings().then(function(resultados) {

        resultado.innerHTML = "<h2>Ranking de vacinação</h2>";

        resultados.rankingVacinas.forEach(function(paisVacina) {
            resultado.innerHTML += "<p>" + paisVacina.nome + " — " + paisVacina.porcentagemVacinas.toFixed(2) + "%</p>";
        });

    });
});


botaoMortes.addEventListener("click", function() {
     buscarRankings().then(function(resultados) {

        resultado.innerHTML = "<h2>Ranking de mortes</h2>";

        resultados.rankingMortes.forEach(function(paisMorte) {
            resultado.innerHTML += "<p>" + paisMorte.nome + " — " + paisMorte.porcentagemMortes.toFixed(2) + "%</p>";
        });

    });
});

//O .map() passa por cada país da lista e cria um novo objeto para ele.
//Promise.all garante que só vai acontecer isso depois de ja ter buscado as duas APIs 
//O .find() percorre a API