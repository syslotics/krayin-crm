<?php

namespace Webkul\Driver\DataGrids;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class DriverDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('drivers')
            ->addSelect(
                'drivers.id',
                'drivers.name',
                'drivers.email',
                'drivers.phone'
            );

        $this->addFilter('id', 'drivers.id');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'    => 'name',
            'label'    => trans('drivers::app.datagrid.name'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'email',
            'label'    => trans('drivers::app.datagrid.email'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                return collect(data_get(json_decode($row->email), '*.value'))->join(', ');
            }
        ]);

        $this->addColumn([
            'index'    => 'phone',
            'label'    => trans('drivers::app.datagrid.phone'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                return collect(data_get(json_decode($row->phone), '*.value'))->join(', ');
            }
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'drivers.information.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'drivers.information.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'user']),
            'icon'         => 'trash-icon',
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('ui::app.datagrid.delete'),
            'action' => route('drivers.information.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}
