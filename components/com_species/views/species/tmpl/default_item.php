<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>

<script>
    function mascara_data(data) {
        var mydata = '';
        mydata = mydata + data;
        if (mydata.length == 2) {
            mydata = mydata + '/';
            document.forms[0].date_event.value = mydata;
        }
        if (mydata.length == 5) {
            mydata = mydata + '/';
            document.forms[0].date_event.value = mydata;
        }
        if (mydata.length == 10) {
            verifica_data();
        }
    }

    function verifica_data() {

        dia = (document.forms[0].date_event.value.substring(0, 2));
        mes = (document.forms[0].date_event.value.substring(3, 5));
        ano = (document.forms[0].date_event.value.substring(6, 10));

        situacao = "";
        // verifica o dia valido para cada mes 
        if ((dia < 01) || (dia < 01 || dia > 30) && (mes == 04 || mes == 06 || mes == 09 || mes == 11) || dia > 31) {
            situacao = "falsa";
        }

        // verifica se o mes e valido 
        if (mes < 01 || mes > 12) {
            situacao = "falsa";
        }

        // verifica se e ano bissexto 
        if (mes == 2 && (dia < 01 || dia > 29 || (dia > 28 && (parseInt(ano / 4) != ano / 4)))) {
            situacao = "falsa";
        }

        if (document.forms[0].date_event.value == "") {
            situacao = "falsa";
        }

        if (situacao == "falsa") {
            alert("Data inválida!");
            document.forms[0].date_event.focus();
        }
    }
    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false //disable key press
        }
    }
</script>

<script type="text/javascript">
    function checarEmail() {
        if (document.forms[0].email.value == ""
                || document.forms[0].email.value.indexOf('@') == -1
                || document.forms[0].email.value.indexOf('.') == -1)
        {
            alert("Por favor, informe um E-MAIL válido!");
            return false;
        }
    }
</script>


<script type="text/javascript">
    function validarCPF(cpf) {
        var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;

        if (!filtro.test(cpf))
        {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        cpf = remove(cpf, ".");
        cpf = remove(cpf, "-");

        if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
                cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
                cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
                cpf == "88888888888" || cpf == "99999999999")
        {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        soma = 0;
        for (i = 0; i < 9; i++)
        {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }

        resto = 11 - (soma % 11);
        if (resto == 10 || resto == 11)
        {
            resto = 0;
        }
        if (resto != parseInt(cpf.charAt(9))) {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        soma = 0;
        for (i = 0; i < 10; i++)
        {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = 11 - (soma % 11);
        if (resto == 10 || resto == 11)
        {
            resto = 0;
        }

        if (resto != parseInt(cpf.charAt(10))) {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        return true;
    }

    function remove(str, sub) {
        i = str.indexOf(sub);
        r = "";
        if (i == -1)
            return str;
        {
            r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
        }

        return r;
    }

    /**
     * MASCARA ( mascara(o,f) e execmascara() ) CRIADAS POR ELCIO LUIZ
     * elcio.com.br
     */
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    function cpf_mask(v) {
        v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
        v = v.replace(/(\d{3})(\d)/, "$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
        v = v.replace(/(\d{3})(\d)/, "$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
        return v
    }
</script>


<script type="text/javascript">
    /* Máscaras TELEFONE */
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }
    function mtel(v) {
        v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }
    function id(el) {
        return document.getElementById(el);
    }
    /*TELEFONE 1*/
    window.onload = function () {
        id('telefone').onkeyup = function () {
            mascara(this, mtel);
        }
        id('celular').onkeyup = function () {
            mascara(this, mtel);
        }
    }
</script>
<?php 
    foreach ($this->produtositem as $produtositem){
        $prod = $produtositem->name;
        $cat = $produtositem->categoria;
        $desc = $produtositem->description;
        $img = $produtositem->image1;
    }

    if(!empty($prod)){
        $produto = $prod;
    }else{
        $produto = ("") ;
    }
?>
<script type="text/javascript">
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>

<div class="product-form">
    <h1>Escolha sua muda e cuide bem!</h1>
    <?php if((!empty($desc)) || (!empty($img))){ ?>
    <div class="descprod">
        <p>
            <?php if(!empty($img)){ echo '<img src="'.$img.'"/>'; }?>
            <?php if(!empty($desc)){ echo $desc; }?>
        </p>
    </div>
    
    <?php } ?>
    
    <h2>Preencha o formulário abaixo, que entraremos em contato.</h2>
    
    <form id="orcamento-form" action="<?php echo JRoute::_('index.php?option=com_species&view=species&layout=default_item'); ?>" method="post" class="form-vainsereformlidate form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <input type="text" id="nome" name="nome" required="true" placeholder="Nome"/>
            <input type="text" name="tel" id="telefone" maxlength="15" placeholder="Telefone"/>
            <input type="email" name="email" required="true" class="input" id="email" onblur="checarEmail();" placeholder="E-mail"/>
            <input type="text" id="especie" name="especie" required="true" placeholder="Especies" value="<?php echo $produto.' ('.$cat.')'; ?>"/>
            <input type="text" name="quant" id="quant" maxlength="2" placeholder="Quantidade"/>
        </fieldset>
        <fieldset>
            <textarea name="mensagem" id="mensagem" cols="50" rows="7" class="required" placeholder="Mensagem..." ></textarea>
            <div class="envia-orcamento">
                <input type="hidden" name="option" value="com_species" />
                <input type="hidden" name="task" value="species.enviarspecies" />
                <input type="submit" value="Enviar" class="submitform"/>
            </div>
        </fieldset>
    </form>
</div>



