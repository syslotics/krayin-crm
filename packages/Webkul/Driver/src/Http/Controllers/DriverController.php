<?php

namespace Webkul\Driver\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Driver\Http\Resources\DriverResource;
use Webkul\Driver\Repositories\DriverRepository;
use Webkul\Driver\Repositories\DriverLeadRepository;

class DriverController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected DriverRepository $driverRepository,
        protected DriverLeadRepository $driverLeadRepository
    ) {
    }

    /**
     * Search person results.
     *
     * @return \Illuminate\Http\Response|view
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Driver\DataGrids\DriverDataGrid::class)->toJson();
        }

        return view('drivers::common.index');
    }

    /**
     * Search person results.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = $this->driverRepository->findWhere([
            ['first_name', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        return response()->json($results);
    }
  
    /**
     * Display the create form for drivers information.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('drivers::common.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Webkul\Attribute\Http\Requests\AttributeForm $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'first_name' => 'required|unique:drivers',
            'last_name'  => 'required',
            'email'      => 'required|unique:drivers',
            'phone'      => 'required|unique:drivers',
        ]);

        Event::dispatch('drivers.create.before');

        $drives = $this->driverRepository->create(request()->all());

        Event::dispatch('drivers.create.after', $drives);

        session()->flash('success', trans('drivers::app.common.create.create-success'));

        return redirect()->route('drivers.information.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit ($id)
    {
        $driver = $this->driverRepository->findOrFail($id);

        return view('drivers::common.edit', compact('driver'));
    }

    /**
     * Update the in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required',
        ]);

        Event::dispatch('drivers.update.before', $id);

        $type = $this->driverRepository->update(request()->all(), $id);

        Event::dispatch('drivers.update.after', $type);

        session()->flash('success', trans('drivers::app.common.create.update-success'));

        return redirect()->route('drivers.information.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        $this->driverRepository->findOrFail($id);

        try {
            Event::dispatch('drivers.delete.before', $id);

            $this->driverRepository->delete($id);

            Event::dispatch('drivers.delete.after', $id);

            return response()->json([
                'message' => trans('drivers::app.common.create.delete-success'),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('drivers::app.common.create.delete-failed'),
            ], 400);
        }
    }

    /**
     * Mass Delete the specified resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy ()
    {
        foreach (request('rows') as $drivesId) {
            Event::dispatch('drivers.delete.before', $drivesId);

            $this->driverRepository->delete($drivesId);

            Event::dispatch('drivers.delete.after', $drivesId);
        }

        return response()->json([
            'message' => trans('drivers::app.common.create.delete-success'),
        ]);
    }

    /**
     * lead Driver
     * 
     * @param int $lead_id
     * @return \Illuminate\Http\Response
     */
    public function driver($lead_id) 
    {
        $driver = $this->driverLeadRepository->with('driver')->findOneByField('lead_id', $lead_id);
        
        if($driver) {
            return response()->json([
                'status' => true,
                'driver' => $this->resource($driver),
            ]);
        }

        return response()->json([
            'status' => false,
            'driver' => [],
        ]);
    }

    /**
     * Build resource
     */
    private function resource($driver) 
    {
        return [
            'created_at'     => $driver->created_at,
            'driver'         => $driver->driver,
            'cost'           => core()->formatBasePrice($driver->cost),
            'tax'            => core()->formatBasePrice($driver->tax),
            'gratuity'       => core()->formatBasePrice($driver->gratuity),
            'extra_addons'   => core()->formatBasePrice($driver->extra_addons),
            'total_cost'     => core()->formatBasePrice($driver->total_cost),
            'lead_id'        => $driver->lead_id,
            'source_of_lead' => $driver->source_of_lead,
            'updated_at'     => $driver->updated_at,
        ];
    }

    /**
     * Display the success page after payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDriverOnLead()
    {
        try {
            return response()->json([
                'status'      => true,
                'driver_lead' => $this->driverLeadRepository->getDriverDetails(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'driver' => [],
            ]);
        }
    }
}