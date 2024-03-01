<x-default-layout>
    @if(session('success'))
    <div class=" d-flex justify-content-end">
        <div class="alert alert-success w-25">
            {{ session('success') }}
        </div>
    </div>
    @endif
    @section('title')
    Email Templates
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('email.templates') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search email template" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-create_product-table-toolbar="base">
                    @can('create emailtemplate')
                    <!--begin::Add product-->
                    <button type="button" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        <a href="{{route('email.templates.create')}}"> <span class="text-white"> Add Email Template </span> </a>
                    </button>
                    <!--end::Add product-->
                    @endcan
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->

    </div>

    @push('scripts')
    {{ $dataTable->scripts() }}
    @endpush

   @push('scripts')
    <script>
        function deleteRecord(recordId) {
           
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '/email-templates/delete/' + recordId,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        // You may also update the UI or redirect as needed
                        $('#email_templates-table').DataTable().draw();
                    },
                    error: function(error) {
                        console.error('Error deleting record:', error);
                    }
                });
            }
        }
    </script>
@endpush

</x-default-layout>