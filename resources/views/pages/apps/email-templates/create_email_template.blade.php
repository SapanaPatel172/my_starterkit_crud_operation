<x-default-layout>

    @section('title')
    Create Email Templates
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Form-->
                <form id="create_email_template_form" class="form" method="POST" action="{{route('email.templates.store')}}">
                @csrf
                    <div class="d-flex">
                        <div class="col-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"  name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" />
                                <!--end::Input-->
                                @error('title')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Tags</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"  name="tags" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="tags" />
                                <!--end::Input-->
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Template</label>
                                <!--end::Label-->
                                <!--begin::Input-->

                                <textarea class="form-control" name="template" id="summernote"></textarea>

                                <!--end::Input-->
                                @error('template')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-6 ms-2">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Slug</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"  name="slug" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="slug" />
                                <!--end::Input-->
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="description" />
                                <!--end::Input-->
                                @error('description')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Status</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="status" class="form-select form-select-solid mb-3 mb-lg-0">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                    <!-- Add more options as needed -->
                                </select>
                                <!--end::Input-->
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!--end::Input group-->


                        </div>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary" name="submit">submit
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->

        </div>

        <script type="text/javascript">
            $('#summernote').summernote({
                height: 400
            });
        </script>
</x-default-layout>