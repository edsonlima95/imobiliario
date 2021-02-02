<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Contract as ContractRequest;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::with('ownerObject')->get();

        return view('admin.contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessors = User::lessors();
        $lessees = User::lessees();
        return view('admin.contracts.create', [
            'lessors' => $lessors,
            'lessees' => $lessees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        $contractCreate = Contract::create($request->all());
        if ($contractCreate) {

            if ($contractCreate->property) {
                $property = Property::find($contractCreate->property);
                if ($contractCreate->status == 'active') {
                    $property->status = 0;
                    $property->save();
                } else {
                    $property->status = 1;
                    $property->save();
                }
            }

            return redirect()->route('admin.contracts.create')
                ->with(['color' => 'success', 'message' => 'Contrato cadastrado com sucesso']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::find($id);
        $lessors = User::lessors();
        $lessees = User::lessees();
        return view('admin.contracts.edit', [
            'contract' => $contract,
            'lessors' => $lessors,
            'lessees' => $lessees
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
        $contractUpdate = Contract::find($id);
        $contractUpdate->fill($request->all());

        if ($contractUpdate->save()) {

            if ($contractUpdate->property) {
                $property = Property::find($contractUpdate->property);
                if ($contractUpdate->status == 'active') {
                    $property->status = 0;
                    $property->save();
                } else {
                    $property->status = 1;
                    $property->save();
                }
            }

            return redirect()->route('admin.contracts.index')
                ->with(['color' => 'success', 'message' => 'Contrato atualizado com sucesso']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public
    function getDataOwner(Request $request)
    {
        $lessor = User::where('id', $request->user)->first(['id',
                'civil_status',
                'spouse_name',
                'spouse_document']
        );

        if (empty($lessor)) {
            $spouse = null;
            $companies = null;
            $properties = null;
        } else {

            $checkCivilStatus = [
                'married',
                'separated'
            ];

            if (in_array($lessor->civil_status, $checkCivilStatus)) {
                $spouse = [
                    'spouse_name' => $lessor->spouse_name,
                    'spouse_document' => $lessor->spouse_document,
                ];
            } else {
                $spouse = null;
            }

            //EMPRESAS DO USUARIO.
            $companies = $lessor->companies()->get([
                'id',
                'social_name',
                'document_company'
            ]);

            //IMÓVEIS DO USUÁRIO
            $getProperties = $lessor->properties()->get();

            foreach ($getProperties as $property) {
                $arrDataProperty[] = [
                    'id' => $property->id,
                    'description' => '# ' . $property->id . ' ' . $property->street . ' ' . $property->neighborhood . ' ' . '(' . $property->zipcode . ')'
                ];
            }
        }

        $json['spouse'] = $spouse;
        $json['companies'] = (!empty($companies) && $companies->count() ? $companies : null);
        $json['properties'] = (!empty($arrDataProperty) ? $arrDataProperty : null);
        return response()->json($json);
    }

    public
    function getDataAcquirer(Request $request)
    {
        $lessee = User::where('id', $request->user)->first(['id',
                'civil_status',
                'spouse_name',
                'spouse_document']
        );

        if (empty($lessee)) {
            $spouse = null;
            $companies = null;
        } else {

            $checkCivilStatus = [
                'married',
                'separated'
            ];

            if (in_array($lessee->civil_status, $checkCivilStatus)) {
                $spouse = [
                    'spouse_name' => $lessee->spouse_name,
                    'spouse_document' => $lessee->spouse_document,
                ];
            } else {
                $spouse = null;
            }

            //EMPRESAS DO USUARIO.
            $companies = $lessee->companies()->get([
                'id',
                'social_name',
                'document_company'
            ]);
        }

        $json['spouse'] = $spouse;
        $json['companies'] = (!empty($companies) && $companies->count() ? $companies : null);
        return response()->json($json);
    }

    public
    function getDataProperty(Request $request)
    {
        $property = Property::where('id', $request->property)->first();

        if (empty($property)) {
            $property = null;
        } else {
            $property = [
                'id' => $property->id,
                'sale_price' => $property->sale_price,
                'rent_price' => $property->rent_price,
                'tribute' => $property->tribute,
                'condominium' => $property->condominium
            ];
        }

        $json['property'] = $property;
        return response()->json($json);
    }

    public function contractPdf(Request $request)
    {
        $contractPdf = Contract::find($request->id);

        if (!empty($contractPdf)) {
            $pdf = Facade::loadView("admin.contracts.pdf", ['contract' => $contractPdf])->setPaper('a4');
            return $pdf->stream();
        }

        return redirect()->route('admin.contracts.index');
    }
}
