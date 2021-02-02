$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //VALIDAÇÃO DOS CAMPOS DO CONJUGUE
    function validateField() {
        //Desabilita os campos do conjugue caso o select for casado ou solteiro
        if ($('select[name="civil_status"]').val() === 'married' || $('select[name="civil_status"]').val() === 'separated') {
            $('.js-conjugue input, .js-conjugue select').prop('disabled', false)
        } else {
            $('.js-conjugue input, .js-conjugue select').prop('disabled', true)
        }

    }

    validateField();

    $($('select[name="civil_status"]')).change(function () {
        validateField();
    })

    //ABILITA QUANDO HOUVER ERROR.
    if($('input[name="sale_persist"]').val() == 'on'){
        $('input[name="sale_price"]').attr('disabled',false)
    }else{
        $('input[name="sale_price"]').attr('disabled',true)
    }

    if($('input[name="sale"]').prop('checked') == false){
        $('input[name="sale_price"]').attr('disabled',true)
    }else{
        $('input[name="sale_price"]').attr('disabled',false)
    }

    //ABILITA OU DESABLITA O CAMPO DE VENDA
    $('input[type="checkbox"][name="sale"]').change(function () {
        if($(this).get(0).checked){
        $('input[name="sale_price"]').attr('disabled',false)
        }else{
        $('input[name="sale_price"]').attr('disabled',true)
        }
    })

    //ABILITA QUANDO HOUVER ERROR.
    if($('input[name="rent_persist"]').val() == 'on'){
        $('input[name="rent_price"]').attr('disabled',false)
    }else{
        $('input[name="rent_price"]').attr('disabled',true)
    }

    if($('input[name="rent"]').prop('checked') == false){
        $('input[name="rent_price"]').attr('disabled',true)
    }else{
        $('input[name="rent_price"]').attr('disabled',false)
    }

    //ABILITA OU DESABLITA O CAMPO DE VENDA
    $('input[type="checkbox"][name="rent"]').change(function () {
        if($(this).get(0).checked){
            $('input[name="rent_price"]').attr('disabled',false)
        }else{
            $('input[name="rent_price"]').attr('disabled',true)
        }
    })

    // SEARCH ZIPCODE
    $('.zip_code_search').blur(function () {

        function emptyForm() {
            $("#street").val("");
            $("#neighborhood").val("");
            $("#city").val("");
            $("#state").val("");
        }

        var zip_code = $(this).val().replace(/\D/g, '');
        var validate_zip_code = /^[0-9]{8}$/;

        if (zip_code != "" && validate_zip_code.test(zip_code)) {

            $("#street").val("");
            $("#neighborhood").val("");
            $("#city").val("");
            $("#state").val("");

            $.getJSON("https://viacep.com.br/ws/" + zip_code + "/json/?callback=?", function (data) {

                if (!("erro" in data)) {
                    $("#street").val(data.logradouro);
                    $("#neighborhood").val(data.bairro);
                    $("#city").val(data.localidade);
                    $("#state").val(data.uf);
                } else {
                    emptyForm();
                    alert("CEP não encontrado.");
                }
            });
        } else {
            emptyForm();
            alert("Formato de CEP inválido.");
        }
    });

    //MASK
    $('.mask-phone').mask('(00) 00000-0000');
    $('.mask-tel').mask('(00) 0000-0000');
    $(".mask-date").mask('00/00/0000');
    $(".mask-datetime").mask('00/00/0000 00:00');
    $(".mask-month").mask('00/0000', {reverse: true});
    $(".mask-doc-secondary").mask('0000000000-0', {reverse: true});
    $(".mask-doc").mask('000.000.000-00', {reverse: true});
    $(".mask-cnpj").mask('00.000.000/0000-00', {reverse: true});
    $(".mask-zipcode").mask('00000-000', {reverse: true});
    $(".mask-money").mask('R$ 000.000.000.000.000,00', {reverse: true, placeholder: "R$ 0,00"});

    // TINYMCE INIT
    tinyMCE.init({
        selector: "textarea.mce",
        language: 'pt_BR',
        menubar: false,
        theme: "modern",
        height: 132,
        sourceCodeEncoding: /^[227792]{8}&/,
        skin: 'light',
        entity_encoding: "raw",
        theme_advanced_resizing: true,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor media"
        ],
        toolbar: "styleselect | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | code | fullscreen",
        style_formats: [
            {title: 'Normal', block: 'p'},
            {title: 'Titulo 3', block: 'h3'},
            {title: 'Titulo 4', block: 'h4'},
            {title: 'Titulo 5', block: 'h5'},
            {title: 'Código', block: 'pre', classes: 'brush: php;'}
        ],
        link_class_list: [
            {title: 'Nenhum', value: ''},
            {title: 'Botão Verde', value: 'btn btn-green'},
            {title: 'Botão Azul', value: 'btn btn-blue'},
            {title: 'Botão Amarelo', value: 'btn btn-yellow'},
            {title: 'Botão Vermelho', value: 'btn btn-red'}
        ],
        setup: function (editor) {
            editor.addButton('laradevimage', {
                title: 'Enviar Imagem',
                icon: 'image',
                onclick: function () {
                    $('.mce_upload').fadeIn(200, function (e) {
                        $("body").click(function (e) {
                            if ($(e.target).attr("class") === "mce_upload") {
                                $('.mce_upload').fadeOut(200);
                            }
                        });
                    }).css("display", "flex");
                }
            });
        },
        link_title: false,
        target_list: false,
        theme_advanced_blockformats: "h1,h2,h3,h4,h5,p,pre",
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,
        media_embed: false,
        extended_valid_elements: "a[href|target=_blank|rel|class]",
        imagemanager_insert_template: '<img src="{$url}" title="{$title}" alt="{$title}" />',
        image_dimensions: false,
        relative_urls: false,
        remove_script_host: false,
        paste_as_text: true
    });

    // DATATABLES
    $('#data-table').DataTable({
        responsive: true,
        "pageLength": 25,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
    });

    $('[data-toggle="tooltip"]').tooltip()
})
