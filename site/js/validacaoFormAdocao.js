function Validar(){
    const nome = document.formAdocao.nome.value;
    const cpf= document.formAdocao.cpf.value;
    const telefone = document.formAdocao.tel.value;
    const email = document.formAdocao.email.value;
    const dataNasc = document.formAdocao.dataNasc.value;
    const descricao = document.formAdocao.descricao.value;
    const endereco = document.formAdocao.endereco.value; 
    const cidade= document.formAdocao.cidade.value;


    if (nome.length == "" || nome.length < 8){
        alert("Nome inválido!")
        return false;
    }

    if (cpf.length == "" || cpf.length < 14 || cpf.length > 14){
        alert("CPF inválido!")
        return false;
    }

    if (telefone.length == "" || telefone.length < 13 || telefone.length > 13){
        alert("Telefone inválido!")
        return false;

    }
    if (email.length == ""){
        return false;
    }
    if (dataNasc.length == ""){
        alert("Data de nascimento inválida!")
        return false; 
    }
    if (descricao.length == ""){
        alert("Você deve descrever porque deseja anotar o animal");
        return false;
    }
    if (endereco.length == "" || endereco.length < 5){
        alert("Endereço inválido! O campo deve conter nome da rua e número");
        return false;
    }
    if (cidade.length == ""){
        alert("Cidade inválida!");
        return false;
    }

   
}