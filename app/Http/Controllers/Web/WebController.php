<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\Web\Contact;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{

    public function home()
    {
        $forSale = Property::sale()->available()->limit(6)->get();
        $forRent = Property::rent()->available()->limit(6)->get();

        $head = $this->seo->render(
            env('APP_SITE_NAME'),
            'Todas as mais sofisticadas residencias em um só lugar, para você e sua familía morar',
            url('/'),
            asset('frontend/assets/img/background.jpg')
        );

        return view('web.home', [
            'head' => $head,
            'forSale' => $forSale,
            'forRent' => $forRent
        ]);
    }

    public function spotlight()
    {

    }

    public function buy()
    {
        return view('web.filter');
    }

    public function buyProperty(Request $request)
    {
        $buyProperty = Property::where('slug', $request->slug)->first();

        $buyProperty->views += 1;
        $buyProperty->save();

        return view('web.property', [
            'property' => $buyProperty
        ]);
    }

    public function rentProperty(Request $request)
    {
        $rentProperty = Property::where('slug', $request->slug)->first();

        $rentProperty->views += 1;
        $rentProperty->save();

        return view('web.property', [
            'property' => $rentProperty
        ]);
    }

    public function filter(Request $request)
    {
        $filter = new FilterController();
        $getProperties = $filter->createQuery('id');

        foreach ($getProperties as $property) {
            $itemProperties[] = $property->id;
        }

        if (!empty($itemProperties)) {
            $itemProperties = Property::whereIn('id', $itemProperties)->get();
        } else {
            $itemProperties = Property::all();
        }

        return view('web.filter', [
            'properties' => $itemProperties
        ]);
    }


    public function propertyCategory(?Request $request)
    {
        if ($request->type == 'venda') {
            $propertyCategory = Property::sale()->available()->limit(12)->get();
        } elseif ($request->type == 'alugar') {
            $propertyCategory = Property::rent()->available()->limit(12)->get();
        } else {
            $propertyCategory = Property::all();
        }

        return view('web.category', [
            'propertyCategory' => $propertyCategory
        ]);
    }

    public function experience(?Request $request)
    {
        if (!empty($request->slug) == 'regiao-central') {
            $propertyExperience = Property::where('experience', 'Região Central')->get();

        } elseif (!empty($request->slug) == 'alto-padrao') {
            $propertyExperience = Property::where('experience', 'Alto Padrão')->get();

        } elseif (!empty($request->slug) == 'condominio') {
            $propertyExperience = Property::where('experience', 'Condomínio')->get();

        } elseif (!empty($request->slug) == 'medio-padrao') {
            $propertyExperience = Property::where('experience', 'Médio Padrão')->get();

        } elseif (!empty($request->slug) == 'chacara') {
            $propertyExperience = Property::where('experience', 'Chacára')->get();

        } elseif (!empty($request->slug) == 'cobertura') {
            $propertyExperience = Property::where('experience', 'Cobertura')->get();

        } else {
            $propertyExperience = Property::whereNotNull('experience')->get();
        }

        return view('web.experience', ['propertyExperience' => $propertyExperience]);
    }

    public function sendEmail(Request $request)
    {
        $data = [
            'reply_email' => $request->email,
            'reply_name' => $request->name,
            'message' => $request->message,
            'cell' => $request->cell
        ];

        Mail::send(new Contact($data));
    }

    public function contact()
    {
        return view('web.contact');
    }

}
