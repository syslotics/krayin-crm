<?php

namespace Webkul\LeadPerson\Http\Controllers;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\LeadPerson\Repositories\LeadPersonRepository;

class LeadPersonController extends Controller
{
    /**
     * Create a new repository instance.
     */
    public function __construct(
        protected LeadPersonRepository $leadPersonRepository
    ) {
    }

    /**
     * Display the success page after payment.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            return response()->json([
                'status' => true,
                'person' => $this->leadPersonRepository->findOneWhere(request()->all()),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'person' => [],
            ]);
        }
    }
}