const copyToClipboard = idTextElement => {
    const el = document.createElement('textarea');
    el.value = idTextElement.value;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    // if(document.execCommand('copy')){
    //     console.log("Tudo certo");
    // }else{
    //     console.log("Ocorreu um erro");
    // }
    document.body.removeChild(el);
    alert("Atenção!!!\nTexto Copiado com Sucesso!");
};