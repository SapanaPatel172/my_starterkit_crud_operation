<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\EmailTemplates;

class EmailTemplateDataTable extends DataTable
{
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['action'])
            // ->editColumn('emailTemplates', function (EmailTemplates $emailTemplates) {
            //     return view('pages/apps.product-management._product', compact('emailTemplates'));
            // })
            ->addColumn('action', function (EmailTemplates $emailTemplates) {
                return view('pages/apps.email-templates._actions', compact('emailTemplates'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(EmailTemplates $model): QueryBuilder
    {
       
        // if (auth()->user()->hasAnyRole('administrator')) {
            return $model->newQuery();
        // } else {
        //     return $model->where('user_id', auth()->user()->id)->newQuery();
        // }
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('email_templates-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/product-management/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('tags'),
            Column::make('template'),
            Column::make('slug'),
            Column::make('status'),
            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'email_templates-table';
    }
}
