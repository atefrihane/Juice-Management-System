<?php

namespace App\Modules\Product\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductHistory;
use App\Modules\Store\Models\Store;
use App\Repositories\Image;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function store(Request $request)
    {

        $request->validate([
            'code' => 'required|between:1,6',
            'state' => 'required',
            'name' => 'required',
            'type' => 'required',
            'barcode' => 'required|between:1,12',
            'designation' => 'required|min:1|max:200',
            'composition' => 'required|min:1|max:100',
            'version' => 'required|min:1|max:100',
            'color' => 'required',
            'weight' => 'required|digits_between:1,6|numeric',
            'height' => 'required|digits_between:1,6|numeric',
            'width' => 'required|digits_between:1,6|numeric',
            'depth' => 'required|digits_between:1,6|numeric',
            'publicPrice' => 'required|between:0,99.999.999|numeric',
            'validityClosed' => 'required|digits_between:1,6|numeric',
            'validityOpened' => 'required|digits_between:1,6|numeric',
            'unityPerDisplay' => 'required|digits_between:1,6|numeric',
            'unityPerPack' => 'required|digits_between:1,6|numeric',
            'packing' => 'required|digits_between:1,6|numeric',
            'tva' => 'required|digits_between:1,6|numeric',

        ], [
            'code.required' => ' Code est requis',
            'code.digits_between' => ' Code n\'est pas valide',
            'state.required' => ' Etat est requis',
            'name.required' => ' Nom du produit est requis',
            'type.required' => ' Type du produit  est requis',
            'color.required' => ' Couleur  est requis',
            'barcode.required' => ' Code à barres est requis',
            'barcode.between' => ' Code à barres n\'est pas valide',
            'designation.required' => ' Désignation est requise',
            'designation.min' => ' Désignation n\'est pas valide',
            'designation.max' => ' Désignation n\'est pas valide',
            'composition.required' => ' Composition est requise',
            'composition.min' => ' Composition n\'est pas valide',
            'composition.max' => ' Composition n\'est pas valide',
            'version.required' => ' Version est requise',
            'version.min' => ' Version n\'est pas valide',
            'version.max' => ' Version n\'est pas valide',
            'weight.required' => ' Poids est requis',
            'weight.digits_between' => ' Poids n\'est pas valide',
            'weight.numeric' => ' Poids n\'est pas valide',
            'height.required' => ' Hauteur est requis',
            'height.digits_between' => ' Hauteur n\'est pas valide',
            'height.numeric' => ' Hauteur n\'est pas valide',
            'width.required' => ' Largeur est requis',
            'width.digits_between' => ' Largeur n\'est pas valide',
            'width.numeric' => ' Largeur n\'est pas valide',
            'depth.required' => ' Profondeur est requis',
            'depth.digits_between' => ' Profondeur n\'est pas valide',
            'depth.numeric' => ' Profondeur n\'est pas valide',
            'publicPrice.required' => ' Prix unitaire de vente est requis',
            'publicPrice.between' => ' Prix unitaire de vente n\'est pas valide',
            'publicPrice.numeric' => ' Prix unitaire de vente n\'est pas valide',
            'validityClosed.required' => ' Durée de validité de produit fermé ( en jours) est requis',
            'validityClosed.digits_between' => ' Durée de validité de produit fermé ( en jours)  n\'est pas valide',
            'validityClosed.numeric' => ' Durée de validité de produit fermé ( en jours)  n\'est pas valide',
            'validityOpened.required' => ' Durée de validité aprés ouverture ( en heures) est requis',
            'validityOpened.digits_between' => ' Durée de validité aprés ouverture ( en heures) n\'est pas valide',
            'validityOpened.numeric' => ' Durée de validité aprés ouverture ( en heures) n\'est pas valide',
            'unityPerDisplay.required' => ' Nombre d\'unités par display est requis',
            'unityPerDisplay.digits_between' => ' Nombre d\'unités par display n\'est pas valide',
            'unityPerDisplay.numeric' => ' Nombre d\'unités par display n\'est pas valide',
            'unityPerPack.required' => ' Nombre de display par colis est requis',
            'unityPerPack.digits_between' => ' Nombre de display par colis n\'est pas valide',
            'unityPerPack.numeric' => ' Nombre de display par colis n\'est pas valide',
            'packing.required' => ' Colisage est requis',
            'packing.digits_between' => ' Colisage n\'est pas valide',
            'packing.numeric' => ' Colisage n\'est pas valide',
            'tva.required' => ' TVA (%) est requis',
            'tva.digits_between' => ' TVA (%) n\'est pas valide',
            'tva.numeric' => ' TVA (%) n\'est pas valide',
     
        ]);


        $checkCode = Product::where('code', $request->code)->first();
        if ($checkCode) {
            return response()->json(['status' => 400]);
        }
        if ($request->photo) {
            $name = $this->image->handleUploadImage($request->photo);

        }

        $product = Product::create([
            'code' => $request->code,
            'status' => lcfirst($request->state),
            'type' => $request->type,
            'nom' => $request->name,
            'designation' => $request->designation,
            'barcode' => $request->barcode,
            'version' => $request->version,
            'composition' => $request->composition,
            'color' => $request->color,
            'weight' => $request->weight,
            'height' => $request->height,
            'width' => $request->width,
            'depth' => $request->depth,
            'public_price' => $request->publicPrice,
            'period_of_validity' => $request->validityClosed,
            'validity_after_opening' => $request->validityOpened,
            'comment' => $request->comment,
            'unit_by_display' => $request->unityPerDisplay,
            'unit_per_package' => $request->unityPerPack,
            'packing' => $request->packing,
            'tva' => $request->tva,
            'photo_url' => isset($name) ? $name : null,
        ]);

        ProductHistory::create([
            'action' => 'Création',
            'product_id' => $product->id,
            'user_id' => $request->userId,
        ]);
        return response()->json(['status' => 200]);

    }

    public function index()
    {
        return Product::where('status', 'disponible')->get();
    }

    public function handleGetProductById($id)
    {

        $checkProduct = Product::find($id);

        if ($checkProduct) {

            return response()->json(['status' => 'status', 'product' => $checkProduct->mixtures]);

        } else {
            return response()->json(['status' => '404', 'product' => 'Product not found']);
        }

    }

    public function handleGetProductByName($name)
    {
        $checkProduct = Product::where('nom', $name)->first();
        if ($checkProduct) {
            return response()->json(['status' => '200', 'product' => $checkProduct]);

        } else {
            return response()->json(['status' => '404', 'product' => ' Product not found']);
        }

    }

    public function handleGetProductByBarcode($barcode)
    {

        $checkProduct = Product::where('barcode', $barcode)->first();
        if ($checkProduct) {
            return response()->json(['status' => '200', 'product' => $checkProduct]);

        } else {
            return response()->json(['status' => '404', 'product' => ' Product not found']);
        }

    }

    public function handleGetAllProduct()
    {
        $products = Product::where('status', 'disponible')->get();
        return response()->json(['status' => '200', 'products' => $products]);

    }

    public function handleUpdateProduct(Request $request, $id)
    {
      
        $request->validate([
            'code' => 'required|between:1,6',
            'state' => 'required',
            'name' => 'required',
            'type' => 'required',
            'barcode' => 'required|between:1,12',
            'designation' => 'required|min:1|max:200',
            'composition' => 'required|min:1|max:100',
            'version' => 'required|min:1|max:100',
            'color' => 'required',
            'weight' => 'required|digits_between:1,6|numeric',
            'height' => 'required|digits_between:1,6|numeric',
            'width' => 'required|digits_between:1,6|numeric',
            'depth' => 'required|digits_between:1,6|numeric',
            'publicPrice' => 'required|between:0,99.999.999|numeric',
            'validityClosed' => 'required|digits_between:1,6|numeric',
            'validityOpened' => 'required|digits_between:1,6|numeric',
            'unityPerDisplay' => 'required|digits_between:1,6|numeric',
            'unityPerPack' => 'required|digits_between:1,6|numeric',
            'packing' => 'required|digits_between:1,6|numeric',
            'tva' => 'required|digits_between:1,6|numeric',

        ], [
            'code.required' => ' Code est requis',
            'code.digits_between' => ' Code n\'est pas valide',
            'state.required' => ' Etat est requis',
            'name.required' => ' Nom du produit est requis',
            'type.required' => ' Type du produit  est requis',
            'color.required' => ' Couleur  est requis',
            'barcode.required' => ' Code à barres est requis',
            'barcode.between' => ' Code à barres n\'est pas valide',
            'designation.required' => ' Désignation est requise',
            'designation.min' => ' Désignation n\'est pas valide',
            'designation.max' => ' Désignation n\'est pas valide',
            'composition.required' => ' Composition est requise',
            'composition.min' => ' Composition n\'est pas valide',
            'composition.max' => ' Composition n\'est pas valide',
            'version.required' => ' Version est requise',
            'version.min' => ' Version n\'est pas valide',
            'version.max' => ' Version n\'est pas valide',
            'weight.required' => ' Poids est requis',
            'weight.digits_between' => ' Poids n\'est pas valide',
            'weight.numeric' => ' Poids n\'est pas valide',
            'height.required' => ' Hauteur est requis',
            'height.digits_between' => ' Hauteur n\'est pas valide',
            'height.numeric' => ' Hauteur n\'est pas valide',
            'width.required' => ' Largeur est requis',
            'width.digits_between' => ' Largeur n\'est pas valide',
            'width.numeric' => ' Largeur n\'est pas valide',
            'depth.required' => ' Profondeur est requis',
            'depth.digits_between' => ' Profondeur n\'est pas valide',
            'depth.numeric' => ' Profondeur n\'est pas valide',
            'publicPrice.required' => ' Prix unitaire de vente est requis',
            'publicPrice.between' => ' Prix unitaire de vente n\'est pas valide',
            'publicPrice.numeric' => ' Prix unitaire de vente n\'est pas valide',
            'validityClosed.required' => ' Durée de validité de produit fermé ( en jours) est requis',
            'validityClosed.digits_between' => ' Durée de validité de produit fermé ( en jours)  n\'est pas valide',
            'validityClosed.numeric' => ' Durée de validité de produit fermé ( en jours)  n\'est pas valide',
            'validityOpened.required' => ' Durée de validité aprés ouverture ( en heures) est requis',
            'validityOpened.digits_between' => ' Durée de validité aprés ouverture ( en heures) n\'est pas valide',
            'validityOpened.numeric' => ' Durée de validité aprés ouverture ( en heures) n\'est pas valide',
            'unityPerDisplay.required' => ' Nombre d\'unités par display est requis',
            'unityPerDisplay.digits_between' => ' Nombre d\'unités par display n\'est pas valide',
            'unityPerDisplay.numeric' => ' Nombre d\'unités par display n\'est pas valide',
            'unityPerPack.required' => ' Nombre de display par colis est requis',
            'unityPerPack.digits_between' => ' Nombre de display par colis n\'est pas valide',
            'unityPerPack.numeric' => ' Nombre de display par colis n\'est pas valide',
            'packing.required' => ' Colisage est requis',
            'packing.digits_between' => ' Colisage n\'est pas valide',
            'packing.numeric' => ' Colisage n\'est pas valide',
            'tva.required' => ' TVA (%) est requis',
            'tva.digits_between' => ' TVA (%) n\'est pas valide',
            'tva.numeric' => ' TVA (%) n\'est pas valide',
     
        ]);

        $product = Product::find($id);
        $checkCode = Product::where('code', $request->code)
            ->where('id', '!=', $product->id)
            ->first();
        if ($checkCode) {
            return response()->json(['status' => 400]);
        }
        $currentPhoto = $product->photo_url;
        if ($product) {

            if ($request->photo != $currentPhoto) {
                $name = $this->image->handleUploadImage($request->photo);

                // $image->upload($request);
                $userPhoto = public_path('img/') . $currentPhoto;
                if (file_exists($userPhoto)) {
                    @unlink($userPhoto);
                }

            }

            $product->update([
                'code' => $request->code,
                'status' => $request->state,
                'type' => $request->type,
                'nom' => $request->name,
                'designation' => $request->designation,
                'barcode' => $request->barcode,
                'version' => $request->version,
                'composition' => $request->composition,
                'color' => $request->color,
                'weight' => $request->weight,
                'height' => $request->height,
                'width' => $request->width,
                'depth' => $request->depth,
                'public_price' => $request->publicPrice,
                'period_of_validity' => $request->validityClosed,
                'validity_after_opening' => $request->validityOpened,
                'comment' => $request->comment,
                'unit_by_display' => $request->unityPerDisplay,
                'unit_per_package' => $request->unityPerPack,
                'packing' => $request->packing,
                'tva' => $request->tva,
                'photo_url' => isset($name) ? $name : $currentPhoto,
            ]);

            ProductHistory::create([
                'action' => 'Modification',
                'user_id' => $request->userId,
                'product_id' => $product->id,
            ]);

            return response()->json(['status' => 200]);

        }
    }
    public function handleGetProductDetails($id)
    {

        $product = Product::find($id);

        if ($product) {
            return response()->json(['status' => '200', 'product' => $product]);

        }
        return response()->json(['status' => '404']);

    }
    public function handleGetProductPrices($id, Request $request)
    {

        $product = Product::find($id);
        $checkCustomPrice = Store::find($request->store_id)->prices->where('product_id', $product->id)->first();

        if ($product) {
            return response()->json(['status' => '200', 'product' => $product, 'custom_price' => $checkCustomPrice]);

        }
        return response()->json(['status' => '404']);

    }

    public function handleGetProductInWarehouses(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {

            $productInWarehouses = $product->warehouses()
                ->where('quantity', '>', 0)
                ->orderBy('pivot_expiration_date', 'ASC')
                ->withPivot('id', 'packing', 'quantity', 'comment', 'creation_date', 'expiration_date')
                ->get();

            return response()->json(['status' => 200, 'warehouse_products' => $productInWarehouses, 'productName' => $product->nom]);

        }
        return response()->json(['status' => 404]);

    }
    public function handleGetValidityAfterOpening($id, Request $request)
    {

        $product = Product::find($id);
        if ($product) {

            $date = Carbon::parse($request->date);
            $finalDate = $date->addDays($product->period_of_validity);

            return response()->json(['status' => 200, 'finalDate' => $date->format('Y-m-d')]);

        }
        return response()->json(['status' => 404]);

    }

    public function handleCheckQuantityInWarehouses($id, Request $request)
    {
        $checkProductInWarehouse = DB::table('product_warehouse')->find($id);
        if ($checkProductInWarehouse) {
            if ($checkProductInWarehouse->quantity >= $request->preparedQuantity) {
                return response()->json(['status' => 200, 'warehouseQuantity' => $checkProductInWarehouse->quantity]);

            }
            return response()->json(['status' => 400, 'warehouseQuantity' => $checkProductInWarehouse->quantity]);
        }
        return response()->json(['status' => 404]);

    }

}
