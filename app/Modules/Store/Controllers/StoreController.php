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
use Auth;
use Illuminate\Http\Request;

class StoreController extends Controller
{
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

        $val = $request->validate([
            'code' => 'required',
            'sign' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:companies',
            'tel' => 'required',
            'cc' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'sign.required' => 'le champs enseigne  est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zipcode_id.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.unique' => 'email deja existant',
            'email.email' => 'email non valide',
            'cc.required' => 'le premier champs telephone est obligatoire',
            'tel.required' => 'le deuxieme champs telephone est obligatoire',

        ]);

        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('img', 'public');
        } else {
            $path = 'img/company-placeholder.png';
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
        $insertable['photo'] = 'files/' . $path;
        $insertable['company_id'] = $company_id;
        $checkCode = Store::where('code', preg_replace('/\s/', '', $request->code))->first();
        if ($checkCode) {
            alert()->error('Oups', 'Code déja utilisé !')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        $store = Store::create($insertable);
        $store->schedules()->update(['store_id' => $store]);
        StoreHistory::create([
            'changes' => 'creation',
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

        $val = $request->validate([
            'code' => 'required',
            'sign' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'cc' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'sign.required' => 'le champs enseigne  est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zipcode_id.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.email' => 'email non valide',
            'cc.required' => 'le premier champs telephone est obligatoire',
            'tel.required' => 'le deuxieme champs telephone est obligatoire',

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
            if ($request->file('photo') != null) {
                $path = $request->file('photo')->store('img', 'public');
                $updateable['photo'] = 'files/' . $path;
            } else {
                unset($updateable['logo']);
            }

            $changes = array();
            $fullTel = $request->cc . ' ' . $request->tel;

            if ($store->code != $request->code) {
                array_push($changes, 'code');
            }
            if ($store->status != $request->status) {
                array_push($changes, 'status');
            }

            if ($store->designation != $request->designation) {
                array_push($changes, 'designation');
            }
            if ($store->sign != $request->sign) {
                array_push($changes, 'signe');
            }
            if ($store->country_id != $request->country_id) {
                array_push($changes, 'pays');
            }
            if ($store->city_id != $request->city_id) {
                array_push($changes, 'ville');
            }
            if ($store->zipcode_id != $request->zipcode_id) {
                array_push($changes, 'code postal');
            }
            if ($store->address != $request->address) {
                array_push($changes, 'addresse');
            }
            if ($store->complement != $request->complement) {
                array_push($changes, 'complement addresse');
            }
            if ($store->email != $request->email) {
                array_push($changes, 'email');
            }
            if ($fullTel != $store->tel) {
                array_push($changes, 'téléphone');
            }
            if ($store->comment != $request->comment) {
                array_push($changes, 'comment');
            }
            if ($request->photo && $store->photo != $request->photo) {
                array_push($changes, 'photo');
            }

            if ($request->bill_type && $store->bill_type != $request->bill_type) {
                array_push($changes, 'Type de facturation');
            }
            if ($request->bill_to && $store->bill_type != $request->bill_to) {
                array_push($changes, 'Facture addressée vers');
            }
            if ($request->deliveryRec && $store->deliveryRec != $request->deliveryRec) {
                array_push($changes, 'Recommendation pour livreur ');
            }
            $changes = implode(",", $changes);

            $checkCode = Store::where('code', preg_replace('/\s/', '', $request->code))
                ->where('id', '!=', $store->id)
                ->first();
            if ($checkCode) {
                alert()->error('Oups', 'Code déja utilisé !')->persistent('Femer');
                return redirect()->back();
            }

            $store->update($updateable);

            if ($changes != '') {
                StoreHistory::create([
                    'changes' => $changes,
                    'store_id' => $store->id,
                    'user_id' => Auth::id(),

                ]);

            }

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

            alert()->success('Succès', 'Le magasin a été modifié avec succès')->persistent('Femer');
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
                alert()->error('Impossible de supprimer ce magasin !', 'Oups! ')->persistent("Fermer");
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
        $store = Store::find($idStore);
        $stocks = StoreProduct::all();

        $checkStock = StoreProduct::where('product_id', $request->product_id)
            ->where('store_id', $idStore)
            ->where('creation_date', $request->creation_date)
            ->where('expiration_date', $request->expiration_date)
            ->first();

        if ($checkStock) {
            alert()->error('Oups!', 'Stock déja existant !')->persistent('Femer');
            return redirect()->back()->withInput();

        }

        if ($request->creation_date >= $request->expiration_date) {
            alert()->error('Oups!', 'Veuillez vérifier les dates !')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        if ($store) {

            $store->products()->attach($request->product_id, [
                'quantity' => $request->quantity,
                'packing' => $request->packing,
                'creation_date' => $request->creation_date,
                'expiration_date' => $request->expiration_date,
            ]);
            alert()->success('Succès', 'Stock ajouté !')->persistent('Femer');
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

        $stock = StoreProduct::find($idStock);
        $stocks = StoreProduct::all();
        $store = Store::find($idStore);
        if ($request->creation_date >= $request->expiration_date) {
            alert()->error('Oups!', 'Veuillez vérifier les dates !')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        if ($stock) {

            $stock->update([
                'product_id' => $request->product_id,
                'store_id' => $idStore,
                'quantity' => $request->quantity,
                'packing' => $request->packing,
                'creation_date' => $request->creation_date,
                'expiration_date' => $request->expiration_date,
            ]);
            alert()->success('Succès', 'Stock modifié !')->persistent('Femer');
            return redirect()->route('showStoreStock', ['store_id' => $store->company->id, 'store' => $store->id]);
        }
    }

}
