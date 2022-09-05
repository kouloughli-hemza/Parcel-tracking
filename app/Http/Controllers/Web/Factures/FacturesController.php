<?php

namespace Dsone\Http\Controllers\Web\Factures;

use Barryvdh\DomPDF\Facade\Pdf;
use Dsone\Facture;
use Dsone\Http\Controllers\Controller;
use Dsone\Http\Requests\Colis\CreateColisRequest;
use Dsone\Repositories\Coli\ColiRepository;
use Dsone\Repositories\Facture\FactureRepository;
use Dsone\Support\Enum\SendTypes;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FacturesController extends Controller
{

    /**
     * @var FactureRepository
     */
    private $factures;


    /**
     * @var ColiRepository
     */
    private $colis;


    /**
     * FacturesController constructor.
     * @param FactureRepository $factures
     * @param ColiRepository $colis
     */
    public function __construct(FactureRepository $factures,ColiRepository $colis)
    {
        $this->factures = $factures;
        $this->colis = $colis;
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $factures = $this->factures->paginate(20,$request->search);

        return view('facture.list',compact('factures'));
    }


    /**
     * @param Facture $facture
     * @return Application|Factory|View
     */
    public function show(Facture $facture)
    {
        $parcels = $facture->colis;
        return view('facture.view',compact('facture','parcels'));
    }


    /**
     * @param Facture $facture
     * @return Application|Factory|View
     */
    public function appendParcelView(Facture $facture)
    {
        $statuses = SendTypes::lists();

        return view('facture.append-parcel',compact('facture','statuses'));
    }



    /**
     * @param CreateColisRequest $request
     * @param Facture $facture
     * @return Facture
     * @throws \Throwable
     */
    public function appendParcel(CreateColisRequest $request,Facture $facture)
    {
        try {
            $result = DB::transaction(function () use ($request,$facture) {

                $data = $request->all();

                $client = $this->colis->createColisClient($request);

                $data += [
                    'client_id' => $client->id,
                    'facture_id' => $facture->id,
                    'expediteur_id' => $facture->expedireur->id,
                    'tracking_number' => $this->colis->generateTrackingNumber()
                ];
                $this->colis->create($data);

                $totalShippingCost = $facture->colis()->sum('shipping_cost');
                $totalTTC = $facture->colis()->sum('prix_unitaire') + $totalShippingCost;
                $totalNetAmount = ($facture->colis()->sum('prix_unitaire') + $this->factures->calculateSurFacture($request));

                $factureData = [
                    'total_coli' => $facture->colis->count(),
                    'total_ttc' => $totalTTC,
                    'sur_facture' => $this->factures->calculateSurFacture($request),
                    'net_amount' => $totalNetAmount,
                    'total_shipping' => $totalShippingCost,
                    'expediteur_id' => $facture->expedireur->id,
                ];

                $this->factures->update($facture->id,$factureData);
            });

            return redirect()->route('factures.show',$facture->id)
                ->withSuccess(__('Colis créée avec succès'));
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Generate PDF file for facture
     * @param Facture $facture
     * @return Response
     */
    public function generatePDF(Facture $facture): Response
    {
        $pdf = Pdf::loadView('exports.facture', ['facture' => $facture]);
        return $pdf->stream('facture.pdf');
    }
}
