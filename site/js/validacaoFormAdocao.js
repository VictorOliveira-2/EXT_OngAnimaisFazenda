function Validar(){
    const nome = document.formAdocao.nome.value;
    const cpf= document.formAdocao.cpf.value;
    const telefone = document.formAdocao.tel.value;
    const email = document.formAdocao.email.value;
    const dataNasc = document.formAdocao.dataNasc.value;
    const descricao = document.formAdocao.descricao.value;
    const endereco = document.formAdocao.endereco.value; 
    const cidade = document.formAdocao.cidade.value;


    if (nome.length == "" || nome.length < 8){
        // alert("Nome inválido!");
        document.formAdocao.nome.classList.add('erroFormulario');
        document.querySelector("#validaNome").classList.add("exibido");
        return false;
    }

    if (cpf.length == "" || cpf.length < 14 || cpf.length > 14){
        // alert("CPF inválido!")
        document.formAdocao.cpf.classList.add('erroFormulario');
        document.querySelector("#validaCpf").classList.add("exibido");
        return false;
    }

    if (telefone.length == ""){
        // alert("Telefone inválido!")
        document.formAdocao.tel.classList.add('erroFormulario');
        document.querySelector("#validaTel").classList.add("exibido");
        return false;

    }
    if (email.length == ""){
        // alert("Preencha o e-mail corretamente")
        document.formAdocao.email.classList.add('erroFormulario');
        document.querySelector("#validaEmail").classList.add("exibido");
        return false;
    }
    if (dataNasc.length == ""){
        // alert("Data de nascimento inválida!")
        document.formAdocao.dataNasc.classList.add('erroFormulario');
        document.querySelector("#validaDataNasc").classList.add("exibido");
        return false; 
    }
    if (descricao.length == ""){
        // alert("Você deve descrever porque deseja anotar o animal");
        document.formAdocao.descricao.classList.add('erroFormulario');
        document.querySelector("#validaDescricao").classList.add("exibido");
        return false;
    }
    if (endereco.length == "" || endereco.length < 5){
        // alert("Endereço inválido! O campo deve conter nome da rua e número");
        document.formAdocao.endereco.classList.add('erroFormulario');
        document.querySelector("#validaEndereco").classList.add("exibido");
        return false;
    }
    if (cidade.length == ""){
        // alert("Cidade inválida!");   
        document.formAdocao.cidade.classList.add('erroFormulario');
        document.querySelector("#validaCidade").classList.add("exibido");
        return false;
    }

   
}