<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use App\Modules\Store\Models\StoreHistory;
use App\Modules\Store\Models\StoreProduct;
use App\Modules\Store\Models\StoreSchedule;
use App\Repositories\Image;
use App\Repositories\Validation;
use Auth;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $image, $validation;

    public function __construct(Image $image, Validation $validation)
    {
        $this->image = $image;
        $this->validation = $validation;
    }
    public function showStores($id)
    {$company = Company::find($id);
        $stores = Store::query()->whereCompanyId($id)->get();
        if ($company) {
            return view('Store::showStores', compact('company', 'stores'));
        }
        return view('General::notFound');

    }

    public function showAddStore($company_id)
    {
        $company = Company::find($company_id);
        $lastStoreId = Company::all()->last()->id + 1;
        $countries = Country::all();

        if ($company) {
            return view('Store::addStore', compact('company', 'lastStoreId', 'countries'));}
        return view('General::notFound');

    }

    public function handleFillSchedule($day, $startDay, $endDay, $startNight, $endNight, $closed, $storeId)
    {

        if ($storeId) {
            $dayText = "";
            switch ($day) {
                case (1):
                    $dayText = 'Lundi';
                    break;
                case (2):
                    $dayText = 'Mardi';
                    break;
                case (3):
                    $dayText = 'Mercredi';
                    break;
                case (4):
                    $dayText = 'Jeudi';
                    break;
                case (5):
                    $dayText = 'Vendredi';
                    break;
                case (6):
                    $dayText = 'Samedi';
                    break;
                case (7):
                    $dayText = 'Dimanche';
                    break;

            }

            if ($startDay && $endDay) {
                if ($startDay >= $endDay) {

                    alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                    return false;

                }

            }

            if ($startNight && $endNight) {
                if ($startNight >= $endNight) {
                    alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                    return false;

                }
            }

            if ($startDay && $endDay && $startNight && $endNight) {
                if ($startNight <= $endDay or $startNight <= $startDay) {
                    alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                    return false;

                }

                if ($endNight <= $endDay or $endNight <= $startDay) {
                    alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                    return false;

                }

            }

            StoreSchedule::create([
                'day' => $day,
                'start_day_time' => $startDay,
                'end_day_time' => $endDay,
                'start_night_time' => $startNight,
                'end_night_time' => $endNight,
                'closed' => $closed == 'on' ? 1 : 0,
                'store_id' => $storeId,

            ]);

            return true;

        }
        alert()->error('Oups', 'Magasin introuvable');
        return redirect()->back()->withInput();
    }

    public function store($company_id, Request $request)
    {

        $request->validate([
            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
            'sign' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tel' => 'required|digits_between:1,12',
            'cc' => 'required|min:3|max:10|regex:/^[+][0-9]{1,3}+$/',
            'order_type' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',

        ], [
            'code.required' => ' Code est obligatoire',
            'code.regex' => ' Code n\'est pas valide',
            'code.alpha_dash' => ' Code doit être alphanumérique',
            'sign.required' => ' Enseigne  est obligatoire',
            'designation.required' => ' Designation est obligatoire',
            'address.required' => ' Addresse est obligatoire',
            'zipcode_id.required' => ' Code postale est obligatoire',
            'country_id.required' => ' Code postale est obligatoire',
            'city_id.required' => ' Code postale est obligatoire',
            'email.required' => ' Email est obligatoire',
            'email.email' => 'Email non valide',
            'cc.required' => 'Préfixe telephone est obligatoire',
            'cc.min' => ' Préfixe telephone est invalide',
            'cc.max' => ' Préfixe telephone est invalide',
            'cc.regex' => ' Préfixe telephone est invalide',
            'tel.required' => ' Numéro telephone est obligatoire',
            'tel.digits_between' => ' Numéro telephone est invalide',
            'order_type.required' => 'Type de la commande est obligatoire',
            'photo.image' => 'Le format du logo importé est non supporté ',
            'photo.mimes' => 'Le format du logo importé est non supporté ',
            'photo.max' => 'Logo importé est volumineux ! ',

        ]);

        if ($request->photo) {
            $path = $this->image->uploadBinaryImage($request->photo);
        } else {
            $path = 'company-placeholder.png';
        }

        $telephone = $request->cc . " " . $request->tel;
        $insertable = $request->all();

        $insertable['tel'] = $telephone;
        unset(
            $insertable['cc'],
            $insertable['mondayDayStart'],
            $insertable['mondayDayEnd'],
            $insertable['mondayNightStart'],
            $insertable['mondayNightEnd'],
            $insertable['mondayClosed'],
            $insertable['tuesdayDayStart'],
            $insertable['tuesdayDayEnd'],
            $insertable['tuesdayNightStart'],
            $insertable['tuesdayNightEnd'],
            $insertable['tuesdayClosed'],
            $insertable['wednesdayDayStart'],
            $insertable['wednesdayDayEnd'],
            $insertable['wednesdayNightStart'],
            $insertable['wednesdayNightEnd'],
            $insertable['wednesdayClosed'],
            $insertable['thursdayDayStart'],
            $insertable['thursdayDayEnd'],
            $insertable['thursdayNightStart'],
            $insertable['thursdayNightEnd'],
            $insertable['thursdayClosed'],
            $insertable['fridayDayStart'],
            $insertable['fridayDayEnd'],
            $insertable['fridayNightStart'],
            $insertable['fridayNightEnd'],
            $insertable['fridayClosed'],
            $insertable['saturdayDayStart'],
            $insertable['saturdayDayEnd'],
            $insertable['saturdayNightStart'],
            $insertable['saturdayNightEnd'],
            $insertable['saturdayClosed'],
            $insertable['sundayDayStart'],
            $insertable['sundayDayEnd'],
            $insertable['sundayNightStart'],
            $insertable['sundayNightEnd'],
            $insertable['sundayClosed']

        );
        $insertable['photo'] = $path;
        $insertable['company_id'] = $company_id;
        $checkCode = Store::where('code', preg_replace('/\s/', '', $request->code))->first();
        if ($checkCode) {
            alert()->error('Code déja utilisé', 'Oups')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        $store = Store::create($insertable);
        $store->schedules()->update(['store_id' => $store]);
        StoreHistory::create([
            'action' => 'Creation',
            'store_id' => $store->id,
            'user_id' => Auth::id(),

        ]);

        $checkMonday = $this->handleFillSchedule(1, $request->mondayDayStart, $request->mondayDayEnd, $request->mondayNightStart, $request->mondayNightEnd, $request->mondayClosed, $store->id);
        $checkTuesday = $this->handleFillSchedule(2, $request->tuesdayDayStart, $request->tuesdayDayEnd, $request->tuesdayNightStart, $request->tuesdayNightEnd, $request->tuesdayClosed, $store->id);
        $checkWednesday = $this->handleFillSchedule(3, $request->wednesdayDayStart, $request->wednesdayDayEnd, $request->wednesdayNightStart, $request->wednesdayNightEnd, $request->wednesdayClosed, $store->id);
        $checkThursday = $this->handleFillSchedule(4, $request->thursdayDayStart, $request->thursdayDayEnd, $request->thursdayNightStart, $request->thursdayNightEnd, $request->thursdayClosed, $store->id);
        $checkFriday = $this->handleFillSchedule(5, $request->fridayDayStart, $request->fridayDayEnd, $request->fridayNightStart, $request->fridayNightEnd, $request->fridayClosed, $store->id);
        $checkSaturday = $this->handleFillSchedule(6, $request->saturdayDayStart, $request->saturdayDayEnd, $request->saturdayNightStart, $request->saturdayNightEnd, $request->saturdayClosed, $store->id);
        $checkSunday = $this->handleFillSchedule(7, $request->sundayDayStart, $request->sundayDayEnd, $request->sundayNightStart, $request->sundayNightEnd, $request->sundayClosed, $store->id);

        if (!$checkMonday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Lundi')->persistent('Femer');return redirect()->back()->withInput();}
        if (!$checkTuesday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Mardi')->persistent('Femer');return redirect()->back()->withInput();}
        if (!$checkWednesday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Mercredi')->persistent('Femer');return redirect()->back()->withInput();}
        if (!$checkThursday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Jeudi')->persistent('Femer');return redirect()->back()->withInput();}
        if (!$checkFriday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Vendredi')->persistent('Femer');return redirect()->back()->withInput();}
        if (!$checkSaturday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Samedi')->persistent('Femer');return redirect()->back()->withInput();}
        if (!$checkSunday) {$store->delete();
            alert()->error('Oups!', 'Veuillez vérifier les horaires pour Dimanche')->persistent('Femer');return redirect()->back()->withInput();}

        alert()->success('Succès!', 'Le magasin a été crée avec succès ! ')->persistent('Femer');
        return redirect(route('showStores', $company_id));

    }

    public function edit($id)
    {
        $store = Store::find($id);

        if ($store) {
            $company = Company::find($store->company_id);
            $countries = Country::all();
            $cities = City::where('country_id', $store->country_id)->get();
            $zipcodes = Zipcode::where('city_id', $store->city_id)->get();

            return view("Store::editStore", compact('store', 'company', 'countries', 'cities', 'zipcodes'));

        }

    }

    public function update($id, Request $request)
    {

        $request->validate([
            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
            'sign' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tel' => 'required|digits_between:1,12',
            'cc' => 'required|min:3|max:10|regex:/^[+][0-9]{1,3}+$/',
            'order_type' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',

        ], [
            'code.required' => ' Code est obligatoire',
            'code.regex' => ' Code n\'est pas valide',
            'code.alpha_dash' => ' Code doit être alphanumérique',
            'sign.required' => ' Enseigne  est obligatoire',
            'designation.required' => ' Designation est obligatoire',
            'address.required' => ' Addresse est obligatoire',
            'zipcode_id.required' => ' Code postale est obligatoire',
            'country_id.required' => ' Code postale est obligatoire',
            'city_id.required' => ' Code postale est obligatoire',
            'email.required' => ' Email est obligatoire',
            'email.email' => 'Email non valide',
            'cc.required' => 'Préfixe telephone est obligatoire',
            'cc.min' => ' Préfixe telephone est invalide',
            'cc.max' => ' Préfixe telephone est invalide',
            'cc.regex' => ' Préfixe telephone est invalide',
            'tel.required' => ' Numéro telephone est obligatoire',
            'tel.digits_between' => ' Numéro telephone est invalide',
            'order_type.required' => 'Type de la commande est obligatoire',
            'photo.image' => 'Le format du logo importé est non supporté ',
            'photo.mimes' => 'Le format du logo importé est non supporté ',
            'photo.max' => 'Logo importé est volumineux ! ',

        ]);
        $updateable = $request->all();

        $store = Store::find($id);
        if ($store) {
            unset($updateable['_token']);
            $updateable['tel'] = $request->cc . ' ' . $request->tel;
            unset(
                $updateable['cc'],
                $updateable['schedules']
            );
            if ($request->photo) {

                $updateable['photo'] = $this->image->uploadBinaryImage($request->photo);

            } else {
                unset($updateable['photo']);
            }

            $checkCode = Store::where('code', preg_replace('/\s/', '', $request->code))
                ->where('id', '!=', $store->id)
                ->first();
            if ($checkCode) {
                alert()->error('Code déja utilisé', 'Oups')->persistent('Femer');
                return redirect()->back();
            }

            $store->update($updateable);

            StoreHistory::create([
                'action' => 'Modification',
                'store_id' => $store->id,
                'user_id' => Auth::id(),

            ]);

            if ($request->input('schedules')) {

                foreach ($request->schedules as $schedule) {

                    if (isset($schedule[0])) {
                        $checkSchedule = StoreSchedule::find($schedule[0]);
                        $dayText = "";
                        switch ($checkSchedule->day) {
                            case (1):
                                $dayText = 'Lundi';
                                break;
                            case (2):
                                $dayText = 'Mardi';
                                break;
                            case (3):
                                $dayText = 'Mercredi';
                                break;
                            case (4):
                                $dayText = 'Jeudi';
                                break;
                            case (5):
                                $dayText = 'Vendredi';
                                break;
                            case (6):
                                $dayText = 'Samedi';
                                break;
                            case (7):
                                $dayText = 'Dimanche';
                                break;

                        }

                        $startDay = $schedule[1];
                        $endDay = $schedule[2];
                        $startNight = $schedule[3];
                        $endNight = $schedule[4];

                        if ($startDay && $endDay) {
                            if ($startDay >= $endDay) {
                                alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                                return redirect()->back();

                            }

                        }

                        if ($startNight && $endNight) {
                            if ($startNight >= $endNight) {
                                alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                                return redirect()->back();

                            }
                        }

                        if ($startDay && $endDay && $startNight && $endNight) {
                            if ($startNight <= $endDay or $startNight <= $startDay) {
                                alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                                return redirect()->back();

                            }

                            if ($endNight <= $endDay or $endNight <= $startDay) {
                                alert()->error('Oups', ' Verifier les horaires pour ' . $dayText)->persistent('Femer');
                                return redirect()->back();

                            }

                        }

                        $checkSchedule->update([
                            'day' => $checkSchedule->day,
                            'start_day_time' => $startDay,
                            'end_day_time' => $endDay,
                            'start_night_time' => $startNight,
                            'end_night_time' => $endNight,
                            'closed' => isset($schedule[5]) ? 1 : 0,
                            'store_id' => $store->id,

                        ]);
                    }

                }

            }
            alert()->success('Le magasin a été modifié avec succès', 'Succès!')->persistent("Fermer");

            return redirect(route('showStores', $store->company_id));
        }
    }

    public function delete($id)
    {
        $store = Store::find($id);
        if ($store) {
            if (!$store->rentals()->exists() &&
                !$store->products()->exists() &&
                !$store->orders()->exists()
            ) {
                $companyId = $store->company_id;
                $currentRentals = $store->rentals()->where('active', 1)->get();
                foreach ($currentRentals as $currentRental) {
                    $currentRental->machine->update(['rented' => 0]);
                }
                $store->delete();
                alert()->success('Succès!', 'Le magasin  a été supprimé avec succès ')->persistent("Fermer");
                return redirect(route('showStores', $companyId));

            } else {
                alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
                return redirect()->back();

            }

        }

        return view('General::notFound');
    }

    public function showStore($id, $idStore)
    {
        $store = Store::find($idStore);

        if ($store) {
            return view('Store::showStore', compact('store'));
        }
        return view('General::notFound');

    }

    public function showStoreRentals($id, $idStore)
    {
        $store = Store::find($idStore);
        if ($store) {
            $rentals = MachineRental::where('store_id', $idStore)
                ->where('active', 1)
                ->get();
            return view('Store::showStoreMachines', compact('rentals', 'store'));
        }
        return view('General::notFound');

    }

    public function showStoreStock($id, $idStore, Request $request)
    {
        $store = Store::find($idStore);
        $stocks = StoreProduct::all();

        if ($store) {
            return view('Store::showStoreStock', compact('store', 'stocks'));
        }
        return view('General::notFound');

    }
    public function showAddStoreStock($id, $idStore, Request $request)
    {
        $store = Store::find($idStore);

        if ($store) {
            $products = Product::all();
            return view('Store::showAddStoreStock', compact('store', 'products'));
        }
        return view('General::notFound');

    }

    public function handleAddStoreStock($id, $idStore, Request $request)
    {

        $request->validate([
            'stock_display' => 'required|digits_between:1,6',
            'packing_display' => 'required|digits_between:1,6',
            'packing' => 'required|digits_between:1,6',
            'quantity' => 'required|digits_between:1,6||min:0|not_in:0',
            'creation_date' => 'required|date',
            'expiration_date' => 'required|date',

        ], [
            'stock_display.required' => ' Nombre d\'unités par display est requis',
            'stock_display.digits_between' => ' Nombre d\'unités par display n\'est pas valide',
            'packing_display.required' => ' Nombre de display par colis est requis',
            'packing_display.digits_between' => ' Nombre de display par colis n\'est pas valide',
            'packing.required' => ' Colisage est requis',
            'packing.digits_between' => ' Colisage n\'est pas valide',
            'creation_date.required' => ' Date de fabrication est requis',
            'expiration_date.required' => 'le  champs Date de péremption est requis',
            'quantity.required' => 'le  champs quantité est requis',
            'quantity.min' => ' Quantité n\est pas valide',
            'quantity.not_in' => ' Quantité n\est pas valide',
            'quantity.digits_between' => ' Quantité n\'est pas valide',

        ]);
        $store = Store::find($idStore);
        $stocks = StoreProduct::all();

        $checkStock = StoreProduct::where('product_id', $request->product_id)
            ->where('store_id', $idStore)
            ->where('creation_date', $request->creation_date)
            ->where('expiration_date', $request->expiration_date)
            ->first();

        if ($checkStock) {
            alert()->error('Stock déja existant ', 'Oups!')->persistent('Femer');
            return redirect()->back()->withInput();

        }

        if ($request->creation_date >= $request->expiration_date) {
            alert()->error('Oups!', 'Veuillez vérifier les dates !')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        if ($store) {

            $store->products()->attach($request->product_id,
                $request->except(
                    '_token',
                    'url',
                    'productCode',
                    'productBarcode',
                    'productPacking',
                    'defaultDisplay',
                    'defaultPacking',
                    'productPacking'

                ));
            alert()->success('Stock ajouté', 'Succès!')->persistent('Femer');
            return redirect()->route('showStoreStock', ['store_id' => $store->company->id, 'store' => $store->id]);

        }
    }

    public function handleDeleteStock($id)
    {
        $stock = StoreProduct::find($id);
        if ($stock) {
            $stock->delete();
            alert()->success('Succès', 'Stock supprimé !')->persistent('Femer');
            return redirect()->back();
        }
        return view('General::notFound');

    }

    public function showUpdateStoreStock($id, $idStore, $idStock, Request $request)
    {

        $stock = StoreProduct::find($idStock);
        $store = Store::find($idStore);

        if ($stock) {
            $products = Product::all();

            return view('Store::showUpdateStoreStock', compact('stock', 'products', 'store'));
        }
        return view('General::notFound');

    }

    public function handleUpdateStoreStock($id, $idStore, $idStock, Request $request)
    {
        $request->validate([
            'stock_display' => 'required|digits_between:1,6',
            'packing_display' => 'required|digits_between:1,6',
            'packing' => 'required|digits_between:1,6',
            'quantity' => 'required|digits_between:1,6||min:0|not_in:0',
            'creation_date' => 'required|date',
            'expiration_date' => 'required|date',

        ], [
            'stock_display.required' => ' Nombre d\'unités par display est requis',
            'stock_display.digits_between' => ' Nombre d\'unités par display n\'est pas valide',
            'packing_display.required' => ' Nombre de display par colis est requis',
            'packing_display.digits_between' => ' Nombre de display par colis n\'est pas valide',
            'packing.required' => ' Colisage est requis',
            'packing.digits_between' => ' Colisage n\'est pas valide',
            'creation_date.required' => ' Date de fabrication est requis',
            'expiration_date.required' => 'le  champs Date de péremption est requis',
            'quantity.required' => 'le  champs quantité est requis',
            'quantity.min' => ' Quantité n\est pas valide',
            'quantity.not_in' => ' Quantité n\est pas valide',
            'quantity.digits_between' => ' Quantité n\'est pas valide',

        ]);

        $stock = StoreProduct::find($idStock);
        $stocks = StoreProduct::all();
        $store = Store::find($idStore);
        if ($request->creation_date >= $request->expiration_date) {
            alert()->error('Oups!', 'Veuillez vérifier les dates !')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        if ($stock) {
            $stock->update($request->except('_token'));
            alert()->success('Succès', 'Stock modifié !')->persistent('Femer');
            return redirect()->route('showStoreStock', ['store_id' => $store->company->id, 'store' => $store->id]);
        }
    }

}
