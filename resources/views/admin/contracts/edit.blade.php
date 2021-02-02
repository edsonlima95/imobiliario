@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-edit"></i> Edição de Contratos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-success"
                                                       href="{{route('admin.contracts.create')}}">
                                <i class="fa fa-plus-circle mr-1"></i> <strong>Cadastrar</strong></a></li>
                        <li class="breadcrumb-item"><a class="btn btn-primary"
                                                       href="{{route('admin.contracts.index')}}">
                                <i class="fa fa-list mr-1"></i> <strong>Listar</strong></a></li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @if($errors->all())
        @foreach($errors->all() as $error)
            <x-alert type="danger">
                {{$error}}
            </x-alert>
        @endforeach
    @endif

    @if(session()->exists('message'))
        <x-alert type="{{session()->get('color')}}">
            {{ session()->get('message') }}
        </x-alert>
    @endif

    <form action="{{ route('admin.contracts.update',['contract'=>$contract->id]) }}" method="post"
          enctype="multipart/form-data" class="col-12">
        @csrf
        @method('PUT')
        <input type="hidden" name="owner_spouse_persist" value="{{old('owner_spouse') ?? $contract->owner_spouse}}">
        <input type="hidden" name="owner_company_persist" value="{{old('owner_company') ?? $contract->owner_company}}">
        <input type="hidden" name="acquirer_spouse_persist"
               value="{{old('acquirer_spouse') ?? $contract->acquirer_spouse}}">
        <input type="hidden" name="acquirer_company_persist"
               value="{{old('acquirer_company') ?? $contract->acquirer_company}}">
        <input type="hidden" name="property_persist" value="{{old('property') ?? $contract->property}}">

        {{-- MENU TABLS --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="parts-tab" data-toggle="tab" href="#parts" role="tab"
                   aria-controls="parts"
                   aria-selected="true">Das Partes</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="terms-tab" data-toggle="tab" href="#terms" role="tab"
                   aria-controls="terms"
                   aria-selected="false">Termos</a>
            </li>
        </ul>

        {{-- CONTEUDO --}}
        <div class="tab-content" id="myTabContent">

            {{-- DADOS CADASTRAIS --}}
            <div class="tab-pane fade show active" id="parts" role="tabpanel" aria-labelledby="parts-tab">

                <nav class="navbar navbar-light bg-dark my-3 p-3 justify-content-start">
                    <div class="form-check form-check-inline mr-4">
                        <label class="form-check-label font-weight-bold" for="inlineCheckbox1">Finalidade:</label>
                    </div>
                    <div class="form-check form-check-inline mr-5">
                        <input class="form-check-input" type="checkbox" id="sale"
                               name="sale" {{old('sale') == 'on' || old('sale') == true ? 'checked' : ($contract->sale ? 'checked' : '')}}>
                        <label class="form-check-label" for="lessor">Venda</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="lessee"
                               name="rent" {{old('rent') == 'on' || old('rent') == true ? 'checked' : ($contract->rent ? 'checked' : '')}}>
                        <label class="form-check-label" for="lessee">Alugar</label>
                    </div>
                </nav>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Status</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="pending" {{ (old('status') == 'pending' ? 'selected' : ($contract->status == 'pending' ? 'selected' : '')) }}>Pendente</option>
                                    <option value="active" {{ (old('status') == 'active' ? 'selected' : ($contract->status == 'active' ? 'selected' : '')) }}>Ativo</option>
                                    <option value="canceled" {{ (old('status') == 'canceled' ? 'selected' : ($contract->status == 'canceled' ? 'selected' : '')) }}>Indisponível</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Proprietário</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="category">Proprietário:</label>
                                <select name="owner" class="form-control" id="category"
                                        data-action="{{route('admin.contracts.getDataOwner')}}">
                                    <option value="">Informe um Cliente</option>
                                    @foreach($lessors->get() as $lessor)
                                        <option
                                            value="{{$lessor->id}}" {{(old('owner') == $lessor->id ? 'selected' : ($contract->owner == $lessor->id ? 'selected' : ''))}}>{{$lessor->name}}
                                            ({{$lessor->document}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="owner_spouse">Conjuge do Proprietário:</label>
                                <select name="owner_spouse" class="form-control" id="owner_spouse">
                                    <option value="">Não Informado</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="owner_company">Empresa:</label>
                                <select name="owner_company" class="form-control" id="owner_company">
                                    <option value="">Não Informado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Adquerinte</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="acquirer">Adquerinte:</label>
                                <select name="acquirer" class="form-control" id="acquirer"
                                        data-action="{{route('admin.contracts.getDataAcquirer')}}">
                                    <option value="">Informe um Cliente</option>
                                    @foreach($lessees->get() as $lessee)
                                        <option
                                            value="{{$lessee->id}}" {{(old('acquirer') == $lessee->id ? 'selected' : ($contract->acquirer == $lessee->id ? 'selected' : ''))}}>{{$lessee->name}}
                                            ({{$lessee->document}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="acquirer_spouse">Conjuge do Adquerinte:</label>
                                <select name="acquirer_spouse" class="form-control" id="acquirer_spouse">
                                    <option value="">Não Informado</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="acquirer_company">Empresa:</label>
                                <select name="acquirer_company" class="form-control" id="acquirer_company">
                                    <option value="">Não Informado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Parâmetros do Contrato</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="acquirer_company">Imóvel:</label>
                                <select name="property" class="form-control" id="property"
                                        data-action="{{route('admin.contracts.getDataProperty')}}">
                                    <option value="">Não Informado</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="sale_price">Valor de Venda:</label>
                                <input type="text" class="form-control mask-money" id="sale_price" name="sale_price"
                                       placeholder="R$ 0,00" value="{{$contract->sale == true ? $contract->price : ''}}"
                                    {{$contract->sale != true ? 'disabled' : ''}}>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="rent_price">Valor de Locação:</label>
                                <input type="text" class="form-control mask-money" id="rent_price" name="rent_price"
                                       placeholder="R$ 0,00" value="{{$contract->rent == true ? $contract->price : ''}}"
                                    {{$contract->rent != true ? 'disabled' : ''}}>
                            </div>
                            <div class=" form-group col-lg-6">
                                <label for="tribute">IPTU:</label>
                                <input type="text" class="form-control mask-money" id="tribute" name="tribute"
                                       placeholder="R$ 0,00" value="{{old('tribute') ?? $contract->tribute}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="condominium">Condomínio:</label>
                                <input type="text" class="form-control mask-money" id="condominium" name="condominium"
                                       placeholder="R$ 0,00" value="{{old('condominium') ?? $contract->condominium}}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="due_date">Dia do Vencimento:</label>
                                <select name="due_date" class="form-control" id="due_date">
                                    <option
                                        value="1" {{old('due_date') == 1 ? 'selected' : ($contract->due_date ==  1 ? 'selected' : '')}} >
                                        1º
                                    </option>
                                    <option
                                        value="2" {{old('due_date') ==  2 ? 'selected' : ($contract->due_date ==  2 ? 'selected' : '')}}>
                                        2/mês
                                    </option>
                                    <option
                                        value="3" {{old('due_date') ==  3 ? 'selected' : ($contract->due_date ==  3 ? 'selected' : '')}}>
                                        3/mês
                                    </option>
                                    <option
                                        value="4" {{old('due_date') ==  4 ? 'selected' : ($contract->due_date ==  4 ? 'selected' : '')}}>
                                        4/mês
                                    </option>
                                    <option
                                        value="5" {{old('due_date') ==  5 ? 'selected' : ($contract->due_date ==  5 ? 'selected' : '')}}>
                                        5/mês
                                    </option>
                                    <option
                                        value="6" {{old('due_date') ==  6 ? 'selected' : ($contract->due_date ==  6 ? 'selected' : '')}}>
                                        6/mês
                                    </option>
                                    <option
                                        value="7" {{old('due_date') ==  7 ? 'selected' : ($contract->due_date ==  7 ? 'selected' : '')}}>
                                        7/mês
                                    </option>
                                    <option
                                        value="8" {{old('due_date') ==  8 ? 'selected' : ($contract->due_date ==  8 ? 'selected' : '')}}>
                                        8/mês
                                    </option>
                                    <option
                                        value="9" {{old('due_date') ==  9 ? 'selected' : ($contract->due_date ==  9 ? 'selected' : '')}}>
                                        9/mês
                                    </option>
                                    <option
                                        value="10" {{old('due_date') == 10 ? 'selected' : ($contract->due_date == 10 ? 'selected' : '')}}>
                                        10/mês
                                    </option>
                                    <option
                                        value="11" {{old('due_date') == 11 ? 'selected' : ($contract->due_date == 11 ? 'selected' : '')}}>
                                        11/mês
                                    </option>
                                    <option
                                        value="12" {{old('due_date') == 12 ? 'selected' : ($contract->due_date == 12 ? 'selected' : '')}}>
                                        12/mês
                                    </option>
                                    <option
                                        value="13" {{old('due_date') == 13 ? 'selected' : ($contract->due_date == 13 ? 'selected' : '')}}>
                                        13/mês
                                    </option>
                                    <option
                                        value="14" {{old('due_date') == 14 ? 'selected' : ($contract->due_date == 14 ? 'selected' : '')}}>
                                        14/mês
                                    </option>
                                    <option
                                        value="15" {{old('due_date') == 15 ? 'selected' : ($contract->due_date == 15 ? 'selected' : '')}}>
                                        15/mês
                                    </option>
                                    <option
                                        value="16" {{old('due_date') == 16 ? 'selected' : ($contract->due_date == 16 ? 'selected' : '')}}>
                                        16/mês
                                    </option>
                                    <option
                                        value="17" {{old('due_date') == 17 ? 'selected' : ($contract->due_date == 17 ? 'selected' : '')}}>
                                        17/mês
                                    </option>
                                    <option
                                        value="18" {{old('due_date') == 18 ? 'selected' : ($contract->due_date == 18 ? 'selected' : '')}}>
                                        18/mês
                                    </option>
                                    <option
                                        value="19" {{old('due_date') == 19 ? 'selected' : ($contract->due_date == 19 ? 'selected' : '')}}>
                                        19/mês
                                    </option>
                                    <option
                                        value="20" {{old('due_date') == 20 ? 'selected' : ($contract->due_date == 20 ? 'selected' : '')}}>
                                        20/mês
                                    </option>
                                    <option
                                        value="21" {{old('due_date') == 21 ? 'selected' : ($contract->due_date == 21 ? 'selected' : '')}}>
                                        21/mês
                                    </option>
                                    <option
                                        value="22" {{old('due_date') == 22 ? 'selected' : ($contract->due_date == 22 ? 'selected' : '')}}>
                                        22/mês
                                    </option>
                                    <option
                                        value="23" {{old('due_date') == 23 ? 'selected' : ($contract->due_date == 23 ? 'selected' : '')}}>
                                        23/mês
                                    </option>
                                    <option
                                        value="24" {{old('due_date') == 24 ? 'selected' : ($contract->due_date == 24 ? 'selected' : '')}}>
                                        24/mês
                                    </option>
                                    <option
                                        value="25" {{old('due_date') == 25 ? 'selected' : ($contract->due_date == 25 ? 'selected' : '')}}>
                                        25/mês
                                    </option>
                                    <option
                                        value="26" {{old('due_date') == 26 ? 'selected' : ($contract->due_date == 26 ? 'selected' : '')}}>
                                        26/mês
                                    </option>
                                    <option
                                        value="27" {{old('due_date') == 27 ? 'selected' : ($contract->due_date == 27 ? 'selected' : '')}}>
                                        27/mês
                                    </option>
                                    <option
                                        value="28" {{old('due_date') == 28 ? 'selected' : ($contract->due_date == 28 ? 'selected' : '')}}>
                                        28/mês
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="deadline">Prazo do Contrato (Em meses):</label>
                                <select name="deadline" class="form-control" id="deadline">
                                    <option value="12">12
                                        meses
                                    </option>
                                    <option
                                        value="24" {{old('deadline') == 24 ? 'selected' :  ($contract->deadline == 24 ? 'selected' : '') }}>
                                        24
                                        meses
                                    </option>
                                    <option
                                        value="36" {{old('deadline') == 36 ? 'selected' :  ($contract->deadline == 36 ? 'selected' : '') }}>
                                        36
                                        meses
                                    </option>
                                    <option
                                        value="48" {{old('deadline') == 48 ? 'selected' :  ($contract->deadline == 48 ? 'selected' : '') }}>
                                        48
                                        meses
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="start_at">Data de Início:</label>
                                <input type="date" class="form-control" id="start_at" name="start_at"
                                       placeholder="Data de Início"
                                       value="{{ old('start_at') ?? $contract->start_at }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ESTRUTURA --}}
            <div class="mt-3 tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Termos</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="terms">Contrato:</label>
                                <textarea name="terms" cols="30" rows="10" class="mce"
                                          id="terms"
                                          data-test="{{route('admin.companies.index')}}">{{ $contract->terms() }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 btn-center">
            <button type="submit" class="col-4 btn btn-primary"><i class="mr-2 fa fa-edit"></i>Atualizar</button>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(function () {

            function setFieldOwner(response) {
                //OWNER SPOUSE
                $('select[name="owner_spouse"]').html('');
                if (response.spouse) {
                    $('select[name="owner_spouse"]').append($('<option>', {
                        value: "",
                        text: "Não Informado",
                    }));

                    $('select[name="owner_spouse"]').append($('<option>', {
                        value: 1,
                        text: response.spouse.spouse_name,
                        selected: ($('input[name="owner_spouse_persist"]').val() != 0 ? 'selected' : false)
                    }));

                } else {
                    $('select[name="owner_spouse"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));
                }

                //OWNER COMPANY
                $('select[name="owner_company"]').html('');
                if (response.companies != null && response.companies.length) {
                    $('select[name="owner_company"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));

                    $.each(response.companies, function (key, value) {
                        $('select[name="owner_company"]').append($('<option>', {
                            value: value.id,
                            text: value.social_name + " (" + value.document_company + ")",
                            selected: ($('input[name="owner_company_persist"]').val() != 0 && $('input[name="owner_company_persist"]').val() == value.id ? 'selected' : false)
                        }));
                    })
                } else {
                    $('select[name="owner_company"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));
                }

                //OWNER PROPERTIES
                $('select[name="property"]').html('');
                if (response.properties != null && response.properties.length) {
                    $('select[name="property"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));

                    $.each(response.properties, function (key, value) {
                        $('select[name="property"]').append($('<option>', {
                            value: value.id,
                            text: value.description,
                            selected: ($('input[name="property_persist"]').val() != 0 && $('input[name="property_persist"]').val() == value.id ? 'selected' : false)
                        }));
                    })
                } else {
                    $('select[name="property"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));
                }
            }

            function setFieldAcquirer(response) {
                //OWNER SPOUSE
                $('select[name="acquirer_spouse"]').html('');
                if (response.spouse) {
                    $('select[name="acquirer_spouse"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));

                    $('select[name="acquirer_spouse"]').append($('<option>', {
                        value: 1,
                        text: response.spouse.spouse_name,
                        selected: ($('input[name="acquirer_spouse_persist"]').val() != 0 ? 'selected' : false)
                    }));

                } else {
                    $('select[name="acquirer_spouse"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));
                }

                //OWNER COMPANY
                $('select[name="acquirer_company"]').html('');
                if (response.companies != null && response.companies.length) {
                    $('select[name="acquirer_company"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));

                    $.each(response.companies, function (key, value) {
                        $('select[name="acquirer_company"]').append($('<option>', {
                            value: value.id,
                            text: value.social_name + " (" + value.document_company + ")",
                            selected: ($('input[name="acquirer_company_persist"]').val() != 0 && $('input[name="acquirer_company_persist"]').val() == value.id ? 'selected' : false)
                        }));
                    })
                } else {
                    $('select[name="acquirer_company"]').append($('<option>', {
                        value: "",
                        text: "Não Informado"
                    }));
                }
            }

            function setFieldProperty(response) {
                if (response.property != null) {
                    $('input[name="sale_price"]').val(response.property.sale_price);
                    $('input[name="rent_price"]').val(response.property.rent_price);
                    $('input[name="tribute"]').val(response.property.tribute);
                    $('input[name="condominium"]').val(response.property.condominium);
                } else {
                    $('input[name="sale_price"]').val('0,00');
                    $('input[name="rent_price"]').val('0,00');
                    $('input[name="tribute"]').val('0,00');
                    $('input[name="condominium"]').val('0,00');
                }
            }

            //PROPRIETÁRIO - LESSOR
            $('select[name="owner"]').change(function () {
                var owner = $(this);
                $.post(owner.data('action'), {user: owner.val()}, function (response) {
                    setFieldOwner(response)
                }, 'json');
            });

            //SETA A ESPOSA DO PROPRIETARIO
            if ($('select[name="owner"]').val() != 0) {
                var owner = $('select[name="owner"]');
                $.post(owner.data('action'), {user: owner.val()}, function (response) {
                    setFieldOwner(response)
                }, 'json');
            }

            //LOCADOR - LESSEE
            $('select[name="acquirer"]').change(function () {
                var acquirer = $(this);
                $.post(acquirer.data('action'), {user: acquirer.val()}, function (response) {
                    setFieldAcquirer(response);
                }, 'json');
            });

            //SETA A ESPOSA DO PROPRIETARIO
            if ($('select[name="acquirer"]').val() != 0) {
                var acquirer = $('select[name="acquirer"]');
                $.post(acquirer.data('action'), {user: acquirer.val()}, function (response) {
                    setFieldAcquirer(response);
                }, 'json');
            }

            $('select[name="property"]').change(function () {
                var property = $(this);
                $.post(property.data('action'), {property: property.val()}, function (response) {
                    setFieldProperty(response)
                }, 'json')
            });
        });
    </script>
@endsection
