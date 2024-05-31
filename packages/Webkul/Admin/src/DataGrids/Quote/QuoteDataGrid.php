<?php

namespace Webkul\Admin\DataGrids\Quote;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\UI\DataGrid\DataGrid;
use Webkul\User\Repositories\UserRepository;

class QuoteDataGrid extends DataGrid
{
    use ProvideDropdownOptions;

    /**
     * User repository instance.
     *
     * @var \Webkul\User\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create datagrid instance.
     *
     * @param \Webkul\User\Repositories\UserRepository  $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    /**
     * Place your datagrid extra settings here.
     *
     * @return void
     */
    public function init()
    {
        $this->setRowProperties([
            'backgroundColor' => '#d0ffdd',
            'condition' => function ($row) {
                if ($row->is_payment_completed) {
                    return true;
                }

                return false;
            }
        ]);
    }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('quotes')
            ->addSelect(
                'quotes.id',
                'quotes.name',
                'quotes.price',
                'quotes.tax',
                'quotes.tip',
                'quotes.created_at',
                'quotes.is_payment_completed as is_payment_completed',
                'users.id as user_id',
                'users.name as sales_person',
                'persons.id as person_id',
                'persons.name as person_name',
            )
            ->leftJoin('users', 'quotes.user_id', '=', 'users.id')
            ->leftJoin('persons', 'quotes.person_id', '=', 'persons.id');

        $currentUser = auth()->guard('user')->user();

        if ($currentUser->view_permission != 'global') {
            if ($currentUser->view_permission == 'group') {
                $queryBuilder->whereIn('quotes.user_id', $this->userRepository->getCurrentUserGroupsUserIds());
            } else {
                $queryBuilder->where('quotes.user_id', $currentUser->id);
            }
        }

        $this->addFilter('id', 'quotes.id');
        $this->addFilter('user', 'quotes.user_id');
        $this->addFilter('sales_person', 'quotes.user_id');
        $this->addFilter('person_name', 'persons.name');
        $this->addFilter('created_at', 'quotes.created_at');

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
            'label'    => trans('admin::app.datagrid.name'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'            => 'sales_person',
            'label'            => trans('admin::app.datagrid.sales-person'),
            'type'             => 'dropdown',
            'dropdown_options' => $this->getUserDropdownOptions(),
            'sortable'         => true,
            'closure'          => function ($row) {
                $route = urldecode(route('admin.settings.users.index', ['id[eq]' => $row->user_id]));

                return "<a href='" . $route . "'>" . $row->sales_person . "</a>";
            },
        ]);

        $this->addColumn([
            'index'    => 'person_name',
            'label'    => trans('admin::app.datagrid.person'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                $route = urldecode(route('admin.contacts.persons.index', ['id[eq]' => $row->person_id]));

                return "<a href='" . $route . "'>" . $row->person_name . "</a>";
            },
        ]);

        $this->addColumn([
            'index'      => 'is_payment_completed',
            'label'      => trans('admin::app.leads.is_payment_completed'),
            'type'       => 'dropdown',
            'searchable' => false,
            'sortable'   => true,
            'dropdown_options' => [
                [
                    'label'    => __('select One'),
                    'value'    => '',
                    'disabled' => true,
                    'selected' => true,
                ], [
                    'label'    => __('Pending'),
                    'value'    => null,
                    'disabled' => false,
                    'selected' => false,
                ], [
                    'label'    => __('Completed'),
                    'value'    => 1,
                    'disabled' => false,
                    'selected' => false,
                ], [
                    'label'    => __('Cancelled'),
                    'value'    => 0,
                    'disabled' => false,
                    'selected' => false,
                ],
            ],
            'closure'    => function ($row) {
                if ($row->is_payment_completed == null) {
                    return "<span class='badge badge-round badge-warning'></span> Pending";
                } elseif($row->is_payment_completed) {
                    return "<span class='badge badge-round badge-success'></span> Completed";
                } else {
                    return "<span class='badge badge-round badge-danger'></span> Cancelled";
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.datagrid.created_at'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->created_at);
            },
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
            'route'  => 'admin.quotes.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.print'),
            'method' => 'GET',
            'route'  => 'admin.quotes.print',
            'icon'   => 'sprite quotes-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.quotes.delete',
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
            'action' => route('admin.quotes.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}
