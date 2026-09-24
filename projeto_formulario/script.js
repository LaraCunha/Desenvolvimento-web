console.log("JavaScript funcionando!");

//cada paciente é um objeto dentro de um array de pacientes

let pacientes = [
    {
        id: 1,
        nome: "Ana Silva",
        idade: 32,
        doenca: "Diabetes",
        tratamento: "Insulina"
    },
    {
        id: 2,
        nome: "João Santos",
        idade: 45,
        doenca: "Hipertensão",
        tratamento: "Losartana"
    },
    {
        id: 3,
        nome: "Maria Oliveira",
        idade: 28,
        doenca: "Asma",
        tratamento: "Aerolin"
    }
];

console.log(pacientes);

//busca o que o usuário digitou no input e salva em formulario
let formulario = document.getElementById("formularioBusca");

let resultado = document.getElementById("resultado");

//ao clicar no botão 

formulario.addEventListener("submit", function(event) {
    event.preventDefault();

    let id = document.getElementById("idPaciente").value;

    console.log(id);

    //.find percorre o array de objetos e retorna o objeto inteiro
    let pacienteEncontrado = pacientes.find(function(paciente) {
    return paciente.id == id;
});
    console.log(pacienteEncontrado);

     if (pacienteEncontrado) {
        resultado.innerHTML = `
            <h2>Paciente encontrado!</h2>
            <p>Nome: ${pacienteEncontrado.nome}</p>
            <p>Idade: ${pacienteEncontrado.idade}</p>
            <p>Doença: ${pacienteEncontrado.doenca}</p>
            <p>Tratamento: ${pacienteEncontrado.tratamento}</p>
        `;
    resultado.className = "sucesso";
    } else {
        resultado.innerHTML = `
            <h2>Paciente não encontrado!</h2>
            <p>Não existe paciente com o ID informado.</p>
        `;
    resultado.className = "erro";
    }

});