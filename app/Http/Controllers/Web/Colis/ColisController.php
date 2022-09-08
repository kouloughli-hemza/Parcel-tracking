<?php

namespace Dsone\Http\Controllers\Web\Colis;

use Barryvdh\DomPDF\Facade\Pdf;
use Dsone\Coli;
use Dsone\Http\Controllers\Controller;
use Dsone\Http\Requests\Colis\CreateColisRequest;
use Dsone\Repositories\Client\ClientRepository;
use Dsone\Repositories\Coli\ColiRepository;
use Dsone\Repositories\Expediteur\ExpediteurRepository;
use Dsone\Repositories\Facture\FactureRepository;
use Dsone\Support\Enum\SendTypes;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ColisController extends Controller
{

    /**
     * @var ColiRepository
     */
    private $colis;

    /**
     * @var ClientRepository
     */
    private $clients;

    /**
     * @var ExpediteurRepository
     */
    private $expediteurs;

    /**
     * @var FactureRepository
     */
    private $factures;


    /**
     * Colis Controller constructor.
     * @param ColiRepository $colis
     * @param ClientRepository $clients
     * @param ExpediteurRepository $expediteurs
     * @param FactureRepository $factures
     */
    public function __construct(
        ColiRepository $colis,
        ClientRepository $clients,
        ExpediteurRepository $expediteurs,
        FactureRepository $factures
    )
    {
        $this->colis = $colis;
        $this->clients = $clients;
        $this->expediteurs = $expediteurs;
        $this->factures = $factures;
    }


    /**
     * Display paginated list of all Parcels.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $parcels = $this->colis->paginate($perPage = 20, $request->search, $request->status);

        return view('parcel.list', compact('parcels'));
    }


    /**
     * Displays form for creating a new parcel.
     * @return Application|Factory|View
     */
    public function create()
    {
        $statuses = SendTypes::lists();
        return view('parcel.add',compact('statuses'));
    }


    /**
     * @param CreateColisRequest $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(CreateColisRequest $request)
    {
        $data = $request->all();
        try {
            $result = DB::transaction(function () use ($request,$data) {
                $client = $this->colis->createColisClient($request);
                $sender = $this->createSender($request);
                $facture = $this->createInvoice($request,$sender->id);
                $data += [
                    'client_id' => $client->id,
                    'facture_id' => $facture->id,
                    'expediteur_id' => $sender->id,
                    'tracking_number' => $this->colis->generateTrackingNumber()
                ];
                $this->colis->create($data);
            });

            return redirect()->route('parcels.index')
                ->withSuccess(__('Colis créée avec succès'));
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * @param $request
     * @return mixed
     */
    private function createSender($request)
    {
        $senderData = [
            'nom' => $request->sender_nom,
            'prenom' => $request->sender_prenom,
            'phone' => $request->sender_tel,
        ];
        return $this->expediteurs->create($senderData);
    }


    /**
     * @param $request
     * @param $senderID
     * @return mixed
     */
    private function createInvoice($request,$senderID)
    {

        $factureData = [
            'reference' => $this->factures->createReference(),
            'total_coli' => 1,
            'total_ttc' => $this->factures->calculateTotalTTC($request),
            'sur_facture' => $this->factures->calculateSurFacture($request),
            'net_amount' => $this->factures->calculateNetAmount($request),
            'total_shipping' => $this->factures->getShippingTotal($request),
            'expediteur_id' => $senderID,
        ];

        return $this->factures->create($factureData);
    }

    /**
     * @param Coli $coli
     * @param DNS1D $dns1d
     * @param DNS2D $dns2d
     * @return Response
     */
    public function generatePDF(Coli $coli,DNS1D $dns1d, DNS2D $dns2d): Response
    {
        $pdf = Pdf::loadView('exports.colis', ['coli' => $coli,'dns1d' => $dns1d,'dns2d' => $dns2d]);
        return $pdf->stream('colis.pdf');
    }


}
