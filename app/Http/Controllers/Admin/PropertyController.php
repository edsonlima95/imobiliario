<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use App\Support\Cropper;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Property as PropertyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        return view('admin.properties.index', [
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.properties.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $propertyCreate = Property::create($request->all());

        $propertyCreate->setSlug();

        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if ($validator->fails() === true) {
            return redirect()->back()->withInput()->with([
                'color' => 'danger',
                'message' => 'Todas as imagens devem ser do tipo jpg, jpeg ou png.',
            ]);
        }

        if ($request->allFiles()) {
            foreach ($request->allFiles()['files'] as $image) {
                $propertyImage = new PropertyImage();
                $propertyImage->property = $propertyCreate->id;
                $propertyImage->path = $image->store('properties/' . $propertyCreate->id);
                $propertyImage->save();
                unset($propertyImage);
            }
        }

        if ($propertyCreate) {
            return redirect()->route('admin.properties.index')
                ->with(['color' => 'success', 'message' => 'O imóvel foi cadastrado com sucesso']);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);
        $users = User::all();

        return view('admin.properties.edit', [
            'property' => $property,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $propertyUpdate = Property::find($id);

        $propertyUpdate->fill($request->all());

        $propertyUpdate->setSaleAttribute($request->sale);
        $propertyUpdate->setRentAttribute($request->rent);
        $propertyUpdate->setAirConditioningAttribute($request->air_conditioning);
        $propertyUpdate->setBarAttribute($request->bar);
        $propertyUpdate->setLibraryAttribute($request->library);
        $propertyUpdate->setBarbecueGrillAttribute($request->barbecue_grill);
        $propertyUpdate->setAmericanKitchenAttribute($request->american_kitchen);
        $propertyUpdate->setFittedKitchenAttribute($request->fitted_kitchen);
        $propertyUpdate->setPantryAttribute($request->pantry);
        $propertyUpdate->setEdiculeAttribute($request->edicule);
        $propertyUpdate->setOfficeAttribute($request->office);
        $propertyUpdate->setBathtubAttribute($request->bathtub);
        $propertyUpdate->setFirePlaceAttribute($request->fireplace);
        $propertyUpdate->setLavatoryAttribute($request->lavatory);
        $propertyUpdate->setFurnishedAttribute($request->furnished);
        $propertyUpdate->setPoolAttribute($request->pool);
        $propertyUpdate->setSteamRoomAttribute($request->steam_room);
        $propertyUpdate->setViewOfTheSeaAttribute($request->view_of_the_sea);

        $propertyUpdate->save();
        $propertyUpdate->setSlug();

        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if ($validator->fails() === true) {
            return redirect()->back()->withInput()->with([
                'color' => 'orange',
                'message' => 'Todas as imagens devem ser do tipo jpg, jpeg ou png.',
            ]);
        }

        if ($request->allFiles()) {
            foreach ($request->allFiles()['files'] as $image) {
                $propertyImage = new PropertyImage();
                $propertyImage->property = $propertyUpdate->id;
                $propertyImage->path = $image->store('properties/' . $propertyUpdate->id);
                $propertyImage->save();
                unset($propertyImage);
            }
        }

        return redirect()->route('admin.properties.edit', ['property' => $propertyUpdate->id])
            ->with(['color' => 'success', 'message' => 'O imóvel foi atualizado com sucesso']);
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

    public function imageSetCover(Request $request)
    {
        $imageSetCover = PropertyImage::where('id', $request->id)->first();
        $allImages = PropertyImage::where('property', $imageSetCover->property)->get();

        foreach ($allImages as $image) {
            $image->cover = null;
            $image->save();
        }

        $imageSetCover->cover = true;
        $imageSetCover->save();

        return response()->json(['success' => true]);
    }

    public function imageRemove(Request $request)
    {
        $propertyImageRemove = PropertyImage::find($request->id);

        if ($propertyImageRemove) {
            Storage::delete($propertyImageRemove->path);
            Cropper::flush($propertyImageRemove->path);
            $propertyImageRemove->delete();

            return response()->json(['success' => true]);
        }
    }
}
